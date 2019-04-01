<?php
$con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
if (!$con) {
    die('连接失败: ' . mysqli_error($con));
}

mysqli_select_db($con, 'jol');
mysqli_query($con, "set names utf8");
session_start();   //开启一个session会话SESSION是全局变量，只要被声明，在不关闭网页或者没有到SESSION的周期在所有页面都是可用的
$pid = $_SESSION['ppid'];
$sql = "select * FROM comment where problem_id=" . $pid;
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) {
    $datas[] = array("user_id" => $row['user_id'], "problem_id" => $row['problem_id'], "content" => $row['content'], "sendtime" => $row['sendtime']);

}
echo json_encode($datas);//以json格式编码
