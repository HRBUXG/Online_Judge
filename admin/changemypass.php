<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/18
 * Time: 11:49
 */
require_once("admin-header.php"); ?>
<?php if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'password_setter']))) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
if (isset($_POST['do'])) {
    //echo $_POST['user_id'];
    require_once("../include/check_post_key.php");
    //echo $_POST['passwd'];
    require_once("../include/my_func.inc.php");

    $user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];
    $oldpasswd = $_POST['oldpasswd'];
    $newpasswd = $_POST['newpasswd'];
    $repeatpasswd = $_POST['repeatpasswd'];
    $sql_q = "select `password` from `users` where `user_id`='" . $user_id . "'";
    $result = pdo_query($sql_q);
    foreach ($result as $row) {
        $dbpasswd = $row['password'];
    }
    stripslashes($dbpasswd);
    header("location:index.php");

    if ($newpasswd == $repeatpasswd && $dbpasswd == md5($oldpasswd)) {
        if (get_magic_quotes_gpc()) {
            $user_id = stripslashes($user_id);
            $newpasswd = stripslashes($newpasswd);
        }
        $newpasswd = md5($newpasswd);
//    $sql = "update `users` set `password`=? where `user_id`=?  and user_id not in( select user_id from privilege where rightstr='administrator') ";
        $sql = "update `users` set `password`=? where `user_id`=? ";

        if (pdo_query($sql, $newpasswd, $user_id) == 1) echo "修改成功";
        session_destroy();

    } else if ($dbpasswd != md5($oldpasswd)) {
        echo " 旧密码不正确";

    } else {
        echo '两次密码不一致，请检查';
    }
}
?>
<div class="container">
    <form action='changemypass.php' method=post>
        <b>Reset Password:</b><br/>
        <!--	--><?php //echo $MSG_USER_ID?><!--:<input type=text size=10 name="user_id"><br />-->
        <?php echo $MSG_USER_ID;
        echo $_SESSION[$OJ_NAME . '_' . 'user_id'] ?>:
        <br/>
        <?php echo "oldpasswd" ?>:<input type=password size=10 name="oldpasswd"><br/>
        <?php echo "newpasswd" ?>:<input type=password size=10 name="newpasswd"><br/>
        <?php echo "repeatpasswd" ?>:<input type=password size=10 name="repeatpasswd"><br/>
        <?php require_once("../include/set_post_key.php"); ?>
        <input type='hidden' name='do' value='do'>
        <input type=submit value='Change'>
    </form>
</div>
