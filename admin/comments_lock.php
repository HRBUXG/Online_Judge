<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/3/29
 * Time: 14:20
 */
$conn = mysqli_connect("localhost", "root", "HRBUXGOJ");
mysqli_query($conn, "set names utf8");
if (!$conn) {
    echo "连接失败";
} else {
    $id = $_GET['id'];
    mysqli_select_db($conn, "jol");
    $sql = "update comment set `lock`=1 where `id` =" . $id;
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
echo "操作成功！";
echo "<script>
    window.history.back(-1);
</script>"
?>