<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/7/16
 * Time: 11:28
 */

date_default_timezone_set("Asia/Shanghai");
$id = $_GET['id'];

$db = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
mysqli_set_charset($db, "utf8");
mysqli_query($db, "SET time_zone = '+8:00'");

$sql = "delete from `shieldwords` where id=".$id;
mysqli_query($db, $sql);
echo "删除成功";
?>