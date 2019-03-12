<?php
//echo "<h2>down界面</h2>";
$conn = mysql_connect("localhost", "root", "HRBUXGOJ");
if (!$conn) {
    echo "连接失败";
}
mysql_select_db("jol", $conn);
mysql_query("set names utf8");

$id = $_GET["fid"];
echo "id:" . $id;
$sql = "select file_download_total from file where file_id='$id'";
$data = mysql_query($sql, $conn);
$num = mysql_result($data, 0);
/*echo "<script>alert('$num');</script>";*/
$num = $num + 1;
/*echo "<script>alert('$num');</script>";*/
$sql1 = "update file set file_download_total='$num' where file_id='$id'";
$data2 = mysql_query($sql1, $conn);
?>
