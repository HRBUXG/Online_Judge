<?php
$OJ_CACHE_SHARE = false;
$cache_time = 60;
require_once('./include/db_info.inc.php');
require_once('./include/cache_start.php');
require_once('./include/memcache.php');
require_once('./include/setlang.php');
$view_title = "File Down";


require("template/" . $OJ_TEMPLATE . "/filedown.php");
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>