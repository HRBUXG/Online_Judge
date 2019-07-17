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
    <link rel="stylesheet" type="text/css" href="template/bs3/qiandao_style.css">

    <!--    <script src="template/bs3/jquery.min.js"></script>-->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title><?php echo $OJ_NAME ?></title>
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
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">积分流水</a></li>
            <li><a href="#level" data-toggle="tab">签到日历</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <?php
                $page = empty($_GET['page']) ? 1 : $_GET['page'];
                $conn = mysqli_connect("localhost", "root", "HRBUXGOJ");
                mysqli_query($conn, "set names utf8");
                mysqli_query($conn, "SET time_zone = '+8:00'");
                if (!$conn) {
                    echo "失败";
                }
                mysqli_select_db($conn, "jol");
                $user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];


                $sql_c = "SELECT
	COUNT(*) AS count 
FROM
	(( SELECT 'tag1', user_id, 'info', check_time AS time, sign_score FROM sign WHERE user_id = '" . $user_id . "' ) UNION
( SELECT 'tag2', user_id, problem_id, purchase_time AS time, purchase_score FROM purchase_record WHERE user_id = '" . $user_id . "' ) UNION
(
SELECT
	'tag3',
	s.user_id,
	s.problem_id,
	judgetime AS time,
	p.difficulty 
FROM
	solution s,
	problem p 
WHERE
	p.problem_id = s.problem_id 
	AND p.difficulty IS NOT NULL 
	AND result = 4 
	AND user_id = '" . $user_id . "'
	) ) AS t";
                $result = mysqli_query($conn, $sql_c);
                $pageRes = mysqli_fetch_assoc($result);
                #var_dump($pageRes);   //13
                $count = $pageRes['count'];


                //2.每页显示数(5)
                $num = 15;

                //3.根据每页显示数求出总页数
                $pageCount = ceil($count / $num);  //向上取整
                #var_dump($pageCount);  //3

                //4.根据总页数求出偏移量
                $offset = ($page - 1) * $num;  //$page默认为 1, 下一步设置


                $sql = "( SELECT 'tag1', user_id, 'info', check_time AS time, sign_score FROM sign WHERE user_id = '" . $user_id . "' ) UNION
( SELECT 'tag2', user_id, problem_id, purchase_time AS time, purchase_score FROM purchase_record WHERE user_id = '" . $user_id . "' ) UNION
(
SELECT
	'tag3',
	s.user_id,
	s.problem_id,
	judgetime AS time,
	p.difficulty 
FROM
	solution s,
	problem p 
WHERE
	p.problem_id = s.problem_id 
	AND p.difficulty IS NOT NULL 
	AND result = 4 
	AND user_id = '" . $user_id . "'
	) 
