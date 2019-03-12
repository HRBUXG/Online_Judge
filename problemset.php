<?php if (isset($OJ_ON_SITE_CONTEST_ID)) {
    header("location:index.php");
    exit();
}
?>
<?php
$OJ_CACHE_SHARE = false;
$cache_time = 60;
require_once('./include/db_info.inc.php');
require_once('./include/cache_start.php');
require_once('./include/memcache.php');
require_once('./include/setlang.php');
$view_title = "Problem Set";
$first = 1000;
//if($OJ_SAE) $first=1;
$page_cnt = 50;
if (isset($_GET['page_cnt'])) {
    $page_cnt = $_GET['page_cnt'];
    $_SESSION[$OJ_NAME . '_' . 'page_cnt'] = $page_cnt;
} else if (!isset($_SESSION[$OJ_NAME . '_' . 'page_cnt'])) {
    $_SESSION[$OJ_NAME . '_' . 'page_cnt'] = 50;
    $page_cnt = 50;
} else {
    $page_cnt = $_SESSION[$OJ_NAME . '_' . 'page_cnt'];
}
$tag = "null";
$tage_kaiguan = 0;
$h = 0;
//remember page
$page = "1";
if (isset($_GET['h'])) {
    $h = intval($_GET['h']);
}
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
    if (isset($_SESSION[$OJ_NAME . '_' . 'user_id'])) {
        $sql = "update users set volume=? where user_id=?";
        pdo_query($sql, $page, $_SESSION[$OJ_NAME . '_' . 'user_id']);
    }
} else {
    if (isset($_SESSION[$OJ_NAME . '_' . 'user_id'])) {
        $sql = "select volume from users where user_id=?";
        $result = pdo_query($sql, $_SESSION[$OJ_NAME . '_' . 'user_id']);
        $row = $result[0];
        $page = intval($row[0]);
    }
    if (!is_numeric($page) || $page < 0)
        $page = '1';
}
//end of remember page


$sub_arr = Array();
// submit
if (isset($_SESSION[$OJ_NAME . '_' . 'user_id'])) {
    $sql = "SELECT `problem_id` FROM `solution` WHERE `user_id`=?" . //  " AND `problem_id`>='$pstart'".
        // " AND `problem_id`<'$pend'".
        " group by `problem_id`";
    $result = pdo_query($sql, $_SESSION[$OJ_NAME . '_' . 'user_id']);
    foreach ($result as $row)
        $sub_arr[$row[0]] = true;
}

