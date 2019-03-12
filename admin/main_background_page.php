<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Problem</title>
<script type="text/javascript">
function preview(obj)
{
    var img = document.getElementById("previewimg");
    img.src = window.URL.createObjectURL(obj.files[0]);
}
</script>
</head>
<body leftmargin="30" >
<div class="container">

<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
include_once("kindeditor.php") ;
?>
<?php
//连接数据库
$conn=mysql_connect("localhost","root","HRBUXGOJ");
if(!$conn)
{  
     echo "连接失败";  
}  
mysql_select_db("jol",$conn);
mysql_query("set names utf8");
$sql="select main_background from main_background";  
$data=mysql_query($sql,$conn); 
$main_background=mysql_result($data,0);

?>
<!--添加主界面背景模块-->
<table align="center" border="2" bordercolor="#000000">
<form method=POST action="main_background.php" enctype="multipart/form-data"> 
<label for="file"><h2 style="color:#F00">选择上传图片：</h2></label>
<br/>
<br/>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
<input type="file" name="upfile"  onChange="preview(this)"/><br/>
源图片：<img src="<?php echo $main_background?>" width="340px" height="220"> 
&nbsp;&nbsp;&nbsp;&nbsp;
所选图片：<img src="" id="previewimg" width="340px" height="220"/>
<br/>
<input type="submit"  style=" background:#000;color:#FFF" value="上传背景" />

</form>
</table>
<?php require_once("../include/set_post_key.php");?>

</div>
</body>
</html>

