<?php
$cache_time = 30;
$OJ_CACHE_SHARE = false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/const.inc.php');
require_once('./include/setlang.php');
$now = strftime("%Y-%m-%d %H:%M", time());
if (isset($_GET['cid'])) $ucid = "&cid=" . intval($_GET['cid']);
else $ucid = "";
require_once("./include/db_info.inc.php");

if (isset($OJ_LANG)) {
    require_once("./lang/$OJ_LANG.php");
}
/*****************************************添加开始***************************************************************************/
$next_page0 = "";
$next_page1 = "";
/*****************************************添加结束******************************************************************/
$pr_flag = false;
$co_flag = false;
if (isset($_GET['id'])) {
    // practice
    $id = intval($_GET['id']);
    //require("oj-header.php");
    if (!isset($_SESSION[$OJ_NAME . '_' . 'administrator']) && $id != 1000 && !isset($_SESSION[$OJ_NAME . '_' . 'contest_creator'])) {
        /*****************************************添加开始*************************************   *******/
        $sql = "SELECT * FROM `problem` WHERE `problem_id`=? AND `defunct`='N' " . $_SESSION[$OJ_NAME . '_' . 'level'] . " AND `problem_id` NOT IN (
                                SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN(
                                                SELECT `contest_id` FROM `contest` WHERE `end_time`>'$now' or `private`='1'))
                                ";
        $sql_max = "SELECT max(`problem_id`) as max FROM `problem` WHERE `defunct`='N' " . $_SESSION[$OJ_NAME . '_' . 'level'] . " AND `problem_id` NOT IN (
                                SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN(
                                                SELECT `contest_id` FROM `contest` WHERE `end_time`>'$now' or `private`='1'))
                                ";
        $sql_min = "SELECT min(`problem_id`) as min FROM `problem` WHERE `defunct`='N' " . $_SESSION[$OJ_NAME . '_' . 'level'] . " AND `problem_id` NOT IN (
                                SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN(
                                                SELECT `contest_id` FROM `contest` WHERE `end_time`>'$now' or `private`='1'))
                                ";
        /*****************************************添加结束******************************************************************/

    } else {
        $sql = "SELECT * FROM `problem` WHERE `problem_id`=?";
        /*****************************************添加开始******************************************************************/
        $sql_max = "SELECT max(`problem_id`) as max FROM `problem` ";
        $sql_min = "SELECT min(`problem_id`) as min FROM `problem` ";
        /*****************************************添加结束******************************************************************/
    }
    /*****************************************添加开始******************************************************************/
    $result_max = pdo_query($sql_max);
    $result_max = $result_max[0]['max'];
    $result_min = pdo_query($sql_min);
    $result_min = $result_min[0]['min'];
    if ($id == $result_max) {
        $next_page1 = "<a href='#'><span style='ont-size: 20px;font-weight:bold;'>下一题</span></a>";
    } else {
        $next_page1 = "<a href='problem.php?next=1&id=" . ($id + 1) . "'><span style='font-size: 20px;font-weight:bold;'>下一题</span></a>";
    }
    if ($id == $result_min) {
        $next_page0 = "<a href='#'><span style='ont-size: 20px;font-weight:bold;'>上一题</span></a>";
    } else {
        $next_page0 = "<a href='problem.php?next=0&id=" . ($id - 1) . "'><span style='font-size: 20px;font-weight:bold;'>上一题</span></a>";
    }
    /*****************************************添加结束******************************************************************/

    //echo($id.'<br>'.$result_min.$min_flag.'<br>'.$result_max.$max_flag);
    $pr_flag = true;
    $result = pdo_query($sql, $id);
} else if (isset($_GET['cid']) && isset($_GET['pid'])) {
    // contest
    $cid = intval($_GET['cid']);
    $pid = intval($_GET['pid']);

    if (!isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
        $sql = "SELECT langmask,private,defunct FROM `contest` WHERE `defunct`='N' AND `contest_id`=? AND `start_time`<='$now'";
    } else {
        $sql = "SELECT langmask,private,defunct FROM `contest` WHERE `defunct`='N' AND `contest_id`=?";
    }
    $result = pdo_query($sql, $cid);
    $rows_cnt = count($result);
    $row = ($result[0]);
    $contest_ok = true;
    if ($row[1] && !isset($_SESSION[$OJ_NAME . '_' . 'c' . $cid])) $contest_ok = false;
    if ($row[2] == 'Y') $contest_ok = false;
    if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) $contest_ok = true;
    $ok_cnt = $rows_cnt == 1;
    $langmask = $row[0];
    if ($ok_cnt != 1) {
        // not started
        $view_errors = "No such Contest!";

        require("template/" . $OJ_TEMPLATE . "/error.php");
        exit(0);
    } else {
        // started
        $sql = "SELECT * FROM `problem` WHERE `defunct`='N' AND `problem_id`=(
                        SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=? AND `num`=?
                        )";
        /*****************************************添加开始******************************************************************/
        $sql_num = "SELECT count(`problem_id`) as num FROM `contest_problem` WHERE `contest_id`=? ";
        $result = pdo_query($sql, $cid, $pid);
        $result_num = pdo_query($sql_num, $cid);
        $result_num = $result_num[0]['num'];
        if ($pid == $result_num - 1) {
            $next_page1 = "<a href='#'><span style='ont-size: 20px;font-weight:bold;'>下一题</span></a>";
        } else {
            $next_page1 = "<a href='problem.php?next=1&cid=" . $cid . "&pid=" . ($pid + 1) . "'><span style='font-size: 20px;font-weight:bold;'>下一题</span></a>";
        }
        if ($pid == 0) {
            $next_page0 = "<a href='#'><span style='ont-size: 20px;font-weight:bold;'>上一题</span></a>";
        } else {
            $next_page0 = "<a href='problem.php?next=0&cid=" . $cid . "&pid=" . ($pid - 1) . "'><span style='font-size: 20px;font-weight:bold;'>上一题</span></a>";
        }
        /*****************************************添加结束******************************************************************/
    }
    // public
    if (!$contest_ok) {
        $view_errors = "Not Invited!";
        require("template/" . $OJ_TEMPLATE . "/error.php");
        exit(0);
    }
    $co_flag = true;
} else {
    $view_errors = "<title>$MSG_NO_SUCH_PROBLEM</title><h2>$MSG_NO_SUCH_PROBLEM</h2>";
    require("template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}
if (count($result) != 1) {
    /*****************************************添加开始******************************************************************/
    if (isset($_GET['next'])) {
        $next = $_GET['next'];
        if ($next == 1) {
            if (isset($_GET['cid']) && isset($_GET['pid'])) {
                header("Location: problem.php?next=" . $next . "&cid=" . ($cid + 1)) . "&pid=" . $pid;
            } else {
                header("Location: problem.php?next=" . $next . "&id=" . ($id + 1));
            }

        } else {
            if (isset($_GET['cid']) && isset($_GET['pid'])) {
                header("Location: problem.php?next=" . $next . "&cid=" . ($cid - 1)) . "&pid=" . $pid;
            } else {
                header("Location: problem.php?next=" . $next . "&id=" . ($id - 1));
            }
        }
    }
    /*****************************************添加结束******************************************************************/
    $view_errors = "";
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "SELECT  contest.`contest_id` , contest.`title`,contest_problem.num FROM `contest_problem`,`contest` 
				WHERE contest.contest_id=contest_problem.contest_id and `problem_id`=? and defunct='N'  ORDER BY `num`";
        //echo $sql;
        $result = pdo_query($sql, $id);
        if ($i = count($result)) {
            $view_errors .= "This problem is in Contest(s) below:<br>";
            foreach ($result as $row) {
                $view_errors .= "<a href=problem.php?cid=$row[0]&pid=$row[2]>Contest $row[0]:" .
                    htmlentities($row[1], ENT_QUOTES, "utf-8")
                    . "</a><br>";
            }
        } else {
            $view_title = "<title>$MSG_NO_SUCH_PROBLEM!</title>";
            $view_errors .= "<h2>$MSG_NO_SUCH_PROBLEM!</h2>";
        }
    } else {
        $view_title = "<title>$MSG_NO_SUCH_PROBLEM!</title>";
        $view_errors .= "<h2>$MSG_NO_SUCH_PROBLEM!</h2>";
    }
    require("template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
} else {
    $row = $result[0];
    $view_title = $row['title'];
}


/////////////////////////Template
require("template/" . $OJ_TEMPLATE . "/problem.php");//问题页面

/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>
<!--我的记录开始-->
<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

////////////////////////////Common head
$cache_time = 2;
$OJ_CACHE_SHARE = false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/memcache.php');
require_once('./include/setlang.php');
$view_title = "$MSG_STATUS";


require_once("./include/my_func.inc.php");
if (isset($OJ_LANG)) {
    require_once("./lang/$OJ_LANG.php");
}
require_once("./include/const.inc.php");

if ($OJ_TEMPLATE != "classic")
    $judge_color = Array("btn gray", "btn btn-info", "btn btn-warning", "btn btn-warning", "btn btn-success", "btn btn-danger", "btn btn-danger", "btn btn-warning", "btn btn-warning", "btn btn-warning", "btn btn-warning", "btn btn-warning", "btn btn-warning", "btn btn-info");

$str2 = "";
$lock = false;
$lock_time = date("Y-m-d H:i:s", time());
$sql = "WHERE problem_id>0 ";
if (isset($_GET['cid'])) {
    $cid = intval($_GET['cid']);
    $sql = $sql . " AND `contest_id`='$cid' and num>=0 ";
    $str2 = $str2 . "&cid=$cid";
    $sql_lock = "SELECT `start_time`,`title`,`end_time` FROM `contest` WHERE `contest_id`=?";
    $result = pdo_query($sql_lock, $cid);
    $rows_cnt = count($result);
    $start_time = 0;
    $end_time = 0;
    if ($rows_cnt > 0) {
        $row = $result[0];
        $start_time = strtotime($row[0]);
        $title = $row[1];
        $end_time = strtotime($row[2]);
    }
    $lock_time = $end_time - ($end_time - $start_time) * $OJ_RANK_LOCK_PERCENT;
    //$lock_time=date("Y-m-d H:i:s",$lock_time);
    $time_sql = "";
    //echo $lock.'-'.date("Y-m-d H:i:s",$lock);
    if (time() > $lock_time && time() < $end_time) {
        //$lock_time=date("Y-m-d H:i:s",$lock_time);
        //echo $time_sql;
        $lock = true;
    } else {
        $lock = false;
    }

    //require_once("contest-header.php");
} else {
    //require_once("oj-header.php");
    if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])
        || isset($_SESSION[$OJ_NAME . '_' . 'source_browser'])
        || (isset($_SESSION[$OJ_NAME . '_' . 'user_id'])
            && (isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION[$OJ_NAME . '_' . 'user_id']))
    ) {
        if ($_SESSION[$OJ_NAME . '_' . 'user_id'] != "guest")
            $sql = "WHERE 1 ";
    } else {
        $sql = "WHERE problem_id>0 ";
    }
}
$start_first = true;
$order_str = " ORDER BY `solution_id` DESC ";


