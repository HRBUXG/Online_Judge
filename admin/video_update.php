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
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'video_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
  video update
  <?php
$link_video_update=mysql_connect("localhost","root","HRBUXGOJ");  
if(!$link_video_update)
{  
      echo "连接失败";  
}  
mysql_select_db("jol",$link_video_update);  
mysql_query("set names utf8");  


$id = $_GET["video_id"];
$flag = $_GET["flag"];
echo "id: ".$id."</br>";
echo "flag: ".$flag."</br>";

if($flag=="del")
{
	//echo "进行删除操作:</br>";
	//echo "name: ".$name."</br>";
	$sql="select video_address from video where video_id='$id'";  
    $data=mysql_query($sql,$link_video_update); 
    $address=mysql_result($data,0);
	echo "address:".$address;
	
	$delete_video="delete from video where video_id='$id'";
	$delete_video_result=mysql_query($delete_video,$link_video_update);
	//echo "delete result: ".$res;
	if($delete_video_result)
	{	
	     unlink($address);
		?>
  <script>
		  alert("删除成功");
          window.location.href="video_update_page.php";
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
	 $sql="select video_address from video where video_id='$id'";  
     $data=mysql_query($sql,$link_video_update); 
     $address=mysql_result($data,0);
	 //echo "address:".$address;
	  
	 $select_video_name="select video_name from video where video_id='$id'";  
     $select_video_name_result=mysql_query($select_video_name,$link_video_update);
	 $name=mysql_result($select_video_name_result,0);
	 //name
	  
	 $select_video_describe="select video_describe from video where video_id='$id'";  
     $select_video_describe_result=mysql_query($select_video_describe,$link_video_update);
	 $describe=mysql_result($select_video_describe_result,0);
	 //echo $describe;
	 
	 $select_video_framer="select video_framer from video where video_id='$id'";  
     $select_video_framer_result=mysql_query($select_video_framer,$link_video_update);
	 $framer=mysql_result($select_video_framer_result,0);
	// echo $framer;
	 
	 $select_video_source="select video_source from video where video_id='$id'";  
     $select_video_source_result=mysql_query($select_video_source,$link_video_update);
	 $source=mysql_result($select_video_source_result,0); 
	 //echo $source;

	$select_video_privilege="select video_privilege from video where video_id='$id'";  
     $select_video_privilege_result=mysql_query($select_video_privilege,$link_video_update);
	 $privilege=mysql_result($select_video_privilege_result,0); 
	 //echo $privilege;	 
	?>
  <h2 align="center" style="color:#F00"> 修改<?php echo $name?>的信息： </h2>
  <form method=POST  action="video_update.php?flag=upd&id=<?php echo $id;?>&oldname=<?php echo $address;?>" enctype="multipart/form-data" >
    <table border="2" bordercolor="#000000" width="500" align="center" height="250">
      <tr>
        <td><p>视频名：</p></td>
        <td><input type="text" value="<?php echo $name?>" name="v_name"></td>
      </tr>
<tr>
        <td><p>视频描述：</p></td>
        <td><!--<input type="text" value="<?php echo $describe?>" name="v_describe">-->
            <?php   
	         //搜索数据库找标签
	         $select_video_describe="select tag_video_describe from tag_video_describe";  
             $video_describe_res=mysql_query($select_video_describe,$link_video_update);
	         $rows=mysql_affected_rows($link_video_update);//获取行数  
             $colums=mysql_num_fields($link_video_update);//获取列数 
   
             ?>
             <select name="v_describe" >
               <?php
			   
                  while($row=mysql_fetch_row($video_describe_res))
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
        <td><p>视频发布者：</p></td>
        <td><!--<input type="text" value="<?php echo $framer?>" name="v_farmer">-->
             <?php   
	         //搜索数据库找标签
	         $select_video_framer="select tag_video_framer from tag_video_framer";  
             $video_framer_res=mysql_query($select_video_framer,$link_video_update);
	         $rows=mysql_affected_rows($link_video_update);//获取行数  
             $colums=mysql_num_fields($link_video_update);//获取列数 
   
             ?>
             <select name="v_farmer" >
               <?php
			   
                  while($row=mysql_fetch_row($video_framer_res))
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
        <td><p>视频来源</p></td>
        <td><!--<input type="text" value="<?php echo $source?>" name="v_source">-->
            <?php   
	         //搜索数据库找标签
	         $select_video_source="select tag_video_source from tag_video_source";  
             $video_source_res=mysql_query($select_video_source,$link_video_update);
	         $rows=mysql_affected_rows($link_video_update);//获取行数  
             $colums=mysql_num_fields($link_video_update);//获取列数 
   
             ?>
             <select name="v_source" >
               <?php
			   
                  while($row=mysql_fetch_row($video_source_res))
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
<td><p>视频权限：</p></td>
        <td><!--<input type="text" value="<?php echo $privilege?>" name="v_describe">-->
            <?php   
	         //搜索数据库找标签
	         $select_video_privilege="select tag_privilege_name from tag_privilege";  
             $video_privilege_res=mysql_query($select_video_privilege,$link_video_update);
	         $rows=mysql_affected_rows($link_video_update);//获取行数  
             $colums=mysql_num_fields($link_video_update);//获取列数 
   
             ?>
             <select name="v_privilege" >
               <?php
			   
                  while($row=mysql_fetch_row($video_privilege_res))
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
	$id_upd=$_GET["id"];
	$oldname=$_GET["oldname"];
	$v_name = $_POST["v_name"];
	$v_describe = $_POST["v_describe"];
	$v_farmer = $_POST["v_farmer"];
    $v_source = $_POST["v_source"];
	$v_privilege = $_POST["v_privilege"];	
	echo "newname:".$v_name."</br>";
	echo "oldname:".$oldname."</br>";
	echo "discribe:".$v_describe."</br>";
	echo "framer:".$v_farmer."</br>";
	echo "source:".$v_source."</br>";
	//newname
	echo "url:".dirname($oldname)."</br>";
	$newname=dirname($oldname)."/".$v_name;
	echo "newname:".$newname."</br>";
	echo "id:".$id_upd."</br>";
    
	/*$select_video_id="select video_id from video where video_name='$v_name'";
    $select_video_id_result=mysql_query($select_video_id,$link_video_update);
	$id=mysql_result($select_video_id_result,0);*/ 
	
	
	$update_video=
	"update video set 
	video_name='$v_name',video_describe='$v_describe',video_framer='$v_farmer',video_source='$v_source',video_address='$newname',video_privilege='$v_privilege'
	where video_id='$id_upd'";
	$update_video_result=mysql_query($update_video,$link_video_update);
	if(rename($oldname,$newname))
	{
		echo "成功重命名";
	}
	if($update_video_result)
	{	 
		?>
  <script>
		  alert("修改成功");
          window.location.href="video_update_page.php";
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
		window.location.href='video_update_page.php';
	}
	//function update()
//	{
//		var flagup="upd";
//		window.location.href='video_update.php?flag='+flagup;
//	}
 </script>
</body>
</html>
