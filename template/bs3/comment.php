<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/3/28
 * Time: 7:58
 */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" type="text/css" href="template/bs3/bootstrap.min.css"/>
    <script language="javascript" type="text/javascript" src="template/bs3/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="template/bs3/bootstrap.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .box {
            width: 600px;
            height: 300px;
            margin: 50px auto;
        }

        .box p {
            width: 600px;
            height: 40px;
            border-bottom: 1px solid #999;
        }

        .box p b {
            width: 80px;
            height: 40px;
            line-height: 40px;
            font-size: 20px;
            border-bottom: 1px solid red;
            display: block;
        }

        .box .con {
            margin-top: 20px;
        }

        .box small {
            margin-left: 5px;
            color: #999;
            font-size: 12px;
        }

        .box .name {
            width: 100px;
            height: 30px;
            line-height: 30px;
            display: inline-block;
        }

        .box .text {
            width: 300px;
            height: 100px;
            display: inline-block;
        }

        .box .btn {
            width: 80px;
            height: 30px;
            line-height: 30px;
            display: block;
            margin: 20px 0 0 80px;
        }

        .ul li {
            width: 600px;
            margin: 0 auto;
            list-style: none;
        }

        .ul li p {
            width: 600px;
            height: 30px;
            line-height: 30px;
            text-align: left;
            color: #000;
            font-size: 16px;
        }

        .ul li span {
            width: 480px;
            line-height: 30px;
            text-align: left;
            font-size: 14px;
            display: inline-block;
            color: #333;
        }

        .ul li a {
            width: 120px;
            line-height: 30px;
            text-align: center;
            color: #333;
            font-size: 12px;
            display: inline-block;
        }
    </style>
    <title><?php echo "Develop" ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="box">
            <p><b>发表评论</b></p>

            <div class="con">
                题目号：
                <label class="pid"><?php echo $_SESSION['ppid']; ?></label>
                <br><br>
                用户名：<!--<input type="text" class="name">
                <small>请输入6到15位字母加数字用户名</small>-->

                <label class="uid"><?php echo $_SESSION[$OJ_NAME . '_' . 'user_id']; ?></label>

                <br><br>
                评论区：<textarea cols="40" rows="6" class="text" placeholder="请说出您的建议和意见，最多不超过60个字"></textarea>
                <input type="button" value="提交" class="btn">
            </div>
        </div>
        <ul class="ul"></ul>

    </div>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("../../template/$OJ_TEMPLATE/js.php"); ?>
<!--折叠面板-->
<script src="template/bs3/cons.js"></script>
<script type="text/javascript">
/* 鼠标特效 */
var a_idx = 0;
jQuery(document).ready(function ($) {
$("body").click(function (e) {
var a = new Array("富强", "民主", "文明", "和谐", "自由", "平等", "公正", "法治", "爱国", "敬业", "诚信", "友善");
var $i = $("<span/>").text(a[a_idx]);
a_idx = (a_idx + 1) % a.length;
var x = e.pageX,
y = e.pageY;
$i.css({
"z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
"top": y - 20,
"left": x,
"position": "absolute",
"font-weight": "bold",
"color": "#ff6651"
});
$("body").append($i);
$i.animate({
"top": y - 180,
"opacity": 0
},
1500,
function () {
$i.remove();
});
});
});
</script>
</body>
</html>

