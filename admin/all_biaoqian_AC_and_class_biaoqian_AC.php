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
        <form action="all_biaoqian_AC_and_class_biaoqian_AC.php" method="GET">
            <td><font size=1>年级:<input type="text" name="NJ"></td>
            <td> <font size=1>班级:<input type="text" name="BJ"></td>
            <td> <font size=1>专业:<input type="text" name="ZY"></td>
            <td> <input type="submit" value="提交"> <a>导出表格</a>
        </form></tr>
    </body>
    </html>
<?php

error_reporting(E_ALL^E_NOTICE^E_WARNING);//消除警告
//////////////////////////////////////////
$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
//////////////////////////////////////////
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
$nianji = $_GET['NJ'];//年级输入

if($nianji!=null&&$nianji<=date('Y')&&$nianji>=date('Y')-10) {

    $nianji = $_GET['NJ'];//年级输入

    $BJ = $_GET['BJ'];
    $ZY = $_GET['ZY'];
    $BJ1 = $_GET['BJ']-1;

    //--------入学到现在的AC率，全年级----------------
    $tijiaoliang = array();//提交量
    $biaoqian = array();//标签
    $zhengqueliang = array();//正确量
    $all_AC = array();//年级AC率

    $zhengqueliang[] = 0;//正确量
    $tijiaoliang[] = 0;//提交量
    $biaoqian[] = "";//标签

    $all_nember = 0;//年级人数
//----------------入学到现在的AC率，各个班级------------------------
    class test
    {
        public $tijiaoliang = array();//提交量
        public $biaoqian = array();//标签
        public $zhengqueliang = array();//正确量
        public $all_AC = array();//年级AC率
        public $all_nember = 0;//班级人数

        function __construct()
        {//构造函数
            $zhengqueliang[] = 0;//正确量
            $tijiaoliang[] = 0;//提交量
            $biaoqian[] = "";//标签
        }
    }

    $class_1 = array();//存放班级对象,软件
    $class_2 = array();//存放班级对象,计算机
    for ($i = 0; $i < 12; $i++) {//规定班级最大数
        $class_1[] = new test();
        $class_2[] = new test();
    }

//---------------------------------------------------
    $con->query("SET NAMES utf8");//定义字符编码
    $sql = "SELECT tags,result,class,users.user_id FROM users,solution,problem WHERE users.user_id=solution.user_id AND problem.problem_id=solution.problem_id AND grade = '" . $nianji . "' ";//查出这个年级的学生做过的题
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $biaoqian_zu = preg_split('/[,:;]+/is', $row['tags']);//切割标签
//-------------------------全年级-----------------------------------------
        for ($j = 0; $j < count($biaoqian_zu); $j++) {
            $a = 0;//标签是否存在的标志位
            for ($i = 0; $i < count($biaoqian); $i++) {
                if ($biaoqian[$i] == $biaoqian_zu[$j]) {
                    $tijiaoliang[$i] = $tijiaoliang[$i] + 1;//标签存在+1
                    if ($row['result'] == 4) {
                        $zhengqueliang[$i] = $zhengqueliang[$i] + 1;
                    }
                    $a = 1;
                    break;
                }
            }
            if ($a == 0) {//标签不存在
                $tijiaoliang[] = 1;//新增标签提交量+1
                if ($row['result'] == 4) {
                    $zhengqueliang[] = 1;//新增标签正确数+1
                } else {
                    $zhengqueliang[] = 0;//新增标签正确数初始化
                }
                $biaoqian[] = $biaoqian_zu[$j];//新增标签

            }
        }
        //---------------------------每个班级---------------------------------------
        $hhm = substr($row['user_id'], 4, 1);
        if ($hhm == 4) {//软件

            for ($j = 0; $j < count($biaoqian_zu); $j++) {
                $a = 0;//标签是否存在的标志位
                for ($i = 0; $i < count($class_1[$row['class'] - 1]->biaoqian); $i++) {
                    if ($class_1[$row['class'] - 1]->biaoqian[$i] == $biaoqian_zu[$j]) {
                        $class_1[$row['class'] - 1]->tijiaoliang[$i] = $class_1[$row['class'] - 1]->tijiaoliang[$i] + 1;//标签存在+1
                        if ($row['result'] == 4) {
                            $class_1[$row['class'] - 1]->zhengqueliang[$i] = $class_1[$row['class'] - 1]->zhengqueliang[$i] + 1;
                        }
                        $a = 1;
                        break;
                    }
                }
                if ($a == 0) {//标签不存在
                    $class_1[$row['class'] - 1]->tijiaoliang[] = 1;//新增标签提交量+1
                    if ($row['result'] == 4) {
                        $class_1[$row['class'] - 1]->zhengqueliang[] = 1;//新增标签正确数+1
                    } else {
                        $class_1[$row['class'] - 1]->zhengqueliang[] = 0;//新增标签正确数初始化
                    }
                    $class_1[$row['class'] - 1]->biaoqian[] = $biaoqian_zu[$j];//新增标签
                }
            }

        } elseif ($hhm == 2) {//计算机
            for ($j = 0; $j < count($biaoqian_zu); $j++) {
                $a = 0;//标签是否存在的标志位
                for ($i = 0; $i < count($class_2[$row['class'] - 1]->biaoqian); $i++) {
                    if ($class_2[$row['class'] - 1]->biaoqian[$i] == $biaoqian_zu[$j]) {
                        $class_2[$row['class'] - 1]->tijiaoliang[$i] = $class_2[$row['class'] - 1]->tijiaoliang[$i] + 1;//标签存在+1
                        if ($row['result'] == 4) {
                            $class_2[$row['class'] - 1]->zhengqueliang[$i] = $class_2[$row['class'] - 1]->zhengqueliang[$i] + 1;
                        }
                        $a = 1;
                        break;
                    }
                }
                if ($a == 0) {//标签不存在
                    $class_2[$row['class'] - 1]->tijiaoliang[] = 1;//新增标签提交量+1
                    if ($row['result'] == 4) {
                        $class_2[$row['class'] - 1]->zhengqueliang[] = 1;//新增标签正确数+1
                    } else {
                        $class_2[$row['class'] - 1]->zhengqueliang[] = 0;//新增标签正确数+1
                    }
                    $class_2[$row['class'] - 1]->biaoqian[] = $biaoqian_zu[$j];//新增标签
                }
            }
        }
    }

    $sql = "SELECT count(*) FROM users WHERE grade = '" . $nianji . "' ";//查出这个年级的学生人数
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $all_nember = $row['count(*)'];
    }

    $sql = "SELECT user_id,class FROM users WHERE grade = '" . $nianji . "' ";//查出这个年级各个班级的学生人数
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $hhm = substr($row['user_id'], 4, 1);
        if ($hhm == 4) {//软件
            $class_1[$row['class'] - 1]->all_nember = $class_1[$row['class'] - 1]->all_nember + 1;
        } elseif ($hhm == 2) {//计算机
            $class_2[$row['class'] - 1]->all_nember = $class_2[$row['class'] - 1]->all_nember + 1;
        }
    }

