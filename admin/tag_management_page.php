<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Tag Manage</title>
<!--标签css----------------->
<style type="text/css">
#tag{
	background-color:#292929;
	color:#FFF;
	text-align: center;
	width:140%
   
}
#tag:hover{
	background-color:#999;
   
}
</style>
<style type="text/css">
a:link {color: #FFF} /* 未访问的链接 */
a:visited {color:#FFF} /* 已访问的链接 */
a:hover {color: #FFF} /* 鼠标移动到链接上 */
a:active {color: #FFF} /* 选定的链接 */
</style>
<!--标签css结束-------------->
</head>
<body leftmargin="30" >
<!--********************************************加一个style************************************************-->
<div class="container" style="width:100%">

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
<?php /*连接数据库*/
    $link_update_tag=mysql_connect("localhost","root","HRBUXGOJ");
    if(!$link_update_tag)
    {  
          echo "连接失败";  
    }  
    mysql_select_db("jol",$link_update_tag);
    mysql_query("set names utf8");
?>
<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center; width:100%;
position:fixed; overflow:visible; _position: absolute; _top: expression(documentElement.scrollTop-5 + 'px');">
  <h1><?php echo $MSG_TAG.$MSG_MANAGE?></h1>
</div>
<!--整体div-->
<br><br><br><br>
 <!--导航div-->
<!--************************************************width值变成21%*******************************************-->
   <div style="float:right; width:21%;">
<!--******************************************position变成relativ，在加一个宽度e*********************************-->
   <div style="position:fixed; overflow:visible; _position: relative;width:15%;
        _top: expression(documentElement.scrollTop-5 + 'px');">
   <!--标签在这里加-->
   <ul>
     <li id="tag" onClick="show_video_tag()"><h3>视频频标签管理</h3></li>
     <li id="tag" onClick="show_file_tag()"><h3>文件标签管理</h3></li>
     <li id="tag" onClick="show_players_tag()"><h3>队员标签管理</h3></a></li>
     <li id="tag" onClick="show_problem_tag()"><h3>问题标签管理</h3></li>	
     <li id="tag" onClick="show_privilege_tag()"><h3>权限标签管理</h3></li>	
   </ul>
   </div>
   </div><!--导航div结束-->
<div id="all_page" style="float:left; width:80%;">
   <!--第一行div-->
   <a id="video"></a>
   <div id="video_tag" style="float:left;">
      <!--第一行头-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="video_tag_header" style="float:left; height:60px; width:100%;background-color:#CCC;text-align:center">
          <h3 align="center">视频标签管理</h3>
      </div>
      <!--第一行的第一个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="tag_video_describe" style="float:left;padding:5px; height:500px; width:33%; 
               overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
   <!--视频描述标签-->
          <div id="tag_video_describe_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
              <h5 align="center"><strong>视频描述管理</strong></h5>
          </div>
          <form action="tag_management_page.php?choice=tag_video" class="center">
             <input name="tag_video_describe" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加视频描述-->
                <form method=POST action="tag_management.php?add_flag=add_video_describe" 
                                  enctype="multipart/form-data">
                   <p><h5><strong>视频描述：</strong></h5>
                      <input type="text" name="add_video_describe">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索视频描述并打印表*/
			if(isset($_GET['tag_video_describe']))
			{
				$tag_video_describe=$_GET['tag_video_describe'];
	            $tag_video_describe="%$tag_video_describe%";
				$select_tag_video_describe=
				 "select tag_video_describe_id,tag_video_describe from tag_video_describe 
				  where tag_video_describe like '$tag_video_describe'";  
                 $tag_video_describe_res=mysql_query($select_tag_video_describe,$link_update_tag);
	             $rows=mysql_affected_rows($link_update_tag);//获取行数  
                 $colums=mysql_num_fields($tag_video_describe_res);//获取列数
			     //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				 $select_tag_video_describe=
				 "select tag_video_describe_id,tag_video_describe from tag_video_describe";  
                 $tag_video_describe_res=mysql_query($select_tag_video_describe,$link_update_tag);
	             $rows=mysql_affected_rows($link_update_tag);//获取行数  
                 $colums=mysql_num_fields($tag_video_describe_res);//获取列数
			     //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			
			?>
            
			 <table id='video_describe_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_VIDEO_DESCRIBE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_video_describe_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_video_describe" type="button" value="删除">
                          <input class="update_video_describe" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
                
      </div>
      <!--第一行第二个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="first_center1" style="float:left;padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
           <!--视频来源标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>视频来源管理</strong></h5>
      </div>
          <form action="tag_management_page.php?flag=tag_video" class="center">
             <input name="tag_video_source" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加视频来源-->
                <form method=POST action="tag_management.php?add_flag=add_video_source" enctype="multipart/form-data">
                   <p><h5><strong>视频来源：</strong></h5>
                      <input type="text" name="add_video_source">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索视频来源并打印表*/
			if(isset($_GET['tag_video_source']))
			{
				$tag_video_source=$_GET['tag_video_source'];
	            $tag_video_source="%$tag_video_source%";
				
				$select_tag_video_source=
				"select tag_video_source_id,tag_video_source from tag_video_source
				where tag_video_source like '$tag_video_source'";  
                $tag_video_source_res=mysql_query($select_tag_video_source,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_video_source_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_video_source="select tag_video_source_id,tag_video_source from tag_video_source";  
                $tag_video_source_res=mysql_query($select_tag_video_source,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_video_source_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			
			?>
            
			 <table id='video_describe_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_VIDEO_SOURCE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_video_source_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_video_source" type="button" value="删除">
                          <input class="update_video_source" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
      <!--第一行第三个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="first_center1" style="float:left; padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
           <!--视频发布者标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>视频发布者管理</strong></h5>
           
      </div>
         <form action="tag_management_page.php?flag=tag_video" class="center">
             <input name="tag_video_framer" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加视频发布者-->
                <form method=POST action="tag_management.php?add_flag=add_video_framer" enctype="multipart/form-data">
                   <p><h5><strong>视频发布者：</strong></h5>
                      <input type="text" name="add_video_framer">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索视频发布者并打印表*/
			if(isset($_GET['tag_video_framer']))
			{
				$tag_video_framer=$_GET['tag_video_framer'];
	            $tag_video_framer="%$tag_video_framer%";
				
				$select_tag_video_framer=
				"select tag_video_framer_id,tag_video_framer from tag_video_framer
				where tag_video_framer like '$tag_video_framer'";  
                $tag_video_framer_res=mysql_query($select_tag_video_framer,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_video_framer_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";	
			}
			else
			{
			    $select_tag_video_framer="select tag_video_framer_id,tag_video_framer from tag_video_framer";  
                $tag_video_framer_res=mysql_query($select_tag_video_framer,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_video_framer_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";	
			}
			
			?>
            
			 <table id='video_describe_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_VIDEO_FRAMER?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_video_framer_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_video_framer" type="button" value="删除">
                          <input class="update_video_framer" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
      </div>
   </div>
   
   
   <!--第二行div-->
   <a id="file"></a>
   <div id="file_tag" style="float:left;">
      <!--第二行头-->
      <br>
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_header" style="float:left;height:60px;width:100%;background-color:#CCC;text-align:center">
          <h3 align="center">文件标签管理</h3>
      </div>
      <!--第二行的第一个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_left" style="float:left;padding:5px; height:500px; width:33%;
            overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
          <!--文件描述标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>文件描述管理</strong></h5>
          
      </div>
         <form action="tag_management_page.php#file" class="center">
             <input name="tag_file_describe" type="text">
             <input type="submit" value="搜索">
          </form>
          
          <!--添加文件描述-->
                <form method=POST action="tag_management.php?add_flag=add_file_describe" enctype="multipart/form-data">
                   <p><h5><strong>文件描述：</strong></h5>
                      <input type="text" name="add_file_describe">
                      <br><br>
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_file_describe']))
			{
				$tag_file_describe=$_GET['tag_file_describe'];
	            $tag_file_describe="%$tag_file_describe%";
				
				$select_tag_file_describe=
				"select tag_file_describe_id,tag_file_describe from tag_file_describe
				where tag_file_describe like '$tag_file_describe'";  
                $tag_file_describe_res=mysql_query($select_tag_file_describe,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_file_describe_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_file_describe="select tag_file_describe_id,tag_file_describe from tag_file_describe";  
                $tag_file_describe_res=mysql_query($select_tag_file_describe,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_file_describe_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			
			?>
            
			 <table id='video_describe_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_FILE_DESCRIBE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_file_describe_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_file_describe" type="button" value="删除">
                          <input class="update_file_describe" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
      </div>
      <!--第二行第二个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_center1" style="float:left;padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
            <!--文件来源标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>文件来源管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#file" class="center">
             <input name="tag_file_source" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加文件来源-->
                <form method=POST action="tag_management.php?add_flag=add_file_source" enctype="multipart/form-data">
                   <p><h5><strong>文件来源：</strong></h5>
                      <input type="text" name="add_file_source">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索文件来源并打印表*/
			if(isset($_GET['tag_file_source']))
			{
				$tag_file_source=$_GET['tag_file_source'];
	            $tag_file_source="%$tag_file_source%";
				$select_tag_file_source=
				"select tag_file_source_id,tag_file_source from tag_file_source
				where tag_file_source like '$tag_file_source'";  
                $tag_file_source_res=mysql_query($select_tag_file_source,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_file_source_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_file_source="select tag_file_source_id,tag_file_source from tag_file_source";  
                $tag_file_source_res=mysql_query($select_tag_file_source,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_file_source_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}			
			?>
            
			 <table id='video_describe_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_FILE_SOURCE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_file_source_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_file_source" type="button" value="删除">
                          <input class="update_file_source" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
      <!--第二行第三个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_center1" style="float:left;padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
            <!--文件发布者标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>文件发布者管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#file" class="center">
             <input name="tag_file_framer" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加文件发布者-->
                <form method=POST action="tag_management.php?add_flag=add_file_framer" enctype="multipart/form-data">
                   <p><h5><strong>文件发布者：</strong></h5>
                      <input type="text" name="add_file_framer">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索文件发布者并打印表*/
			if(isset($_GET['tag_file_framer']))
			{
				$tag_file_framer=$_GET['tag_file_framer'];
	            $tag_file_framer="%$tag_file_framer%";
				$select_tag_file_framer=
				"select tag_file_framer_id,tag_file_framer from tag_file_framer
				where tag_file_framer like '$tag_file_framer'";  
                $tag_file_framer_res=mysql_query($select_tag_file_framer,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_file_framer_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_file_framer="select tag_file_framer_id,tag_file_framer from tag_file_framer";  
                $tag_file_framer_res=mysql_query($select_tag_file_framer,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_file_framer_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
            
			
			?>
            
			 <table id='video_describe_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_FILE_FRAMER?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_file_framer_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_file_framer" type="button" value="删除">
                          <input class="update_file_framer" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
   </div>
   
   <!--第三行div-->
   <a id="players"></a>
   <div id="players_tag" style="float:left">
      <!--第三行头-->
      <br>
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_header" style="float:left;height:60px;width:100%;background-color:#CCC;text-align:center">
          <h3 align="center">队员标签管理</h3>
      </div>
      <!--第三行的第一个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_left" style="float:left;padding:5px; height:500px; width:33%;
            overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
          <!--历届队员年级标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>队员年级管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#players" class="center">
             <input name="tag_player_grade" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加历届队员年级-->
                <form method=POST action="tag_management.php?add_flag=add_player_grade" enctype="multipart/form-data">
                   <p><h5><strong>队员年级：</strong></h5>
                      <input type="text" name="add_player_grade">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_player_grade']))
			{
				$tag_player_grade=$_GET['tag_player_grade'];
	            $tag_player_grade="%$tag_player_grade%";
				$select_tag_player_grade=
				"select tag_player_grade_id,tag_player_grade from tag_player_grade
				where tag_player_grade like '$tag_player_grade'";  
                $tag_player_grade_res=mysql_query($select_tag_player_grade,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_grade_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_player_grade="select tag_player_grade_id,tag_player_grade from tag_player_grade";  
                $tag_player_grade_res=mysql_query($select_tag_player_grade,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_grade_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
            
			
			?>
            
			 <table id='player_grade_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PLAYER_GRADE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_player_grade_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_player_grade" type="button" value="删除">
                          <input class="update_player_grade" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
      <!--第三行第二个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_center1" style="float:left;padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
            <!--历届队员专业标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>队员专业管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#players" class="center">
             <input name="tag_player_professional" type="text">
             <input type="submit" value="搜索">
          </form>
           <!--添加历届队员专业-->
                <form method=POST action="tag_management.php?add_flag=add_player_professional" 
                      enctype="multipart/form-data">
                   <p><h5><strong>队员专业：</strong></h5>
                      <input type="text" name="add_player_professional">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_player_professional']))
			{
				$tag_player_professional=$_GET['tag_player_professional'];
	            $tag_player_professional="%$tag_player_professional%";
				$select_tag_player_professional=
			    "select tag_player_professional_id,tag_player_professional from tag_player_professional
				where tag_player_professional like '$tag_player_professional'";  
                $tag_player_professional_res=mysql_query($select_tag_player_professional,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_professional_res);//获取列数
		     	//echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_player_professional=
			    "select tag_player_professional_id,tag_player_professional from tag_player_professional";  
                $tag_player_professional_res=mysql_query($select_tag_player_professional,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_professional_res);//获取列数
		     	//echo "共计".$rows."行 ".$colums."列<br/>";
			}
           
			
			?>
            
			 <table id='player_professional_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PLAYER_PROFESSOIONAL?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_player_professional_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_player_professional" type="button" value="删除">
                          <input class="update_player_professional" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
               
      </div>
      <!--第二行第三个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_center1" style="float:left;padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
            <!--历届队员学院标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>队员学院管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#players" class="center">
             <input name="tag_player_college" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加历届队员学院-->
                <form method=POST action="tag_management.php?add_flag=add_player_college" 
                       enctype="multipart/form-data">
                   <p><h5><strong>队员学院：</strong></h5>
                      <input type="text" name="add_player_college">
                      <input type="submit" value="添加">
                   </p>
                </form> 
           <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_player_college']))
			{
				$tag_player_college=$_GET['tag_player_college'];
	            $tag_player_college="%$tag_player_college%";
				$select_tag_player_college=
				"select tag_player_college_id,tag_player_college from tag_player_college
				where tag_player_college like '$tag_player_college'";  
                $tag_player_college_res=mysql_query($select_tag_player_college,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_college_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_player_college=
				"select tag_player_college_id,tag_player_college from tag_player_college";  
                $tag_player_college_res=mysql_query($select_tag_player_college,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_college_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
           
			
			?>
            
			 <table id='player_grade_tag' width='300px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PLAYER_COLLEGE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_player_college_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_player_college" type="button" value="删除">
                          <input class="update_player_college" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
   <div id="secend_center1" style="float:left;padding:5px; height:500px; width:33%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
            <!--队员学院标签-->
          <div id="first_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>队员职务管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#players" class="center">
             <input name="tag_player_post" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加历届队员学院-->
                <form method=POST action="tag_management.php?add_flag=add_player_post" 
                       enctype="multipart/form-data">
                   <p><h5><strong>队员职务：</strong></h5>
                      <input type="text" name="add_player_post">
                      <input type="submit" value="添加">
                   </p>
                </form> 
           <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_player_post']))
			{
				$tag_player_post=$_GET['tag_player_post'];
	            $tag_player_post="%$tag_player_post%";
				$select_tag_player_post=
				"select tag_player_post_id,tag_player_post from tag_player_post
				where tag_player_post like '$tag_player_post'";  
                $tag_player_post_res=mysql_query($select_tag_player_post,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_post_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_player_post=
				"select tag_player_post_id,tag_player_post from tag_player_post";  
                $tag_player_post_res=mysql_query($select_tag_player_post,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_player_post_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
           
			
			?>
            
			 <table id='player_grade_tag' width='300px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PLAYER_POST?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_player_post_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_player_post" type="button" value="删除">
                          <input class="update_player_post" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
   </div>
   <!--第四行div-->
   <a id="problem"></a>
   <div id="problem_tag" style="float:left;">
      <!--第四行头-->
      <br>
<!--************************************************width值变成百分比*******************************************-->
      <div id="fourth_header" style="float:left;height:60px;width:100%;background-color:#CCC;text-align:center">
          <h3 align="center">问题标签管理</h3>
      </div>
      <!--第四行的第一个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_left" style="float:left;padding:5px; height:500px; width:33%;
            overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
          <!--问题一级标签-->
          <div id="fourth_left_header" style="float:left; height:30px; width:300px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>问题一级标签管理</strong></h5>
          
      </div>
           <form action="tag_management_page.php#problem" class="center">
             <input name="tag1_name" type="text">
             <input type="submit" value="搜索">
          </form>
          <!--添加问题一级标签-->
                <form method=POST action="tag_management.php?add_flag=add_tag1" enctype="multipart/form-data">
                   <p><h5><strong>添加问题一级标签：</strong></h5>
                      <input type="text" name="add_tag1">
                      <input type="submit" value="添加">
                   </p>
                </form> 
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag1_name']))
			{
				$tag1_name=$_GET['tag1_name'];
	            $tag1_name="%$tag1_name%";
				$select_tag1="select tag1_id,tag1_name from tag1 where tag1_name like '$tag1_name'";  
                $tag1_res=mysql_query($select_tag1,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag1_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				 $select_tag1="select tag1_id,tag1_name from tag1";  
                 $tag1_res=mysql_query($select_tag1,$link_update_tag);
	             $rows=mysql_affected_rows($link_update_tag);//获取行数  
                 $colums=mysql_num_fields($tag1_res);//获取列数
			     //echo "共计".$rows."行 ".$colums."列<br/>";
			}
           
			
			?>
            
			 <table id='tag1' width='300px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PROBLEM_TAG1?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag1_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_tag1" type="button" value="删除">
                          <input class="update_tag1" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div>
      <!--第四行第二个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_center1" style="float:left;padding:5px; height:500px; width:66%;
             overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
            <!--问题二级标签-->
          <div id="first_left_header" style="float:left; height:30px; width:600px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>问题二级标签管理</strong></h5>
          
      </div>
          <form action="tag_management_page.php#problem" class="center">
             <input name="tag2_select" type="text">
             <input type="submit" value="搜索">
          </form>
           <!--添加问题二级标签-->
           <div style=" float:left;margin-right:30px;">
                <form method=POST action="tag_management.php?add_flag=add_tag2" 
                      enctype="multipart/form-data">
                
                   <h5><strong>问题一级标签：</strong></h5>
                      <?php   
	                  //搜索数据库找标签
	                 $select_tag1="select tag1_name from tag1";  
                     $tag1_res=mysql_query($select_tag1,$link_update_tag);
	                 $rows=mysql_affected_rows($link_update_tag);//获取行数  
                     $colums=mysql_num_fields($tag1_res);//获取列数
	    
   
                      ?>
                      <select name="tag1" >
                      <?php
                      while($row=mysql_fetch_row($tag1_res))
		              {    
                      ?>  
                      <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>  
                      <?php  
                      }  						
						
	                  ?>
                      </select>
                      </div>
                      <a id="problem_source"></a>
                      <div style=" float:left">
                       <p><h5><strong>问题二级标签：</strong></h5>
                       <input type="text" name="add_tag2" >	
                      <input type="submit" value="添加">
                      </p>
                      </div>
                </form> 
                
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag2_select']))
			{
				$tag2_select=$_GET['tag2_select'];
	            $tag2_select="%$tag2_select%";
				$select_tag2=
		   	    "SELECT tag2.tag2_id,tag2.tag2_tag1_id,tag1.tag1_name,tag2.tag2_name FROM tag1 
			    right join tag2 on tag1.tag1_id=tag2.tag2_tag1_id
				where concat(tag1.tag1_name,tag2.tag2_name) like '$tag2_select'
			    ORDER BY tag2.tag2_tag1_id asc,tag2.tag2_id asc
			    ";  
                $tag2_res=mysql_query($select_tag2,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag2_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag2=
		   	    "SELECT tag2.tag2_id,tag2.tag2_tag1_id,tag1.tag1_name,tag2.tag2_name FROM tag1 
			    right join tag2 on tag1.tag1_id=tag2.tag2_tag1_id
			    ORDER BY tag2.tag2_tag1_id asc,tag2.tag2_id asc";  
                $tag2_res=mysql_query($select_tag2,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag2_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
            
			
			?>
            
			 <table id='player_professional_tag' width='380px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
                        <th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PROBLEM_TAG1?>
						</th>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PROBLEM_TAG2?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='15%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag2_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
						  echo "<td class='hidden-xs' style='display:none'>$row[1]</td>";
                          for($i=2; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_tag2" type="button" value="删除">
                          <input class="update_tag2" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
               
      </div>
       <!--第四行的第三个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="secend_left" style="float:left;padding:5px; height:500px; width:100%;
            overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
          <!--问题来源标签-->
          <div id="fourth_left_header" style="float:left; height:30px; width:100%;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>问题来源标签管理</strong></h5>
          
      </div>
           <!--添加历届队员年级-->
           <div style=" float:left;margin-right:30px">
                <form method=POST action="tag_management.php?add_flag=add_tag_problem_source" 
                      enctype="multipart/form-data">
                   <p><h5><strong>添加问题来源标签：</strong></h5>
                      <input type="text" name="add_tag_problem_source" style="width:500px">
                      <input type="submit" value="添加">
                   </p>
                </form> 
                </div>
           <div style=" float:left">
            <form action="tag_management_page.php#problem_source" class="center">
            <p><h5><strong>搜索：</strong></h5>
             <input name="tag_problem_source" type="text">
             <input type="submit" value="搜索">
             </p>
          </form>
          </div>
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_problem_source']))
			{
				$tag_problem_source=$_GET['tag_problem_source'];
	            $tag_problem_source="%$tag_problem_source%";
				$select_tag_problem_source=
				"select tag_problem_source_id,tag_problem_source from tag_problem_source
				where tag_problem_source like '$tag_problem_source'";  
                $tag_problem_source_res=mysql_query($select_tag_problem_source,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_problem_source_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_problem_source=
				"select tag_problem_source_id,tag_problem_source from tag_problem_source";  
                $tag_problem_source_res=mysql_query($select_tag_problem_source,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_problem_source_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
            
			?>
            
			 <table id='tag_problem_source' width='300px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PROBLEM_SOURCE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_problem_source_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_tag_problem_source" type="button" value="删除">
                          <input class="update_tag_problem_source" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
               
      </div>
   </div><!--第四行div结束-->
   
   <!--第五行div-->
   <a id="privilege"></a>
   <div id="privilege_tag" style="float:left;">
      <!--第五行头-->
      <br>
      <div id="fourth_header" style="float:left;height:60px;width:100%;background-color:#CCC;text-align:center">
          <h3 align="center">权限标签管理</h3>
      </div>
      <!--第五行的第一个div-->
<!--************************************************width值变成百分比*******************************************-->
      <div id="five_left" style="float:left;padding:5px; height:500px; width:100%;
            overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
          <!--问题一级标签-->
          <div id="five_left_header" style="float:left; height:30px; width:900px;background-color:#eeeeee;
                   text-align:center">
          <h5 align="center"><strong>权限标签管理</strong></h5>
          
      </div>
       <div style=" float:left;margin-right:30px">
           <!--添加历届队员年级-->
         <form method=POST action="tag_management.php?add_flag=add_tag_privilege" enctype="multipart/form-data">
                   <p><h5><strong>添加权限标签：</strong></h5>
                      <input type="text" name="add_tag_privilege">
                      <input type="submit" value="添加">
                   </p>
                </form> 
       </div>
        <div style=" float:left">
          <form action="tag_management_page.php#privilege" class="center">
          <p><h5><strong>搜索：</strong></h5>
             <input name="tag_privilege_name" type="text">
             <input type="submit" value="搜索">
          </p>
          </form>
          </div>
          <?php
		    /*数据库搜索文件描述并打印表*/
			if(isset($_GET['tag_privilege_name']))
			{
				$tag_privilege_name=$_GET['tag_privilege_name'];
	            $tag_privilege_name="%$tag_privilege_name%";
				$select_tag_privilege="select tag_privilege_id,tag_privilege_name from tag_privilege
				where tag_privilege_name like '$tag_privilege_name'";  
                $tag_privilege_res=mysql_query($select_tag_privilege,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_privilege_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
			else
			{
				$select_tag_privilege="select tag_privilege_id,tag_privilege_name from tag_privilege";  
                $tag_privilege_res=mysql_query($select_tag_privilege,$link_update_tag);
	            $rows=mysql_affected_rows($link_update_tag);//获取行数  
                $colums=mysql_num_fields($tag_privilege_res);//获取列数
			    //echo "共计".$rows."行 ".$colums."列<br/>";
			}
            
			
			?>
            
			 <table id='tag1' width='300px' class='table table-striped'>
				<thead>
					<tr class='toprow'>
						<th class='hidden-xs' width='20%'>
							<?php echo $MSG_TAG_PRIVILEGE?>
						</th>
                        <th class='hidden-xs' style="cursor:hand" width='10%'>
						    <?php echo "操作";?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<?php
                      while($row=mysql_fetch_row($tag_privilege_res))
				      {  
						  $t=0;
                          echo "<tr>";  
					      echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";
                          for($i=1; $i<$colums; $i++)
						  {  
                              echo "<td class='hidden-xs'>$row[$i]</td>";
									 
                          } 
					  ?>
                          <td class='hidden-xs' >
                          <input class="delete_tag_privilege" type="button" value="删除">
                          <input class="update_tag_privilege" type="button" value="修改">
                          </td>
                      <?php
                           echo "</tr>";  
                       }  						
						
					   ?>
					</tbody>
				</table>
                
      </div><!--第五行第一个div结束-->
   
   </div><!--第五行div结束-->
 <!--**********************************************修改结束***************************************************-->

</div><!--整体标签页div结束-->

<?php require_once("../include/set_post_key.php");?>

</div>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
	<script>
	<!--video_decribe-->
	$('.delete_video_describe').click(function ()
	    {
			var flagdel = "delete_video_describe";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var video_describe_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&video_describe_id='+video_describe_id;
            
	    });
		
	$('.update_video_describe').click(function ()
	    {
			var flagup = "update_video_describe";
		    var tr = $(this).closest("tr");
		    var video_describe_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&video_describe_id='+video_describe_id;
			
            
	    });
		
	<!--video_source-->
	$('.delete_video_source').click(function ()
	    {
			var flagdel = "delete_video_source";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var video_source_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&video_source_id='+video_source_id;
            
	    });
		
	$('.update_video_source').click(function ()
	    {
			var flagup = "update_video_source";
		    var tr = $(this).closest("tr");
		    var video_source_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&video_source_id='+video_source_id;
			
            
	    });
		
	<!--video_framer-->
	$('.delete_video_framer').click(function ()
	    {
			var flagdel = "delete_video_framer";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var video_framer_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&video_framer_id='+video_framer_id;
            
	    });
		
	$('.update_video_framer').click(function ()
	    {
			var flagup = "update_video_framer";
		    var tr = $(this).closest("tr");
		    var video_framer_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&video_framer_id='+video_framer_id;
			
            
	    });
	<!--file_describe-->
	$('.delete_file_describe').click(function ()
	    {
			var flagdel = "delete_file_describe";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var file_describe_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&file_describe_id='+file_describe_id;
            
	    });
		
	$('.update_file_describe').click(function ()
	    {
			var flagup = "update_file_describe";
		    var tr = $(this).closest("tr");
		    var file_describe_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&file_describe_id='+file_describe_id;
			
            
	    });
	
	<!--file_source-->
	$('.delete_file_source').click(function ()
	    {
			var flagdel = "delete_file_source";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var file_source_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&file_source_id='+file_source_id;
            
	    });
		
	$('.update_file_source').click(function ()
	    {
			var flagup = "update_file_source";
		    var tr = $(this).closest("tr");
		    var file_source_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&file_source_id='+file_source_id;
			
            
	    });
	
	<!--file_framer-->
	$('.delete_file_framer').click(function ()
	    {
			var flagdel = "delete_file_framer";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var file_framer_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&file_framer_id='+file_framer_id;
            
	    });
		
	$('.update_file_framer').click(function ()
	    {
			var flagup = "update_file_framer";
		    var tr = $(this).closest("tr");
		    var file_framer_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&file_framer_id='+file_framer_id;
			
            
	    });
		
	<!--player_grade-->
	$('.delete_player_grade').click(function ()
	    {
			var flagdel = "delete_player_grade";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var player_grade_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&player_grade_id='+player_grade_id;
            
	    });
		
	$('.update_player_grade').click(function ()
	    {
			var flagup = "update_player_grade";
		    var tr = $(this).closest("tr");
		    var player_grade_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&player_grade_id='+player_grade_id;
			
            
	    });
		
	<!--player_professional-->
	$('.delete_player_professional').click(function ()
	    {
			var flagdel = "delete_player_professional";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var player_professional_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&player_professional_id='+player_professional_id;
            
	    });
		
	$('.update_player_professional').click(function ()
	    {
			var flagup = "update_player_professional";
		    var tr = $(this).closest("tr");
		    var player_professional_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&player_professional_id='+player_professional_id;
			
            
	    });
		
	<!--player_college-->
	$('.delete_player_college').click(function ()
	    {
			var flagdel = "delete_player_college";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var player_college_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&player_college_id='+player_college_id;
            
	    });
		
	$('.update_player_college').click(function ()
	    {
			var flagup = "update_player_college";
		    var tr = $(this).closest("tr");
		    var player_college_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&player_college_id='+player_college_id;
			
            
	    });
   <!--problem_tag1-->
	$('.delete_tag1').click(function ()
	    {
			var flagdel = "delete_tag1";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var tag1_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&tag1_id='+tag1_id;
            
	    });
		
	$('.update_tag1').click(function ()
	    {
			var flagup = "update_tag1";
		    var tr = $(this).closest("tr");
		    var tag1_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&tag1_id='+tag1_id;
			
            
	    });
	<!--problem_tag2-->
	$('.delete_tag2').click(function ()
	    {
			var flagdel = "delete_tag2";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var tag2_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&tag2_id='+tag2_id;
            
	    });
		
	$('.update_tag2').click(function ()
	    {
			var flagup = "update_tag2";
		    var tr = $(this).closest("tr");
		    var tag2_id = tr.find("td:eq(0)").text();
			var tag2_tag1_id = tr.find("td:eq(1)").text();
			window.location.href='tag_management.php?flag='+flagup+'&tag2_id='+tag2_id+'&tag2_tag1_id='+tag2_tag1_id;
			
            
	    });
	 <!--tag_problem_source-->
	$('.delete_tag_problem_source').click(function ()
	    {
			var flagdel = "delete_tag_problem_source";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var tag_problem_source_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&tag_problem_source_id='+tag_problem_source_id;
            
	    });
		
	$('.update_tag_problem_source').click(function ()
	    {
			var flagup = "update_tag_problem_source";
		    var tr = $(this).closest("tr");
		    var tag_problem_source_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&tag_problem_source_id='+tag_problem_source_id;
			
            
	    });
	<!--tag_privilege-->
	$('.delete_tag_privilege').click(function ()
	    {
			var flagdel = "delete_tag_privilege";
			if(false === confirm('是否真的要删除当前记录吗?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var tag_privilege_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagdel+'&tag_privilege_id='+tag_privilege_id;
            
	    });
		
	$('.update_tag_privilege').click(function ()
	    {
			var flagup = "update_tag_privilege";
		    var tr = $(this).closest("tr");
		    var tag_privilege_id = tr.find("td:eq(0)").text();
			window.location.href='tag_management.php?flag='+flagup+'&tag_privilege_id='+tag_privilege_id;
			
            
	    });
    </script> 
    <script type="text/javascript">
	function show_video_tag()
	{
		var video_tag = document.getElementById("video_tag");//获取视频标签div的id
		var file_tag = document.getElementById("file_tag");//获取文件标签div的id
		var players_tag = document.getElementById("players_tag");//获取历届队员标签div的id
		var problem_tag = document.getElementById("problem_tag");//获取问题标签div的id
		var privilege_tag = document.getElementById("privilege_tag");//获取权限标签div的id
　　     video_tag.style.display = 'block';//video_tag显示其他隐藏
        file_tag.style.display = 'none';
	    players_tag.style.display = 'none';
	    problem_tag.style.display = 'none';
	    privilege_tag.style.display = 'none';
	}
	function show_file_tag()
	{
		var video_tag = document.getElementById("video_tag");//获取视频标签div的id
		var file_tag = document.getElementById("file_tag");//获取文件标签div的id
		var players_tag = document.getElementById("players_tag");//获取历届队员标签div的id
		var problem_tag = document.getElementById("problem_tag");//获取问题标签div的id
		var privilege_tag = document.getElementById("privilege_tag");//获取权限标签div的id
　　     video_tag.style.display = 'none';//file_tag显示其他隐藏
        file_tag.style.display = 'block';
	    players_tag.style.display = 'none';
	    problem_tag.style.display = 'none';
		privilege_tag.style.display = 'none';
	}
	function show_players_tag()
	{
		var video_tag = document.getElementById("video_tag");//获取视频标签div的id
		var file_tag = document.getElementById("file_tag");//获取文件标签div的id
		var players_tag = document.getElementById("players_tag");//获取历届队员标签div的id
		var problem_tag = document.getElementById("problem_tag");//获取问题标签div的id
		var privilege_tag = document.getElementById("privilege_tag");//获取权限标签div的id
　　     video_tag.style.display = 'none';//players_tag显示其他隐藏
        file_tag.style.display = 'none';
	    players_tag.style.display = 'block';
	    problem_tag.style.display = 'none';
	    privilege_tag.style.display = 'none';
	}
	function show_problem_tag()
	{
		var video_tag = document.getElementById("video_tag");//获取视频标签div的id
		var file_tag = document.getElementById("file_tag");//获取文件标签div的id
		var players_tag = document.getElementById("players_tag");//获取历届队员标签div的id
		var problem_tag = document.getElementById("problem_tag");//获取问题标签div的id
		var privilege_tag = document.getElementById("privilege_tag");//获取权限标签div的id
　　     video_tag.style.display = 'none';//problem_tag显示其他隐藏
        file_tag.style.display = 'none';
	    players_tag.style.display = 'none';
	    problem_tag.style.display = 'block';
	    privilege_tag.style.display = 'none';
	}
	function show_privilege_tag()
	{
		var video_tag = document.getElementById("video_tag");//获取视频标签div的id
		var file_tag = document.getElementById("file_tag");//获取文件标签div的id
		var players_tag = document.getElementById("players_tag");//获取历届队员标签div的id
		var problem_tag = document.getElementById("problem_tag");//获取问题标签div的id
		var privilege_tag = document.getElementById("privilege_tag");//获取权限标签div的id
　　     video_tag.style.display = 'none';//privilege_tag显示其他隐藏
        file_tag.style.display = 'none';
	    players_tag.style.display = 'none';
	    problem_tag.style.display = 'none';
	    privilege_tag.style.display = 'block';
	}
	</script>
    </body>
</html>

