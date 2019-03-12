<?php
session_start();
//检测是否登录
if (isset($_SESSION['logined']) && $_SESSION['logined']) {
    //$_SESSION['logined']有设置，并且值为真，表示已经登录
    //echo "当前登录用户是: ".$_SESSION['user_id'];
    $id = $_SESSION['user_id'];//当前用户的id
    $id2 = (int)substr($id, 0, 2);//用户id的前两位
    // echo $id2;
}

/*?>
//<?php*/
$OJ_CACHE_SHARE = false;
$cache_time = 30;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/memcache.php');
$view_title = $MSG_RANKLIST;

$scope = "";
if (isset($_GET['scope']))
    $scope = $_GET['scope'];
if ($scope != "" && $scope != 'd' && $scope != 'w' && $scope != 'm')
    $scope = 'y';
$where = "";
if (isset($_GET['prefix'])) {
    $prefix = $_GET['prefix'];
    $where = "where user_id like ?";
} else {
    $where = "where user_id!='admin' and defunct='N' ";
}

$like = "";
$grade = $id2;
$class = "";
if (isset($_GET['grade'])) {
    $grade = $_GET['grade'];
}
if (isset($_GET['class'])) {
    $class = $_GET['class'];
}
if ($grade == "") {
    $like = " and user_id like '__0__";
} else {
    if ((int)$grade >= 16) {
        $like = " and user_id like '" . $grade . "0_";
    } else {
        $like = " and user_id like '" . $grade . "0__";
    }

}
if ($class == "") {
    $like = $like . "_" . "%' ";
} else {
    if ((int)$grade >= 16) {
        $like = $like . $class . "%' ";
    } else {
        $class = substr($class, 1);
        $like = $like . $class . "%' ";
    }
}
if ($grade == "" && $class != "") {
    $like = "";
    $hello = '年级不能为空';
    echo "<script> alert('{$hello}') </script>";
}
if ($grade == "" && $class == "") {
    $like = "";
}

$rank = 0;
if (isset($_GET ['start']))
    $rank = intval($_GET ['start']);

if (isset($OJ_LANG)) {
    require_once("./lang/$OJ_LANG.php");
}
$page_size = 50;
//$rank = intval ( $_GET ['start'] );
if ($rank < 0)
    $rank = 0;
$sql = "SELECT sum(difficulty) as score1,user_id from (SELECT distinct `difficulty`,`user_id`, problem.problem_id from `problem` right join `solution` on problem.problem_id=solution.problem_id and `result`=4 and contest_id is null) a group by user_id;";
$result = pdo_query($sql);
$num = 0;
foreach ($result as $row) {
    $num++;
}
foreach ($result as $row) {
    $sql = "select `otherscore` from users WHERE `user_id`=?";
    $temp = pdo_query($sql, $row['user_id']);
    foreach ($temp as $row3) {
        $sql = "UPDATE `users` SET `score`=? WHERE `user_id`=?";
        $row3['otherscore'] = $row3['otherscore'] + $row['score1'];
        $result3 = pdo_query($sql, $row3['otherscore'], $row['user_id']);
    }
}
//
/*$sql ="SELECT * FROM `users`
   $where user_id LIKE '$id2%'user_id LIKE '16%' and */
$sql = "SELECT `user_id`,`nick`,`solved`+`othersolved` as `solved`,`submit`+`othersolved` as `submit`,`score` FROM `users` $where  $like ORDER BY `solved` DESC,submit,reg_time  LIMIT  " . strval($rank) . ",$page_size";
if ($scope) {
    $s = "";
    switch ($scope) {
        case 'd':
            $s = date('Y') . '-' . date('m') . '-' . date('d');
            break;
        case 'w':
            //$monday=mktime(0, 0, 0, date("m"),date("d")-(date("w")+7)%8+1, date("Y"));
            $s = date('Y-m-d', strtotime('-7 days'));
            break;
        case 'm':
            $s = date('Y-m-d', strtotime('-30 days'));;
            break;
        default :
            $s = date('Y-m-d', strtotime('-365 days'));
    }
    $sql = "SELECT users.`user_id`,`nick`,s.`solved`,t.`submit`,`score` FROM `users`
                                        inner join
                                        (select count(distinct problem_id) solved ,user_id from solution 
						where in_date>str_to_date('$s','%Y-%m-%d') and result=4 
						group by user_id order by solved desc limit " . strval($rank) . ",$page_size) s 
					on users.user_id=s.user_id
                                        inner join
                                        (select count( problem_id) submit ,user_id from solution 
						where in_date>str_to_date('$s','%Y-%m-%d') 
						group by user_id order by submit desc ) t 
					on users.user_id=t.user_id
                     
                                ORDER BY s.`solved` DESC,t.submit,reg_time  LIMIT  0,50
                         ";
//                      echo $sql;
    //				新加取积分字段结束
//                      echo $sql;
}


if (isset($_GET['prefix'])) {
    $result = pdo_query($sql, $_GET['prefix'] . "%");
} else {
    $result = pdo_query($sql);
}
if ($result)
    $rows_cnt = count($result);
else
    $rows_cnt = 0;
$view_rank = Array();
$i = 0;
for ($i = 0; $i < $rows_cnt; $i++) {

    $row = $result[$i];

    $rank++;
    $sql = "SELECT  SUM(account) as count FROM otherojaccount GROUP BY user_id HAVING `user_id` = " . '"' . $row['user_id'] . '"';
    $otherojresult = pdo_query($sql);
    $view_rank[$i][0] = $rank;
    $view_rank[$i][1] = "<div class=center><a href='userinfo.php?user=" . htmlentities($row['user_id'], ENT_QUOTES, "UTF-8") . "'>" . $row['user_id'] . "</a>" . "</div>";
    $view_rank[$i][2] = "<div class=center>" . htmlentities($row['nick'], ENT_QUOTES, "UTF-8") . "</div>";
//    存入积分字段
    $view_rank[$i][3] = "<div class=center>" . htmlentities($row['score'], ENT_QUOTES, "UTF-8") . "</div>";
    $view_rank[$i][4] = "<div class=center><a href='status.php?user_id=" . htmlentities($row['user_id'], ENT_QUOTES, "UTF-8") . "&jresult=4'>" . $row['solved'] . "</a>" . "</div>";
    $view_rank[$i][5] = "<div class=center><a href='status.php?user_id=" . htmlentities($row['user_id'], ENT_QUOTES, "UTF-8") . "'>" . $row['submit'] . "</a>" . "</div>";
    if (count($otherojresult) != 0)
        $view_rank[$i][6] = "<div class=center><a href='viewotheroj.php?user_id=" . htmlentities($row['user_id'], ENT_QUOTES, "UTF-8") . "'>" . $otherojresult[0]['count'] . "</a>" . "</div>";
    else {
        $view_rank[$i][6] = "<div class=center><a href='viewotheroj.php?user_id=" . htmlentities($row['user_id'], ENT_QUOTES, "UTF-8") . "'>" . "0" . "</a>" . "</div>";
    }
    if ($row['submit'] == 0)
        $view_rank[$i][7] = "0.000%";
    else
        $view_rank[$i][7] = sprintf("%.02lf%%", 100 * $row['solved'] / $row['submit']);

//                      $i++;

}

$sql = "SELECT count(1) as `mycount` FROM `users`";
//        $result = mysql_query ( $sql );
// require("./include/memcache.php");
$result = pdo_query($sql);
$row = $result[0];
$view_total = $row['mycount'];


/////////////////////////Template
require("template/" . $OJ_TEMPLATE . "/ranklist.php");
/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>