// check the top arg
if (isset($_GET['top'])) {
    $top = strval(intval($_GET['top']));
    if ($top != -1) $sql = $sql . "AND `solution_id`<='" . $top . "' ";
}

// check the problem arg
$problem_id = "";
if (isset($_GET['problem_id']) && $_GET['problem_id'] != "") {

    if (isset($_GET['cid'])) {
        $problem_id = htmlentities($_GET['problem_id'], ENT_QUOTES, 'UTF-8');
        $num = strpos($PID, $problem_id);
        $sql = $sql . "AND `num`='" . $num . "' ";
        $str2 = $str2 . "&problem_id=" . $problem_id;

    } else {
        $problem_id = strval(intval($_GET['problem_id']));
        if ($problem_id != '0') {
            $sql = $sql . "AND `problem_id`='" . $problem_id . "' ";
            $str2 = $str2 . "&problem_id=" . $problem_id;
        } else $problem_id = "";
    }
}
// check the user_id arg
$user_id = "";
if (isset($OJ_ON_SITE_CONTEST_ID) && $OJ_ON_SITE_CONTEST_ID > 0 && !isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    $_GET['user_id'] = $_SESSION[$OJ_NAME . '_' . 'user_id'];
}
if (isset($OJ_ON_SITE_CONTEST_ID) && $OJ_ON_SITE_CONTEST_ID > 0 && !isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    $_GET['user_id'] = $_SESSION[$OJ_NAME . '_' . 'user_id'];
}
if (isset($_GET['user_id'])) {
    $user_id = trim($_GET['user_id']);
    if (is_valid_user_name($user_id) && $user_id != "") {
        if ($OJ_MEMCACHE) {
            $sql = $sql . "AND `user_id`='" . addslashes($user_id) . "' ";
        } else {
            $sql = $sql . "AND `user_id`=? ";
        }
        if ($str2 != "") $str2 = $str2 . "&";
        $str2 = $str2 . "user_id=" . urlencode($user_id);
    } else $user_id = "";
}
if (isset($_GET['language'])) $language = intval($_GET['language']);
else $language = -1;

