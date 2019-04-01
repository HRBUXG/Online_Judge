<?php
$con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
if (!$con) {
    die('连接失败: ' . mysqli_error($con));
}
mysqli_select_db($con, 'jol');
mysqli_query($con, "set names utf8");
$sql = " INSERT INTO comment (user_id,problem_id,content,sendtime)
VALUES('$_POST[user_id]','$_POST[problem_id]','$_POST[content]','$_POST[sendtime]') ";
mysqli_query($con, $sql);
echo "发表成功";

mysqli_close($con);
?>