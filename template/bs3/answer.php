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
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <div id="top" class="panel panel-default">
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
                    $user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];
                    $sql = "select problem_id,problem_title,problem_analyse FROM problem_solution where problem_id=" . $pid;
                    $result = mysqli_query($con, $sql);
                    foreach ($result as $row) {
                        echo $row['problem_id'] . $row['problem_title'];
                        $anglyse = $row['problem_analyse'];
                    }
                    ?>
                </h3>
            </div>
            <div class="panel-body">
                <div id="purchase_div">
                    <?php

                    $sql_user_score = "select otherscore from users where user_id='" . $user_id . "'";
                    $result2 = mysqli_query($con, $sql_user_score);
                    foreach ($result2 as $row) {
                        global $user_score;
                        $user_score = $row['otherscore'];
                    }
                    $sql_problme_score = "select difficulty from problem where problem_id=" . $pid;
                    $result3 = mysqli_query($con, $sql_problme_score);
                    foreach ($result3 as $row) {
                        $problem_score = $row['difficulty'];
                    }
                    $sql_purchase_status = "select * from purchase_record where user_id='" . $user_id . "'and problem_id =" . $pid;
                    $result4 = mysqli_query($con, $sql_purchase_status);
                    foreach ($result4 as $row) {
                        $purchase_status = $row['purchase_status'];
                    }
                    if ($purchase_status == "true" || isset($_SESSION[$OJ_NAME . '_' . 'root'])) {
                        echo "<div id=\"anglyse_div\">" . $anglyse . "</div>";;
                    } else {
                        $problem_score = $problem_score * 3.0;
                        echo " <center>
                        <img src=\"./image/purchase.jpg\"/>
                        <p>很遗憾！您尚未购买题解&nbsp&nbsp <button id=\"btp\" onclick='purchase()' type=\"button\" class=\"btn btn-primary btn-lg \">购买题解</button></p>
                        <br/>
                        <br/>
                        <p>您的消费积分余额： " . " $user_score" . "  本题需要花费： " . $problem_score . "</p>
                        <p style='color: #CC0000'>消费积分可以通过签到、刷外站题获得哦</p>
                    </center>";
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>

</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script>
    setInterval("status()", 3000);

    function status() {
        var uid = '<?php /*echo $user_id;*/ ?>';
        var pid =<?php /*echo $pid;*/ ?>;
        $.post("template/bs3/purchase_status.php?uid=" + uid + "&pid=" + pid, function (statu) {
            console.log("手动断点：" + statu);
            if (statu == "ture") {

            }
        });
    }
</script>-->
<script>
    function purchase() {
        var uid = '<?php echo $user_id;?>';
        var pid =<?php echo $pid;?>;
        var difficulty =<?php echo $problem_score;?>;
        $.get("template/bs3/purchase_answer.php?uid=" + uid + "&pid=" + pid + "&diff=" + difficulty, {}, function (data) {
//$("#days").html(data);
            if (data == 1) {
                document.getElementById("btp").className = "btn btn-success btn-lg";
                alert("购买成功！");
                location.reload();
            }
            if (data == 2) {
                alert("购买失败！");
            }
            if (data == 3) {
                alert("您已经购买了！");
            }
        });
    }
</script>
</body>
</html>

