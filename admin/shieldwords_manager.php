<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/7/16
 * Time: 10:51
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>系统主页面</title>
</head>

<body>

<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
    <h2>shieldwords Manager</h2>
</div>
<div style="margin: 3% 30%">
    <form action="shieldwords_add.php">
        <label>添加新的屏蔽字</label>
        <input type="text" name="shieldwords">
        <button type="submit">提交</button>
    </form>
</div>

<?php


//5.设置$page的默认值
#$page = 1;

//8.修改$page的值
$page = empty($_GET['page']) ? 1 : $_GET['page'];
$conn = mysqli_connect("localhost", "root", "HRBUXGOJ");
mysqli_query($conn, "set names utf8");
if (!$conn) {
    echo "失败";
}
mysqli_select_db($conn, "jol");


//------------分页开始-------------------
//1.求出总条数
$sql = "select count(*) as count from shieldwords";
$result = mysqli_query($conn, $sql);
$pageRes = mysqli_fetch_assoc($result);
#var_dump($pageRes);   //13
$count = $pageRes['count'];

//2.每页显示数(5)
$num = 10;

//3.根据每页显示数求出总页数
$pageCount = ceil($count / $num);  //向上取整
#var_dump($pageCount);  //3

//4.根据总页数求出偏移量
$offset = ($page - 1) * $num;  //$page默认为 1, 下一步设置

//------------分页结束-------------------


//6.修改sql语句
$sql = "select * from shieldwords order by addtime desc limit " . $offset . ',' . $num;

#$sql = "select * from bbs_user";
$obj = mysqli_query($conn, $sql);
echo "<center>";
echo "<table style='text-align:center;' class=\"table table-hover\" border = 1 cellspacing = '0' cellpadding = '10'>";

echo "<th style='text-align:center;' >屏蔽字内容</th><th  style='text-align:center;width: 20%'>添加时间</th><th  style='text-align:center;width: 15%'>操作</th>";
while ($row = mysqli_fetch_assoc($obj)) {
    echo "<tr>";
    echo '<td>' . $row['keywords'] . '</td>';
    echo '<td>' . $row['addtime'] . '</td>';
    echo '<td><a href = "shieldwords_del.php?id=' . $row['id'] . '">【删除】</a></td>';
    echo "</tr>";
}

echo "</table>";
echo "<center>";

//10.设置上一页下一页的$prev和$next
$prev = $page - 1;
$next = $page + 1;

//11.设置页数限制
if ($prev < 1) {
    $prev = 1;
}
if ($next > $pageCount) {
    $next = $pageCount;
}

//关闭连接
mysqli_close($conn);
?>
<a href="shieldwords_manager.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;
<a href="shieldwords_manager.php?page=<?php echo $prev; ?>">上一页</a>&nbsp;&nbsp;&nbsp;
<!--混编简写-->
<a href="shieldwords_manager.php?page=<?= $next; ?>">下一页</a>&nbsp;&nbsp;&nbsp;
<a href="shieldwords_manager.php?page=<?= $pageCount; ?>">尾页</a>

</body>
</html>
