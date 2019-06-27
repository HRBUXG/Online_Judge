<?php

$conn = mysqli_connect("localhost", "root", "HRBUXGOJ");
mysqli_query($conn, "set names utf8");
if (!$conn) {
    echo "连接失败";
} else {
    $id = $_GET['id'];
    mysqli_select_db($conn, "jol");
    $sql = "delete from pushmsg where id =" . $id;
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
echo "删除成功！";
?>