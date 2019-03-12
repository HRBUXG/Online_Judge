<?php require_once ("admin-header.php");
 ini_set("display_errors", "On"); 
 error_reporting(E_ALL);
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<div>
	<br/>
	<p style="font-size:30px ">请管理员下载以下xls，并按照里面的既定格式添加学生的信息<p>
	<a href="../accountimport.xls">点我下载账号导入xls模板</a>
</div>
<br/>
<div>
	<form action="../upload_file.php?parm=acc" method="post" enctype="multipart/form-data">
       <!--<label for="file">Filename:</label>-->
       <input type="file" name="file" id="file" accept=".xls,.xlsx"/> 
       <br />
       <input type="submit" name="submit" value="Submit" />
   </form>
</body>
</div>
<?php require_once('../oj-footer.php');
?>