<?php
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/memcache.php');
require_once('./include/setlang.php');
ini_set("display_errors", "On");
error_reporting(E_ALL);
$nid = $_GET["nid"];
if ($_GET["nid"] == $_POST["news_id"]) {
} else {
    if (isset($_COOKIE["\"" . $_POST["news_id"] . "\""])) {
    } else {
        setcookie("\"" . $_POST["news_id"] . "\"", "1", time() + 3600);
        $sql = "update news set view = view +1 where news_id = ?;";
        pdo_query($sql, $_POST["news_id"]);
    }
}
//header('Location: viwenews.php?nid='.$news_id);
?>