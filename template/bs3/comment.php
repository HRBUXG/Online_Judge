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

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <!--    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css" media="screen" />-->
    <link rel="stylesheet" type="text/css" href="template/bs3/style.css"/>
    <link rel="stylesheet" type="text/css" href="template/bs3/barrager.css">
    <link rel="stylesheet" type="text/css" href="template/bs3/pick-a-color-1.2.3.min.css">
    <link type="text/css" rel="stylesheet" href="template/bs3/shCoreDefault.css"/>
    <script language="javascript" type="text/javascript" src="template/bs3/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="template/bs3/bootstrap.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .box {
            width: 100%;
            height: 300px;
            margin: 50px auto;
        }

/*        .box p {
            width: 100%;
            height: 40px;
           border-bottom: 1px solid #999;
        }*/

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
            /*margin: 20px 0 0 80px;*/
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


        * {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        a, img {
            border: 0;
        }

        body {
            background: url(images/blog7year_videobg.png);
            font: 12px/180% Arial, Helvetica, sans-serif, "新宋体";
        }


        * {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        a, img {
            border: 0;
        }

        body {
            background: url(images/blog7year_videobg.png);
            font: 12px/180% Arial, Helvetica, sans-serif, "新宋体";
        }


        /* actGotop */
        .actGotop {
            position: fixed;
            _position: absolute;
            bottom: 100px;
            right: 50px;
            width: 150px;
            height: 195px;
            display: none;
        }

        .actGotop a, .actGotop a:link {
            width: 150px;
            height: 195px;
            display: inline-block;
            background: url(template/bs3/images/blog7year_gotop.png) no-repeat;
            _background: url(template/bs3/images/blog7year_gotop.gif) no-repeat;
            outline: none;
        }

        .actGotop a:hover {
            background: url(template/bs3/images/blog7year_gotopd.gif) no-repeat;
            outline: none;
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
<div id="top" class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <?php
        $con = mysqli_connect('localhost', 'root', 'HRBUXGOJ');
        if (!$con) {
            die('连接失败: ' . mysqli_error($con));
        }

        mysqli_select_db($con, 'jol');
        mysqli_query($con, "set names utf8");
        session_start();   //开启一个session会话SESSION是全局变量，只要被声明，在不关闭网页或者没有到SESSION的周期在所有页面都是可用的
        $pid = $_SESSION['ppid'];
        $sql="select title,description from problem where problem_id=".$pid;
        $result=mysqli_query($con,$sql);
        foreach ($result as $row){
            $title=$row['title'];
            $description=$row['description'];
        }


        ?>
        <marquee style="margin-top:10px" id="broadcast" scrollamount="1" scrolldelay="50" onmouseover="this.stop()"
                 onmouseout="this.start()" class="toprow">﻿
            请注意评论文明礼仪，禁止脏话谩骂以及恶意灌水行为！管理员一经发现或他人举报将会进行惩罚措施！
        </marquee>
        <div class="box">
            <h4>
                <button type="button" id="clear" class="label label-danger">弹幕清屏</button>
            </h4>
            <h4>
                <button type="button" id="close" class="label label-danger" style="float: right;">弹幕关闭</button>
            </h4>
            <center>
                <p style=" width: 100%;height: 40px;border-bottom: 1px solid #999;"><b>发表评论</b></p>
                <div style="width: 60%;float: left;border:1px solid #ccc;background-color: #f5f5f5">
                    <?php echo $title;?>
                    <?php echo $description;?>

                </div>

                <div class="con ">
                    <label class="label label-info">题目号：</label>
                    <label class="pid" ><?php echo $pid ?></label>
                    <div>

                    </div>
                    <label class="label label-info">用户名：</label><!--<input type="text" class="name">
                <small>请输入6到15位字母加数字用户名</small>-->

                    <label class="uid"><?php echo $_SESSION[$OJ_NAME . '_' . 'user_id']; ?></label>
                    <br>
                    <!--                    <label class="label label-info"> 评论区： </label>-->
                    <br>
                    <br><textarea cols="60" rows="6" class="text" style="width: 20%"
                                  placeholder="请说出您的建议和意见，最多不超过60个字"></textarea>
                    <input style="margin-left:60%; " type="button" value="发送" class="btn btn-primary">
                </div>
            </center>
        </div>
    </div>

    <div class="container" style="align:center">
        <div class="demo">
            <ul class="ull"></ul>
            <div id="content">
                <?php

                $sql = "select * FROM comment where `lock` =0 and  `problem_id`=" . $pid . " order by sendtime desc limit 10";
                $result = mysqli_query($con, $sql);

                /*    while ($row = mysqli_fetch_array($result)) {
                        $datas[] = array("user_id" => $row['user_id'], "problem_id" => $row['problem_id'], "content" => $row['content'], "sendtime" => $row['sendtime']);

                    }
                    echo json_encode($datas);//以json格式编码*/
                foreach ($result as $row) {
                    echo '<li><div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">用户：' . $row['user_id'] . '
		</h3>
	</div>
	<div class="panel-body">
		' . $row['content'] . '<br/><p style="text-align:right">评论时间：' . $row['sendtime'] . '
	</p></div>
</div></li>';
                }
                ?>
            </div>
            <div id="pages"><a id="next" href="page.php?page=1"></a></div>
            <div class="loading"></div>
        </div>
    </div>
    <!--  <h3><a href="#top" class="label label-danger" style="z-index:9999999;position:fixed;float:left;bottom:30%;">返回顶部</a>

      </h3>-->
    <div class="actGotop"><a href="javascript:;" title="返回顶部"></a></div>
    <?php
    $sql = "select * from shieldwords where status=1";
    $result = mysqli_query($con, $sql);
    $str = "";
    foreach ($result as $row) {
        $str = $str . $row['keywords'] . '|';
    }
    ?>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<?php include("../../template/$OJ_TEMPLATE/js.php"); ?>
<!--折叠面板-->
<!--ajax评论-->

<!--<script src="template/bs3/cons.js"></script>-->


<script>

    $(document).ready(function () {

        $(".btn").click(function () {
            function p(s) {
                return s < 10 ? '0' + s : s;
            }

            var myDate = new Date();
            var year = myDate.getFullYear();
            var month = myDate.getMonth() + 1;
            var date = myDate.getDate();
            var h = myDate.getHours();
            var m = myDate.getMinutes();
            var s = myDate.getSeconds();
            var now = year + '-' + p(month) + "-" + p(date) + " " + p(h) + ':' + p(m) + ":" + p(s);
            var oT = $(".box .text").val();
            var primary = oT;
            //var re = /中华人民共和国|发红包|看到没/g;
            var re = /<?php echo $str;?>|看到没/g;

            var regexed = "";
            regexed = oT.replace(re, function (str) {
                //函数中的第一个参数是整个正则表达式,第二个是第一个子项....
                var result = '';
                for (var i = 0; i < str.length; i++) {
                    result += '*';
                }
                console.log(result);
                return result;
            });
            if ($(".box .text").val().length == 0) {
                alert("请说出您宝贵的意见和建议")
            } else {

                $.ajax({
                    type: "POST",
                    url: "template/bs3/send_comment.php",
                    data: {
                        "user_id": $(".con .uid").html(),
                        "problem_id": $(".con .pid").html(),
                        "content_primary": primary,
                        "content": regexed,
                        "sendtime": now
                    },
                    success: function (data) {
                        //var str = "<li><p>" + "用户" + $(".con .uid").html() + ":" + "</p><span>" + $(".box .text").val() + "</span><a>" + now + "</a></li>";
                        var str = '<li><div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">' + '用户:' + $(".con .uid").html() + ':' + '</h3></div><div class="panel-body">' +/* $(".box .text").val()*/regexed + '<br/><p style="text-align:right">评论时间：' + now + '</p></div></div></li>';

                        $(".ull").prepend(str);
                        alert(data);

                    },
                    error: function () {
                        console.log("失败，请稍后再试！");
                    },
                });
            }
        })
    })
</script>

<!--鼠标特性-->
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
<!--无限加载-->
<script src="template/bs3/debug.js"></script>
<script src="template/bs3/jquery.infinitescroll.js"></script>
<script type="text/javascript">
    $('#content').infinitescroll({
        loading: {
            msgText: "",
            img: "template/bs3/loading.gif",
            finishedMsg: '没有新数据了哦...',
            selector: '.loading' //loading选择器
        },
        navSelector: "#pages", //导航的选择器，会被隐藏
        nextSelector: "#next", //包含下一页链接的选择器
        itemSelector: "li", //你将要取回的选项(内容块)
        debug: true, //启用调试信息，若启用必须引入debug.js
        dataType: 'html', //格式要和itemSelector保持一致
        maxPage: 15, //最大加载的页数
        // animate: true, //当有新数据加载进来的时候，页面是否有动画效果，默认没有
        extraScrollPx: 150, //滚动条距离底部多少像素的时候开始加载，默认150
        // bufferPx: 40, //载入信息的显示时间，时间越大，载入信息显示时间越短
        errorCallback: function () { //加载完数据后的回调函数

        },
        path: function (index) { //获取下一页方法
            return "page.php?p=" + index;
        },
    }, function (newElements, data, url) { //回调函数
        //console.log(data);
        //alert(url);
    });
</script>

<!--弹幕-->
<script type="text/javascript" src="template/bs3/jquery.barrager.js"></script>
<script type="text/javascript" src="template/bs3/tinycolor-0.9.15.min.js"></script>
<script type="text/javascript" src="template/bs3/shCore.js"></script>
<script type="text/javascript" src="template/bs3/shBrushJScript.js"></script>
<script type="text/javascript" src="template/bs3/shBrushPhp.js"></script>
<script type="text/javascript" src="template/bs3/pick-a-color-1.2.3.min.js"></script>
<!--关闭弹幕-->
<script type="text/javascript">
    $.ajaxSettings.async = false;
    $.getJSON('comment_barrages.php?mode=2', function (data) {

//每条弹幕发送间隔
        var looper_time = 3 * 1000;
        var items = data;
//弹幕总数
        var total = data.length;
//是否首次执行
        var run_once = true;
//弹幕索引
        var index = 0;
//先执行一次
        barrager();

        function barrager() {


            if (run_once) {
                //如果是首次执行,则设置一个定时器,并且把首次执行置为false
                looper = setInterval(barrager, looper_time);
                run_once = false;
            }
            //发布一个弹幕
            $('body').barrager(items[index]);
            //索引自增
            index++;
            //所有弹幕发布完毕，清除计时器。
            if (index == total) {

                clearInterval(looper);
                return false;
            }
            $("#close").click(function () {
                //通过点击dom结点调用函数
                $.fn.barrager.removeAll();
                clearInterval(looper);
                return false;
            })


        }


    });
</script>
<!--清屏弹幕-->
<script>
    $(document).ready(function () {
        $("#clear").click(function () {
            //通过点击dom结点调用函数
            $.fn.barrager.removeAll();
        })

    })

</script>
<!--返回顶部-->
<script type="text/javascript">
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 100) {
                $('.actGotop').fadeIn(300);
            } else {
                $('.actGotop').fadeOut(300);
            }
        });
        $('.actGotop').click(function () {
            $('html,body').animate({scrollTop: '0px'}, 800);
        });
    });
</script>
</body>
</html>

