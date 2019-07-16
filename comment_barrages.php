<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/7/5
 * Time: 23:21
 */


$con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
if (!$con) {
    die('连接失败: ' . mysqli_error($con));
}

mysqli_select_db($con, 'jol');
mysqli_query($con, "set names utf8");
session_start();   //开启一个session会话SESSION是全局变量，只要被声明，在不关闭网页或者没有到SESSION的周期在所有页面都是可用的
$pid = $_SESSION['ppid'];
$sql = "select substring(content,1,20) as sub_content FROM comment where `content`=`content_primary` and `lock`=0 and `problem_id`=" . $pid . " order by sendtime desc";
$result = mysqli_query($con, $sql);

/*    while ($row = mysqli_fetch_array($result)) {
        $datas[] = array("user_id" => $row['user_id'], "problem_id" => $row['problem_id'], "content" => $row['content'], "sendtime" => $row['sendtime']);

    }
    echo json_encode($datas);//以json格式编码*/
while ($row = mysqli_fetch_array($result)) {
    $datas[] = array('info' => $row['sub_content'], 'href' => '');
}
$barrages =
    array(
        array(
            'info' => '第一条弹幕',
            ''
        ),
    );


echo json_encode($datas);
//echo   json_encode($barrages);