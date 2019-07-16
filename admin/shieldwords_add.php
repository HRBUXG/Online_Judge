<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/7/16
 * Time: 11:28
 */

date_default_timezone_set("Asia/Shanghai");
$shieldwords = $_GET['shieldwords'];
$addtime = date("Y-m-d H:i:s");

$db = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
mysqli_set_charset($db, "utf8");
mysqli_query($db, "SET time_zone = '+8:00'");

$sql = "insert into `shieldwords`(`keywords`,`addtime`,`status`) values ('{$shieldwords}','{$addtime}',1)";
mysqli_query($db, $sql);
echo "添加成功";
?>