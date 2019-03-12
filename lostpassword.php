<?php
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title = "Welcome To Online Judge";

require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");
$lost_user_id = $_POST['user_id'];
$lost_email = $_POST['email'];
if (isset($_POST['vcode'])) $vcode = trim($_POST['vcode']);
if ($lost_user_id && ($vcode != $_SESSION[$OJ_NAME . '_' . "vcode"] || $vcode == "" || $vcode == null)) {
    echo "<script language='javascript'>\n";
    echo "alert('Verify Code Wrong!');\n";
    echo "history.go(-1);\n";
    echo "</script>";
    exit(0);
}
if (get_magic_quotes_gpc()) {
    $lost_user_id = stripslashes($lost_user_id);
    $lost_email = stripslashes($lost_email);
}
$sql = "SELECT `email` FROM `users` WHERE `user_id`=?";
$result = pdo_query($sql, $lost_user_id);
$row = $result[0];
if ($row && $row['email'] == $lost_email && strpos($lost_email, '@')) {
    $_SESSION[$OJ_NAME . '_' . 'lost_user_id'] = $lost_user_id;
    $_SESSION[$OJ_NAME . '_' . 'lost_key'] = getToken(16);

    require_once 'QQMailer.php';
// 实例化 QQMailer
    $mailer = new QQMailer(false);
// 邮件标题
    $title = 'HRBUOJ找回密码';
// 邮件内容
    $id = base64_encode($lost_user_id);
    $content = "$lost_user_id:\n您好！\n您在HRBUOJ系统选择了找回密码服务,为了验证您的身份,请进入口令重置页面以确认身份:" . "http://" . "www.hrbuacm.top" . "/verify.php" . "?parm=f&" . "id=$id" . "\n\n\n哈尔滨学院在线OJ评测系统 本页面推荐使用网页邮箱打开，已知qq邮箱手机版会出错";
// 发送QQ邮件
    $mailer->send($lost_email, $title, $content);
    $sql = "update `users` set `isrequirelost`=1 where `user_id`=?;";
    $result = pdo_query($sql, $lost_user_id);
    $view_errors = "Please look at your email addr to check urls!";
    require("template/" . $OJ_TEMPLATE . "/error.php");
} else {
    $errors = '邮箱不匹配或者错误';
    if ($row['email'] != null)
        echo "<script>alert('$errors');</script>";
    require("template/" . $OJ_TEMPLATE . "/lostpassword.php");

}
/////////////////////////Common foot
?>
