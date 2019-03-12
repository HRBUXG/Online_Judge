<?php require_once("admin-header.php");?>
<?php if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
if(isset($_POST['do'])){
	require_once("../include/check_post_key.php");
	$user_id=$_POST['user_id'];
	$rightstr =$_POST['rightstr'];
	if(isset($_POST['contest'])) $rightstr="c$rightstr";
	$sql="insert into `privilege` values(?,?,'N')";
	$rows=pdo_query($sql,$user_id,$rightstr);
	echo "$user_id $rightstr added!";
	
}
?>
<div class="container">
<form method=post>
<?php require("../include/set_post_key.php");?>
	<b>Add privilege for User:</b><br />
	User:<input type=text size=10 name="user_id"><br />
<?php
//**************************************************修改开始****************************************************
/*连接数据库*/
    $conn=mysql_connect("localhost","root","HRBUXGOJ");
    if(!$conn)
    {  
          echo "连接失败";  
    }  
    mysql_select_db("jol",$conn);
    mysql_query("set names utf8");
	
$tag_privilege = array();
$sql = "select tag_privilege_name from tag_privilege";
$result = mysql_query($sql,$conn);
//var_dump ($result);
$tag_privilege = array();
while ($rows= mysql_fetch_array($result))
{
  $tag_privilege[] = $rows["tag_privilege_name"];
}
//**************************************************修改结束*****************************************************
?>
	Privilege:
	<select name="rightstr">
<?php
$rightarray=$tag_privilege;//array("administrator","problem_editor","source_browser","contest_creator","http_judge","password_setter","printer","balloon" );
while(list($key, $val)=each($rightarray)) {
	if (isset($rightstr) && ($rightstr == $val)) {
		echo '<option value="'.$val.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$val.'">'.$val.'</option>';
	}
}
?></select><br />
	<input type='hidden' name='do' value='do'>
	<input type=submit value='Add'>
	<?php echo $MSG_HELP_ADD_PRIVILEGE; ?>
</form>
<form method=post>
	<b>Add contest for User:</b><br />
	User:<input type=text size=10 name="user_id"><br />
	Contest:<input type=text size=10 name="rightstr">1000 for Contest1000<br />
	<input type='hidden' name='do' value='do'>
	<input type='hidden' name='contest' value='do'>
	<input type=submit value='Add'>
	<input type=hidden name="postkey" value="<?php echo $_SESSION[$OJ_NAME.'_'.'postkey']?>">
</form>
</div>
