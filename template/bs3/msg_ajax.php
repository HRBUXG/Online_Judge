<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/27
 * Time: 18:44
 */

$con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
if (!$con) {
    die('连接失败: ' . mysqli_error($con));
}

mysqli_select_db($con, 'jol');
mysqli_query($con, "set names utf8");
mysqli_query($con,"SET time_zone = '+8:00'");

$sql = "select * from pushmsg where groupflag='true' order by sendtime desc  limit 1";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) {
    $datas[] = array("content" => $row['content'], "sendtime" => $row['sendtime']);

}
echo json_encode($datas);//以json格式编码