if ($language > count($language_ext) || $language < 0) $language = -1;
if ($language != -1) {
    $sql = $sql . "AND `language`='" . ($language) . "' ";
    $str2 = $str2 . "&language=" . $language;
}
if (isset($_GET['jresult'])) $result = intval($_GET['jresult']);
else $result = -1;

if ($result > 12 || $result < 0) $result = -1;
if ($result != -1 && !$lock) {
    $sql = $sql . "AND `result`='" . ($result) . "' ";
    $str2 = $str2 . "&jresult=" . $result;
}


if ($OJ_SIM) {
    // $old=$sql;
    $sql = "select * from solution solution left join `sim` sim on solution.solution_id=sim.s_id " . $sql;
    if (isset($_GET['showsim']) && intval($_GET['showsim']) > 0) {
        $showsim = intval($_GET['showsim']);
        $sql .= " and sim.sim>=$showsim";
        $str2 .= "&showsim=$showsim";
    }

    //$sql=$sql.$order_str." LIMIT 20";
} else {
    $sql = "select * from `solution` " . $sql;
}
//echo $sql;


$sql = $sql . $order_str . " LIMIT 50";
//echo $sql;


if (isset($_GET['user_id'])) {
    $result = pdo_query($sql, $user_id);
} else {
    $result = mysql_query_cache($sql);
}

