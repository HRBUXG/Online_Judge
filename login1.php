<?php
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
$sql1 = "SELECT * FROM `users` WHERE `user_id`=?";
$result1 = pdo_query($sql1, $user_id);
if ($result1[0]['isimportacc'] == 1) {
    if (pwCheck($password, $result1[0]['password'])) {
        echo "<script language='javascript'>\n";
        echo "alert('your account is imported plez change password first!');\n";
        echo "window.location.href='importchangepass.php?user_id=$user_id&parm=c';\n";
        echo "</script>";
        exit(0);
    }
} else {
}
if ($result1[0]['verifyemail'] != 0) {
} else {

    if (pwCheck($password, $result1[0]['password'])) {
        echo "<script language='javascript'>\n";
        echo "alert('please input your email address!');\n";
        echo "window.location.href='addemails.php?user_id=$user_id&parm=f';\n";
        echo "</script>";
        exit(0);
    }
}
?>
