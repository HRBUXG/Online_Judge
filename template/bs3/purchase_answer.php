<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/29
 * Time: 13:54
 */
date_default_timezone_set("Asia/Shanghai");
$pid = $_GET['pid'];
$user_id = $_GET['uid'];
$problem_score = $_GET['diff'];
$purchase_time = date("Y-m-d H:i:s");
$con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
if (!$con) {
    die('连接失败: ' . mysqli_error($con));
}

mysqli_select_db($con, 'jol');
mysqli_query($con, "set names utf8");
mysqli_query($con, "SET time_zone = '+8:00'");

$sql_purchase_status = "select * from purchase_record where user_id='" . $user_id . "'and problem_id =" . $pid;
$result = mysqli_query($con, $sql_purchase_status);
foreach ($result as $row) {
    $purchase_status = $row['purchase_status'];
}
$sql_user_score = "select otherscore from users where user_id='" . $user_id . "'";
$result2 = mysqli_query($con, $sql_user_score);
foreach ($result2 as $row) {
    $user_score = $row['otherscore'];
}

if ($purchase_status == 1) {
    echo 3;
} elseif ($user_score >= $problem_score && $user_score > 0) {
    $sql_update = "UPDATE `users` SET `otherscore` =`otherscore` - " . $problem_score . " WHERE `user_id`='{$user_id}'";
    $result_update = mysqli_query($con, $sql_update);
    $sql_insert = "INSERT INTO `purchase_record` (`user_id`,`problem_id`,`purchase_status`,`purchase_time`,`purchase_score`) VALUES ('{$user_id}','{$pid}','true','{$purchase_time}','{$problem_score}') ";
    $result_insert = mysqli_query($con, $sql_insert);
    echo 1;
}else{
    echo 2;
}
/*while ($row = mysqli_fetch_array($result)) {
    $datas[] = array("status" => $row['purchase_status']);

}
echo json_encode($datas);*/
