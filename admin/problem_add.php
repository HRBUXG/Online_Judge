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
require_once( "../include/problem.php" );
?>
<?php // contest_id


$title = $_POST[ 'title' ];
$title = str_replace(",", "&#44;", $title);
$time_limit = $_POST[ 'time_limit' ];
$memory_limit = $_POST[ 'memory_limit' ];
$description = $_POST[ 'description' ];
$input = $_POST[ 'input' ];
$output = $_POST[ 'output' ];
$sample_input = $_POST[ 'sample_input' ];
$sample_output = $_POST[ 'sample_output' ];
$test_input = $_POST[ 'test_input' ];
$test_output = $_POST[ 'test_output' ];
$hint = $_POST[ 'hint' ];
$source = $_POST[ 'source' ];
$spj = $_POST[ 'spj' ];
/*****************************************添加开始***************************************************************************/
$sample_input2 = $_POST[ 'sample_input2' ];
$sample_output2 = $_POST[ 'sample_output2' ];
$sample_input3 = $_POST[ 'sample_input3' ];
$sample_output3 = $_POST[ 'sample_output3' ];
$tags = $_POST[ 'tags' ];
$difficulty = $_POST[ 'difficulty' ];
$level = $_POST[ 'level' ];
/*****************************************添加开始***************************************************************************/
//新增 分级
if ( get_magic_quotes_gpc() ) {
	$title = stripslashes( $title );
	$time_limit = stripslashes( $time_limit );
	$memory_limit = stripslashes( $memory_limit );
	$description = stripslashes( $description );
	$input = stripslashes( $input );
	$output = stripslashes( $output );
	$sample_input = stripslashes( $sample_input );
	$sample_output = stripslashes( $sample_output );
	$test_input = stripslashes( $test_input );
	$test_output = stripslashes( $test_output );
	$hint = stripslashes( $hint );
	$source = stripslashes( $source );
	$spj = stripslashes( $spj );
	$source = stripslashes( $source );
/*****************************************添加开始***************************************************************************/
	$tags = stripslashes( $tags );
	$difficulty = stripslashes( $difficulty );
	$sample_input2 = stripslashes( $sample_input2 );
	$sample_output2 = stripslashes( $sample_output2 );
	$sample_input3 = stripslashes( $sample_input3 );
	$sample_output3 = stripslashes( $sample_output3 );
	$level = stripslashes( $level );
/*****************************************添加结束***************************************************************************/
}
$title = RemoveXSS( $title );
$description = RemoveXSS( $description );
$input = RemoveXSS( $input );
$output = RemoveXSS( $output );
$hint = RemoveXSS( $hint );
//echo "->".$OJ_DATA."<-"; 
/*****************************************修改开始***************************************************************************/
$pid = addproblem( $title, $time_limit, $memory_limit, $description, $input, $output, $sample_input, $sample_output, $hint, $source, $spj, $OJ_DATA, $tags, $difficulty, $sample_input2, $sample_output2, $sample_input3, $sample_output3,$level );
/*****************************************修改结束***************************************************************************/
$basedir = "$OJ_DATA/$pid";
mkdir( $basedir );
if ( strlen( $sample_output ) && !strlen( $sample_input ) )$sample_input = "0";
if ( strlen( $sample_input ) )mkdata( $pid, "sample.in", $sample_input, $OJ_DATA );
if ( strlen( $sample_output ) )mkdata( $pid, "sample.out", $sample_output, $OJ_DATA );

/*****************************************添加开始***************************************************************************/
if ( strlen( $sample_output2 ) && !strlen( $sample_input2 ) )$sample_input2 = "0";
if ( strlen( $sample_input2 ) )mkdata( $pid, "sample.in2", $sample_input2, $OJ_DATA );
if ( strlen( $sample_output2 ) )mkdata( $pid, "sample.out2", $sample_output2, $OJ_DATA );
if ( strlen( $sample_output3 ) && !strlen( $sample_input3 ) )$sample_input3 = "0";
if ( strlen( $sample_input3 ) )mkdata( $pid, "sample.in3", $sample_input3, $OJ_DATA );
if ( strlen( $sample_output3 ) )mkdata( $pid, "sample.out3", $sample_output3, $OJ_DATA );
/*****************************************添加结束***************************************************************************/

if ( strlen( $test_output ) && !strlen( $test_input ) )$test_input = "0";
if ( strlen( $test_input ) )mkdata( $pid, "test.in", $test_input, $OJ_DATA );
if ( strlen( $test_output ) )mkdata( $pid, "test.out", $test_output, $OJ_DATA );

$sql = "insert into `privilege` (`user_id`,`rightstr`)  values(?,?)";
pdo_query( $sql, $_SESSION[ $OJ_NAME . '_' . 'user_id' ], "p$pid" );
$_SESSION[ $OJ_NAME . '_' . "p$pid" ] = true;

echo "problem_add.php<a href='javascript:phpfm($pid);'>Add more TestData now !</a>";
/*	*/
?>
<script src='../template/bs3/jquery.min.js'></script>
<script>
/*****************************************添加开始***************************************************************************/ 
	$( document ).ready( function () {
		var error = $( "#error" ).text();
		if ( error.length != 0 ) {
			alert( "有错误！" );
		} else {
			document.location.href = "phpfm.php?frame=3&pid=" + <?php echo $pid?>;
		}

	} );
/*****************************************添加结束***************************************************************************/

	function phpfm( pid ) {
		//alert(pid);
		$.post( "phpfm.php", {
			'frame': 3,
			'pid': pid,
			'pass': ''
		}, function ( data, status ) {
			if ( status == "success" ) {
				document.location.href = "phpfm.php?frame=3&pid=" + pid;
			}
		} );
	}
</script>
