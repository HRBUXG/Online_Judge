<?php require("admin-header.php");
require_once("../include/set_get_key.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'news_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
echo "<link rel='stylesheet' href='../bootstrap/css/normalize.min.css'>";
echo "<link rel='stylesheet' href='../bootstrap/css/style1.css'>";
echo "<title>News List</title>";
echo "<hr>
	<h1 align='center'>News List</h1>";
echo "<div class='container'>";
<<<<<<< HEAD
$sql = "select `news_id`,`user_id`,`title`,`time`,`defunct` FROM `news` order by `news_id` desc";
$result = pdo_query($sql);
echo "<center><table width=90% border=1 class=\"table table-bordered\">";

echo "<tr><td>PID<td id='title'>Title<td>Date<td>Status<td>Edit</tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['news_id'];
    //echo "<input type=checkbox name='pid[]' value='$row['problem_id']'>";
    echo "<td style='overflow:hidden;word-break: normal;'><a href='news_edit.php?id=" . $row['news_id'] . "'>" . $row['title'] . "</a>";
    echo "<td>" . $row['time'];
    echo "<td><a href=news_df_change.php?id=" . $row['news_id'] . "&getkey=" . $_SESSION[$OJ_NAME . '_' . 'getkey'] . ">" . ($row['defunct'] == "N" ? "<span class=green>Available</span>" : "<span class=red>Reserved</span>") . "</a>";
    echo "<td><a href=news_edit.php?id=" . $row['news_id'] . ">Edit</a>";

    echo "</tr>";
=======
$sql="select `news_id`,`user_id`,`title`,`time`,`defunct` FROM `news` order by `news_id` desc";
$result=pdo_query($sql) ;
echo "<center>
<table width=90% border=1>";
echo "<tr style='background-color: darkgray'><td>PID<td>Title<td>Date<td>Status<td>Edit<td>Delete</tr>";
$count=0;
foreach($result as $row){
    if($count){
        echo "<tr id='oddrow'>";
    }else{
        echo "<tr id='evenrow'>";
    }
    /*echo "<tr id='oddrow'>";*/
	echo "<td>".$row['news_id'];
	//echo "<input type=checkbox name='pid[]' value='$row['problem_id']'>";
	echo "<td><a href='news_edit.php?id=".$row['news_id']."'>".$row['title']."</a>";
	echo "<td>".$row['time'];
/*	echo "<td><a href=news_df_change.php?id=".$row['news_id']."&getkey=".$_SESSION[$OJ_NAME.'_'.'getkey'].">".($row['defunct']=="N"?"<span class=green>Available</span>":"<span class=red>Reserved</span>")."</a>";*/


echo "<td><div class='toggle toggle--knob'>
			<input type='checkbox' id='toggle--knob' class='toggle--checkbox'>
			<label class='toggle--btn' for='toggle--knob'><span class='toggle--feature' data-label-on='Available'  data-label-off='Reserved'></span></label>
		</div>";
echo "<td><a href=news_edit.php?id=".$row['news_id'].">Edit</a>";

   /* echo "<td><a href=news_del.php?id=".$row['news_id'].">Delete</a>";*/
    if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'news_editor'])){
        if($OJ_SAE||function_exists("system")){
            ?>
            <td><a href=# onclick='javascript:if(confirm("Delete?")) location.href="news_del.php?id=<?php echo $row['news_id']?>&getkey=<?php echo $_SESSION[$OJ_NAME.'_'.'getkey']?>";'>
                Delete</a>
            <?php
        }
    }

	
	echo "</tr>";

    $count=1-$count;

>>>>>>> 91ee6283971238ae0597e008366c581921a81c6c
}

echo "</tr></form>";
echo "</table></div>";

echo "<div style='text-align:center;clear:both'>
<script src='/gg_bd_ad_720x90.js' type='text/javascript'></script>
<script src='/follow.js' type='text/javascript'></script>
</div>"

?>
<script type="text/javascript" src='../template/bs3/jquery.min.js' ></script>
                <script type="text/javascript">
    function phpfm(pid){
        //alert(pid);
        $.post("phpfm.php",{'frame':3,'pid':pid,'pass':''},function(data,status){
            if(status=="success"){
                document.location.href="phpfm.php?frame=3&pid="+pid;
            }
        });
    }

                </script>

<style>
	#oddrow{
		background-color:paleturquoise;
	}
</style>
