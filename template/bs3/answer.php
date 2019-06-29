<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/4/9
 * Time: 11:11
 */
?>
<!DOCTYPE html>
<lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo "Develop" ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <script src="template/bs3/jquery.min.js"></script>

    <!--  <link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">-->

    <!-- <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>-->
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

</head>

<body>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php
                    $con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
                    if (!$con) {
                        die('连接失败: ' . mysqli_error($con));
                    }

                    mysqli_select_db($con, 'jol');
                    mysqli_query($con, "set names utf8");
                    session_start();   //开启一个session会话SESSION是全局变量，只要被声明，在不关闭网页或者没有到SESSION的周期在所有页面都是可用的
                    $pid = $_SESSION['ppid'];
                    $sql = "select * FROM problem_solution where problem_id=" . $pid;
                    $result = mysqli_query($con, $sql);
                    foreach ($result as $row) {
                        echo $row['problem_id'] . $row['problem_title'];
                        $anglyse = $row['problem_analyse'];
                    }

                    ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php echo $anglyse ?>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>

