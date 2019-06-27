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
$sql = "select count(*) as count from comment";
$result = mysqli_query($conn, $sql);
$pageRes = mysqli_fetch_assoc($result);
#var_dump($pageRes);   //13
$count = $pageRes['count'];

//2.每页显示数(5)
$num = 20;

//3.根据每页显示数求出总页数
$pageCount = ceil($count / $num);  //向上取整
#var_dump($pageCount);  //3

//4.根据总页数求出偏移量
$offset = ($page - 1) * $num;  //$page默认为 1, 下一步设置

//------------分页结束-------------------


//6.修改sql语句
$sql = "select * from comment limit " . $offset . ',' . $num;

#$sql = "select * from bbs_user";
$obj = mysqli_query($conn, $sql);
echo "<center>";
echo "<div id=\"header\" style=\"padding:5px;background-color:#000; color:#FFF;text-align:center;\">
    <h2>Comments Manager</h2>
</div><br />";
echo "<table class=\"table table-hover\" border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<!--<th>编号</th>--><th>用户编号</th><th>题目题号</th><th>评论内容</th><th>发布时间</th><th>操作</th>";
while ($row = mysqli_fetch_assoc($obj)) {
    echo "<tr>";
    /*    echo '<td>' . $row['id'] . '</td>';*/
    echo '<td>' . $row['user_id'] . '</td>';
    echo '<td>' . $row['problem_id'] . '</td>';
    echo '<td>' . $row['content'] . '</td>';
    echo '<td>' . $row['sendtime'] . '</td>';
    echo '<td><a href = "comments_del.php?id=' . $row['id'] . '">删除</a></td>';
    echo "</tr>";
}

echo "</table>";
#echo "<a href = 'add.php'>添加</a>";
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

<!--7.添加首页、上一页、下一页、尾页(href没有链接)-->
<!--9.给定链接,首页和尾页写死，首页就是page=1，尾页是总页数，上一页先用$prev表示，下一步设置，下一页同上一页-->
<a href="comments_manager.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;
<a href="comments_manager.php?page=<?php echo $prev; ?>">上一页</a>&nbsp;&nbsp;&nbsp;
<!--混编简写-->
<a href="comments_manager.php?page=<?= $next; ?>">下一页</a>&nbsp;&nbsp;&nbsp;
<a href="comments_manager.php?page=<?= $pageCount; ?>">尾页</a>

</body>
</html>