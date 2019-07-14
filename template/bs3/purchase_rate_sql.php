<?php
$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');//连接数据库//host: 主机//username：用户名//passwd：用户密码//dbname：数据库名
$con->query("SET NAMES utf8");//定义字符编码
//problem_id 自行赋值、
$sql = "select user_id from purchase_record";
$result = mysqli_query($con, $sql);//建立数据库连接
$array = array();    //定义变量json存储值
class Solutioni
{    //定义变量
    public $result_i;
}

while ($row = mysqli_fetch_row($result))//从结果集中取得一行，并作为枚举数组返回。
{
    list($result_i) = $row; //list 将元组转换为列表
    $gz = new Solutioni();  //实例Solutioni
    $gz->result_i = $result_i; //$gz->result_i  这里的result_i用于前端数据处理

    $array[] = $gz;//数组赋值
}
echo json_encode($array);//将数值转换成json数据存储格式
?>
