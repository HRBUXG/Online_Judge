<?php
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
//require_once("./include/db_info.inc.php");
//require_once("./include/my_func.inc.php");
$view_title = "Welcome To Online Judge";
//ini_set("display_errors", "On");
//error_reporting(E_ALL);
require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");
$parm = $_GET['parm'];
$user_id = $_GET['user_id'];
if ($parm == "c") {
    require("template/" . $OJ_TEMPLATE . "/importchangepass.php");
    //exit(0);
} else if ($parm == "") {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $sql = "select * from `users` where `user_id`=?";
    $resultset = pdo_query($sql, $user_id);
    if (pwCheck($password, $resultset[0]['password'])) {
        echo "<script language='javascript'>\n";
        echo "alert('your repassword is eq to default password change password fail!!!');\n";
        echo "window.location.href='loginpage.php';\n";
        echo "</script>";
        exit(0);
    } else {
        $passwordlen = strlen(strval($password));
        if ($passwordlen < 6) {
            echo "<script language='javascript'>\n";
            echo "alert('your repassword is too short less than 6!!!');\n";
            echo "window.location.href='loginpage.php';\n";
            echo "</script>";
            exit(0);
        }
        if ($passwordlen > 20) {
            echo "<script language='javascript'>\n";
            echo "alert('your repassword is too long more than 20!!!');\n";
            echo "window.location.href='loginpage.php';\n";
            echo "</script>";
            exit(0);
        }
        $sql = "update  `users` set `password` = ?,`isimportacc` = 0 where `user_id`=?";
        $resultset = pdo_query($sql, md5($password), $user_id);
        echo "<script language='javascript'>\n";
        echo "alert('your password is changed successfully!!!');\n";
        echo "window.location.href='loginpage.php';\n";
        echo "</script>";
        exit(0);
    }
}
//$view_errors = "url type error!!!you may use computer browser to open this url!!!";
//require("template/".$OJ_TEMPLATE."/error.php");
/////////////////////////Template

/////////////////////////Common foot
?>
