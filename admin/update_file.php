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
video update
<?php
$conn=mysql_connect("localhost","root","HRBUXGOJ");  
if(!$conn)
{  
      echo "连接失败";  
}  
mysql_select_db("jol",$conn);  
mysql_query("set names utf8");  


$id = $_GET["file_id"];
$flag = $_GET["flag"];
echo "flag: ".$flag."</br>";
echo "id: ".$id."</br>";
if($flag=="del")
{
	echo "进行删除操作:</br>";
	
	
	$sql2="select file_address from file where file_id='$id'";
	$res1=mysql_query($sql2,$conn);
	$address=mysql_result($res1,0);
	echo "address:".$address;
	
	$sql1="delete from file where file_id='$id'";
	$res=mysql_query($sql1,$conn);
	//echo "delete result: ".$res;
	
	if($res)
	{
		unlink($address);
		?>
		<script>
		  alert("删除成功");
          window.location.href="update_file_page.php";
        </script>
        <?php 
		
	}
	else
	{
		?>
		<script>
		  alert("删除失败");
		 //window.location.href="video_update_page.php";
        </script> 
        <?php 
	}
	
}
if($flag=="update")
{
	 $sql="select file_address from file where file_id='$id'";  
     $data=mysql_query($sql,$conn); 
     $address=mysql_result($data,0);
	 echo "address:".$address;
	  
	 $sql9="select file_name from file where file_id='$id'";  
     $res9=mysql_query($sql9,$conn);
	 $name=mysql_result($res9,0);
	 echo $name;
	 
	 $sql8="select file_describe from file where file_id='$id'";  
     $res8=mysql_query($sql8,$conn);
	 $describe=mysql_result($res8,0);
	 echo $describe;
	 
	 $sql4="select file_framer from file where file_id='$id'";  
     $res3=mysql_query($sql4,$conn);
	 $framer=mysql_result($res3,0);
	 echo $framer;
	 
	 $sql5="select file_source from file where file_id='$id'";  
     $res4=mysql_query($sql5,$conn);
	 $source=mysql_result($res4,0); 
	 echo $source;
	
	$select_file_privilege="select file_privilege from file where file_id='$id'";  
     $select_file_privilege_result=mysql_query($select_file_privilege,$conn);
	 $privilege=mysql_result($select_file_privilege_result,0); 
	 //echo $privilege; 
	?>
    <h2 align="center" style="color:#F00">
       修改<?php echo $name?>的信息：
    </h2>
    <form method=POST  action="update_file.php?flag=upd&id=<?php echo $id?>&oldname=<?php echo $address;?>" enctype="multipart/form-data" >
       <table border="2" bordercolor="#000000" width="500" align="center" height="250">
        <tr>
              <td><p>文件名：</p></td>
              <td><input type="text" value="<?php echo $name?>" name="f_name"></td>
         </tr>
         <tr>
              <td><p>文件描述：</p></td>
              <td><!--<input type="text" value="<?php echo $describe?>" name="f_describe">-->
                <?php   
	            //搜索数据库找标签
	            $select_file_describe="select tag_file_describe from tag_file_describe";  
                $file_describe_res=mysql_query($select_file_describe,$conn);
	            $rows=mysql_affected_rows($conn);//获取行数  
                $colums=mysql_num_fields($conn);//获取列数 
   
                ?>
                <select name="f_describe" >
                  <?php
			   
                     while($row=mysql_fetch_row($file_describe_res))
		             {   
                  ?>    
                        <option <?php if($row[0]==$describe){echo("selected");}?> value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
                  <?php  
                     }  						
						
	              ?>
                </select>
              </td>
         </tr>
         <tr>
              <td><p>文件发布者：</p></td>
              <td><!--<input type="text" value="<?php echo $framer?>" name="f_farmer">-->
                  <?php   
	            //搜索数据库找标签
	            $select_file_framer="select tag_file_framer from tag_file_framer";  
                $file_framer_res=mysql_query($select_file_framer,$conn);
	            $rows=mysql_affected_rows($conn);//获取行数  
                $colums=mysql_num_fields($conn);//获取列数 
   
                ?>
                <select name="f_framer" >
                  <?php
			   
                     while($row=mysql_fetch_row($file_framer_res))
		             {   
                  ?>    
                        <option <?php if($row[0]==$framer){echo("selected");}?> value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
                  <?php  
                     }  						
						
	              ?>
                </select>
              </td>
         </tr>
         <tr>
              <td><p>文件来源</p></td>
              <td><!--<input type="text" value="<?php echo $source?>" name="f_source">-->
                  <?php   
	            //搜索数据库找标签
	            $select_file_source="select tag_file_source from tag_file_source";  
                $file_source_res=mysql_query($select_file_source,$conn);
	            $rows=mysql_affected_rows($conn);//获取行数  
                $colums=mysql_num_fields($conn);//获取列数 
   
                ?>
                <select name="f_source" >
                  <?php
			   
                     while($row=mysql_fetch_row($file_source_res))
		             {   
                  ?>    
                        <option <?php if($row[0]==$source){echo("selected");}?> value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
                  <?php  
                     }  						
						
	              ?>
                </select>
              </td>
         </tr>
	 <tr>
              <td><p>文件权限</p></td>
              <td><!--<input type="text" value="<?php echo $privilege?>" name="f_source">-->
                  <?php   
	            //搜索数据库找标签
	            $select_file_privilege="select tag_privilege_name from tag_privilege";  
                $file_privilege_res=mysql_query($select_file_privilege,$conn);
	            $rows=mysql_affected_rows($conn);//获取行数  
                $colums=mysql_num_fields($conn);//获取列数 
   
                ?>
                <select name="f_privilege" >
                  <?php
			   
                     while($row=mysql_fetch_row($file_privilege_res))
		             {   
                  ?>    
                        <option <?php if($row[0]==$privilege){echo("selected");}?> value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
                  <?php  
                     }  						
						
	              ?>
                </select>
              </td>
         </tr>
	 <tr>
              <td><input type="button" value="返回" onClick="back()"></td>
              <td><input type="submit" value="修改"></td>
         </tr>
       </table>
     </form> 
<?php 
}
if($flag=="upd")
{
    echo "修改操作";
	$oldname=$_GET["oldname"];
	$f_name = $_POST["f_name"];
	$f_describe = $_POST["f_describe"];
	$f_framer = $_POST["f_framer"];
        $f_source = $_POST["f_source"];
	$f_privilege = $_POST["f_privilege"];
	$f_id = $_GET["id"];
	//newname
	echo "url:".dirname($oldname)."</br>";
	$newname=dirname($oldname)."/".$f_name;
	
	echo "name:".$f_name."</br>";
	echo "discribe:".$f_describe."</br>";
	echo "framer:".$f_framer."</br>";
	echo "source:".$f_source."</br>";
	
	echo "oldname:".$oldname."</br>";
	echo "newname:".$newname."</br>";
	
	$sql7="update file set 
	file_name='$f_name',file_describe='$f_describe'
	,file_framer='$f_framer',file_source='$f_source',file_address='$newname',file_privilege='$f_privilege'
	where file_id='$f_id'";
	$res6=mysql_query($sql7,$conn);
	if(rename($oldname,$newname))
	{
		echo "成功重命名";
	}
	if($res6)
	{
		
		?>
		<script>
		  alert("修改成功");
          window.location.href="update_file_page.php";
        </script>
        <?php 
		
	}
	else
	{
		?>
		<script>
		  alert("修改失败");
		 //window.location.href="video_update_page.php";
        </script> 
        <?php 
	}
}


?>
 
 </div>
 <script>
    function back()
	{

		window.location.href='update_file_page.php';
	}
	//function update()
//	{
//		var flagup="upd";
//		window.location.href='video_update.php?flag='+flagup;
//	}
 </script>
</body>
</html>

