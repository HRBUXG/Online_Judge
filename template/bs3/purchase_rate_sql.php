<?php
$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');//连接数据库//host: 主机//username：用户名//passwd：用户密码//dbname：数据库名
$con->query("SET NAMES utf8");//定义字符编码
//problem_id 自行赋值、
$user_id = $_GET['uid'];
$sql = "select count(user_id) num from purchase_record where user_id=" . $user_id;
$result = mysqli_query($con, $sql);//建立数据库连接
foreach ($result as $row) {
    $num = $row['num'];
}
$sql2 = "select max(num) alln from (select user_id,count(user_id) num from purchase_record group by user_id) t";
$result2 = mysqli_query($con, $sql2);//建立数据库连接
foreach ($result2 as $row) {
    $alln = $row['alln'];
}
$rate = $num * 100 / $alln;

echo round($rate, 2);//将数值转换成json数据存储格式
?>
