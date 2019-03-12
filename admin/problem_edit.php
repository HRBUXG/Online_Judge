<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit Problem</title>
</head>
<body>
<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");

require_once("../include/my_func.inc.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])
      ||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])
     )){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
include_once("kindeditor.php") ;
?>
<div class="container">
<?php if(isset($_GET['id'])){
;//	require_once("../include/check_get_key.php");
?>
<form method=POST action=problem_edit.php>
<?php $sql="SELECT * FROM `problem` WHERE `problem_id`=?";
$result=pdo_query($sql,intval($_GET['id']));
 $row=$result[0];
?>
<p>Problem Id: <?php echo $row['problem_id']?></p>
<input type=hidden name=problem_id value='<?php echo $row['problem_id']?>'>
<p><?php echo $MSG_TITLE?>:<input class="input-xxlarge" type=text name=title value='<?php echo htmlentities($row['title'],ENT_QUOTES,"UTF-8")?>'></p>
<?php echo $MSG_Time_Limit?>:<input class="input-mini" type=text name=time_limit size=20 value='<?php echo $row['time_limit']?>'>S
<?php echo $MSG_Memory_Limit?>:<input class="input-mini" type=text name=memory_limit size=20 value='<?php echo $row['memory_limit']?>'>MByte</p>
<!--				新增难度系数和标签-->
			<?php echo $MSG_PROBLEM_LABEL?>:<input class="input input-mini" type=text name=tags size='40' value='<?php echo ($row['tags']);?>' style="width:150px;">
			<?php echo $MSG_DEGREE_OF_DIFFICULTY?>:
			<select name=difficulty>
				<option value="1"  <?php if($row['difficulty']==1) echo('selected=""');?> >1</option>
				<option value="2" <?php if($row['difficulty']==2) echo('selected=""');?>>2</option>
				<option value="3" <?php if($row['difficulty']==3) echo('selected=""');?>>3</option>
				<option value="4" <?php if($row['difficulty']==4) echo('selected=""');?>>4</option>
			</select>
			<!--				新增难度系数和标签   结束-->

<p><?php echo $MSG_Description?>:<br><textarea class="kindeditor" rows=13 name=description cols=120><?php echo htmlentities($row['description'],ENT_QUOTES,"UTF-8")?></textarea></p>
<p><?php echo $MSG_Input?>:<br><textarea class="kindeditor" rows=13 name=input cols=120><?php echo htmlentities($row['input'],ENT_QUOTES,"UTF-8")?></textarea></p>
<p><?php echo $MSG_Output?>:<br><textarea class="kindeditor" rows=13 name=output cols=120><?php echo htmlentities($row['output'],ENT_QUOTES,"UTF-8")?></textarea></p>

<p><?php echo $MSG_Sample_Input?>:<textarea rows=13 name=sample_input cols=120><?php echo htmlentities($row['sample_input'],ENT_QUOTES,"UTF-8")?></textarea>
<?php echo $MSG_Sample_Output?>:<textarea rows=13 name=sample_output cols=120><?php echo htmlentities($row['sample_output'],ENT_QUOTES,"UTF-8")?></textarea></p>
<p><?php echo $MSG_Hint?>:<br><textarea class="kindeditor" rows=13 name=hint cols=120><?php echo htmlentities($row['hint'],ENT_QUOTES,"UTF-8")?></textarea></p>
<p><?php echo $MSG_SPJ?>: 
N<input type=radio name=spj value='0' <?php echo $row['spj']=="0"?"checked":""?>>
Y<input type=radio name=spj value='1' <?php echo $row['spj']=="1"?"checked":""?>></p>
<p><?php echo $MSG_Source?>:<br><textarea name=source rows=1 cols=70><?php echo htmlentities($row['source'],ENT_QUOTES,"UTF-8")?></textarea></p>
<div align=center>
<?php require_once("../include/set_post_key.php");?>
<input type=submit value=Submit name=submit>
</div></form>
<p>

<?php }else{
require_once("../include/check_post_key.php");
$id=intval($_POST['problem_id']);
if(!(isset($_SESSION[$OJ_NAME.'_'."p$id"])||isset($_SESSION[$OJ_NAME.'_'.'administrator']))) exit();	
$title=$_POST['title'];
$title = str_replace(",", "&#44;", $title);
$time_limit=$_POST['time_limit'];
$memory_limit=$_POST['memory_limit'];
//新加输入字段
$tags=$_POST ['tags'];
$difficulty=$_POST ['difficulty'];
//新加输入字段结束
$description=$_POST['description'];
$input=$_POST['input'];
$output=$_POST['output'];
$sample_input=$_POST['sample_input'];
$sample_output=$_POST['sample_output'];
$hint=$_POST['hint'];
$source=$_POST['source'];
$spj=$_POST['spj'];
if (get_magic_quotes_gpc ()) {
	$title = stripslashes ( $title);
	$time_limit = stripslashes ( $time_limit);
	$memory_limit = stripslashes ( $memory_limit);
	$description = stripslashes ( $description);
	$input = stripslashes ( $input);
	$output = stripslashes ( $output);
	$sample_input = stripslashes ( $sample_input);
	$sample_output = stripslashes ( $sample_output);
//	$test_input = stripslashes ( $test_input);
//	$test_output = stripslashes ( $test_output);
	$hint = stripslashes ( $hint);
	$source = stripslashes ( $source); 
        //新加输入字段
	$tags = stripslashes ( $tags );
	$difficulty=stripslashes ( $difficulty );
	//新加输入字段结束
	$spj = stripslashes ( $spj);
	$source = stripslashes ( $source );
}
$title=$title;
$description=$description;
$input=$input;
$output=$output;
$hint=$hint;
$basedir=$OJ_DATA."/$id";
echo "Sample data file Updated!<br>";

	if($sample_input&&file_exists($basedir."/sample.in")){
		//mkdir($basedir);
		$fp=fopen($basedir."/sample.in","w");
		fputs($fp,preg_replace("(\r\n)","\n",$sample_input));
		fclose($fp);
		
		$fp=fopen($basedir."/sample.out","w");
		fputs($fp,preg_replace("(\r\n)","\n",$sample_output));
		fclose($fp);
	}

	$spj=intval($spj);
//添加传值 $tags,$difficulty
$sql="UPDATE `problem` set `title`=?,`time_limit`=?,`memory_limit`=?,
	`description`=?,`input`=?,`output`=?,`sample_input`=?,`sample_output`=?,`hint`=?,`source`=?,`spj`=?,`tags`=?,`difficulty`=?,`in_date`=NOW()
	WHERE `problem_id`=?";

@pdo_query($sql,$title,$time_limit,$memory_limit,$description,$input,$output,$sample_input,$sample_output,$hint,$source,$spj,$tags,$difficulty,$id) ;
	//添加传值 $tags,$difficulty结束	
echo "Edit OK!";


		
echo "<a href='../problem.php?id=$id'>See The Problem!</a>";
}
?>
</div>
</body>
</html>

