<table cellspacing="0">
    <tr>
        <html>
        <head>
            <style type="text/css">
                table{
                    border:0;
                    cellspacing:0;
                    cellpadding:0;
                }

                table tr{
                    border:none;
                    padding:0;
                    margin:0;
                }

                table td{
                    background:#cccc99;
                    border-bottom:3px solid red;
                    border-top:3px solid blue;
                    margin:0;
                    padding:7px;
                }

                table td:hover{
                    background:#ccdd00;
                    cursor:pointer;
                }

            </style>
            <meta charset="utf-8">
            <title>排名</title>
        </head>
    <tr>
        <form action="AC_shuxing.php" method="GET">
            <td><font size=1>年级:<input type="text" name="NJ"></td>
            <td> <font size=1>题号:<input type="text" name="TH"></td>
            <td> <input type="submit" value="提交"> <a>导出表格</a>
        </form></tr>
    </body>
    </html>
<?php
/**
 * Created by PhpStorm.
 * User: 10312
 * Date: 2019/2/20
 * Time: 15:00
 * 题号，标签，来源，提交量，正确量，AC
 */
/*打开数据库*/
$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
////////////////////////////////////////////////////////////////////////////////
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
if(isset($_GET['NJ'])&&isset($_GET['TH'])){
    $nianji = $_GET['NJ'];//年级输入
    $tihao = $_GET['TH'];//题号输入

//需要题号
    $problem_id = "";//题ID
    $source = "";//标签
    $tags = "";//来源

//需要题号和年级
    $tijiao = "";//提交量
    $zhengque = "";//正确量
    $AC = "";//AC

    $con->query("SET NAMES utf8");//定义字符编码
    $sql = "SELECT problem_id,source,tags FROM problem WHERE problem_id = '" . $tihao . "'";//题号，标签，来源
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))
    {
        $problem_id = $row['problem_id'];
        $source = $row['source'];
        $tags = $row['tags'];
    }

    $sql = "SELECT count(*) FROM users,solution WHERE users.user_id=solution.user_id and grade = '" . $nianji . "' and problem_id = '" . $tihao . "'";//题号，标签，来源
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))
    {
        $tijiao = $row['count(*)'];//提交量
    }

    $sql = "SELECT count(*) FROM users,solution WHERE users.user_id=solution.user_id and grade = '" . $nianji . "' and problem_id = '" . $tihao . "' and result = 4";//题号，标签，来源
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))
    {
        $zhengque = $row['count(*)'];//正确量
    }

    if ($zhengque != 0) {
        $AC = round(($zhengque/$tijiao),4)*100;//AC率
    }else{
        $AC = 0;
    }

//echo $problem_id."  ".$source."  ".$tags."  ".$tijiao."  ".$zhengque."  ".$AC;
      if($problem_id==null){echo "查无此题!请重新输入！";}else{
          echo "<tr><td >"."题号：".$problem_id."</tr>";
          echo "<tr><td >"."来源：".$source."</tr>";
          echo "<tr><td>"."标签：".$tags."</tr>";
          echo "<tr><td>"."提交量：".$tijiao."</tr>";
          echo "<tr><td>"."正确题数：".$zhengque."</tr>";
          echo "<tr><td >"."AC率：".$AC."%"."</tr>";
      }
}


?>
    <script>
        // 使用outerHTML属性获取整个table元素的HTML代码（包括<table>标签），然后包装成一个完整的HTML文档，设置charset为urf-8以防止中文乱码
        var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
        // 实例化一个Blob对象，其构造函数的第一个参数是包含文件内容的数组，第二个参数是包含文件类型属性的对象
        var blob = new Blob([html], { type: "application/vnd.ms-excel" });
        var a = document.getElementsByTagName("a")[0];
        // 利用URL.createObjectURL()方法为a元素生成blob URL
        a.href = URL.createObjectURL(blob);
        // 设置文件名
        a.download = "排名.xls";
    </script>
</table>
</html>