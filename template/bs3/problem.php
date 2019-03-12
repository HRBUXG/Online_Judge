<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script src="template/bs3/jquery.min.js"></script><!-- 调用js目录下的jquery.js文件 -->
    <link rel="stylesheet" href="template/bs3/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="template/bs3/echarts.js"></script><!-- 调用js目录下的echarts.js文件 -->
    <script src="template/bs3/bootstrap.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <title>
        <?php echo $OJ_NAME ?>
    </title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    \
    <![endif]-->
</head>
<style type="text/css">

    .biankuang {
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.42857143;
        color: #333;
        /*word-break: keep-all;*/
        word-wrap: break-word;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .right { /*主框架的右边*/
        overflow: auto;
        float: right;
        width: 19%;
        border: solid 1px #fcfcfc;
    }

    /*此处为判断奇数偶数行，改变表格的背景颜色*/
    .table-striped > tbody > tr:nth-child(2n+1) > td {
        background-color: #fff;
    }

    .table-striped > tbody > tr:nth-child(2n+1) > th {
        background-color: #fff;
    }

    /*下面是数字跳动的CSS*/

    .counter {
        background-color: #ffffff;
        padding: 20px 0;
        border-radius: 5px;
    }

    .count-title {
        font-size: 40px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .count-text {
        font-size: 13px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .count-text a {
        text-decoration: none;
        color: green;
    }

    .fa-2x {
        margin: 0 auto;
        float: none;
        display: table;
        color: #4ad1e5;
    }

</style>
<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <marquee style="margin-top:10px" id="broadcast" scrollamount="1" scrolldelay="50" onmouseover="this.stop()"
             onmouseout="this.start()" class="toprow">﻿
        Welcome to HRBUOJ 程序在线评测系统
    </marquee>
    <!-- Main component for a primary marketing message or call to action -->
    <div style='float: left;'>
        <?php echo $next_page0 ?>
    </div>
    <div style='float: right;'>
        <?php echo $next_page1 ?>
    </div>
    <?php if ($pr_flag) {
        echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</title>";
        echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</h2></center>";
    } else {
        //$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $id = $row['problem_id'];
        echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . " </title>";
        echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</h2></center>";
    }
    ?>
    <!-- 创建一个导航栏 它是根据锚点进行定位的 -->
    <ul id="myTab" class="nav nav-tabs">
        <li id="a1" class="active"><a href="#home" data-toggle="tab">题目正文</a></li>
        <li id="a2">
            <!-- --><?php /*echo "<a href='../../status.php?problem_id=" . $row['problem_id'] . "&user_id=" . $_SESSION[$OJ_NAME . '_' . 'user_id'] . "'>我的记录</a>"  */ ?>
            <a href="#mystatu" data-toggle="tab">我的记录</a>
        </li>
        <li id="a3">

            <a href="#statistics" data-toggle="tab">评测统计</a>
        </li>

        <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor'])) {
            // require_once("include/set_get_key.php");
            ?>
            <?php echo "<li id='a4'>"; ?>
            <a href="admin/problem_edit.php?id=<?php echo $id ?>&getkey=<?php echo $_SESSION[$OJ_NAME . '_' . 'getkey'] ?>"
               target="_blank">Edit</a>
            <?php echo "</li>"; ?>
            <!--   <li><a href='javascript:phpfm(<?php /*echo $row['problem_id']; */ ?>)'></a></li>      -->
            <?php echo "<li id='a5'> "; ?>
            <a href='javascript:phpfm(<?php echo $row['problem_id']; ?>)'>TestData</a> <?php echo "</li>"; ?>
            <?php
        } ?>

    </ul>
    <div id="myTabContent" class="tab-content">
        <div cla="tab-pane fade in active" id="home">
            <div class="jumbotron" style="width: 80%;float:left" onselectstart="return false">


                <?php

                /* 此处注释是显示标题*/
                /*  if ($pr_flag) {
                      echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</title>";
                      echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</h2>";
                  } else {
                      //$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                      $id = $row['problem_id'];
                      echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . " </title>";
                      echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</h2>";
                  }*/

                session_start();   //开启一个session会话SESSION是全局变量，只要被声明，在不关闭网页或者没有到SESSION的周期在所有页面都是可用的
                $_SESSION['ppid'] = $id; //把查询到的id值会传到sql.php


                //
                /*          if ($pr_flag) {
                                 echo "<a href='submitpage.php?id=$id'><input style='width:70px;height:30px;margin-top:10px;border-radius:5px;background:red;border-width:0px;margin-left:20px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center' type='button' value='$MSG_SUBMIT'></a>";
                             } else {
                                 echo "<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'><input style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:red;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center' type='button' value='$MSG_SUBMIT'></a>";
                             }
                             if (!isset($OJ_ON_SITE_CONTEST_ID)) {
                                 echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='problemstatus.php?id=" . $row['problem_id'] . "'><input style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:#1e90ff;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center' type='button' value='$MSG_STATUS'></a>";
                             }
                             echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='bbs.php?pid=" . $row['problem_id'] . "$ucid'><input style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:yellow;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:#1e90ff;bold:none;text-align:center' type='button' value='$MSG_BBS'></a>";*/

                /*   if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor'])) {*/
                /*require_once("include/set_get_key.php");*/
                ?>
                <!-- <a href="admin/problem_edit.php?id=<?php /*echo $id */ ?>&getkey=<?php /*echo $_SESSION[$OJ_NAME . '_' . 'getkey'] */ ?>"><input
                                style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:#FF6600;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center'
                                type='button' value='Edit'></a>
                    <a href='javascript:phpfm(<?php /*echo $row['problem_id']; */ ?>)'><input
                                style='width:80px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:#33FF00;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center'
                                type='button' value='TestData'></a>-->


                <!--echo "[$MSG_Creator:<span id='creator'></span>]";-->


                <?php
                /*  }*/
                echo "</center>";
                echo "<!--StartMarkForVirtualJudge-->";
                /* <h2 style='color:#7CA9ED'>$MSG_Description</h2>*/
                if (!empty($row['description'])) {
                    echo "
			<div class=content style='display: block;padding-top:10px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;white-space:normal;word-wrap: break-word;background-color: #fcfcfc;border: 1px solid #ccc;border-radius: 4px;width:100%'>" . $row['description'] . "</div>";
                }
                if (!empty($row['input'])) {
                    echo "<div ><center><h2 style='color:#7CA9ED'>$MSG_Input </h2></center><div class=content style='display: block;padding-top:10px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #fcfcfc;border: 1px solid #ccc;border-radius: 4px;width:100%'>" . $row['input'] . "</div></div>";

                }
                if (!empty($row['output'])) {
                    echo "<div ><center><h2 style='color:#7CA9ED'>$MSG_Output</h2></center><div class=content style='display: block;padding-top:10px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #fcfcfc;border: 1px solid #ccc;border-radius: 4px;width:100%'>" . $row['output'] . "</div></div>";
                }
                $sinput = str_replace("<", "&lt;", $row['sample_input']);
                $sinput = str_replace(">", "&gt;", $sinput);
                $soutput = str_replace("<", "&lt;", $row['sample_output']);
                $soutput = str_replace(">", "&gt;", $soutput);
                if (strlen($sinput) && strlen($soutput)) {
                    echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input</h2></center>
				<pre class=content id='sinputleft' style='width:90%;background-color:#fcfcfc;font-size:16px;font-family:Times New Roman;padding-left:20px'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput) . "</span></pre></div>";
                    echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output</h2>
<pre class=content id='sinputright' style='width:90%;background-color:#fcfcfc;font-size:16px;font-family:Times New Roman;padding-left:20px'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right;'>copy</a><br><span class=sampledata>" . ($soutput) . "</span></pre></div>";
                } else if (strlen($sinput)) {
                    echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input</h2>
<pre class=content style='width:95%;font-size:16px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><span class=sampledata>" . ($sinput) . "</span></pre>";

                } else if (strlen($soutput)) {
                    echo "<center><h2 style='color:#7CA9ED'>$MSG_Sample_Output</h2></center>
<pre class=content style='width:95%;font-size:16px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput) . "</span></pre>";
                }

                $sinput2 = str_replace("<", "&lt;", $row['sample_input2']);
                $sinput2 = str_replace(">", "&gt;", $sinput2);
                $soutput2 = str_replace("<", "&lt;", $row['sample_output2']);
                $soutput2 = str_replace(">", "&gt;", $soutput2);
                if (strlen($sinput2) && strlen($soutput2)) {
                    echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input 2</h2>
			<pre class=content id='sinputleft2' style='width:90%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput2) . "</span></pre></div>";
                    echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output 2</h2>
			<pre class=content id='sinputright2' style='width:90%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput2) . "</span></pre></div>";
                } else if (strlen($sinput2)) {
                    echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input 2</h2>
			<pre class=content style='width:95%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy'style='float: right'>copy</a><br><span class=sampledata>" . ($sinput2) . "</span></pre>";

                } else if (strlen($soutput2)) {
                    echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output 2</h2>
			<pre class=content style='width:95%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput2) . "</span></pre>";
                }

                $sinput3 = str_replace("<", "&lt;", $row['sample_input3']);
                $sinput3 = str_replace(">", "&gt;", $sinput3);
                $soutput3 = str_replace("<", "&lt;", $row['sample_output3']);
                $soutput3 = str_replace(">", "&gt;", $soutput3);
                if (strlen($sinput3) && strlen($soutput3)) {
                    echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input 3</h2>
<pre class=content id='sinputleft3' style='width:90%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput3) . "</span></pre></div>";
                    echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output 3</h2>
<pre class=content id='sinputright3' style='width:90%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput3) . "</span></pre></div>";
                } else if (strlen($sinput3)) {
                    echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input 3</h2>
<pre class=content style='width:95%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput3) . "</span></pre>";

                } else if (strlen($soutput3)) {
                    echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output 3</h2>
<pre class=content  style='width:95%;font-size:14px;font-family:Times New Roman;'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput3) . "</span></pre>";
                }
                if ($row['hint'])
                    echo "<h2 style='color:#7CA9ED'>$MSG_HINT</h2>
