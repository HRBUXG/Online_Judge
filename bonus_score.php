<?php
$cache_time = 30;
$OJ_CACHE_SHARE = false;
$debug = false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
ini_set("display_errors", "Off");
require_once('./include/setlang.php');
$view_title = "Welcome To Online Judge";
$user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];
$sql = "select distinct s.problem_id,judgetime,difficulty from solution as s,problem as p where result=4 and s.problem_id=p.problem_id and user_id=" . $user_id . " order by judgetime desc";
$result = pdo_query($sql);
foreach ($result as $row) {
    $count_solved = $row['solved'];
}

?>


<?php


/////////////////////////Template
require("template/" . $OJ_TEMPLATE . "/bonus_score.php");
/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>
