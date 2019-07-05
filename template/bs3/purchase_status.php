<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/29
 * Time: 13:57
 */
$pid = $_GET['pid'];
$user_id = $_GET['uid'];
$con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
if (!$con) {
    die('连接失败: ' . mysqli_error($con));
}

mysqli_select_db($con, 'jol');
mysqli_query($con, "set names utf8");
mysqli_query($con, "SET time_zone = '+8:00'");

$sql_purchase_status = "select * from purchase_record where user_id='" . $user_id . "'and problem_id =" . $pid;
$result = mysqli_query($con, $sql_purchase_status);

echo json_encode($datas);//以json格式编码*/
foreach ($result as $row) {
    $purchase_status = $row['purchase_status'];
    echo $purchase_status;
}