<div class=content>" . $row['hint'] . "</div>";
                if ($pr_flag) {
                    echo "<h2 style='color:#7CA9ED'>$MSG_Source</h2><div class=content><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    $cats = explode(" ", $row['source']);
                    foreach ($cats as $cat) {
                        echo "<a href='problemset.php?search=" . htmlentities($cat, ENT_QUOTES, 'utf-8') . "'>" . htmlentities($cat, ENT_QUOTES, 'utf-8') . "</a>&nbsp;";
                    }
                    echo "</p></div>";
                }


                ?>
                <?php require_once("template/$OJ_TEMPLATE/submitpage.php"); ?>
            </div>


            <div class="right">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td class="td-left">
                            <div class="timer count-title" id="count-number"
                                 data-to="<?php echo $row['accepted']; ?>"
                                 data-speed="1500" decimals="0"></div>
                            <div>通过</div>
                        </td>
                        <td class="td-right">
                            <div class="timer count-title" id="count-number"
                                 data-to="<?php echo $row['submit']; ?>"
                                 data-speed="1500" decimals="0"></div>
                            <div>提交</div>
                        </td>

                    </tr>

                    <tr>
                        <td class="td-left">题目类型</td>
                        <td class="td-right"><?php echo $row['tags']; ?></td>
                    </tr>
                    <tr>
                        <td class="td-left">判题模式</td>
                        <td class="td-right">
                            <?php
                            if ($row['spj'] == 0) {
                                echo "标准判题";
                            } else {
                                echo "特殊判题";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-left">题目难度</td>
                        <td class="td-right">
                            <?php
                            for ($i = 0; $i < ceil($row['difficulty']); $i++) {
                                echo '<span class="glyphicon glyphicon-star"></span>';
                            }
                            for ($i = 5; $i > ceil($row['difficulty']); $i--) {
                                echo '<span class="glyphicon glyphicon-star-empty"></span>';
                            }
                            //  echo $row['difficulty']; ?>

                        </td>
                    </tr>
                    <tr>
                        <td class="td-left">题目发布</td>
                        <td class="td-right">
                            <?php if (empty($row['provider'])) {
                                echo "管理员";
                            } else {
                                echo $row['provider'];
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><strong>可用评测语言及资源限制</strong></td>
                    </tr>
                    <tr>
                        <td class="td-left"> GNU C</td>
                        <td class="td-right"><?php echo $row['time_limit'] . "Sec," . $row['memory_limit'] . "MB"; ?></td>
                    </tr>
                    <tr>
                        <td class="td-left">GNU C++</td>
                        <td class="td-right"><?php echo $row['time_limit'] . "Sec," . $row['memory_limit'] . "MB"; ?></td>
                    </tr>
                    <tr>
                        <td class="td-left">Java</td>
                        <td class="td-right"><?php echo 2 * (int)$row['time_limit'] . "Sec," ?><?php echo 4 * (int)$row['memory_limit'] . "MB" ?></td>
                    </tr>
                    </tbody>
                </table>
                <div>
                    <a href="#Submit" class="btn btn-info" type="button" value="Submit"
                       style="margin-top:10%;margin-left: 5%;margin-bottom: 10%">Submit</a>
                </div>
                <?php /*require_once("template/bs3/test0311.php");*/ ?>
                <div id="main" style="width: 100%;height: 400px;"></div>
            </div>
        </div>
    </div>
    <!-- /containessr -->
    <div class="tab-pane fade" id="mystatu">

        <!--我的评测：开始-->
        <?php require_once("mystatus.php"); ?>
        <!--我的评测：结束-->
    </div>

    <div class="tab-pane fade" id="statistics">

        <div id="bing" style="width: 100%;height: 400px;"></div>
        <?php require_once("template/bs3/bar_graph0313_1.php"); ?>
    </div>

</div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="include/clipboard.js"></script>


<!--这里是处理tab页切换的js-->

<script>

    $(function () {
        $('#myTab li:eq(0) a').tab('show');
        /*此处ready处理第一次div 隐藏但仍然显示空白的问题*/
        $(document).ready(function () {
            $("#mystatu").hide();
            $("#statistics").hide();
        });
        /*此处处理切换tab页面的div显示问题*/
        var aaa = document.getElementById('a1');
        aaa.onclick = function () {
            document.getElementById('home').style.display = "block";
            document.getElementById('mystatu').style.display = "none";
            document.getElementById('statistics').style.display = "none";
        };

        var bbb = document.getElementById('a2');
        bbb.onclick = function () {
            document.getElementById('home').style.display = 'none';
            document.getElementById('mystatu').style.display = 'block';
            document.getElementById('statistics').style.display = 'none';

        };

        var ccc = document.getElementById('a3');
        ccc.onclick = function () {
            document.getElementById('home').style.display = 'none';
            document.getElementById('mystatu').style.display = 'none';
            document.getElementById('statistics').style.display = 'block';
        };

    });
</script>

<script>

    function phpfm(pid) {
        //alert(pid);
        $.post("admin/phpfm.php", {
            'frame': 3,
            'pid': pid,
            'pass': ''
        }, function (data, status) {
            if (status == "success") {
                document.location.href = "admin/phpfm.php?frame=3&pid=" + pid;
            }
        });
    }

    $(document).ready(function () {
        $("#creator").load("problem-ajax.php?pid=<?php echo $id?>");
        var left = $("#sinputleft").height();
        var right = $("#sinputright").height();
        if (left < right) {
            $("#sinputleft").height(right);
        } else if (left > right) {
            $("#sinputright").height(left);
        }
        left = $("#sinputleft2").height();
        right = $("#sinputright2").height();
        if (left < right) {
            $("#sinputleft2").height(right);
        } else if (left > right) {
            $("#sinputright2").height(left);
        }
        left = $("#sinputleft3").height();
        right = $("#sinputright3").height();
        if (left < right) {
            $("#sinputleft3").height(right);
        } else if (left > right) {
            $("#sinputright3").height(left);
        }
    });
    var fuzhi;
    $('.CopyToClipboard').click(function () {
        fuzhi = this.nextElementSibling.nextElementSibling.firstChild.nodeValue;
    });
    var clipboard = new Clipboard('.CopyToClipboard', {
        text: function () {
            alert("复制成功");
            return fuzhi;
        }
    });
    clipboard.on('success', function (e) {
        console.log(e);
    });

    clipboard.on('error', function (e) {
        console.log(e);
    });


</script>
<!--这里是通过量和总量的统计图-->
<script>

    var myChart = echarts.init(document.getElementById('main'));// 基于准备好的dom，初始化echarts实例
    // 初始化counts = [], qw_i = [], qa_i = [], qd_i = []，四个数组，counts = [],盛装从数据库中获取到的数据, qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值
    var counts = [], qa_i = [], qs_i = [], qd_i = [];
    //初始化qa,qs，qd两个整型，qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
    var qa = 0, qs = 0, qd = 0;

    function TestAjax() {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            url: "template/bs3/sql.php", //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        counts.push(result[i].result_i);//push()向数组的末尾添加一个或多个元素，并返回新的长度。
                        //console.log(result[i].result_i);//控制台输出
                        if (counts[i] === '4') {
                            qs++;
                        }
                        qa++;
                    }
                    qa_i[0] = qa;//qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值,qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
                    qs_i[0] = qs;

                    qd = qa - qs;
                    qd_i[0] = qd;
                }
            }
        })
    }

    //执行异步请求
    TestAjax();
    //=============================================================================================
    var app = {};
    app.title = '饼图';//标题
    option = null;
    option = {
        tooltip: {//提示框
            trigger: 'item',//当trigger为’item’时只会显示该点的数据
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {//实例组合表单中的相关元素    name[i]
            orient: 'vertical',//方向：垂直
            x: 'left'//矩形的左上角
        },
        series: [//一维数组结构
            {
                name: '访问来源',//标签
                type: 'pie',//类型：圆饼
                selectedMode: 'single',//为series属性的每一项添加一个selectedMode属性 'single':单选
                radius: [0, '60%'],//半径
                label: {//标签
                    normal: {
                        position: 'inner'//位置：内部
                    }
                },
                labelLine: {//加标签
                    normal: {
                        show: false
                    }
                },
                data: [
                    //  {value:qa_i, name:'题目提交量'},//value 数值  value:[123]
                    {value: qs_i, name: '答题正确量'},
                    {value: qd_i, name: '答题错误量'}
                ]
                //                data:[
                //                    {value:nums[0], name:places[0]}, //数据添加赋值
                //                    {value:nums[1], name:places[1]},
                //                    {value:nums[2], name:places[2]},
                //                    {value:nums[3], name:places[3]},
                //                    {value:nums[4], name:places[4]},
                //                    {value:nums[5], name:places[5]},
                //                    {value:nums[6], name:places[6]},
                //                    {value:nums[7], name:places[7]},
                //                    {value:nums[8], name:places[8]},
                //                    {value:nums[9], name:places[9]},
                //                    {value:nums[10], name:places[10]},
                //                    {value:nums[11], name:places[11]},
                //                    {value:nums[12], name:places[12]},
                //                    {value:nums[13], name:places[13]},
                //                    {value:nums[14], name:places[14]}
                //                ]
            }
        ]
    };
    if (option && typeof option === "object") {//选项==选择选项==对象
        myChart.setOption(option, true);//set Option设置选项
    }

</script>

<!--这里是各种评判错误类型的统计图-->
<script>
    var myChart = echarts.init(document.getElementById('bing'));// 基于准备好的dom，初始化echarts实例
    // 初始化counts = [], qw_i = [], qa_i = [], qd_i = []，四个数组，counts = [],盛装从数据库中获取到的数据, qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值
    var counts = [], Accepted_i = [], Presentation_Error_i = [], Wrong_Answer_i = [], Time_Limit_Exceed_i = [],
        Memory_Limit_Exceed_i = [], Output_Limit_Exceed_i = [], Runtime_Error_i = [], Compile_Error_i = [];
    //初始化qa,qs，qd两个整型，qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
    var Accepted = 0, Presentation_Error = 0, Wrong_Answer = 0, Time_Limit_Exceed = 0, Memory_Limit_Exceed = 0,
        Output_Limit_Exceed = 0, Runtime_Error = 0, Compile_Error = 0;

    function TestAjax() {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            url: "template/bs3/sql.php", //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        counts.push(result[i].result_i);//push()向数组的末尾添加一个或多个元素，并返回新的长度。
                        //console.log(result[i].result_i);//控制台输出
                        if (counts[i] === '4') {
                            Accepted++;
                        } else if (counts[i] === '5') {
                            Presentation_Error++;
                        } else if (counts[i] === '6') {
                            Wrong_Answer++;
                        } else if (counts[i] === '7') {
                            Time_Limit_Exceed++;
                        } else if (counts[i] === '8') {
                            Memory_Limit_Exceed++;
                        } else if (counts[i] === '9') {
                            Output_Limit_Exceed++;
                        } else if (counts[i] === '10') {
                            Runtime_Error++;
                        } else if (counts[i] === '11') {
                            Compile_Error++;
                        }
                    }
                    Accepted_i[0] = Accepted;
                    Presentation_Error_i[0] = Presentation_Error;
                    Wrong_Answer_i[0] = Wrong_Answer;
                    Time_Limit_Exceed_i[0] = Time_Limit_Exceed;
                    Memory_Limit_Exceed_i[0] = Memory_Limit_Exceed;
                    Output_Limit_Exceed_i[0] = Output_Limit_Exceed;
                    Runtime_Error_i[0] = Runtime_Error;
                    Compile_Error_i[0] = Compile_Error;
                }
            }
        })
    }

    //执行异步请求
    TestAjax();
    //=============================================================================================
    var app = {};
    app.title = '饼图';//标题
    option = null;
    option = {
        tooltip: {//提示框
            trigger: 'item',//当trigger为’item’时只会显示该点的数据
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {//实例组合表单中的相关元素    name[i]
            orient: 'vertical',//方向：垂直
            x: 'left'//矩形的左上角
        },
        series: [//一维数组结构
            {
                name: '访问来源',//标签
                type: 'pie',//类型：圆饼
                selectedMode: 'single',//为series属性的每一项添加一个selectedMode属性 'single':单选
                radius: [0, '50%'],//半径

                data: [
                    {value: Accepted_i, name: 'Accepted'}, //数据添加赋值
                    {value: Presentation_Error_i, name: 'Presentation_Error'},
                    {value: Wrong_Answer, name: 'Wrong_Answer'},
                    {value: Time_Limit_Exceed, name: 'Time_Limit_Exceed'},
                    {value: Memory_Limit_Exceed, name: 'Memory_Limit_Exceed'},
                    {value: Output_Limit_Exceed, name: 'Output_Limit_Exceed'},
                    {value: Runtime_Error, name: 'Runtime_Error'},
                    {value: Compile_Error, name: 'Compile_Error'},
                ]
            }
        ]
    };
    if (option && typeof option === "object") {//选项==选择选项==对象
        myChart.setOption(option, true);//set Option设置选项
    }
</script>

<!--此处为数字调动的JS-->
<script>
    $.fn.countTo = function (a) {
        a = a || {};
        return $(this).each(function () {
            var c = $.extend({},
                $.fn.countTo.defaults, {
                    from: $(this).data("from"),
                    to: $(this).data("to"),
                    speed: $(this).data("speed"),
                    refreshInterval: $(this).data("refresh-interval"),
                    decimals: $(this).data("decimals")
                },
                a);
            var h = Math.ceil(c.speed / c.refreshInterval),
                i = (c.to - c.from) / h;
            var j = this,
                f = $(this),
                e = 0,
                g = c.from,
                d = f.data("countTo") || {};
            f.data("countTo", d);
            if (d.interval) {
                clearInterval(d.interval)
            }
            d.interval = setInterval(k, c.refreshInterval);
            b(g);

            function k() {
                g += i;
                e++;
                b(g);
                if (typeof(c.onUpdate) == "function") {
                    c.onUpdate.call(j, g)
                }
                if (e >= h) {
                    f.removeData("countTo");
                    clearInterval(d.interval);
                    g = c.to;
                    if (typeof(c.onComplete) == "function") {
                        c.onComplete.call(j, g)
                    }
                }
            }

            function b(m) {
                var l = c.formatter.call(j, m, c);
                f.html(l)
            }
        })
    };
    $.fn.countTo.defaults = {
        from: 0,
        to: 0,
        speed: 1000,
        refreshInterval: 100,
        decimals: 0,
        formatter: formatter,
        onUpdate: null,
        onComplete: null
    };

    function formatter(b, a) {
        return b.toFixed(0)
    }

    $("#count-number").data("countToOptions", {
        formatter: function (b, a) {
            return b.toFixed(0).replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")
        }
    });
    $(".timer").each(count);

    function count(a) {
        var b = $(this);
        a = $.extend({},
            a || {},
            b.data("countToOptions") || {});
        b.countTo(a)
    };
</script>

</body>
</html>
