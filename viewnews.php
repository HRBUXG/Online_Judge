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
$result = false;
///////////////////////////MAIN	
$sql = "select * "
    . "FROM `news` WHERE `defunct`=" . '"N"' . ";";   //修改
$result = pdo_query($sql);
$nid = $_GET['nid'];
if ($nid != "" || $nid != null) {
    $sql = "select * "
        . "FROM `news` "
        . "WHERE `news_id`=?;";
    $result = pdo_query($sql, $nid);
    $sql = "select * "
        . "FROM `news` WHERE `defunct`=" . '"N"' . " ORDER BY time DESC LIMIT 5;";
    $morenews = pdo_query($sql);
    require("template/" . $OJ_TEMPLATE . "/viewnews.php");
} else {
    $countnews = count($result);     //修改
    $page = 0;
    $pagelenth = $_GET["pl"];
    if (!isset($pagelenth)) {
        $pagelenth = 20;
    } else {
        $pagelenth = intval($pagelenth);
    }
    if ($countnews <= $pagelenth && $countnews > 0) {   //修改
        $page = 1;
    } else if ($countnews > $pagelenth) {   //修改
        $page = $countnews / $pagelenth;  //修改
        if ($page % $countnews > 0) {  //修改
            $page = $page + 1;
        }
    } else {
        $page = 0;
    }
    $nowpage = $_GET['nowpage'];
    if ($nowpage != "" || $nowpage != null) {

    } else {
        $nowpage = 1;
    }
    $sql = "select * "
        . "FROM `news` "
        . "WHERE `defunct`=" . '"N" '    //修改
        . "ORDER BY time DESC "
        . "limit "
        . (0 + ($nowpage - 1) * $pagelenth) . "," . $pagelenth;
    //echo $sql;
    $result = pdo_query($sql);
    require("template/" . $OJ_TEMPLATE . "/viewnews.php");
}
/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>
