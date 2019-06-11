<table>
<tr>
    <html>
    <head>
        <meta charset="utf-8">
        <title>表格</title>
    </head>
    <body>
    <tr>
        <form action="Ranking.php" method="GET">
            <td><font size=1>题号:<input type="text" name="TH"></td>
            <td> <font size=1>难度系数:<input type="text" name="ND"></td>
            <td> <font size=1> 标签:<input type="text" name="BQ"></td>
            <td> <font size=1>AC率:<input type="text" name="AC"></td>
            <td><font size=1>来源:<input type="text" name="LY"></td>
            <td><font size=1>页数:<input type="text" name="YS"></td>
            <td> <input type="submit" value="提交"> <a>导出表格</a>
        </form></tr>
    </body>
    </html>
<?php
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$array5 = array();
$array6 = array();
$array7 = array();
$array8 = array();
$array9 = array();
$array10 = array();
$array11 = array();
$array12 = array();
if(isset($_GET['TH'])) {
    $_GET['ND'];
    $_GET['BQ'];
    $_GET['AC'];
    $_GET['LY'];
    $_GET['YS'];
    /*打开数据库*/
    $con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
    $con->query("SET NAMES utf8");//定义字符编码
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    $ti0 = $_GET['TH'];
    $ti1 = $_GET['ND'];
    $ti2 = $_GET['BQ'];
    $ti3 = $_GET['AC'];
    $ti4 = $_GET['LY'];
    $ti5 = $_GET['YS'];
if($ti0!=0){
    if($ti1!=0){
        if($ti2!=0){
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'AND  source like '%" . $ti4 . "%' and difficulty='" . $ti1 . "'and tags like '%" . $ti2 . "%' ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'and difficulty='" . $ti1 . "'and tags like '%" . $ti2 . "%' ";//所有的题目
            }
        }else{
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'AND  source like '%" . $ti4 . "%' and difficulty='" . $ti1 . "' ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'and difficulty='" . $ti1 . "' ";//所有的题目
            }
        }
    }else{
        if($ti2!=0){
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'AND  source like '%" . $ti4 . "%' and tags like '%" . $ti2 . "%' ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'and tags like '%" . $ti2 . "%' ";//所有的题目
            }
        }else{
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "'AND  source like '%" . $ti4 . "%'  ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE problem_id >= '" . $ti0 . "' ";//所有的题目
            }
        }
    }
}else{
    if($ti1!=0){
        if($ti2!=0){
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE  source like '%" . $ti4 . "%' and difficulty='" . $ti1 . "'and tags like '%" . $ti2 . "%' ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE  difficulty='" . $ti1 . "'and tags like '%" . $ti2 . "%' ";//所有的题目
            }
        }else{
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE  source like '%" . $ti4 . "%' and difficulty='" . $ti1 . "' ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE  difficulty='" . $ti1 . "' ";//所有的题目
            }
        }
    }else{
        if($ti2!=0){
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE   source like '%" . $ti4 . "%' and tags like '%" . $ti2 . "%' ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem WHERE  tags like '%" . $ti2 . "%' ";//所有的题目
            }
        }else{
            if($ti4!=0){
                $sql = "SELECT * FROM problem WHERE  source like '%" . $ti4 . "%'  ";//所有的题目
            }else{
                $sql = "SELECT * FROM problem   ";//所有的题目
            }
        }
    }
}
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array1[] = $row['problem_id'];
        $array2[]=$row['accepted'];
        $array3[]=$row['submit'];
        $array5[]=$row['source'];
        $array6[]=$row['difficulty'];
        $array7[]=$row['tags'];
    }

for($i=0;$i<count($array1);$i++){
        if($array3[$i]>0){$array4[$i]=round($array2[$i]/$array3[$i],4)*100;
        }else{
            $array4[$i]=0;
        }

}
$n=0;
if($ti3!=0){
    for($i=0;$i<count($array1);$i++){
        if($array4[$i]>=$ti3){

            $array8[$n] =$array1[$i];
            $array9[$n] =$array4[$i];
            $array10[$n] =$array5[$i];
            $array11[$n] =$array6[$i];
            $array12[$n] =$array7[$i];
            $n++;
        }
    }
}else{
    for($i=0;$i<count($array1);$i++){
        $array8[$n] =$array1[$i];
        $array9[$n] =$array4[$i];
        $array10[$n] =$array5[$i];
        $array11[$n] =$array6[$i];
        $array12[$n] =$array7[$i];
        $n++;
    }
}
    echo "<td >"."<font size=5>"."题号"."</font>";
    echo "<td >"."<font size=5>"."来源"."</font>";
    echo "<td >"."<font size=5>"."难度系数"."</font>";
    echo "<td >"."<font size=5>"."标签"."</font>";
    echo "<td >"."<font size=5>"."AC率"."</font>";
    echo "</tr>";
//控制页数的出题数
    if($ti5<=0){
        $ti5=0;
    }
 if($ti5*20<count($array8)&&($ti5+1)*20<=count($array8)){
     for($i=$ti5*20;$i<($ti5+1)*20;$i++){
         echo "<td >"."<font size=3>"."$array8[$i]"."</font>";
         echo "<td >"."<font size=3>".$array10[$i]."</font>";
         echo "<td >"."<font size=3>".$array11[$i]."</font>";
         echo "<td >"."<font size=3>".$array12[$i]."</font>";
         echo "<td >"."<font size=3>".$array9[$i]."</font>";
         echo "</tr>";
     }
 }else{
     if((count($array8)-$ti5*20)>0){
         for($i=$ti5*20;$i<count($array8);$i++){
             echo "<td >"."<font size=3>"."$array8[$i]"."</font>";
             echo "<td >"."<font size=3>".$array10[$i]."</font>";
             echo "<td >"."<font size=3>".$array11[$i]."</font>";
             echo "<td >"."<font size=3>".$array12[$i]."</font>";
             echo "<td >"."<font size=3>".$array9[$i]."</font>";
             echo "</tr>";
         }
     }else{
         echo "<td >"."<font size=5>"."到底了!"."</font>";
     }
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
    a.download = "题表.xls";
</script>

</table>