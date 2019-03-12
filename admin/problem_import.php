<?php function writable($path){
	$ret=false;
	$fp=fopen($path."/testifwritable.tst","w");
	$ret=!($fp===false);
	fclose($fp);
	unlink($path."/testifwritable.tst");
	return $ret;
}
require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))&&!(isset($_SESSION[$OJ_NAME.'_'.'problem_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
   $maxfile=min(ini_get("upload_max_filesize"),ini_get("post_max_size"));

?>

<div class="container">
<?php 
    $show_form=true;
   if(!isset($OJ_SAE)||!$OJ_SAE){
	   if(!writable($OJ_DATA)){
		   echo " You need to add  $OJ_DATA into your open_basedir setting of php.ini,<br>
					or you need to execute:<br>
					   <b>chmod 775 -R $OJ_DATA && chgrp -R www-data $OJ_DATA</b><br>
					you can't use import function at this time.<br>"; 
			$show_form=false;
	   }
	   if(!file_exists("../upload"))mkdir("../upload");
	   if(!writable("../upload")){
	   	 
		   echo "../upload is not writable, <b>chmod 770</b> to it.<br>";
		   $show_form=false;
	   }
	}	
	if($show_form){
?>
<br>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
<form action='problem_import_xml.php' method=post enctype="multipart/form-data">

	<h2 align="center">Import Problem</h2>
    <span class="u-icon-detail"><i></i></span>
    <input type=file name=fps style="width: 75px; background-color: gray" >
	<?php require_once("../include/set_post_key.php");?>

    <div class="div-border"></div>
    <div class="wrap">
        <div class="shan"></div>
    </div>

<ul>
    <li>Import FPS data ,please make sure you file is smaller than [<?php echo $maxfile?>] </li><br/>
    <li>or set upload_max_filesize and post_max_size in PHP.ini</li><br/>
    <li>if you fail on import big files[10M+],try enlarge your [memory_limit]  setting in php.ini.</li><br/>
</ul>

    <div align="center"><input type=submit value='Import' class="btn btn-primary"></div>
</form>
<?php 
  
   	}
   
?>
<br>
免费题目<a href="https://github.com/zhblue/freeproblemset/blob/master/fps-examples/fps-loj-small-pics.zip" target="_blank">下载</a><br>
更多题目请到 <a href="http://tk.hustoj.com/" target="_blank">TK 题库</a> 选购。
</div>

<style>
    .wrap{
        height: 40px;
        width: 50px;
    }

    .shan {
        position: absolute;
        top: 0px;
        left: 0px;
        right:1060px;
        bottom: 300px;
        margin: auto;


        background: red;
        width: 25px;
        height: 25px;
        border-radius: 100%;
        animation: show-animation 2s ease-in-out 0s infinite;
        -moz-animation: show-animation 2s ease-in-out 0s infinite;
        -webkit-animation: show-animation 2s ease-in-out 0s infinite;
    }

    @keyframes show-animation{
        0%{
            transform: scale(0);
            -moz-transform: scale(0);
            -webkit-transform: scale(0);
        }
        100%{
            transform: scale(1);
            -moz-transform: scale(1);
            -webkit-transform: scale(1);
            opacity: 0;
        }
    }


/*三条杠的细节显示图标*/
    .u-icon-detail
    {
        width: 12px;
        height: 10px;
        padding: 19px 10px;
    }

    .u-icon-detail i
    {
        display: block;
        position: relative;
        width: 12px;
        height: 2px;
        background-color: #ffa124;
    }

    .u-icon-detail i:before
    {
        position: absolute;
        top: 4px;
        width: 12px;
        height: 2px;
        background-color: #ffa124;
        content: '';
    }

    .u-icon-detail i:after
    {
        position: absolute;
        top: 8px;
        width: 7px;
        height: 2px;
        background-color: #ffa124;
        content: '';
    }
</style>
