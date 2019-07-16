<?php
require_once( "admin-header.php" );
require_once( "../include/check_post_key.php" );
if ( !( isset( $_SESSION[ $OJ_NAME . '_' . 'administrator' ] ) || isset( $_SESSION[ $OJ_NAME . '_' . 'problem_editor' ] ) ) ) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit( 1 );
}
?>
<?php
require_once( "../include/db_info.inc.php" );
require_once( "../include/my_func.inc.php" );
?>
<?php

$db = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
$db->query("set names utf8");
$problemId = $_POST['problemId'];   //问题ID
$problemSummary = $_POST['problemSummary'];   //题解摘要
$content = $_POST['content'];   //题解详情

echo $problemId;
echo $problemSummary;
echo $content;
//更新题库中对应题目的题解，保存到数据库
$getData = "UPDATE problem_solution
SET problem_analyse_summary=\"{$problemSummary}\",problem_analyse=\"{$content}\"
WHERE problem_id=\"{$problemId}\"";

$result = $db->query($getData);

if($result){
    echo "sql执行成功";
}else{
    echo "sql执行失败";
}

?>

