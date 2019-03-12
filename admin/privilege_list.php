<?php require("admin-header.php");
require_once("../include/set_get_key.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
echo "<title>Privilege List</title>"; 
echo "<div class='container'>";
//************************************************修改开始***************************************************
if(isset($_GET['keyword']))
{
	$keyword=$_GET['keyword'];
	$keyword="%$keyword%";
	$sql="select * FROM privilege where concat(user_id,rightstr)like ? and rightstr in (select tag_privilege_name from tag_privilege)";
    $result=pdo_query($sql,$keyword) ;
}
else
{
    $sql="select * FROM privilege where rightstr in (select tag_privilege_name from tag_privilege) ";
    $result=pdo_query($sql) ;
}
?>
<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
      <h2><?php echo $MSG_PRIVILEGE.$MSG_LIST?></h2>
</div>
<br>
<form action="privilege_list.php" class="center">
  <input name="keyword" type="text">
  <input type="submit" value="<?php echo $MSG_SEARCH?>">
</form>
<?php
//************************************************修改结束***************************************************


echo "<center><table class='table table-striped' width=60% border=1>";
echo "<thead><tr><td>user<td>right<td>defunc</tr></thead>";
foreach($result as $row){
	echo "<tr>";
	echo "<td>".$row['user_id'];
	echo "<td>".$row['rightstr'];
//	echo "<td>".$row['start_time'];
//	echo "<td>".$row['end_time'];
//	echo "<td><a href=contest_pr_change.php?cid=$row['contest_id']>".($row['private']=="0"?"Public->Private":"Private->Public")."</a>";
	echo "<td><a href=privilege_delete.php?uid={$row['user_id']}&rightstr={$row['rightstr']}&getkey=".$_SESSION[$OJ_NAME.'_'.'getkey'].">Delete</a>";
//	echo "<td><a href=contest_edit.php?cid=$row['contest_id']>Edit</a>";
//	echo "<td><a href=contest_add.php?cid=$row['contest_id']>Copy</a>";
	echo "</tr>";
}
echo "</table></center></div>";

?>
