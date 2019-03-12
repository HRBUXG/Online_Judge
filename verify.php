<?php
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title = "Welcome To Online Judge";
// ini_set("display_errors", "On"); 
//error_reporting(E_ALL);
require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");
$parm = $_GET['parm'];
$id = $_GET['id'];
if ($parm != "") {
    $id = base64_decode($id);
    $sql = "select * from `users` where `user_id`=?;";
    $result = pdo_query($sql, $id);
    if ($result[0]['isrequirelost'] == 1) {
        $sql = "update `users` set `isrequirelost`=0 where `user_id`=?;";
        $result = pdo_query($sql, $id);
        require_once("template/" . $OJ_TEMPLATE . "/verify.php");
    } else {
        echo "<script language='javascript'>\n";
        echo "alert('You are not require for lostpassword!');\n";
        echo "</script>";
        echo "<a href='loginpage.php'>return to loginpage</a>";
        exit(0);
    }
} else {
    $lost_user_id = $_POST['id'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $vcode = trim($_POST['vcode']);
    if ($vcode != $_SESSION[$OJ_NAME . '_' . "vcode"] || $vcode == "" || $vcode == null) {
        echo "<script language='javascript'>\n";
        echo "alert('Verify Code Wrong!');\n";
        echo "history.go(-1);\n";
        echo "</script>";
        exit(0);
    }
    if (get_magic_quotes_gpc()) {
        $lost_user_id = stripslashes($lost_user_id);
    }
    $sql = " update `users` set password=? WHERE `user_id`=?";
    if ($password == $repassword) {
        $result = pdo_query($sql, md5($repassword), $lost_user_id);
        $view_errors = "Password Reseted to the key you've just inputed.Click <a href=index.php>Here</a> to login!";
    } else {
        $view_errors = "Password Reset Fail password does not match the repassword!";
    }
    require("template/" . $OJ_TEMPLATE . "/error.php");
}

// require("template/".$OJ_TEMPLATE."/error.php");
/////////////////////////Template

/////////////////////////Common foot
?>
