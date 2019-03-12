+<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Problem</title>
</head>
<body leftmargin="30" >
<!--***********************************加一个style**********************************************************-->
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
  <?php
        $conn=mysql_connect("localhost","root","HRBUXGOJ");  
        if(!$conn){  
            echo "连接失败";  
        }  
        mysql_select_db("jol",$conn);  
        mysql_query("set names utf8");  
		?>
        <div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
           <h2><?php echo $MSG_UPDATE.$MSG_PLAYINFORMATION?></h2>
        </div>
        <br>
      
        <form action="update_playinformation_page.php" class="center">
             <input name="playinformation" type="text">
             <input type="submit" value="搜索">
         </form>
        <?php
		if(isset($_GET['playinformation']))
		{
     		$playinformation=$_GET['playinformation'];
            $playinformation="%$playinformation%";
			$sql="select user_id,username,grade,email,professional,college,work
		    from former_players where concat(user_id,username,grade,professional,college) like '$playinformation'";  	
            $res=mysql_query($sql,$conn);  
		    $rows=mysql_affected_rows($conn);//获取行数  
            $colums=mysql_num_fields($res);//获取列数  
            //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";  
            //echo "共计".$rows."行 ".$colums."列<br/>";
		}
		else
		{
			$sql="select user_id,username,grade,email,professional,college,work from former_players";  
            $res=mysql_query($sql,$conn);  
		    $rows=mysql_affected_rows($conn);//获取行数  
            $colums=mysql_num_fields($res);//获取列数  
            //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";  
            //echo "共计".$rows."行 ".$colums."列<br/>";
		}
 
	   ?>
  <div id="update_former_players" >
    <table border="1" class='table table-striped' width="100%" style="word-wrap:break-word;word-break:break-all;">
      <thead>
        <tr class='toprow'>
          <th class='hidden-xs' width='8%' > <?php echo $MSG_PLAYER_USERID?> </th>
          <th class='hidden-xs' width='8%'> <?php echo $MSG_PLAYER_UNAME?> </th>
          <th class='hidden-xs' width='5%'> <?php echo $MSG_PLAYER_GRADE?> </th>
          <th class='hidden-xs' width='13%'> <?php echo $MSG_PLAYER_EMAIL?> </th>
          <th class='hidden-xs' width='10%'> <?php echo $MSG_PLAYER_PROFESSIONAL?> </th>
          <th class='hidden-xs' width='10%'> <?php echo $MSG_PLAYER_COLLEGE?> </th>
          <th class='hidden-xs' width='5%'> <?php echo $MSG_PLAYER_WORK?> </th>
          <th class='hidden-xs' width='8%'> <?php echo "操作"?> </th>
        </tr>
      </thead>
      <tbody>
        <?php
			while($row=mysql_fetch_row($res))
			{  
                echo "<tr>";  
				
                for($i=0; $i<$colums; $i++)
				{  
                     echo "<td  >$row[$i]</td>"; 
                }  
				
		?>     <td class='hidden-xs'>
                 <input  type="button" class="del" value="删除">
                 <input  type="button" class="upd" value="修改">
               </td>
        <?php
               echo "</tr>";  
           }  						
		?>
        </tbody>
    </table>
  </div>
  
  <br/>
  <?php require_once("../include/set_post_key.php");?>
</div>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script> 
<script>
    $('.del').click(function ()
	    {
			var flagdel = "del";
			if(false === confirm('是否真的要删除当前记录?'))
			{
				return;
			}
		    var tr = $(this).closest("tr");
		    var team_member_id = tr.find("td:eq(0)").text();
			window.location.href='update_playinformation.php?flagdel='+flagdel+'&team_member_id='+team_member_id;
            
	    });
	 
	$('.upd').click(function ()
	    {
		    var tr = $(this).closest("tr");
		    var team_member_id = tr.find("td:eq(0)").text();
			var flagupdate = "upd";
			//alert(team_member_id);
            window.location.href='update_playinformation.php?team_member_id='+team_member_id+'&flagupdate='+flagupdate;
	    });
		
    </script>
</body>
</html>
