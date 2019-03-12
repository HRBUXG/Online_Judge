<?php
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title = "Welcome To Online Judge";
// ini_set("display_errors", "On");


require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");
$parm = $_GET['parm'];
$user_id = $_GET['user_id'];
if ($parm == "f") {
    $sql = "select * from `users` where `user_id`=?";
    $result = pdo_query($sql, $user_id);
    foreach ($result as $row)
        $email = $row['email'];
    $_SESSION['email'] = $email;
    require("template/" . $OJ_TEMPLATE . "/addemails.php");
    exit(0);
} else if ($parm == "") {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = " update `users` set email=? WHERE `user_id`=?";
        $result = pdo_query($sql, $email, $user_id);
        require_once 'QQMailer.php';

// 实例化 QQMailer
        $mailer = new QQMailer(false);
// 邮件标题
        $title = 'HRBUOJ激活邮件';
// 邮件内容
        $id = base64_encode($user_id);
        $content = "$user_id:\n您好！\n您在HRBUOJ系统选择了验证邮箱的服务,为了验证您的身份,请进入以下页面以确认身份:" . "http://" . "118.190.206.26" . "/addemails.php" . "?parm=s&" . "id=$id" . "\n\n\n哈尔滨学院在线OJ评测系统 本页面推荐使用网页邮箱打开，已知qq邮箱手机版会出错";
// 发送QQ邮件
        $mailer->send($email, $title, $content);
        $view_errors = "We send a email to your email please check it to verify your id!";
    } else {
        $view_errors = "email type error!!!";
    }
    require("template/" . $OJ_TEMPLATE . "/error.php");
} else if ($parm == "s" && $_GET['id'] != "") {
    $parm = $_GET['parm'];
    $user_id = base64_decode($_GET['id']);
    $sql = "update `users` set `verifyemail`=1 where `user_id`=?";
    $result = pdo_query($sql, $user_id);
    echo $result;
    echo "<script language='javascript'>\n";
    echo "alert('your email has verifyed!!');\n";
    echo "window.location.href='index.php';\n";
    echo "</script>";

}
//$view_errors = "url type error!!!you may use computer browser to open this url!!!";
//require("template/".$OJ_TEMPLATE."/error.php");
/////////////////////////Template

/////////////////////////Common foot
?>
