<?php
$cache_time = 30;
$OJ_CACHE_SHARE = false;
$debug = false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
ini_set("display_errors", "Off");
require_once('./include/setlang.php');
require_once('./include/online.php');
$on = new online();
$view_title = "Welcome To Online Judge";
require_once('./include/iplocation.php');
$ip = new IpLocation();
$users = $on->getAll();

$user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];
$sql = "select solved from users where user_id=" . $user_id;
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
