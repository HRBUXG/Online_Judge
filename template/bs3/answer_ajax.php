<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/7/13
 * Time: 19:22
 */
$problem_id = $_POST['problem_id'];
$con = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
mysqli_query($con, "set names utf8");
$sql = "select problem_title,problem_analyse from problem_solution where problem_id=" . $problem_id;
$result = mysqli_query($con, $sql);//建立数据库连接root
while ($row = mysqli_fetch_array($result)) {
    $datas[] = array("problem_title" => $row['problem_title'], "problem_analyse" => $row['problem_analyse']);
}
foreach ($result as $row) {
    $rt = $row['problem_analyse'];
}
echo $rt;