<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/3/28
 * Time: 7:56
 */

$cache_time = 30;

$OJ_CACHE_SHARE = true;

require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/memcache.php');
require_once('./include/setlang.php');
$user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];
$view_title = "Welcome To Online Judge";



/////////////////////////Template
require("template/" . $OJ_TEMPLATE . "/mypurchase.php");
/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>