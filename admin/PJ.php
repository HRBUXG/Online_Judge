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
        <form action="PJ.php" method="GET">
            <td><font size=1>年级1:<input type="text" name="TH"></td>
            <td> <font size=1>年级2:<input type="text" name="ND"></td>
            <td> <font size=1> 大几:<input type="text" name="BQ"></td>
            <td> <input type="submit" value="提交"> <a>导出表格</a>
        </form></tr>
    </body>
    </html>
<?php
/**
 ***
 * Created by PhpStorm.
 * User: LIJICHEN
 * Date: 2019/2/26
 * Time: 19:33
 * 接口：3个，两个入学年份接口，一个年级接口
 * 比如输入2016   2017  2 ；统计出这两个年级每个班在大（2）的做题情况，包括正确量，提交量，AC率，每个班的总人数，年级的总人数
 */
error_reporting(E_ALL^E_NOTICE^E_WARNING);//消除警告

$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');


$nianji = array();
$nianji[0] = $_GET['TH'];//年级输入
$nianji[1] = $_GET['ND'];//年级输入
$nianji[2] = $_GET['BQ'];;//年级输入

if($nianji[0]!=0&&$nianji[1]!=0){

    class test_1
    {
        //软件
        public $array1 = array();////用户ID,正确数
        public $array2 = array();//年级,总题数
        public $array3 = array();//班级,AC
        public $array4 = array();//班级人数

    }

    class test_2
    {
        //计算机
        public $array1 = array();////用户ID,正确数
        public $array2 = array();//年级,总题数
        public $array3 = array();//班级,AC
        public $array4 = array();//班级人数

    }

    $class_1 = array();//存放年级对象,软件
    $class_2 = array();//存放年级对象,计算机

    $class_3 = array();//存放班级对象,软件
    $class_4 = array();//存放班级对象,计算机
    for ($j = 0;$j<2;$j++) {//规定年级最大数
        $class_1[] = new test_1();
        $class_2[] = new test_2();
    }

    $con->query("SET NAMES utf8");//定义字符编码
    for ($i=0;$i<2;$i++) {
        $sql = "SELECT user_id,grade,class FROM users WHERE grade = '" . $nianji[$i] . "'";//找出两个年级的所有学生
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
        {
            $str = $row['user_id'];
            $hhm = substr($str, 4, 1);
            if ($hhm == 4) {//软件
                $class_1[$i]->array1[] = $row['user_id'];
                $class_1[$i]->array2[] = $row['grade'];
                $class_1[$i]->array3[] = $row['class'];

            } elseif ($hhm == 2) {
                $class_2[$i]->array1[] = $row['user_id'];
                $class_2[$i]->array2[] = $row['grade'];
                $class_2[$i]->array3[] = $row['class'];
            }
        }
    }

    for ($j = 0;$j<2;$j++) {//规定年级最大数
        $class_3[] = new test_1();
        for ($i=0; $i<max($class_1[$j]->array3); $i++) {

            $class_3[$j]->array1[] = 0;
            $class_3[$j]->array2[] = 0;
            $class_3[$j]->array3[] = 0;
            $class_3[$j]->array4[] = 0;
        }
        $class_4[] = new test_2();
        for ($i=0; $i<max($class_2[$j]->array3); $i++) {
            $class_4[$j]->array1[] = 0;
            $class_4[$j]->array2[] = 0;
            $class_4[$j]->array3[] = 0;
            $class_4[$j]->array4[] = 0;
        }
    }

    /*
    for ($j=0; $j<2;$j++){
        for ($i=0; $i<count($class_1[$j]->array1);$i++){
            echo $class_1[$j]->array1[$i]." ";
            echo $class_1[$j]->array2[$i]." ";
            echo $class_1[$j]->array3[$i]."\n";
        }
        echo "------------------------------------";
        for ($i=0; $i<count($class_2[$j]->array1);$i++){
            echo $class_2[$j]->array1[$i]." ";
            echo $class_2[$j]->array2[$i]." ";
            echo $class_2[$j]->array3[$i]."\n";
        }
        echo "====================================";
    }*/



    for ($j = 0; $j<2;$j++) {//控制年级
//当前年份
        //////
        if($nianji[2]>0&&$nianji[2]<5){
            $now = ($nianji[$j]+$nianji[2]-1)."-09-01";
            $next = ($nianji[$j]+$nianji[2])."-09-01";
        }else{
            $now = ($nianji[$j]+$nianji[2]-1)."-09-01";
            $next = ($nianji[$j]+4)."-09-01";
        }

        //////

        for ($i = 0; $i < count($class_1[$j]->array1); $i++) {//软件,两个不同的年级
            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $class_1[$j]->array1[$i] . "' AND in_date between '" . $now . "' and '" . $next . "'";//所有的题目

            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                $class_3[$j]->array2[$class_1[$j]->array3[$i] - 1] += $row['count(*)'];//总题数,
                $class_3[$j]->array4[$class_1[$j]->array3[$i] - 1] += 1;//人数,
            }

            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $class_1[$j]->array1[$i] . "' AND result = 4 AND in_date between '" . $now . "' and '" . $next . "'";//所有的正确题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                $class_3[$j]->array1[$class_1[$j]->array3[$i] - 1] += $row['count(*)'];//正确题数
            }
        }

        for ($i = 0; $i < count($class_2[$j]->array1); $i++) {//计算机
            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $class_2[$j]->array1[$i] . "' AND in_date between '" . $now . "' and '" . $next . "'";//所有的题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                $class_4[$j]->array2[$class_2[$j]->array3[$i] - 1] += $row['count(*)'];//总题数
                $class_4[$j]->array4[$class_2[$j]->array3[$i] - 1] += 1;//人数
            }

            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $class_2[$j]->array1[$i] . "' AND result = 4 AND in_date between '" . $now . "' and '" . $next . "'";//所有的正确题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                $class_4[$j]->array1[$class_2[$j]->array3[$i] - 1] += $row['count(*)'];//正确题数
            }
        }
    }

    for ($j = 0; $j<2; $j++) {
        for ($i = 0; $i < count($class_3[$j]->array2); $i++) {//软件AC
            if ($class_3[$j]->array2[$i] != 0) {
                $class_3[$j]->array3[$i] = round(($class_3[$j]->array1[$i] / $class_3[$j]->array2[$i]), 3) * 100;//AC
            }
        }
    }
    for ($j = 0; $j<2; $j++) {
        for ($i = 0; $i < count($class_4[$j]->array2); $i++) {//计算机AC
            if ($class_4[$j]->array2[$i] != 0) {
                $class_4[$j]->array3[$i] = round(($class_4[$j]->array1[$i] / $class_4[$j]->array2[$i]), 3) * 100;//AC
            }
        }
    }

    for ($j = 0; $j<2; $j++) {
        if ($nianji[2] == 1) {
            $k = "一";
        } elseif ($nianji[2] == 2) {
            $k = "二";
        } elseif ($nianji[2] == 3) {
            $k = "三";
        } elseif ($nianji[2] == 4) {
            $k = "四";
        }else{

        }

        if($nianji[2]>0&&$nianji[2]<5){
            echo "<td>" . "大" . $k . "软件" . "</td>";
        }else{
            echo "<td>" .$nianji[0]."入学以来" . "软件 "."</td>";
        }

        echo "<td >" . "  " . "</td>";
        echo "<td >" . "总人数：" . "</td>";
        echo "<td >" . array_sum($class_3[$j]->array4). "</td>";
      //  for ($p = 0; $p < count($class_3[$j]->array2)-3; $p++) {//
            echo "<td >" . "  " . "</td>";
      //  }
        if($nianji[2]>0&&$nianji[2]<5){
            echo "<td >" . "大" . $k . "计算机" . "</td>";
        }else{
            echo "<td>" .$nianji[0]."入学以来" . "计算机 "."</td>";
        }

        echo "<td>" . "  " . "</td>";
        echo "<td>" . "总人数：" . "</td>";
        echo "<td>" . array_sum($class_4[$j]->array4). "</td>";
  //      for ($p = 0; $p < count($class_4[$j]->array2)-3; $p++) {//
            echo "<td >" . "  " . "</td>";
    //    }
        echo "<tr></tr>";

        echo "<td>" . "班级" . "</td>";
        for ($p = 0; $p < count($class_3[$j]->array2); $p++) {//

            echo "<td >" . ($p + 1) . "</td>";
            //echo $array8[$i]." ";
        }
        echo "<td>" . "班级" . "</td>";
        for ($p = 0; $p < count($class_4[$j]->array2); $p++) {//

            echo "<td>" . ($p + 1) . "</td>";
            //echo $array8[$i]." ";
        }
        echo "<tr></tr>";

        echo "<td >" . "总题数" . "</td>";
        for ($i = 0; $i < count($class_3[$j]->array2); $i++) {
            echo "<td >" . $class_3[$j]->array2[$i] . "</td>";
        }
        echo "<td>" . "总题数" . "</td>";
        for ($i = 0; $i < count($class_4[$j]->array2); $i++) {
            echo "<td>" . $class_4[$j]->array2[$i] . "</td>";
        }
        echo "<tr></tr>";

        echo "<td >" . "正确题数" . "</td>";
        for ($i=0;$i<count($class_3[$j]->array1);$i++) {
            echo "<td>" . $class_3[$j]->array1[$i] . "</td>";
        }
        echo "<td>" . "正确题数" . "</td>";
        for ($i=0;$i<count($class_4[$j]->array1);$i++) {
            echo "<td>" . $class_4[$j]->array1[$i] . "</td>";
        }
        echo "<tr></tr>";

        echo "<td>" . "AC" . "</td>";
        for ($i=0;$i<count($class_3[$j]->array3);$i++) {
            echo "<td>" . $class_3[$j]->array3[$i]. "%" . "</td>";
        }
        echo "<td>" . "AC" . "</td>";
        for ($i=0;$i<count($class_4[$j]->array3);$i++) {
            echo "<td>" . $class_4[$j]->array3[$i] . "%" . "</td>";
        }
        echo "<tr></tr>";

        echo "<td>" . "人数" . "</td>";
        for ($i=0;$i<count($class_3[$j]->array4);$i++) {
            echo "<td>" . $class_3[$j]->array4[$i]. "人" . "</td>";
        }
        echo "<td>" . "人数" . "</td>";
        for ($i=0;$i<count($class_4[$j]->array4);$i++) {
            echo "<td>" . $class_4[$j]->array4[$i] . "人" . "</td>";
        }

        echo "<tr></tr>";
     //   for ($p = 0; $p < (count($class_3[$j]->array2)+count($class_4[$j]->array2)+2); $p++) {//
        //    echo "<td>" . "  " . "</td>";
      //  }
        echo "<tr></tr>";

    }
}//else{echo "请按照要求输入两个不同的年级(如“2018”“2019”)和这两个年级在大几的情况!";}
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
