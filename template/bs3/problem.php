<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="template/bs3/jquery.min.js"></script><!-- 调用js目录下的jquery.js文件 -->
    <script src="template/bs3/bootstrap.min.js"></script>
<!--    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="template/bs3/echarts.min.js"></script><!-- 调用js目录下的echarts.js文件 -->
    <title>
        <?php echo $OJ_NAME ?>
    </title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!--------------------------------------修改开始--------------------------------------------------------->
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
<!--------------------------------------修改结束--------------------------------------------------------->
<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div>
        <hr>

        <!--------------------------------------修改开始--------------------------------------------------------->
        <div style='float: left;'>
            <?php echo $next_page0 ?>
        </div>
        <div style='float: right;'>
            <?php echo $next_page1 ?>
        </div>
        <!--------------------------------------修改结束--------------------------------------------------------->
        <?php

        if ($pr_flag) {
            echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</title>";
            echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</h2></center>";
        } else {
            //$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $id = $row['problem_id'];
            echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . " </title>";
            echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row['title'] . "</h2></center>";
        } ?>
        <hr>
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">
                    题目正文</a></li>
            <li><a href="#mystatic" data-toggle="tab">我的评测</a></li>
            <li><a href="#statistics" data-toggle="tab">评测统计</a></li>

            <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor'])) {
                // require_once("include/set_get_key.php");
                ?>
                <?php echo "<li id='edit'>"; ?>
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
            <div class="tab-pane fade in active" id="home">
                <div class="jumbotron">
                    <div class="left" style="float: left;width: 80%">
                        <?php
                        session_start();   //开启一个session会话SESSION是全局变量，只要被声明，在不关闭网页或者没有到SESSION的周期在所有页面都是可用的
                        $_SESSION['ppid'] = $id; //把查询到的id值会传到sql.php
                        ?>

                        <?php

                        echo "<!--StartMarkForVirtualJudge-->";
                        /*****************************************修改开始***************************************************************************/
                        echo "
			<div class=content style='display: block;padding: 9.5px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;width:95%'>" . $row['description'] . "</div>";
                        echo "<div ><h2 style='color:#7CA9ED'>$MSG_Input </h2><div class=content style='display: block;padding: 9.5px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;width:95%'>" . $row['input'] . "</div></div>";
                        echo "<div ><h2 style='color:#7CA9ED'>$MSG_Output</h2><div class=content style='display: block;padding: 9.5px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;width:95%'>" . $row['output'] . "</div></div>";
                        $sinput = str_replace("<", "&lt;", $row['sample_input']);
                        $sinput = str_replace(">", "&gt;", $sinput);
                        $soutput = str_replace("<", "&lt;", $row['sample_output']);
                        $soutput = str_replace(">", "&gt;", $soutput);
                        if (strlen($sinput) && strlen($soutput)) {
                            echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input</h2>
				<pre class=content id='sinputleft' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput) . "</span></pre></div>";
                            echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output</h2>
<pre class=content id='sinputright' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput) . "</span></pre></div>";
                        } else if (strlen($sinput)) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input</h2>
<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><span class=sampledata>" . ($sinput) . "</span></pre>";

                        } else if (strlen($soutput)) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output</h2>
<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput) . "</span></pre>";
                        }

                        $sinput2 = str_replace("<", "&lt;", $row['sample_input2']);
                        $sinput2 = str_replace(">", "&gt;", $sinput2);
                        $soutput2 = str_replace("<", "&lt;", $row['sample_output2']);
                        $soutput2 = str_replace(">", "&gt;", $soutput2);
                        if (strlen($sinput2) && strlen($soutput2)) {
                            echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input 2</h2>
			<pre class=content id='sinputleft2' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput2) . "</span></pre></div>";
                            echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output 2</h2>
			<pre class=content id='sinputright2' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput2) . "</span></pre></div>";
                        } else if (strlen($sinput2)) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input 2</h2>
			<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy'style='float: right'>copy</a><br><span class=sampledata>" . ($sinput2) . "</span></pre>";

                        } else if (strlen($soutput2)) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output 2</h2>
			<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput2) . "</span></pre>";
                        }

                        $sinput3 = str_replace("<", "&lt;", $row['sample_input3']);
                        $sinput3 = str_replace(">", "&gt;", $sinput3);
                        $soutput3 = str_replace("<", "&lt;", $row['sample_output3']);
                        $soutput3 = str_replace(">", "&gt;", $soutput3);
                        if (strlen($sinput3) && strlen($soutput3)) {
                            echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input 3</h2>
<pre class=content id='sinputleft3' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput3) . "</span></pre></div>";
                            echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output 3</h2>
<pre class=content id='sinputright3' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput3) . "</span></pre></div>";
                        } else if (strlen($sinput3)) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input 3</h2>
<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($sinput3) . "</span></pre>";

                        } else if (strlen($soutput3)) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output 3</h2>
