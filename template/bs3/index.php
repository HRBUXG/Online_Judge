<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script language="javascript" type="text/javascript" src="template/bs3/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
    <title><?php echo "Develop" ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<style type="text/css">

    a:link {
        color: black;
        text-decoration: none;
    }

    a:visited {
        color: black;
        text-decoration: none;
    }

    a:hover {
        color: #0066FF;
        text-decoration: none;
    }

    .font_01 {
        font-size: 18px
    }
</style>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <p>

        <center> Recent submission : <?php echo $speed ?>
            <div id=submission style="width:80%;height:300px"></div>
        </center>
        <button id="bt1" onclick="doSign()">点击签到</button>
        </p>
        <?php echo $view_news ?>

    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("../../template/$OJ_TEMPLATE/js.php"); ?>
<!--这里是签到模块的JS BEGIN-->
<script type="text/javascript">
    //page load get num
    $(window).ready(function () {
        doCheck();
    });

    //检查是否今天签到过，若签到过禁用前端的按钮
    function doCheck() {
        var uid = String(<?php echo $_SESSION[$OJ_NAME . '_' . 'user_id'];?>);
        $.get("template/bs3/sign-ajax.php?do=check&uid=" + uid, {}, function (data) {
            //$("#days").html(data);
            if (data == 1) {
                alert("please sign!");
            }
            if (data == 2) {
                alert("already sign today! next tomorrow!");
                document.getElementById("bt1").innerHTML = "已签到";
                document.getElementById("bt1").disabled = true;
            }
        });
    }

    //进行签到操作，并写入数据库签到日期，更新积分
    function doSign() {
        var uid = String(<?php echo $_SESSION[$OJ_NAME . '_' . 'user_id'];?>);
        alert("sign ok today!");
        document.getElementById("bt1").innerHTML = "已签到";
        document.getElementById("bt1").disabled = true;
        $.get("template/bs3/sign-ajax.php?do=sign&uid=" + uid, {}, function (data) {
        });
    }
</script>
<!--这里是签到模块的JS END-->
<script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
<script type="text/javascript">
    $(function () {
        var d1 = <?php echo json_encode($chart_data_all)?>;
        var d2 = <?php echo json_encode($chart_data_ac)?>;
        $.plot($("#submission"), [
            {label: "<?php echo $MSG_SUBMIT?>", data: d1, lines: {show: true}},
            {label: "<?php echo $MSG_AC?>", data: d2, bars: {show: true}}], {
            grid: {
                backgroundColor: {colors: ["#fff", "#eee"]}
            },
            xaxis: {
                mode: "time"//,
//max:{(new Date()).getTime()}
//min:(new Date()).getTime()-100*24*3600*1000
            }
        });
    });
    //alert((new Date()).getTime());
</script>
</body>
</html>

