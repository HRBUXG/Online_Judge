<?php
////////////////////////////Common head
$cache_time = 30;
$OJ_CACHE_SHARE = true;
ini_set("display_errors", "On");
error_reporting(E_ALL);
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/memcache.php');
require_once('./include/setlang.php');
$view_title = "Welcome To Online Judge";
///////////////////////////MAIN	
$user_id = $_GET["user_id"];
$p = $_GET["p"];
if ($user_id != null && !isset($p)) {
    $sql = "select platformname,sum(account) as account  from `otherojaccount` group by platformname,user_id having user_id = " . '"' . $user_id . '"';
    $result2 = pdo_query($sql);
    require_once("template/bs3/viewotheroj.php");
} else if (!isset($user_id)) {
    echo "no such user";
    echo "<br/>";
    echo "<a href='index.php'>cilck here return to main page</a>";
} else {
    $sql = "select  *  from `otherojaccount` where user_id =" . '"' . $user_id . '"' . " and platformname = $p order by account desc";
    $result3 = pdo_query($sql);
    require_once("template/bs3/viewotheroj.php");
}
/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>
