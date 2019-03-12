<?php
$uid = $_GET['uid'];
if ($_GET['do'] == 'check') {
    $db = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
    // $uid = $_SESSION[$OJ_NAME.'_'.'user_id'];
    $date = date("Y-m-d");  //当前时间
    $getDay = "SELECT `check_time` FROM `sign` WHERE `user_id`='{$uid}' ORDER BY `check_time` DESC limit 1 ";   //查询签到时间
    $day = $db->query($getDay);
    $days = $day->fetch_array(MYSQLI_ASSOC);
    // echo $days['check_time'];
    if (empty($days['check_time'])) {
        echo 1;
    } else if ($days['check_time'] != $date) {
        echo 1;
    } else if ($days['check_time'] == $date) {
        echo 2;
    }
}

if ($_GET['do'] == 'sign') {
    $db1 = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
    //$uid = $_SESSION[$OJ_NAME.'_'.'user_id'];
    $date = date("Y-m-d");  //当前时间

    $insertSql = "INSERT INTO `sign` (`user_id`,`check_time`) VALUES ('{$uid}','{$date}') ";
    $insert = $db1->query($insertSql);

    $db2 = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
    $updateSignSql = "UPDATE `users` SET `score` =`score` + 1 WHERE `user_id` = {$uid} ";
    $db2->query($updateSignSql);

}
?>