if ($result) $rows_cnt = count($result);
else $rows_cnt = 0;
$top = $bottom = -1;
$cnt = 0;
if ($start_first) {
    $row_start = 0;
    $row_add = 1;
} else {
    $row_start = $rows_cnt - 1;
    $row_add = -1;
}

$view_status = Array();

$last = 0;
for ($i = 0; $i < $rows_cnt; $i++) {

    $row = $result[$i];
    //$view_status[$i]=$row;
    if ($i == 0 && $row['result'] < 4) $last = $row['solution_id'];


    if ($top == -1) $top = $row['solution_id'];
    $bottom = $row['solution_id'];
    $flag = (!is_running(intval($row['contest_id']))) ||
        isset($_SESSION[$OJ_NAME . '_' . 'source_browser']) ||
        isset($_SESSION[$OJ_NAME . '_' . 'administrator']) ||
        (isset($_SESSION[$OJ_NAME . '_' . 'user_id']) && !strcmp($row['user_id'], $_SESSION[$OJ_NAME . '_' . 'user_id']));

    $cnt = 1 - $cnt;


    $view_status[$i][0] = $row['solution_id'];

    if ($row['contest_id'] > 0) {
//                $view_status[$i][1]= "<a href='contestrank.php?cid=".$row['contest_id']."&user_id=".$row['user_id']."#".$row['user_id']."'>".$row['user_id']."</a>";
        if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']))
            $view_status[$i][1] = "<a href='contestrank.php?cid=" . $row['contest_id'] . "&user_id=" . $row['user_id'] . "#" . $row['user_id'] . "' title='" . $row['ip'] . "'>" . $row['user_id'] . "</a>";
        else
            $view_status[$i][1] = "<a href='contestrank.php?cid=" . $row['contest_id'] . "&user_id=" . $row['user_id'] . "#" . $row['user_id'] . "'>" . $row['user_id'] . "</a>";
    } else {
        //        $view_status[$i][1]= "<a href='userinfo.php?user=".$row['user_id']."'>".$row['user_id']."</a>";
        if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']))
            $view_status[$i][1] = "<a href='userinfo.php?user=" . $row['user_id'] . "' title='" . $row['ip'] . "'>" . $row['user_id'] . "</a>";
        else
            $view_status[$i][1] = "<a href='userinfo.php?user=" . $row['user_id'] . "'>" . $row['user_id'] . "</a>";
    }

    if ($row['contest_id'] > 0) {
        $view_status[$i][2] = "<div class=center><a href='problem.php?cid=" . $row['contest_id'] . "&pid=" . $row['num'] . "'>";
        if (isset($cid)) {
            $view_status[$i][2] .= $PID[$row['num']];
        } else {
            $view_status[$i][2] .= $row['problem_id'];
        }
        $view_status[$i][2] .= "</div></a>";
    } else {
        $view_status[$i][2] = "<div class=center><a href='problem.php?id=" . $row['problem_id'] . "'>" . $row['problem_id'] . "</a></div>";
    }
    switch ($row['result']) {
        case 4:
            $MSG_Tips = $MSG_HELP_AC;
            break;
        case 5:
            $MSG_Tips = $MSG_HELP_PE;
            break;
        case 6:
            $MSG_Tips = $MSG_HELP_WA;
            break;
        case 7:
            $MSG_Tips = $MSG_HELP_TLE;
            break;
        case 8:
            $MSG_Tips = $MSG_HELP_MLE;
            break;
        case 9:
            $MSG_Tips = $MSG_HELP_OLE;
            break;
        case 10:
            $MSG_Tips = $MSG_HELP_RE;
            break;
        case 11:
            $MSG_Tips = $MSG_HELP_CE;
            break;
        default:
            $MSG_Tips = "";

    }

    $view_status[$i][3] = "<span class='hidden' style='display:none' result='" . $row['result'] . "' ></span>";
    if (intval($row['result']) == 11 && ((isset($_SESSION[$OJ_NAME . '_' . 'user_id']) && $row['user_id'] == $_SESSION[$OJ_NAME . '_' . 'user_id']) || isset($_SESSION[$OJ_NAME . '_' . 'source_browser']))) {
        $view_status[$i][3] .= "<a href='ceinfo.php?sid=" . $row['solution_id'] . "' class='" . $judge_color[$row['result']] . "'  title='$MSG_Tips'>" . $MSG_Compile_Error . "";

        if ($row['result'] != 4 && isset($row['pass_rate']) && $row['pass_rate'] > 0 && $row['pass_rate'] < .98)
            $view_status[$i][3] .= (100 - $row['pass_rate'] * 100) . "%</a>";
        else
            $view_status[$i][3] .= "</a>";

    } else if ((((intval($row['result']) == 5 || intval($row['result']) == 6) && $OJ_SHOW_DIFF) || $row['result'] == 10 || $row['result'] == 13) && ((isset($_SESSION[$OJ_NAME . '_' . 'user_id']) && $row['user_id'] == $_SESSION[$OJ_NAME . '_' . 'user_id']) || isset($_SESSION[$OJ_NAME . '_' . 'source_browser']))) {
        $view_status[$i][3] .= "<a href='reinfo.php?sid=" . $row['solution_id']
            . "' class='" . $judge_color[$row['result']] . "' title='$MSG_Tips'>" . $judge_result[$row['result']] . "";
        if ($row['result'] != 4 && isset($row['pass_rate']) && $row['pass_rate'] > 0 && $row['pass_rate'] < .98)
            $view_status[$i][3] .= (100 - $row['pass_rate'] * 100) . "%</a>";
        else
            $view_status[$i][3] .= "</a>";

    } else {
        if (!$lock || $lock_time > $row['in_date'] || $row['user_id'] == $_SESSION[$OJ_NAME . '_' . 'user_id']) {
            if ($OJ_SIM && $row['sim'] > 80 && $row['sim_s_id'] != $row['s_id']) {
                $view_status[$i][3] .= "<span class='" . $judge_color[$row['result']] . "'  title='$MSG_Tips'>*" . $judge_result[$row['result']] . "";
                if ($row['result'] != 4 && isset($row['pass_rate']) && $row['pass_rate'] > 0 && $row['pass_rate'] < .98)
                    $view_status[$i][3] .= (100 - $row['pass_rate'] * 100) . "%</span>";
                else
                    $view_status[$i][3] .= "</span>";

                if (isset($_SESSION[$OJ_NAME . '_' . 'source_browser'])) {

                    $view_status[$i][3] .= "<a href=comparesource.php?left=" . $row['sim_s_id'] . "&right=" . $row['solution_id'] . "  class='btn-info'  target=original>" . $row['sim_s_id'] . "(" . $row['sim'] . "%)</a>";
                } else {

                    $view_status[$i][3] .= "<span class='btn-info'>" . $row['sim_s_id'] . "</span>";

                }
                if (isset($_GET['showsim']) && isset($row['sim_s_id'])) {
                    $view_status[$i][3] .= "<span sid='" . $row['sim_s_id'] . "' class='original'></span>";

                }
            } else {

                $view_status[$i][3] .= "<span class='" . $judge_color[$row['result']] . "'  title='$MSG_Tips'>" . $judge_result[$row['result']] . "";
                if ($row['result'] != 4 && isset($row['pass_rate']) && $row['pass_rate'] > 0 && $row['pass_rate'] < .98)
                    $view_status[$i][3] .= (100 - $row['pass_rate'] * 100) . "%</span>";
                else
                    $view_status[$i][3] .= "</span>";
            }
        } else {
            $view_status[$i][3] = "----";
        }


    }
    if (isset($_SESSION[$OJ_NAME . '_' . 'http_judge'])) {
        $view_status[$i][3] .= "<form class='http_judge_form form-inline' >
					<input type=hidden name=sid value='" . $row['solution_id'] . "'>";
        $view_status[$i][3] .= "</form>";
    }


    if ($flag) {


        if ($row['result'] >= 4) {
            $view_status[$i][4] = "<div id=center class=red>" . $row['memory'] . "</div>";
            $view_status[$i][5] = "<div id=center class=red>" . $row['time'] . "</div>";
            //echo "=========".$row['memory']."========";
        } else {
            $view_status[$i][4] = "---";
            $view_status[$i][5] = "---";

        }
        //echo $row['result'];
        if (!(isset($_SESSION[$OJ_NAME . '_' . 'user_id']) && strtolower($row['user_id']) == strtolower($_SESSION[$OJ_NAME . '_' . 'user_id']) || isset($_SESSION[$OJ_NAME . '_' . 'source_browser']))) {
            $view_status[$i][6] = $language_name[$row['language']];
        } else {

            $view_status[$i][6] = "<a target=_blank href=showsource.php?id=" . $row['solution_id'] . ">" . $language_name[$row['language']] . "</a>";
            if ($row["problem_id"] > 0) {
                if ($row['contest_id'] > 0) {
                    $view_status[$i][6] .= "/<a target=_self href=\"submitpage.php?cid=" . $row['contest_id'] . "&pid=" . $row['num'] . "&sid=" . $row['solution_id'] . "\">Edit</a>";
                } else {
                    $view_status[$i][6] .= "/<a target=_self href=\"submitpage.php?id=" . $row['problem_id'] . "&sid=" . $row['solution_id'] . "\">Edit</a>";
                }
            }
        }
        $view_status[$i][7] = $row['code_length'] . " B";

    } else {
        $view_status[$i][4] = "----";
        $view_status[$i][5] = "----";
        $view_status[$i][6] = "----";
        $view_status[$i][7] = "----";
    }
    $view_status[$i][8] = $row['in_date'];
    $view_status[$i][9] = $row['judger'];


}

?>

<?php
/////////////////////////Template

/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>


<!--我的记录结束-->