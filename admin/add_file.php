<?php
require_once ("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'file_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
} ?>

<?php /*?><?php require_once ("../include/db_info.inc.php");?><?php */?>

<?php
echo"处理文件界面！";
echo "<pre>";
print_r($_FILES);

if(!empty($_FILES['upfile']['name']))
{
	if($_FILES['upfile']['error']>0)
	{
		switch ($_FILES['upfile']['error'])
		{
			case 1:
			     $errorMsg = "上传文件超过了php.ini规定的大小！";
				 break;
			case 2:
			     $errorMsg = "文件大小超过了前台表单规定大小！";
				 break;
			case 3:
			     $errorMsg = "文件上传不完整！";
				 break;
			case 4:
			     $errorMsg = "没有上传文件！";
				 break;
		}
		echo "<div style='border:solid 8px #dcdcdc; width=500px; height:80px; font-size:14px;'>
	            <div style='border-bottom:solid; font-size:20px; font-weigth:bold'>
		           发上错误！！！！
		        </div>
		        {$errorMsg}
		       </div>
		     ";
	}
	else
    {
	   echo "请书写上传代码:<br/>";
	   
	   echo "  对上传文件格式判断:<br/>";
	   
	   
	   
	   echo "  按照年月日生成文件夹来储存文件:<br/>";
	   $dirName = '../file/'.date('y.m.d');
	   //echo "$dirName";
//	   echo "<br/>";
	   if(!is_dir($dirName))
	   {
		   mkdir($dirName,0777,true);
		   if(!mkdir($dirName,0777,true))
		   {
			   echo "上传失败！请检查权限<br/>";
		   }
	   }
	   chmod($dirName,0777);
	   echo "  判断上传是否成功:<br/>";
	   if(is_uploaded_file($_FILES['upfile']['tmp_name']))
	   {
		   /*echo "<pre>";
           print_r($_FILES);
		   echo "name:";
		   print_r($_FILES['ufile']['name']);
		   echo "tmp_name:";
		   print_r($_FILES['upfile']['tmp_name']);
		   echo "<br/>";*/
		   $toFileName = $dirName.'/'.$_FILES['upfile']['name'];
		   //echo $toFileName;
		   if(move_uploaded_file($_FILES['upfile']['tmp_name'],$toFileName))
		   { 
		       /*插入数据库*/
			   $link=mysql_connect("localhost","root","HRBUXGOJ");
			   if(!$link)
			   {  
                   echo "连接失败";  
               }  
               mysql_select_db("jol",$link);
			   mysql_query("set names utf8");
			   $fname=$_FILES['upfile']['name'];
			   $fdescribe=$_POST['file_describe'];
			   $fframer=$_POST['file_framer'];
			   $fsource=$_POST['file_source'];
			   $faddress=$toFileName;
			   $fupload_time=date('Y年m月d日');
			   $fprivilege=$_POST['file_privilege'];			  
         $sql="insert into file
			   values
			  ('$fname','NULL','$faddress','$fdescribe','$fupload_time','$fframer','$fsource','NULL','$fprivilege')";       
	$result=mysql_query($sql);
			   echo $result;
               if($result) 
			   {
			       echo "<script>
				         alert('文件已添加到数据表中')
				         window.location.href='add_file_page.php';
				   </script><br>";
			   }
			   else
			       echo "<script>alert('文件没有添加进数据表，请重新输入!')</script><br>";
               mysql_close();
		       chmod($toFileName,0777);
			   echo "<script>alert('上传文件成功！');</script>>";
		   }
		   else
		   {
			  /* echo "toFileName:";
			   echo $toFileName;
			   echo "<br/>";
			   echo "tmp_name:";
			   echo $_FILES['upfile']['tmp_name'];
			   echo "<br/>";
			   echo "is_uploaded_file true or false:";
			   echo is_uploaded_file($_FILES['upfile']['tmp_name']);*/
			   echo "<script>alert('上传失败');</script>";
		   }
	   }
	   else
	   {
		   echo "<script>alert('错误！不是上传文件');</script>";
	   }   
    }

}
else
{
	 echo"<script>alert('请选择上传文件');history.go(-1)</script>";
}






?>