//echo "全年级\n";

    echo "<td bgcolor='green'>" . "<font size=5>" .  $nianji  . "级" . "</font>";
    echo "<tr></tr>";
    for ($i = 0; $i < count($tijiaoliang); $i++) {
        if ($zhengqueliang[$i] != 0) {
            $all_AC[] = round(($zhengqueliang[$i] / $tijiaoliang[$i]), 3) * 100;//AC率
        } else {
            $all_AC[] = 0;
        }
        echo "<td>" . "AC:   " . $all_AC[$i] . "%";
        echo "<td>" . "正确题数:  " . $zhengqueliang[$i];
        echo "<td >" . "提交量: " . $tijiaoliang[$i];
        echo "<td>" . "标签: " . $biaoqian[$i];
        echo "<td >" . "人数:   " . $all_nember;
        echo "<td >" . "年级:" . $nianji;
        echo "<tr></tr>";

//    echo $all_AC[$i]."%:AC   ";
//    echo $zhengqueliang[$i].":正确题数  ";//正确题数
//    echo $tijiaoliang[$i].":提交量 ";//提交量
//    echo $biaoqian[$i].":标签 ";//标签
//    echo $all_nember.":人数   ";
//    echo $nianji.":年级\n";
    }


//echo "\n每个班级    软件\n";
    if ($BJ!=null || $ZY!=null) {
        if ($BJ!=null) {
            if ($ZY!=null) {
                //////////////////////////////////////////////
                if ($ZY == "计算机") {
                    echo "<tr></tr>";
                    echo "<td >" . "  计算机";
                    echo "<tr></tr>";
                    for ($i = 0; $i < count($class_2); $i++) {
                        if (count($class_2[$i]->tijiaoliang) == 0) {
                            break;
                        }
                        for ($j = 0; $j < count($class_2[$i]->tijiaoliang); $j++) {
                            if ($BJ1 == $i) {
                                if ($class_2[$i]->zhengqueliang[$j] != 0) {
                                    $class_2[$i]->all_AC[] = round(($class_2[$i]->zhengqueliang[$j] / $class_2[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                                } else {
                                    $class_2[$i]->all_AC[] = 0;
                                }
                                echo "<td>" . "AC:   " . $class_2[$i]->all_AC[$j] . "%";
                                echo "<td>" . "正确题数:  " . $class_2[$i]->zhengqueliang[$j];
                                echo "<td>" . "提交量: " . $class_2[$i]->tijiaoliang[$j];
                                echo "<td>" . "标签: " . $class_2[$i]->biaoqian[$j];
                                echo "<td >" . "人数:   " . $class_2[$i]->all_nember;
                                echo "<td>" . "班级:" . ($i + 1);
                                echo "<tr></tr>";
                            }
                        }
                        echo "<tr></tr>";
                    }
                } else {
                    echo "<tr></tr>";
                    echo "<td bgcolor='green'>" . "<font size=5>" . " 软件" . "</font>";
                    echo "<tr></tr>";
                    for ($i = 0; $i < count($class_1); $i++) {
                        if (count($class_1[$i]->tijiaoliang) == 0) {
                            break;
                        }
                        for ($j = 0; $j < count($class_1[$i]->tijiaoliang); $j++) {
                            if ($BJ1 == $i) {
                                if ($class_1[$i]->zhengqueliang[$j] != 0) {
                                    $class_1[$i]->all_AC[] = round(($class_1[$i]->zhengqueliang[$j] / $class_1[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                                } else {
                                    $class_1[$i]->all_AC[] = 0;
                                }
                                echo "<td>" . "AC:   " . $class_1[$i]->all_AC[$j] . "%";
                                echo "<td>" . "正确题数:  " . $class_1[$i]->zhengqueliang[$j];
                                echo "<td>" . "提交量: " . $class_1[$i]->tijiaoliang[$j];
                                echo "<td >" . "标签: " . $class_1[$i]->biaoqian[$j];
                                echo "<td>" . "人数:   " . $class_1[$i]->all_nember;
                                echo "<td >" . "班级:" . ($i + 1) . "</font>";
                                echo "<tr></tr>";
                            }
                        }
                        echo "<tr></tr>";
                    }
                }
                //////////////////////////////////////////////////////////////////
            } else {
                echo "<tr></tr>";
                echo "<td bgcolor='green'>" . "<font size=5>" . " 计算机" . "</font>";
                echo "<tr></tr>";
                for ($i = 0; $i < count($class_2); $i++) {
                    if (count($class_2[$i]->tijiaoliang) == 0) {
                        break;
                    }
                    for ($j = 0; $j < count($class_2[$i]->tijiaoliang); $j++) {
                        if ($BJ1 == $i) {

                            if ($class_2[$i]->zhengqueliang[$j] != 0) {
                                $class_2[$i]->all_AC[] = round(($class_2[$i]->zhengqueliang[$j] / $class_2[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                            } else {
                                $class_2[$i]->all_AC[] = 0;
                            }
                            echo "<td>" . "AC:   " . $class_2[$i]->all_AC[$j] . "%";
                            echo "<td>" . "正确题数:  " . $class_2[$i]->zhengqueliang[$j];
                            echo "<td>" . "提交量: " . $class_2[$i]->tijiaoliang[$j];
                            echo "<td>" . "标签: " . $class_2[$i]->biaoqian[$j];
                            echo "<td >" . "人数:   " . $class_2[$i]->all_nember;
                            echo "<td>" . "班级:" . ($i + 1);
                            echo "<tr></tr>";
                        }
                    }
                    echo "<tr></tr>";
                }

                echo "<tr></tr>";
                echo "<td bgcolor='green'>" . "<font size=5>" . " 软件" . "</font>";
                echo "<tr></tr>";
                for ($i = 0; $i < count($class_1); $i++) {
                    if (count($class_1[$i]->tijiaoliang) == 0) {
                        break;
                    }
                    for ($j = 0; $j < count($class_1[$i]->tijiaoliang); $j++) {
                        if ($BJ1 == $i) {
                            if ($class_1[$i]->zhengqueliang[$j] != 0) {
                                $class_1[$i]->all_AC[] = round(($class_1[$i]->zhengqueliang[$j] / $class_1[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                            } else {
                                $class_1[$i]->all_AC[] = 0;
                            }
                            echo "<td>" . "AC:   " . $class_1[$i]->all_AC[$j] . "%";
                            echo "<td>" . "正确题数:  " . $class_1[$i]->zhengqueliang[$j];
                            echo "<td>" . "提交量: " . $class_1[$i]->tijiaoliang[$j];
                            echo "<td >" . "标签: " . $class_1[$i]->biaoqian[$j];
                            echo "<td>" . "人数:   " . $class_1[$i]->all_nember;
                            echo "<td >" . "班级:" . ($i + 1) . "</font>";
                            echo "<tr></tr>";
                        }
                    }
                    echo "<tr></tr>";
                }
            }
        } else {
            if ($ZY == "计算机") {
                echo "<tr></tr>";
                echo "<td bgcolor='green'>" . "<font size=5>" . "  计算机" . "</font>";
                echo "<tr></tr>";
                for ($i = 0; $i < count($class_2); $i++) {
                    if (count($class_2[$i]->tijiaoliang) == 0) {
                        break;
                    }
                    for ($j = 0; $j < count($class_2[$i]->tijiaoliang); $j++) {

                        if ($class_2[$i]->zhengqueliang[$j] != 0) {
                            $class_2[$i]->all_AC[] = round(($class_2[$i]->zhengqueliang[$j] / $class_2[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                        } else {
                            $class_2[$i]->all_AC[] = 0;
                        }
                        echo "<td>" . "AC:   " . $class_2[$i]->all_AC[$j] . "%";
                        echo "<td>" . "正确题数:  " . $class_2[$i]->zhengqueliang[$j];
                        echo "<td>" . "提交量: " . $class_2[$i]->tijiaoliang[$j];
                        echo "<td>" . "标签: " . $class_2[$i]->biaoqian[$j];
                        echo "<td >" . "人数:   " . $class_2[$i]->all_nember;
                        echo "<td>" . "班级:" . ($i + 1);
                        echo "<tr></tr>";

                    }
                    echo "<tr></tr>";
                }
            } else {
                echo "<tr></tr>";
                echo "<td bgcolor='green'>" . "<font size=5>" . " 软件" . "</font>";
                echo "<tr></tr>";
                for ($i = 0; $i < count($class_1); $i++) {
                    if (count($class_1[$i]->tijiaoliang) == 0) {
                        break;
                    }
                    for ($j = 0; $j < count($class_1[$i]->tijiaoliang); $j++) {
                        if ($class_1[$i]->zhengqueliang[$j] != 0) {
                            $class_1[$i]->all_AC[] = round(($class_1[$i]->zhengqueliang[$j] / $class_1[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                        } else {
                            $class_1[$i]->all_AC[] = 0;
                        }
                        echo "<td>" . "AC:   " . $class_1[$i]->all_AC[$j] . "%";
                        echo "<td>" . "正确题数:  " . $class_1[$i]->zhengqueliang[$j];
                        echo "<td>" . "提交量: " . $class_1[$i]->tijiaoliang[$j];
                        echo "<td >" . "标签: " . $class_1[$i]->biaoqian[$j];
                        echo "<td>" . "人数:   " . $class_1[$i]->all_nember;
                        echo "<td >" . "班级:" . ($i + 1) . "</font>";
                        echo "<tr></tr>";

                    }
                    echo "<tr></tr>";
                }
            }
        }

        /////////////////
    } else {
        echo "<tr></tr>";
        echo "<td bgcolor='green'>" . "<font size=5>" . " 软件" . "</font>";
        echo "<tr></tr>";
        for ($i = 0; $i < count($class_1); $i++) {
            if (count($class_1[$i]->tijiaoliang) == 0) {
                break;
            }
            for ($j = 0; $j < count($class_1[$i]->tijiaoliang); $j++) {
                if ($class_1[$i]->zhengqueliang[$j] != 0) {
                    $class_1[$i]->all_AC[] = round(($class_1[$i]->zhengqueliang[$j] / $class_1[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                } else {
                    $class_1[$i]->all_AC[] = 0;
                }
                echo "<td>" . "AC:   " . $class_1[$i]->all_AC[$j] . "%";
                echo "<td>" . "正确题数:  " . $class_1[$i]->zhengqueliang[$j];
                echo "<td>" . "提交量: " . $class_1[$i]->tijiaoliang[$j];
                echo "<td >" . "标签: " . $class_1[$i]->biaoqian[$j];
                echo "<td>" . "人数:   " . $class_1[$i]->all_nember;
                echo "<td >" . "班级:" . ($i + 1) . "</font>";
                echo "<tr></tr>";

//        echo $class_1[$i]->all_AC[$j] . "%:AC   ";
//        echo $class_1[$i]->zhengqueliang[$j] . ":正确题数  ";//正确题数
//        echo $class_1[$i]->tijiaoliang[$j] . ":提交量 ";//提交量
//        echo $class_1[$i]->biaoqian[$j] . ":标签 ";//标签
//        echo $class_1[$i]->all_nember . ":人数   ";
//        echo ($i + 1) . ":班级\n";
            }
            echo "<tr></tr>";
        }

        echo "<tr></tr>";
        echo "<td bgcolor='green'>" . "<font size=5>" . "  计算机" . "</font>";
        echo "<tr></tr>";
        for ($i = 0; $i < count($class_2); $i++) {
            if (count($class_2[$i]->tijiaoliang) == 0) {
                break;
            }
            for ($j = 0; $j < count($class_2[$i]->tijiaoliang); $j++) {
                if ($class_2[$i]->zhengqueliang[$j] != 0) {
                    $class_2[$i]->all_AC[] = round(($class_2[$i]->zhengqueliang[$j] / $class_2[$i]->tijiaoliang[$j]), 3) * 100;//AC率
                } else {
                    $class_2[$i]->all_AC[] = 0;
                }
                echo "<td>" . "AC:   " . $class_2[$i]->all_AC[$j] . "%";
                echo "<td>" . "正确题数:  " . $class_2[$i]->zhengqueliang[$j];
                echo "<td>" . "提交量: " . $class_2[$i]->tijiaoliang[$j];
                echo "<td>" . "标签: " . $class_2[$i]->biaoqian[$j];
                echo "<td >" . "人数:   " . $class_2[$i]->all_nember;
                echo "<td>" . "班级:" . ($i + 1);
                echo "<tr></tr>";

//        echo $class_2[$i]->all_AC[$j] . "%:AC   ";
//        echo $class_2[$i]->zhengqueliang[$j] . ":正确题数  ";//正确题数
//        echo $class_2[$i]->tijiaoliang[$j] . ":提交量 ";//提交量
//        echo $class_2[$i]->biaoqian[$j] . ":标签 ";//标签
//        echo $class_2[$i]->all_nember . ":人数   ";
//        echo ($i + 1) . ":班级\n";
            }
            echo "<tr></tr>";
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
        a.download = "排名.xls";
    </script>
</table>
</html>
