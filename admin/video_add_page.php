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

<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'video_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
include_once("kindeditor.php") ;
?>

    <!--<br>
    <div class="test-border"></div>-->
<!--添加视频模块-->
<table align="center" border="2" bordercolor="#000000">
<form method=POST action="video_add.php" enctype="multipart/form-data">

    <br/>

    <div class="test-border" style="float: left ;margin-right: 30px"></div>
<label style="float: left" for="file"><h2 style="color:black ">选择上传视频：</h2></label>

<br/>

<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" /><br/><br/><br/>
   <input type="file" name="upfile"/><br/>

<p style="color:#666">视频描述:
<!--</p><textarea class="kindeditor" rows=10 name="video_describe" cols=50></textarea>-->
<!--<input type="text" name="video_describe">-->
   <?php   
	   //搜索数据库找标签
	   $select_tag_video_describe="select tag_video_describe from tag_video_describe";  
       $tag_video_describe_res=pdo_query($select_tag_video_describe);
   
    ?>
   <select name="video_describe" style="width: 410px">
        <?php
           foreach ($tag_video_describe_res as $row)
		   {    
               ?>  
              <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
              <?php  
           }  						
						
	    ?>
   </select>

</p>
<p style="color:#666">视频来源:
<!--</p><textarea class="kindeditor" rows=10 name="video_source" cols=50></textarea>-->
<!--<input type="text" name="video_source">-->
     <?php   
	   //搜索数据库找标签
	   $select_tag_video_source="select tag_video_source from tag_video_source";  
       $tag_video_source_res=pdo_query($select_tag_video_source);
	   /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
       $colums=mysql_num_fields($link_manage_tag);//获取列数*/
   
    ?>
   <select name="video_source" style="width: 410px">
         <?php
           foreach ($tag_video_source_res as $row)
		   {    
               ?>  
              <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
              <?php  
           }  						
						
	    ?>
   </select>

</p>
<p style="color:#666">视频发布者
<!--：<input type="text" name="video_framer"  />-->
    <?php   
	   //搜索数据库找标签
	   $select_tag_video_framer="select tag_video_framer from tag_video_framer";  
       $tag_video_framer_res=pdo_query($select_tag_video_framer);
	   /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
       $colums=mysql_num_fields($link_manage_tag);//获取列数*/
   
    ?>
      <select name="video_framer" style="width: 400px">
         <?php
           foreach ($tag_video_framer_res as $row)
		   {    
               ?>  
              <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
               <?php  
           }  						
						
	    ?>
      </select>
</p>
<p style="color:#666">视频权限：
<!--：<input type="text" name="video_framer"  />-->
    <?php   
	   //搜索数据库找标签
	   $select_tag_privilege_name="select tag_privilege_name from tag_privilege";  
       $tag_privilege_name_res=pdo_query($select_tag_privilege_name);
	   /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
       $colums=mysql_num_fields($link_manage_tag);//获取列数*/
   
    ?>
      <select name="video_privilege" style="width: 400px">
         <?php
           foreach ($tag_privilege_name_res as $row)
		   {    
               ?>  
              <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
               <?php  
           }  						
						
	    ?>
      </select>
</p>
<br/>
    <div align="center">
<input type="submit"  style=" background:#000;color:#FFF;" value="上传视频"/>
    </div>

</form>
</table>
<br/>
    <ul>
<li><h4 style="color:#F00">文件大小不超过500M!!!</h4></li>
    </ul>
<?php require_once("../include/set_post_key.php");?>

</div>

<style>

    .test-border {
        width: 0;
        height: 0;
        border-top: 30px solid transparent;
        border-bottom: 30px solid transparent;
        border-left: 30px solid yellowgreen;
    }
</style>
</body>
</html>