$acc_arr = Array();
// ac
if (isset($_SESSION[$OJ_NAME . '_' . 'user_id'])) {
    $sql = "SELECT `problem_id` FROM `solution` WHERE `user_id`=?" .
        //  " AND `problem_id`>='$pstart'".
        //  " AND `problem_id`<'$pend'".
        " AND `result`=4" .
        " group by `problem_id`";
    $result = pdo_query($sql, $_SESSION[$OJ_NAME . '_' . 'user_id']);
    foreach ($result as $row)
        $acc_arr[$row[0]] = true;
}
$limit = " limit " . ($page - 1) * $page_cnt . " , " . $page_cnt;
if (isset($_GET['search']) && trim($_GET['search']) != "") {
    $type_qian = $_GET['type'];
    $search_qian = $_GET['search'];
    if (!strcmp($type_qian, 'difficulty')) {
        $filter_sql = "  `difficulty`= " . $_GET['search'];
    } else {
        $search = "%" . ($_GET['search']) . "%";
        $filter_sql = "  ( title like ? or source like ?) ";
    }
} else if (isset($_GET['tags']) && trim($_GET['tags']) != "") {
    $tag = $_GET['tags'];
    $search = "%" . ($_GET['tags']) . "%";
    $filter_sql = "  ( tags like '%" . ($_GET['tags']) . "%' ) ";
} else {
    $filter_sql = " 1=1 ";
}
if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    $sql = "SELECT `problem_id`,`title`,`source`,`difficulty`,`submit`,`accepted`,`tags` FROM `problem` where $filter_sql order by `problem_id` ASC $limit";
} else {
    if (!isset($_SESSION[$OJ_NAME . '_' . 'level'])) {
        $_SESSION[$OJ_NAME . '_' . 'level'] = "and ( `level` ='000' )";
    }
    $now = strftime("%Y-%m-%d %H:%M", time());
    $sql = "SELECT `problem_id`,`title`,`source`,`difficulty`,`submit`,`accepted`,`tags` FROM `problem` " .
        "WHERE `defunct`='N' and $filter_sql " . $_SESSION[$OJ_NAME . '_' . 'level'] . " AND `problem_id` NOT IN(
		SELECT  `problem_id` 
		FROM contest c
		INNER JOIN  `contest_problem` cp ON c.contest_id = cp.contest_id
		AND (
			c.`end_time` >  '$now'
			OR c.private =1
		)
			AND c.`defunct` =  'N'
	) order by `problem_id` ASC $limit";
}
/*****************************************修改开始******************************************************************/
$result_tage = $result;
if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    $sql_page = "SELECT count(`problem_id`) as num FROM `problem` where" . $filter_sql;
} else {
    $sql_page = "SELECT count(`problem_id`) as num FROM `problem` where `defunct`='N' and " . $filter_sql . $_SESSION[$OJ_NAME . '_' . 'level'];
}
if (isset($_GET['search']) && trim($_GET['search']) != "") {
    if (!strcmp($type_qian, 'difficulty')) {
        $result = pdo_query($sql);
        $result_page = mysql_query_cache($sql_page);
    } else {
        $result = pdo_query($sql, $search, $search);
        $result_page = pdo_query($sql_page, $search, $search);
    }
} else if (isset($_GET['tags']) && trim($_GET['tags']) != "") {
    $tage_kaiguan = 1;
    $result = pdo_query($sql);
    $result_page = mysql_query_cache($sql_page);
} else {
    $result = mysql_query_cache($sql);
    $result_page = mysql_query_cache($sql_page);
}
$row = $result_page[0];
$cnt = $row['num'];
$cnt = $cnt / $page_cnt - 0.01;
$view_total_page = intval($cnt + 1);
if ($view_total_page == 0) $view_total_page = 1;
$cnt = 0;
$sql_tag = "SELECT  `tag1_id`,`tag1_name` from `tag1`";
$result_tag1 = pdo_query($sql_tag);
$view_tags = Array();
foreach ($result_tag1 as $temp_tag1) {
    $sql_tag = "SELECT `tag2_name` from `tag2` where `tag2_tag1_id`=" . $temp_tag1['tag1_id'];
    $result_tag2 = pdo_query($sql_tag);
    $result_tage['tag1'] = $temp_tag1['tag1_name'];
    $result_tage['tag2'] = $result_tag2;
    array_push($view_tags, $result_tage);
}
/*****************************************修改结束******************************************************************/
$view_problemset = Array();
$i = 0;
foreach ($result as $row) {
    $view_problemset[$i] = Array();
    if (isset($sub_arr[$row['problem_id']])) {
        if (isset($acc_arr[$row['problem_id']]))
            $view_problemset[$i][0] = "<div class='btn btn-success' style='text-align:center'>Y</div>";
        else
            $view_problemset[$i][0] = "<div class='btn btn-danger'>N</div>";
    } else {
        $view_problemset[$i][0] = "<div class=none> </div>";
    }
    $view_problemset[$i][1] = "<div class='center'>" . $row['problem_id'] . "</div>";;
    $view_problemset[$i][2] = "<div class='left'><a href='problem.php?id=" . $row['problem_id'] . "'>" . $row['title'] . "</a></div>";;
    $view_problemset[$i][3] = "<div class='center'><nobr>" . mb_substr($row['source'], 0, 20, 'utf8') . "</nobr></div >";
    //  添加4，改为难度系数
    $view_problemset[$i][4] = "<div class='center'><nobr>" . $row['difficulty'] . "</nobr></div >";
    //  添加4，改为难度系数 结束
    $view_problemset[$i][5] = "<div class='center'><a href='status.php?problem_id=" . $row['problem_id'] . "&jresult=4'>" . $row['accepted'] . "</a></div>";
    $view_problemset[$i][6] = "<div class='center'><a href='status.php?problem_id=" . $row['problem_id'] . "'>" . $row['submit'] . "</a></div>";
    $view_problemset[$i][7] = "<div class='center'>" . ($row['submit'] > 0 ? number_format($row['accepted'] * 100 / $row['submit'], 2) : 0) . '%' . "</div>";
    //添加 7  添加标签部分

    //判断标签是否为空
    $tagsbiao = "";
    if (!empty($row['tags'])) {
        $tags = explode(",", $row['tags']);
        foreach ($tags as $val) {
            $tagsbiao = $tagsbiao . "<button class='tags' style='border-radius:5px;border:none;background:#7fffd4;color:white;margin-top:2px;margin-left:2px'><span>" . $val . "</span></button>";
        }
    }
    $view_problemset[$i][8] = "<div class='center'>" . $tagsbiao . "</div>";
    //添加 7  添加标签部分 结束
    $i++;
}


require("template/" . $OJ_TEMPLATE . "/problemset.php");
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>