<pre class=content  style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ($soutput3) . "</span></pre>";
                        }
                        if ($row['hint'])
                            echo "<h2 style='color:#7CA9ED'>$MSG_HINT</h2>
<div class=content>" . $row['hint'] . "</div>";
                        /*****************************************修改结束***************************************************************************/
                        if ($pr_flag) {
                            echo "<h2 style='color:#7CA9ED'>$MSG_Source</h2><div class=content><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            $cats = explode(" ", $row['source']);
                            foreach ($cats as $cat) {
                                echo "<a href='problemset.php?search=" . htmlentities($cat, ENT_QUOTES, 'utf-8') . "'>" . htmlentities($cat, ENT_QUOTES, 'utf-8') . "</a>&nbsp;";
                            }
                            echo "</p></div>";
                        }
                        require_once("template/$OJ_TEMPLATE/submitpage.php");

                        echo "<center>";
                        echo "<!--EndMarkForVirtualJudge-->";
                        if ($pr_flag) {
                            echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
                        } else {
                            echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
                        }
                        echo "[<a href='problemstatus.php?id=" . $row['problem_id'] . "'>$MSG_STATUS</a>]";
                        //echo "[<a href='bbs.php?pid=".$row['problem_id']."$ucid'>$MSG_BBS</a>]";
                        if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
                            require_once("include/set_get_key.php");
                            ?> [
                            <a href="admin/problem_edit.php?id=<?php echo $id ?>&getkey=<?php echo $_SESSION[$OJ_NAME . '_' . 'getkey'] ?>">Edit</a>] [
                            <a href='javascript:phpfm(<?php echo $row['problem_id']; ?>)'>TestData</a>]
                            <?php
                        }
                        echo "</center>";
                        ?>
                    </div>
                    <div class="right" style="float: right;width: 19%">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td class="td-left">
                                    <div class="timer count-title" id="count-number"
                                         data-to="<?php
                                         if (empty($row['accepted'])) {
                                             echo "0";
                                         } else {
                                             echo $row['accepted'];
                                         }
                                         ?>"
                                         data-speed="1500" decimals="0"></div>
                                    <div>通过</div>
                                </td>
                                <td class="td-right">
                                    <div class="timer count-title" id="count-number"
                                         data-to="<?php
                                         if (empty($row['submit'])) {
                                             echo "0";
                                         } else {
                                             echo $row['submit'];
                                         } ?>"
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
                            <a href="#
