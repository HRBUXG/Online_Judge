<?php
//echo "<h2>down界面</h2>";

$id = $_GET["fid"];
echo "id:" . $id;
$sql = "select file_download_total from file where file_id=''";
$data = pdo_query($sql, $id);
$num = $data[0]['file_download_total'];
/*echo "<script>alert('$num');</script>";*/
$num = $num + 1;
/*echo "<script>alert('$num');</script>";*/
$sql1 = "update file set file_download_total=? where file_id=?";
$data2 = pdo_query($sql1, $num, $id);
?>
