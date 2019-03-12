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

?>


<?php


/////////////////////////Template
require("template/" . $OJ_TEMPLATE . "/onlineuser.php");
/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>