22 " class="btn btn-info btn-sm" type="button"
                               style="width:80px;height:30px;margin-top:10px;margin-bottom:10px;border-radius:5px;background:red;border-width:0px;margin-left:10px;cursor:pointer;outline:none;font-size:15px;color:white;bold:none;text-align:center">Submit</a>

                            <a href="./answer.php" target="_blank" class="btn btn-info btn-sm" type="button"
                               style="width:80px;height:30px;margin-top:10px;margin-bottom:10px;border-radius:5px;background:#1e90ff;border-width:0px;margin-left:10px;cursor:pointer;outline:none;font-size:15px;color:white;bold:none;text-align:center">Answer</a>

                            <a href="./comment.php" target="_blank" class="btn btn-info btn-sm" type="button"
                               style="width:80px;height:30px;margin-top:10px;margin-bottom:10px;border-radius:5px;background:#33ff00;border-width:0px;margin-left:10px;cursor:pointer;outline:none;font-size:15px;color:white;bold:none;text-align:center">Comment</a>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                        <div style="width: auto">
                            <div id="awrate" style="width: auto;height: 300px"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="mystatic">
                <?php require("mystatus.php"); ?>
            </div>
            <div class="tab-pane fade" id="statistics">
                <center>
                    <div id="bing" style="width: 1200px;height: 600px"></div>
                </center>

                <center>
                    <div id="static" style="width:1400px;height: 600px"></div>
                </center>
            </div>
        </div>

    </div>

    <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php //include("template/$OJ_TEMPLATE/js.php"); ?>
    <script type="text/javascript" src="include/clipboard.js"></script>
    <!--切换tab页的js-->
    <script>
        $(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                // 获取已激活的标签页的名称
                var activeTab = $(e.target).text();
                // 获取前一个激活的标签页的名称
                var previousTab = $(e.relatedTarget).text();
                $(".active-tab span").html(activeTab);
                $(".previous-tab span").html(previousTab);
            });
        });
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
                    if (typeof (c.onUpdate) == "function") {
                        c.onUpdate.call(j, g)
                    }
                    if (e >= h) {
                        f.removeData("countTo");
                        clearInterval(d.interval);
                        g = c.to;
                        if (typeof (c.onComplete) == "function") {
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
    <!--学长做的复制粘贴输入输出-->
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

        /*****************************************修改开始***************************************************************************/
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
        /*****************************************修改结束***************************************************************************/
    </script>
    <!--错误类型统计-->
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
    <!--ac wrong的比率-->
    <script>
        var myChart = echarts.init(document.getElementById('awrate'));// 基于准备好的dom，初始化echarts实例
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
                            qa_i[0] = qa;//qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值,qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
                            qs_i[0] = qs;

                            qd = qa - qs;
                            qd_i[0] = qd;
                        }
                    }
                }
            })
        }

        //执行异步请求
        TestAjax();
        //=============================================================================================
        var app = {};
        app.title = '饼图';//标题++;
        option = null;
        option = {
            tooltip: {//提示框
                trigger: 'item',//当trigger为’item’时只会显示该点的数据
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {//实例组合表单中的相关元素    name[i]
                orient: 'vertical',//方向：垂直
                x: 'right'//矩形的左上角
            },
            series: [//一维数组结构
                {
                    name: '访问来源',//标签
                    type: 'pie',//类型：圆饼
                    selectedMode: 'single',//为series属性的每一项添加一个selectedMode属性 'single':单选
                    radius: [0, '50%'],//半径
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
                        {value: qa_i, name: '题目提交量'},//value 数值  value:[123]
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
    <!--各班统计情况-->
    <script>
        var myChart = echarts.init(document.getElementById('static'));// 基于准备好的dom，初始化echarts实例
        //=============================================================================================
        var numbers = [], correct_numbers = [], Wrong_number = [], messages = []

        function TestAjax() {
            $.ajax({
                type: "post",   //向指定资源提交数据，请求服务器进行处理
                async: false,   //异步执行
                url: "template/bs3/sql_0312.php", //SQL数据库文件
                data: {},           //发送给数据库的数据
                dataType: "json",   //json类型
                success: function (result) {
                    if (result) {
                        for (var i = 0; i < result.length; i++) {
                            numbers.push(result[i].number);
                            correct_numbers.push(result[i].correct_number);
                            messages.push(result[i].message);
                            console.log(result[i].number);
                            console.log(result[i].correct_number);
                            console.log(result[i].message);
                            Wrong_number[i] = numbers[i] - correct_numbers[i];
                        }
                    }
                }
            })
        }

        TestAjax(); //执行异步请求
        var app = {};
        app.title = '柱状图';//标题
        option = null;
        option = {
            title: {   //标题
                text: '柱状图',
                subtext: 'From ExcelHome',  //潜台词
            },
            grid: { //网格设计
                left: '5%', //左侧间距
                right: '5%',    //右侧间距
                bottom: '5%',   //底部间距
                containLabel: true  //包含标签
            },
            tooltip: { //提示框
                trigger: 'item',    //当trigger为’item’时只会显示该点的数据/axis 轴线
                axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                    type: 'line'        // 默认为直线，可选为：'line' | 'shadow'
                },
                formatter: "{a} <br/>{b}: {c}"
            },
            legend: {   //实例组合表单中的相关元素    name[i]
            },
            toolbox: {  //工具箱
                show: true,    //显示
                feature: { //特征
                    mark: {show: true},    //标志
                    dataView: {show: true, readOnly: false},   //数据视图 /readonly只读
                    restore: {show: true}, //恢复
                    saveAsImage: {show: true} //save As Image  另存为图片
                }
            },
            calculable: true, //可计算
            xAxis: [   //横坐标
                {
                    type: 'category',  //类型
                    data: messages
                }
            ],
            yAxis: [   //纵坐标
                {
                    type: 'value', //默认为值类型
                    boundaryGap: [0, 0.1]   //边界的差距
                }
            ],
            series: [
                {
                    name: '正确量',  //标签
                    type: 'bar', //类型：柱状
                    //stack: 'sum',   //数据堆积
                    barCategoryGap: '50%',  //柱形宽度
                    itemStyle: {    //项目风格
                        normal: {   //标准化
                            color: 'Red',    //内部颜色
                            barBorderColor: '#fff',   //边框颜色
                            barBorderWidth: 2,  //边框宽度
                            barBorderRadius: 0,  //半径(圆弧度)
                            label: {   //标签
                                show: true, position: 'top'   //position: 'insideTop' 位置：在…之内的顶部
                            }
                        }
                    },
                    data: correct_numbers
                },
                {
                    name: '错误量',
                    type: 'bar',
                    //stack: 'sum',
                    itemStyle: {
                        normal: {
                            color: 'yellow',  //内部颜色
                            barBorderColor: '#fff',   //边框颜色
                            barBorderWidth: 2,  //边框宽度
                            barBorderRadius: 0,  //半径(圆弧度)
                            label: {   //标签
                                show: true, position: 'top',    //顶部
                                textStyle: {    //标签颜色
                                    color: 'blue'
                                }
                            }
                        }
                    },
                    data: Wrong_number
                },

            ]
        };
        if (option && typeof option === "object") {//选项==选择选项==对象
            myChart.setOption(option, true);//set Option设置选项
        }
    </script>
</body>
</html>