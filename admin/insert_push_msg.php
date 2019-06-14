<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/13
 * Time: 8:37
 */

/*************************************/
$uid = $_POST['uid'];
$message = $_POST['message'];
$groupflag = $_POST['groupflag'];
$sendtime = date("Y-m-d h:i:s");

echo $message;
echo $groupflag;
echo $sendtime;

$db = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
mysqli_set_charset($db, "utf8");
$sql = "insert into pushmsg(user_id,content,groupflag,sendtime) values ('{$uid}','{$message}','{$groupflag}','{$sendtime}')";
mysqli_query($db, $sql);

echo 1;


?>


