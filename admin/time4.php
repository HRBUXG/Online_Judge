<?php
/**
 * Created by PhpStorm.
 * User: 10312
 * Date: 2019/3/11
 * Time: 18:58
 */

header('Contebt-type:json;charset=utf-8');
if (is_numeric($_POST['n'])){
    $input_year = $_POST['n'];
// echo $input_year;
    $input_mon = $_POST['y'];
    $input_day = $_POST['r'];
    $output_year = $_POST['n1'];
    $output_mon = $_POST['y1'];
    $output_day = $_POST['r1'];
}else {
    //--------------初始化-----------
    $input_year = (date('Y') - 1);
    // echo $input_year;
    $input_mon = date('m');
    $input_day = date('d');
    $output_year = date('Y');
    $output_mon = date('m');
    $output_day = date('d');
//----------------------------------------
}

class ti2
{
    public $time ;//日期
    public $num ;//人数
}

$class_1 = array();//存放对象
$class = new ti2();

$class_1 = array();//存放年级对象,软件
$stand = mktime(0, 0, 0, $input_mon, $input_day, $input_year);//起始日期
$end = mktime(0, 0, 0, $output_mon, $output_day, $output_year);

$jishi = $stand;
$time_start = 60*60;//一个小时

$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
    $con->query("SET NAMES utf8");//定义字符编码
    $sql = "select count(*), DATE_FORMAT( judgetime ,'%Y-%m-%d %H')  as t    from solution WHERE judgetime between '" . date("Y-m-d H",$stand) . "%' and '" . date("Y-m-d H",$end) . "%' group by DATE_FORMAT( judgetime ,'%Y-%m-%d %H')";
    //$sql = "SELECT count(*) FROM solution WHERE judgetime between '" . date("Y-m-d H:i",$stand) . "%' and '" . date("Y-m-d H:i",$stand += $time_start) . "%'";//所有的题目
    $result = mysqli_query($con, $sql);
    $biaozhi = 0;

    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {

        while (true) {
           $time = date("Y-m-d H",($jishi));
            if ($time==$row['t']){
                break;
            }

            $class = new ti2();
            $class->num=0;
            $class->time=$time;
            $class_1[]=$class;
            if ($time==date("Y-m-d H",$end)){
                $biaozhi = 1;
                break;
            }
            $jishi+=$time_start;
        }
        if ($biaozhi == 1){break;}
        $class = new ti2();
        $class->num=$row['count(*)'];
        $class->time=$row['t'];
        $class_1[]=$class;
        $jishi = (strtotime($row['t'].":00:00") - strtotime("1970-01-01 00:00:00"));
    }

        while (true) {
            $time = date("Y-m-d H",($jishi));

            $class = new ti2();
            $class->num=0;
            $class->time=$time;
            $class_1[]=$class;
            if ($time==date("Y-m-d H",$end)){
                break;
            }
            $jishi+=$time_start;
        }


    $data1=json_encode($class_1);
    echo $data1;
?>