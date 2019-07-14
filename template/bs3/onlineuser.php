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
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title><?php echo $OJ_NAME ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .mature-progress {
            margin-top: 15px;
            margin-bottom: 200px;
        }

        .mature-progress .mature-progress-top {
            position: relative;
            padding-left: 15px;
            font-size: 18px;
            height: 40px;
            line-height: 40px;
        }

        .mature-progress .mature-progress-top:before {
            content: '';
            display: block;
            position: absolute;
            width: 8px;
            height: 20px;
            left: 0;
            top: 10px;
            background: #e10482;
            border-radius: 5px;
        }

        .mature-progress .mature-progress-bottom {
            border-radius: 5px;
            /*border:#f2f2f2 solid 1px;*/
            padding: 15px;
            position: relative;
            height: 125px;
            width: 720px;
            /*width:100%;*/
        }

        .mature-progress .mature-progress-bottom p > span {
            color: #e10482;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box {
            height: 105px;
            padding: 10px 0 0 10px;
            position: absolute;
            top: 60px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.bgtwos {
            z-index: 1;
            top: 55px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.bgtwos dl dt {
            border: #f2f2f2 solid 5px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.v0 dl:nth-of-type(1) dt {
            background: #e10482;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.v1 dl:nth-of-type(2) dt {
            background: #e10482;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.v2 dl:nth-of-type(3) dt {
            background: #e10482;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.v3 dl:nth-of-type(4) dt {
            background: #e10482;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box.v4 dl:nth-of-type(5) dt {
            background: #e10482;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box dl {
            width: 70px;
            text-align: center;
            float: left;
            margin-right: 65px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box dl dt {
            width: 40px;
            height: 40px;
            background: #999999;
            color: #fff;
            text-align: center;
            line-height: 44px;
            border-radius: 50%;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
            z-index: 3;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box dl dd {
            padding-top: 5px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box {
            position: absolute;
            width: 676px;
            height: 15px;
            border-radius: 10px;
            border: #f2f2f2 solid 5px;
            background: #fff;
            z-index: 2;
            top: 20px;
            left: 22px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i {
            position: absolute;
            height: 15px;
            background: #e10482;
            left: 36px;
            top: 0;
            width: 0;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i.progress-box-2 {
            left: 171px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i.progress-box-3 {
            left: 305px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i.progress-box-4 {
            left: 440px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i.progress-box-5 {
            left: 576px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i span {
            position: absolute;
            display: inline-block;
            *zoom: 1;
            *display: inline;
            background: #fff;
            border-radius: 5px;
            height: 30px;
            line-height: 30px;
            font-weight: normal;
            font-size: 12px;
            font-style: normal;
            border: #cccccc solid 1px;
            right: -80px;
            top: -50px;
            padding: 0 10px;
            width: 135px;
            text-align: center;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i span:before {
            content: '';
            display: block;
            position: absolute;
            border-width: 10px;
            border-style: solid;
            border-color: #ccc transparent transparent transparent;
            bottom: -20px;
            left: 50%;
            margin-left: -10px;
        }

        .mature-progress .mature-progress-bottom .mature-progress-box .progress-box i span:after {
            content: '';
            display: block;
            position: absolute;
            border-width: 10px;
            border-style: solid;
            border-color: #fff transparent transparent transparent;
            bottom: -19px;
            left: 50%;
            margin-left: -10px;
        }
    </style>

    <script src="template/bs3/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        $(function () {
            $("[data-toggle='popover']").popover();
        });
    </script>
</head>

<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->

    <?php

    $doc = new DOMDocument();
    $doc->load('template/bs3/level.xml');
    $levelss = array();
    $levels = $doc->getElementsByTagName("level");
    //遍历
    foreach ($levels as $level) {
        //echo $level->getAttribute('id') . "-";
        // echo $level->getElementsByTagName("total")->item(0)->nodeValue;
        // echo "<br>";
        array_push($levelss, $level->getElementsByTagName("total")->item(0)->nodeValue);
    }
    ?>


    <div class="jumbotron">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">我的等级</a></li>
            <li><a href="#level" data-toggle="tab">在线用户</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <center>
                    <div class="mature-progress">
                        <div class="mature-progress-bottom">

                            <div class="mature-progress-box v0" id="mamture_progress">
                                <dl>
                                    <dt>0</dt>
                                    <dd><span class="member-ico v0"></span>
                                        <label class="label label-primary">新手上路</label>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $levelss[0]; ?></dt>
                                    <dd><span class="member-ico v1"></span> <label
                                                class="label label-success">步入江湖</label>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $levelss[1]; ?></dt>
                                    <dd><span class="member-ico v2"></span>
                                        <label class="label label-info">小有名气</label></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $levelss[2]; ?></dt>
                                    <dd><span class="member-ico v3"></span>
                                        <label class="label label-warning">灵魂人物</label></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $levelss[3]; ?></dt>
                                    <dd><span class="member-ico v4"></span>
                                        <label class="label label-danger">传奇人物</label></dd>
                                    </dd>
                                </dl>

                                <div class="progress-box" id="progress_content"
                                     data-progress="<?php echo $count_solved; ?>">
                                    <i class="progress-box-1"></i>

                                    <i class="progress-box-2"></i>

                                    <i class="progress-box-3"></i>

                                    <i class="progress-box-4"></i>

                                    <i class="progress-box-5"></i>

                                </div>
                            </div>
                            <div class="mature-progress-box bgtwos">
                                <dl>
                                    <dt></dt>
                                </dl>
                                <dl>
                                    <dt></dt>
                                </dl>
                                <dl>
                                    <dt></dt>
                                </dl>
                                <dl>
                                    <dt></dt>
                                </dl>
                                <dl>
                                    <dt></dt>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary" style="width: 50%">
                        <div class="panel-heading">
                            <h3 class="panel-title">等级说明</h3>
                        </div>
                        <div class="panel-body">
                            <div><label class="label label-primary">新手上路</label> &nbsp&nbsp解决的题小于<?php echo $levelss[0]; ?>道题</div>
                            <div><label class="label label-success">步入江湖</label> &nbsp&nbsp解决的题小于<?php echo $levelss[1]; ?>道题</div>
                            <div><label class="label label-info">小有名气</label> &nbsp&nbsp解决的题小于<?php echo $levelss[2]; ?>道题</div>
                            <div><label class="label label-warning">灵魂人物</label> &nbsp&nbsp解决的题小于<?php echo $levelss[3]; ?>道题</div>
                            <div><label class="label label-danger">传奇人物</label> &nbsp&nbsp解决的题超过<?php echo $levelss[3]; ?>道题</div>
                        </div>
                    </div>
                </center>


            </div>
            <div class="tab-pane fade" id="level">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    header('Content-Type:text/html; charset=utf-8'); //网页utf8
                    $pdo = new PDO ('mysql:host=localhost;dbname=jol', 'root', 'HRBUXGOJ'); //连接数据库
                    $pdo->query("set names utf8"); //数据库utf8

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    $sql_online = "select distinct t.id as num,t.nick,t.solved from (select substring_index(online.ua,'@',1) as id,nick,solved 
from online,users 
where substring_index(online.ua,'@',1)=users.user_id 
order by solved desc) as t";
                    $stmt = $pdo->query($sql_online);

                    $cnt = 0;
                    echo "<tr>";
                    foreach ($stmt as $row) {
                        echo "<td>";
                        if ($row['solved'] <= $levelss[0]) {
                            echo "<span class=\"label label-primary\">";
                        } elseif ($row['solved'] <= $levelss[1]) {
                            echo "<span class=\"label label-success\">";
                        } elseif ($row['solved'] <= $levelss[2]) {
                            echo "<span class=\"label label-info\">";
                        } elseif ($row['solved'] <= $levelss[3]) {
                            echo "<span class=\"label label-warning\">";
                        } elseif ($row['solved'] > $levelss[3]) {
                            echo "<span class=\"label label-danger\">";
                        }
                        echo $row['nick'] . "</span>" . "</td>";
                        $cnt++;
                        if ($cnt % 8 == 0) {
                            echo "</tr>" . "<tr>";
                        }
                    }

                    echo "</tr>";
                    echo "在线人数：" . $cnt . "人";
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>

<!--等级JS-->
<script>
    (function () {
        var mamture_progress = $('#mamture_progress');
        var progress_content = $('#progress_content');
        var l = 0;
        var _number = progress_content.attr('data-progress');
        var timer = null;
        var pro = 0;

        if (_number < <?php echo $levelss[0]; ?>) {
            lad(_number, <?php echo $levelss[0]; ?>, '.progress-box-1', function () {
                $('.progress-box-1').append('<span>再做出' + (<?php echo $levelss[0]; ?> -_number) + '题即可升级</span>');
            });
        }
        ;

        if (_number >= <?php echo $levelss[0]; ?> && _number < <?php echo $levelss[1]; ?>) {
            lad(<?php echo $levelss[0]; ?>, <?php echo $levelss[0]; ?>, '.progress-box-1', function () {
                mamture_progress.addClass('v1');
                lad(_number - <?php echo $levelss[0]; ?>, <?php echo $levelss[1]; ?> - <?php echo $levelss[0]; ?>, '.progress-box-2', function () {
                    $('.progress-box-2').addClass('active');
                    $('.progress-box-2').append('<span>再做出' + (<?php echo $levelss[1]; ?> -_number) + '题即可升级</span>');
                });
            });
        }
        ;

        if (_number >= <?php echo $levelss[1]; ?> && _number < <?php echo $levelss[2]; ?>) {
            lad(<?php echo $levelss[0]; ?>, <?php echo $levelss[0]; ?>, '.progress-box-1', function () {
                mamture_progress.addClass('v1')
                lad(<?php echo $levelss[1]; ?>, <?php echo $levelss[1]; ?>, '.progress-box-2', function () {
                    mamture_progress.addClass('v2');
                    lad(_number - <?php echo $levelss[1]; ?>, <?php echo $levelss[2]; ?> - <?php echo $levelss[1]; ?>, '.progress-box-3', function () {
                        $('.progress-box-3').addClass('active');
                        $('.progress-box-3').append('<span>再做出' + (<?php echo $levelss[2]; ?> -_number) + '题即可升级</span>');
                    })
                });
            });
        }
        ;

        if (_number >= <?php echo $levelss[2]; ?> && _number < <?php echo $levelss[3]; ?>) {
            lad(<?php echo $levelss[0]; ?>, <?php echo $levelss[0]; ?>, '.progress-box-1', function () {
                mamture_progress.addClass('v1')
                lad(<?php echo $levelss[1]; ?>, <?php echo $levelss[1]; ?>, '.progress-box-2', function () {
                    mamture_progress.addClass('v2')
                    lad(<?php echo $levelss[2]; ?>, <?php echo $levelss[2]; ?>, '.progress-box-3', function () {
                        mamture_progress.addClass('v3')
                        lad(_number - <?php echo $levelss[2]; ?>, <?php echo $levelss[3]; ?> - <?php echo $levelss[2]; ?>, '.progress-box-4', function () {
                            $('.progress-box-4').addClass('active');
                            $('.progress-box-4').append('<span>再做出' + (<?php echo $levelss[3]; ?> -_number) + '题即可升级</span>');
                        })
                    })
                });
            });
        }
        ;

        if (_number >= <?php echo $levelss[3]; ?>) {
            lad(<?php echo $levelss[0]; ?>, <?php echo $levelss[0]; ?>, '.progress-box-1', function () {
                mamture_progress.addClass('v1')
                lad(<?php echo $levelss[1]; ?>, <?php echo $levelss[1]; ?>, '.progress-box-2', function () {
                    mamture_progress.addClass('v2')
                    lad(<?php echo $levelss[2]; ?>, <?php echo $levelss[2]; ?>, '.progress-box-3', function () {
                        mamture_progress.addClass('v3')
                        lad(<?php echo $levelss[3]; ?>, <?php echo $levelss[3]; ?>, '.progress-box-4', function () {
                            mamture_progress.addClass('v4')
                            lad(_number - <?php echo $levelss[3]; ?>, 10000000, '.progress-box-5')
                        })
                    })
                });
            });
        }
        ;

        /*
         @number : 成长值
         @max : 最大值
         @callback : 回调方法
         */
        function lad(number, max, cls, callback) {
            l = 0;
            timer = setInterval(function () {
                if (number <= <?php echo $levelss[0]; ?>) {
                    l++;
                } else if (number > <?php echo $levelss[0]; ?> && number <= <?php echo $levelss[1]; ?>) {
                    l += 5;
                } else if (number > <?php echo $levelss[1]; ?> && number <= <?php echo $levelss[2]; ?>) {
                    l += 10;
                } else if (number > <?php echo $levelss[2]; ?> && number <= <?php echo $levelss[3]; ?>) {
                    l += 20;
                } else {
                    l += 30;
                }
                ;

                pro = (l / max) * 100; //100为  div的长度
                if (l >= number) {
                    clearInterval(timer);
                    if (callback) callback(); //回调
                }
                ;
                $(cls).css({
                    width: pro + 'px'
                })
            }, 1)
        }
    })();
</script>
</body>
</html>