ORDER BY
	time DESC 
	LIMIT ". $offset . ',' . $num;
                $result = mysqli_query($conn, $sql);
                echo "<table class=\"table table-hover table-striped\" >";
                echo "<thead><tr><td>时间<td>流水<td></thead>";
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['time'];
                    if ($row['tag1'] == "tag1") {
                        echo "<td><span class=\"glyphicon glyphicon-check\"></span>    
签到入口每日签到,获得" . $row['sign_score'] . "积分";
                    } elseif ($row['tag1'] == "tag2") {
                        echo "<td><span class=\"glyphicon glyphicon-shopping-cart\">购买" . $row['info'] . "题的题解,花费" . $row['sign_score'] . "积分";
                    } elseif ($row['tag1'] == "tag3") {
                        echo "<td><span class=\"glyphicon glyphicon-book\">练习做" . $row['info'] . "题,获得" . $row['sign_score'] . "积分";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                $prev = $page - 1;
                $next = $page + 1;

                //11.设置页数限制
                if ($prev < 1) {
                    $prev = 1;
                }
                if ($next > $pageCount) {
                    $next = $pageCount;
                }
                ?>
                <center>
                    <a href="bonus_score.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;
                    <a href="bonus_score.php?page=<?php echo $prev; ?>">上一页</a>&nbsp;&nbsp;&nbsp;
                    <!--混编简写-->
                    <a href="bonus_score.php?page=<?= $next; ?>">下一页</a>&nbsp;&nbsp;&nbsp;
                    <a href="bonus_score.php?page=<?= $pageCount; ?>">尾页</a>
                </center>



            </div>
            <!-- 签到 layer end -->

            <div class="tab-pane fade" id="level">
                <p align=left>
                    <?php /*echo $MSG_Description*/ ?><!--:<br>
                            <textarea class="kindeditor" rows=13 name=description cols=80 style="width:1px" ></textarea>-->
                </p>

                <div>
                    <div class="qiandao-con clear">
                        <div class="qiandao-left">
                            <div class="qiandao-left-top clear">
                                <div class="current-date">2016年1月6日</div>
                                <!--<div class="qiandao-history qiandao-tran qiandao-radius" id="js-qiandao-history">我的签到</div>-->
                            </div>
                            <div class="qiandao-main" id="js-qiandao-main">
                                <ul class="qiandao-list" id="js-qiandao-list">
                                </ul>
                            </div>
                        </div>
                        <div class="qiandao-right">
                            <div class="qiandao-top">
                                <div class="just-qiandao qiandao-sprits" id="js-just-qiandao">
                                </div>
                            </div>
                            <div class="qiandao-bottom">
                                <div class="qiandao-rule-list">
                                    <br>
                                    <br>
                                    <br>
                                    <h4>签到规则</h4>
                                    <p>日常签到获得1积分奖励</p>
                                    <p>花费积分可以购买题解</p>
                                    <p>AC题目也可以获得积分</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 我的签到 layer start -->
            <div class="qiandao-layer qiandao-history-layer">
                <div class="qiandao-layer-con qiandao-radius">
                    <a href="javascript:;" class="close-qiandao-layer qiandao-sprits"></a>
                    <ul class="qiandao-history-inf clear">
                        <li>
                            <p>连续签到</p>
                            <h4>5</h4>
                        </li>
                        <li>
                            <p>本月签到</p>
                            <h4>17</h4>
                        </li>
                        <li>
                            <p>总共签到数</p>
                            <h4>28</h4>
                        </li>
                        <li>
                            <p>签到累计奖励</p>
                            <h4>30</h4>
                        </li>
                    </ul>
                    <!-- <div class="qiandao-history-table">
                         <table>
                             <thead>
                             <tr>
                                 <th>签到日期</th>
                                 <th>奖励</th>
                                 <th>说明</th>
                             </tr>
                             </thead>
                             <table>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>分享奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                                 <tr>
                                     <td>2016-1-6 14:23:45</td>
                                     <td>0.20</td>
                                     <td>连续签到19天奖励</td>
                                 </tr>
                             </table>
                         </table>
                     </div>-->
                </div>
                <div class="qiandao-layer-bg"></div>
            </div>
            <!-- 我的签到 layer end -->
            <!-- 签到 layer start -->
            <div class="qiandao-layer qiandao-active">
                <div class="qiandao-layer-con qiandao-radius">
                    <a href="javascript:;" class="close-qiandao-layer qiandao-sprits"></a>
                    <div class="qiandao-jiangli qiandao-sprits">
                        <span class="qiandao-jiangli-num">1.00<em>积分</em></span>
                    </div>
                    <p class="qiandao-share qiandao-tran">再接再厉哦</p>
                    <!--                                <a href="#" class="qiandao-share qiandao-tran">分享获取双倍收益</a>-->
                </div>
                <div class="qiandao-layer-bg"></div>
            </div>
        </div>
    </div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script>


    $(function () {
        var signFun = function () {
            $(window).ready(function () {
                doCheck();
            });

            function doCheck() {
                <?php
                $uid = $_SESSION[$OJ_NAME . '_' . 'user_id'];
                echo "var uid=\"$uid\";";
                ?>
                $.post("template/bs3/sign-ajax.php?do=check&uid=" + uid, {}, function (data) {
                    //$("#days").html(data);
                    if (data == 1) {
                    }
                    if (data == 2) {
                        $qiandaoBnt.addClass('actived');
                        //openLayer("qiandao-active", qianDao);
                        _handle = false;
                    }
                });
            }


// 假设已经签到的
            var dateArray = []
            <?php
            $db = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
            $uid = $_SESSION[$OJ_NAME . '_' . 'user_id'];
            $getDays = "SELECT day(check_time)-1  as days from sign where user_id ='{$uid}' AND month(check_time)=month(curdate())";
            $result = $db->query($getDays);
            while ($row = $result->fetch_assoc()) {
                echo "dateArray.push('{$row["days"]}');";
            }
            ?>


            var $dateBox = $("#js-qiandao-list"),
                $currentDate = $(".current-date"),
                $qiandaoBnt = $("#js-just-qiandao"),
                _html = '',
                _handle = true,
                myDate = new Date();
            $currentDate.text(myDate.getFullYear() + '年' + parseInt(myDate.getMonth() + 1) + '月' + myDate.getDate() + '日');

            var monthFirst = new Date(myDate.getFullYear(), parseInt(myDate.getMonth()), 1).getDay();

            var d = new Date(myDate.getFullYear(), parseInt(myDate.getMonth() + 1), 0);
            var totalDay = d.getDate(); //获取当前月的天数

            for (var i = 0; i < 42; i++) {
                _html += ' <li><div class="qiandao-icon"></div></li>'
            }
            $dateBox.html(_html) //生成日历网格

            var $dateLi = $dateBox.find("li");
            for (var i = 0; i < totalDay; i++) {
                $dateLi.eq(i + monthFirst).addClass("date" + parseInt(i + 1));
                for (var j = 0; j < dateArray.length; j++) {
                    if (i == dateArray[j]) {
                        $dateLi.eq(i + monthFirst).addClass("qiandao");
                    }
                }
            } //生成当月的日历且含已签到

            $(".date" + myDate.getDate()).addClass('able-qiandao');

            $dateBox.on("click", "li", function () {
                if ($(this).hasClass('able-qiandao') && _handle) {
                    $(this).addClass('qiandao');
                    qiandaoFun();
                }
            }) //签到

            $qiandaoBnt.on("click", function () {
                if (_handle) {
                    qiandaoFun();
                    doSign();
                }
            }); //签到
            function doSign() {
                var uid = String(<?php echo $_SESSION[$OJ_NAME . '_' . 'user_id'];?>);
                $.ajax("template/bs3/sign-ajax.php?do=sign&uid=" + uid, {}, function (data) {
                });
            }

            function qiandaoFun() {
                $qiandaoBnt.addClass('actived');
                openLayer("qiandao-active", qianDao);
                _handle = false;
            }

            function qianDao() {
                $(".date" + myDate.getDate()).addClass('qiandao');
            }
        }();

        function openLayer(a, Fun) {
            $('.' + a).fadeIn(Fun)
        } //打开弹窗

        var closeLayer = function () {
            $("body").on("click", ".close-qiandao-layer", function () {
                $(this).parents(".qiandao-layer").fadeOut()
            })
        }() //关闭弹窗

        //检查是否今天签到过，若签到过禁用前端的按钮


        $("#js-qiandao-history").on("click", function () {
            openLayer("qiandao-history-layer", myFun);

            function myFun() {
                console.log(1)
            } //打开弹窗返回函数
        })

    })


</script>
</body>
</html>
