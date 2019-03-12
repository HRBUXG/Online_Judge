<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Problem</title>
</head>
<body leftmargin="30" >
<div class="container">
  <?php
require_once ("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
$conn=mysql_connect("localhost","root","HRBUXGOJ");  
if(!$conn)
{  
      echo "连接失败";  
}  
mysql_select_db("jol",$conn);  
mysql_query("set names utf8");  
?>

<?php
echo "<pre>";
   /* print_r($_FILES);
    echo "修改操作";*/
	
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
		  $sql="select main_background from main_background";  
          $data=mysql_query($sql,$conn); 
          $main_background=mysql_result($data,0);
		  
		  $dirName = '../image';
		  $toFileName = $dirName.'/'.$_FILES['upfile']['name']; 
		  $oddaddress = $main_background;
          $sql10=
		  "update main_background set main_background='$toFileName'";
	       $res10=mysql_query($sql10,$conn);
	       if($res10)
	      {
			  unlink($oddaddress);
		      ?>
                 <script>
		             alert("修改成功");
                    //window.location.href="update_playinformation_page.php";
                 </script>
                <?php 
				mysql_close();
    		    echo "  判断上传是否成功:<br>";
	            if(is_uploaded_file($_FILES['upfile']['tmp_name']))
	            {
		          
		          if(move_uploaded_file($_FILES['upfile']['tmp_name'],$toFileName))
		          { 
		              chmod($toFileName,0777);
		              echo "<script>
					           alert('上传文件成功！');
					           window.location.href='main_background_page.php';
					       </script>";
		          }
		          else
		          {
			           echo "<script>alert('上传失败');</script>";
		          }
	           }
	           else
	           {
		          echo "<script>alert('错误！不是上传文件');</script>";
	           } 
		
	      }
	      else
	      {
		      ?>
               <script>
		          alert("修改失败");
               </script>
             <?php 
	      }
		 
	   }
	}
	else
	{
		 ?>
          <script>
		      alert("请选择上传背景");
			  window.location.href='main_background_page.php';
         </script>
          <?php 
	}
?>

</div>
</body>
</html>
