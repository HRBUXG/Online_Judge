<?php require_once ("admin-header.php");
require_once("../include/check_post_key.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'news_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php require_once ("../include/db_info.inc.php");
require_once("../include/my_func.inc.php");
?>

<?php // contest_id


$title = $_POST ['title'];
$content = $_POST ['content'];
$user_id=$_SESSION[$OJ_NAME.'_'.'user_id'];
if (get_magic_quotes_gpc ()) {
	$title = stripslashes ( $title);
	$content = stripslashes ( $content );
}
$title=RemoveXSS($title);
$content=RemoveXSS($content);

$sql="insert into news(`user_id`,`title`,`content`,`time`) values(?,?,?,now())";
pdo_query($sql,$user_id,$title,$content);
echo "<script>window.location.href=\"news_list.php\";</script>";
?>

