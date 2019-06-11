<head>
    <meta charset="utf-8">
    <title>全部标签做题情况</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div style="width: 50%">
    <table class="table table-hover">
        <caption>标签情况显示</caption>
        <thead>
        <tr>
            <th>标签</th>
            <th>题数</th>
            <th>正确率百分比</th>
        </tr>
        </thead>
        <tbody>
<?php
/**
 * Created by PhpStorm.
 * User: LIJICHEN
 * Date: 2018/11/10
 * Time: 11:49
 */
$con = new mysqli('localhost','root','HRBUXGOJ','jol');
$array2 = array();//存放全部标签
$array3 = array();//存放筛选出来的标签
$array4 = array();//存放各个标签做的题数
$array5 = array();//存放各个标签做题的正确题数
$array6= array();
$con->query("SET NAMES utf8");//定义字符编码
$sql = "SELECT problem_id,tags FROM problem ";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)) //取当前数据放入数组
{
    $array2[]=strtr($row['tags'],';',',');//对数据进行处理，将；换成，
}
    $num=0;
for ($i=0;$i<count($array2);$i++){
    $foo = explode(',',$array2[$i]);//对单个数据进行条件分割
    for ($j=0;$j<count($foo);$j++){
        $F=true;
        for ($k=0;$k<count($array3);$k++){//查看数组是否元素重复
            if($foo[$j]==$array3[$k]){
                $F=false;
            }
        }
        if($F==true){
            $array3[$num]=$foo[$j];$num++;//不重复进行数组元素添加
        }
    }
}
for($i=0;$i<count($array3);$i++){//处理后的标签查询
    $sum1=0;
    $num1=0;
    $num2=0;
    $sql = "SELECT problem_id,tags,accepted,submit FROM problem where tags like '%" . $array3[$i] . "%'";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
            $num1+= $row['accepted'];
            $num2+= $row['submit'];
            $sum1++;
    }
    $array4[$i]=$num1;
    $array5[$i]=$num2;
    $array6[$i]=$sum1;
}
$b="%";
for($i=0;$i<count($array3);$i++){
    if($array5[$i]!=0){
        $a=(round($array4[$i]/$array5[$i],4)*100).$b;
       echo '<tr><td>' . $array3[$i] . '</td><td>' . $array6[$i] . '</td><td>' . $a . '</td></tr>';
    }
    else{
        echo '<tr><td>' . $array3[$i] . '</td><td>' . $array6[$i] . '</td><td>' ."0" . '</td></tr>';
    }
}

//////////////////////////////////
/*
$sql = "delete from lable";
mysqli_query($con,$sql);
$BM='lable';
// $tmpstr='(';
$tmpstr = "'". $array3[0] ."','". (round($array4[0]/$array5[0],3)*10) ."','". $array6[0] ."'";
$sql2="INSERT INTO ". $BM." (tags,difficulty,sum) VALUES(".$tmpstr.")";
$sql2 .= ",";
for($i=1;$i<count($array3);$i++){
    if($array5[$i]!=0){

        $tmpstr = "'". $array3[$i] ."','". (round($array4[$i]/$array5[$i],3)*10) ."','". $array6[$i] ."'";
    }
    else{
        $tmpstr = "'". $array3[$i] ."','". 0 ."','". $array6[$i] ."'";
    }
    $sql2 .= "(".$tmpstr."),";
}
echo $sql2;
$sql2 = substr($sql2,0,-1);   //去除最后的逗号
mysqli_query($con,$sql2);*/
?>
        </tbody>
    </table>
</div>
</body>
</html>