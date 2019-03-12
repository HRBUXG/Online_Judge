<?php

$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
//查询学生信息
$con->query("SET NAMES utf8");//定义字符编码
$a = '16';  //年级接口
$b = '2017-10-12';//截至时间接口
$c = '2017-01-01';//起始时间接口
$d = '0';//专业接口
$e = '0';//班级接口

$array1 = array(); //总题数
$array2 = array();//AC数
$array3 = array();//专业
$array4 = array();//班级
$n = 0;

class out
{
    public $number;//总题数
    public $correct_number;//AC数
    public $message;//专业+班级

}

if ($d == '0' && $e == '0') {
    for ($j = 2; $j < 5; $j += 2) {
        for ($i = 1; $i < 10; $i++) {
            $sql = "SELECT user_id,result FROM solution WHERE ( in_date <= '" . $b . "%'and in_date >= '" . $c . "%'and user_id LIKE '" . $a . "%'and user_id LIKE '____" . $j . "%'and user_id LIKE '_____" . $i . "%')";
            $result = mysqli_query($con, $sql);
            $num = 0;
            $num1 = 0;
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                if ($row['result'] == 4) {
                    $num1++;
                }
                $num++;
            }
            if ($num != 0) {
                $array1[$n] = $num;
                $array2[$n] = $num1;
                $array3[$n] = $j;
                $array4[$n] = $i;
                $n++;
            }
        }
    }

} else if ($d != '0' && $e == '0') {
    for ($i = 1; $i < 10; $i++) {
        $sql = "SELECT user_id,result FROM solution WHERE ( in_date <= '" . $b . "%'and in_date >= '" . $c . "%'and user_id LIKE '" . $a . "%'and user_id LIKE '____" . $d . "%'and user_id LIKE '_____" . $i . "%')";

        $result = mysqli_query($con, $sql);
        $num = 0;
        $num1 = 0;
        $n = 0;
        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
        {
            if ($row['result'] == 4) {
                $num1++;
            }
            $num++;
        }
        if ($num != 0) {
            $array1[$n] = $num;
            $array2[$n] = $num1;
            $array3[$n] = $d;
            $array4[$n] = $i;
            $n++;
        }
    }

} else if ($d != '0' && $e != '0') {

    $sql = "SELECT user_id,result FROM solution WHERE ( in_date <= '" . $b . "%'and in_date >= '" . $c . "%'and user_id LIKE '" . $a . "%'and user_id LIKE '____" . $d . "%'and user_id LIKE '_____" . $e . "%')";

    $result = mysqli_query($con, $sql);
    $num = 0;
    $num1 = 0;
    $n = 0;

    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        if ($row['result'] == 4) {
            $num1++;
        }
        $num++;
    }
    $array1[0] = $num;
    $array2[0] = $num1;
    $array3[0] = $d;
    $array4[0] = $e;
} else {
    echo "错误";
}
$array5 = array(); //总题数
for ($i = 0; $i < count($array1); $i++) {
    if ($array3[$i] == 2) {
        $array5[$i] = $array3[$i] . '计算机' . $array4[$i] . '班';
    }
    if ($array3[$i] == 4) {
        $array5[$i] = $array3[$i] . '软件' . $array4[$i] . '班';
    }
}

$shuchu = array();
for ($i = 0; $i < count($array1); $i++) {
    $gz = new out();
    $gz->number = (String)$array1[$i];  // 题的总数
    $gz->correct_number = (String)$array2[$i];  //正确数
    $gz->message = $array5[$i];  //班级信息

    $shuchu[] = $gz;
}
echo json_encode($shuchu);
?>
