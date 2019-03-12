/**
* Created by PhpStorm.
* User: macbook
* Date: 2018/10/23
* Time: 下午3:37
*/
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
$view_title = "Report Export";
$sql_ = "select count(*) from solution where nick";
$view_AC_total = Array();
$i = 0;
foreach ($result as $row) {
    $view_AC_total[$i] = Array();

}
?>