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
<?php
        $conn=mysql_connect("localhost","root","HRBUXGOJ");  
        if(!$conn){  
            echo "连接失败";  
        }  
        mysql_select_db("jol",$conn);  
        mysql_query("set names utf8");
?>  
<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
           <h2><?php echo $MSG_UPDATE.$MSG_VIDEO?></h2>
        </div>
        <br>
      
        <form action="video_update_page.php" class="center">
             <input name="videoinformation" type="text" style="width:250px">
             <input type="submit" value="搜索">
         </form>
        <?php
		if(isset($_GET['videoinformation']))
		{
     		$videoinformation=$_GET['videoinformation'];
            $videoinformation="%$videoinformation%";
            $sql=
			"select video_id,video_name,video_describe,video_framer,video_upload_time,video_source,video_privilege
			from video
			where concat(video_name,video_describe,video_framer,video_source,video_privilege) 
			like '$videoinformation'";  
	    $res=mysql_query($sql,$conn);  
            $rows=mysql_affected_rows($conn);//获取行数  
            $colums=mysql_num_fields($res);//获取列数  
            //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";  
            //echo "共计".$rows."行 ".$colums."列<br/>";
		}
		else
		{
            $sql="select video_id,video_name,video_describe,video_framer,video_upload_time,video_source,video_privilege 
			from video";
	    $res=mysql_query($sql,$conn);  
            $rows=mysql_affected_rows($conn);//获取行数  
            $colums=mysql_num_fields($res);//获取列数  
            //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";  
            //echo "共计".$rows."行 ".$colums."列<br/>";
		}
		
	   ?>       
<table id='problemset' width='90%' class='table table-striped'>
					<thead>
						<tr class='toprow'>
							<th class='hidden-xs' width='5%' >
                                                                <?php echo $MSG_VIDEO_ID?>
                                                        </th>

							<th class='hidden-xs' width='15%' >
								<?php echo $MSG_VIDEO_NAME?>
							</th>
							<th class='hidden-xs' width='20%'>
								<?php echo $MGE_VIDEO_DESCRRIBE?>
							</th>
							<th class='hidden-xs' width='10%'>
								<?php echo $MSG_VIDEO_FRAMER?>
							</th>
                            <th class='hidden-xs' width='10%'>
                                <?php echo $MSG_VIDEO_UPLOAD_TIME?>
                            </th>
							<th class='hidden-xs' style="cursor:hand" width='20%'>
							    <?php echo $MSG_VIDEO_SOURCE?>
                            </th>
			    <th class='hidden-xs' style="cursor:hand" width='15%'>
							    <?php echo $MSG_VIDEO_PRIVILEGE?>
                            </th>
                            <th class='hidden-xs' style="cursor:hand" width='10%'>
							    <?php echo "操作";?>
                            </th>
						</tr>
					</thead>
					<tbody>
						<?php
                        while($row=mysql_fetch_row($res))
						{  
						     $t=0;
                             echo "<tr>";
                             echo "<td class='hidden-xs' style='display:none'>$row[0]</td>";  
                             for($i=0; $i<$colums; $i++)
							 {  
                                 echo "<td class='hidden-xs' >$row[$i]</td>";
									 
                             } 
							?>
                             <td class='hidden-xs' >
<input class="delete" type="button" value="删除" <?php  if(!isset($_SESSION[$OJ_NAME.'_'.'root'])) echo "disabled='disabled'" ?> >				
<input class="update" type="button" value="修改">
                             </td>
                            <?php
                             echo "</tr>";  
                        }  						
						
						?>
					</tbody>
				</table>
<?php require_once("../include/set_post_key.php");?>

</div>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
    <script language='javascript'>
	function del()
	{
		
	}
	</script>   
    <script>
	$('.delete').click(function ()
	    {
			var flagdel = "del";
			if(false === confirm('是否真的要删除当前记录?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var video_id = tr.find("td:eq(0)").text();
			window.location.href='video_update.php?flag='+flagdel+'&video_id='+video_id;
            
	    });
		
	$('.update').click(function ()
	    {
			var flagup = "update";
		    var tr = $(this).closest("tr");
		    var video_id = tr.find("td:eq(0)").text();
			window.location.href='video_update.php?flag='+flagup+'&video_id='+video_id;
			
            
	    });
    </script> 
    </body>
</html>

