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
            <title>年级做题情况表</title>
        </head>
    <tr>
        <form action="all_nianji_san.php" method="GET">
            <td><font size=1>年级:<input type="text" name="NJ"></td>
            <td> <input type="submit" value="提交"> <a>导出表格</a>
        </form></tr>
    </body>
    </html>
<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//消除警告
 /*打开数据库*/
 $con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
 if (!$con) {
     die('Could not connect: ' . mysql_error());
 }

if(isset($_GET['NJ'])) {
    $nianji = $_GET['NJ'];//年级输入


    //软件
    $array1 = array();//用户ID
    $array2 = array();//年级
    $array3 = array();//班级
    //计算机
    $array4 = array();//用户ID
    $array5 = array();//年级
    $array6 = array();//班级


    $con->query("SET NAMES utf8");//定义字符编码
    $sql = "SELECT user_id,grade,class FROM users WHERE grade = '" . $nianji . "'";//所有的题目
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $str = $row['user_id'];
        $hhm = substr($str, 4, 1);
        if ($hhm==4) {//软件
            $array1[] = $row['user_id'];
            $array2[] = $row['grade'];
            $array3[] = $row['class'];
        }elseif ($hhm==2){
            $array4[] = $row['user_id'];
            $array5[] = $row['grade'];
            $array6[] = $row['class'];
        }
    }



    class test_1
    {
        //软件
        public $array7 = array();//正确数
        public $array8 = array();//总题数
        public $array9 = array();//AC

        function __construct(){//构造函数


            $array7[] = 0;
            $array8[] = 0;
            $array9[] = 0;




        }
    }

    class test_2
    {
        //计算机
        public $array10 = array();//正确数
        public $array11 = array();//总题数
        public $array12 = array();//AC

        function __construct(){//构造函数


            $array10[] = 0;
            $array11[] = 0;
            $array12[] = 0;

        }
    }

    $class_1 = array();//存放年级对象,软件
    $class_2 = array();//存放年级对象,计算机
    for ($j = 0;$j<4;$j++) {//规定年级最大数
        $class_1[] = new test_1();
        for ($i=0; $i<max($array3); $i++) {

            $class_1[$j]->array7[] = 0;
            $class_1[$j]->array8[] = 0;
            $class_1[$j]->array9[] = 0;
        }
        $class_2[] = new test_2();
        for ($i=0; $i<max($array6); $i++) {
            $class_2[$j]->array10[] = 0;
            $class_2[$j]->array11[] = 0;
            $class_2[$j]->array12[] = 0;
        }
    }


    //当前年份
    $time = 2000+date('y',time());
    $now1 = $nianji;
    for ($j = 0; $j<4&&$now1<$time;$j++,$now1++) {
        $now = $now1."-09-01";
        $next = ($now1 + 1)."-09-01";
        for ($i = 0; $i < count($array1); $i++) {//软件
            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $array1[$i] . "' AND in_date between '" . $now . "' and '" . $next . "'";//所有的题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                $class_1[$j]->array8[$array3[$i] - 1] += $row['count(*)'];//总题数,大一
            }

            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $array1[$i] . "' AND result = 4 AND in_date between '" . $now . "' and '" . $next . "'";//所有的正确题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {


                $class_1[$j]->array7[$array3[$i] - 1] += $row['count(*)'];//正确题数,大一

            }
        }


        for ($i = 0; $i < count($array4); $i++) {//计算机
            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $array4[$i] . "' AND in_date between '" . $now . "' and '" . $next . "'";//所有的题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {

                $class_2[$j]->array11[$array6[$i] - 1] += $row['count(*)'];//总题数,大一


            }

            $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $array4[$i] . "' AND result = 4 AND in_date between '" . $now . "' and '" . $next . "'";//所有的正确题目
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {

                $class_2[$j]->array10[$array6[$i] - 1] += $row['count(*)'];//正确题数,大一



            }
        }
    }
    for ($i = 0; $i<count($class_1[0]->array8); $i++){//软件AC
        if ($class_1[0]->array8[$i] != 0){
            $class_1[0]->array9[$i] = round(($class_1[0]->array7[$i]/$class_1[0]->array8[$i]),3)*100;//大一
        }

        if ($class_1[1]->array8[$i] != 0){
            $class_1[1]->array9[$i] = round(($class_1[1]->array7[$i]/$class_1[1]->array8[$i]),3)*100;//大二
        }

        if ($class_1[2]->array8[$i] != 0){
            $class_1[2]->array9[$i] = round(($class_1[1]->array7[$i]/$class_1[1]->array8[$i]),3)*100;//大三
        }

        if ($class_1[3]->array8[$i] != 0){
            $class_1[3]->array9[$i] = round(($class_1[1]->array7[$i]/$class_1[1]->array8[$i]),3)*100;//大四
        }

    }

    for ($i = 0; $i<count($class_2[0]->array11); $i++){//计算机AC
        if ($class_2[0]->array11[$i] != 0){
            $class_2[0]->array12[$i] = round(($class_2[0]->array10[$i]/$class_2[0]->array11[$i]),3)*100;//大二
        }

        if ($class_2[1]->array11[$i] != 0){
            $class_2[1]->array12[$i] = round(($class_2[1]->array10[$i]/$class_2[1]->array11[$i]),3)*100;//大三
        }

        if ($class_2[2]->array11[$i] != 0){
            $class_2[2]->array12[$i] = round(($class_2[2]->array10[$i]/$class_2[2]->array11[$i]),3)*100;//大一
        }

        if ($class_2[3]->array11[$i] != 0){
            $class_2[3]->array12[$i] = round(($class_2[3]->array10[$i]/$class_2[3]->array11[$i]),3)*100;//大四
        }
    }
    for ($i = 0; $i<4; $i++){
        if ($i == 0){$k = "一";}
        elseif ($i == 1){$k = "二";}
        elseif ($i == 2){$k = "三";}
        elseif ($i == 3){$k = "四";}

        echo "<td >"."大".$k."软件";
        for ($p = 0; $p<count($class_1[0]->array8); $p++){//
            echo "<td>"."  ";
        }
        echo "<td >"."大".$k."计算机";
        for ($p = 0; $p<count($class_2[0]->array11); $p++){//
            echo "<td >"."  ";
        }
        echo "<tr></tr>";

        echo "<td>"."班级";
        for ($p = 0; $p<count($class_1[0]->array8); $p++){//

            echo "<td >".($p+1);
            //echo $array8[$i]." ";
        }
        echo "<td >"."班级";
        for ($p = 0; $p<count($class_2[0]->array11); $p++){//

            echo "<td >".($p+1);
            //echo $array8[$i]." ";
        }
        echo "<tr></tr>";

        echo "<td >"."总题数";
        for($j = 0;$j<count($class_1[0]->array8);$j++){
            echo "<td >".$class_1[$i]->array8[$j];
        }
        echo "<td>"."总题数";
        for($j = 0;$j<count($class_2[0]->array11);$j++){
            echo "<td>".$class_2[$i]->array11[$j];
        }
        echo "<tr></tr>";

        echo "<td >"."正确题数";
        for($j = 0;$j<count($class_1[0]->array8);$j++){
            echo "<td>".$class_1[$i]->array7[$j];
        }
        echo "<td>"."正确题数";
        for($j = 0;$j<count($class_2[0]->array11);$j++){
            echo "<td >".$class_2[$i]->array10[$j];
        }
        echo "<tr></tr>";

        echo "<td >"."AC";
        for($j = 0;$j<count($class_1[0]->array8);$j++){
            echo "<td >".$class_1[$i]->array9[$j]."%";
        }
        echo "<td >"."AC";
        for($j = 0;$j<count($class_2[0]->array11);$j++){
            echo "<td >".$class_2[$i]->array12[$j]."%";
        }
        echo "<tr></tr>";
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
