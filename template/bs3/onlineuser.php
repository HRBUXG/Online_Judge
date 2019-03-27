<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


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
        <center>
            <div class="container1" style="padding: 100px 100px 50px;">
                <button type="button" class="btn btn-primary" title="Popover title"
                        data-container="body" data-toggle="popover" data-placement="left"
                        data-content="solve小于<?php echo $levelss[0]; ?>道题目">新手上路
                </button>
                <!-- 表示一个成功的或积极的动作 -->
                <button type="button" class="btn btn-success" title="Popover title"
                        data-container="body" data-toggle="popover" data-placement="top"
                        data-content="solve小于<?php echo $levelss[1]; ?>道题目">步入江湖
                </button>
                <!-- 信息警告消息的上下文按钮 -->
                <button type="button" class="btn btn-info" title="Popover title"
                        data-container="body" data-toggle="popover" data-placement="bottom"
                        data-content="solve小于<?php echo $levelss[2]; ?>道题目">小有名气
                </button>
                <!-- 表示应谨慎采取的动作 -->
                <button type="button" class="btn btn-warning" title="Popover title"
                        data-container="body" data-toggle="popover" data-placement="top"
                        data-content="solve小于<?php echo $levelss[3]; ?>道题目">灵魂人物
                </button>
                <!-- 表示一个危险的或潜在的负面动作 -->
                <button type="button" class="btn btn-danger" title="Popover title"
                        data-container="body" data-toggle="popover" data-placement="right"
                        data-content="solve超过<?php echo $levelss[3]; ?>道题目">传奇人物
                </button>
            </div>
        </center>
        <h3>current online user: <?php echo $on->get_num() ?></h3>
        <table class="table table-hover">
            <caption>在线人数</caption>
            <thead>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
            </tr>
            </thead>
            <tbody>
            <?php
            header('Content-Type:text/html; charset=utf-8'); //网页utf8
            $pdo = new PDO ('mysql:host=localhost;dbname=jol', 'root', 'HRBUXGOJ'); //连接数据库
            $pdo->query("set names utf8"); //数据库utf8

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql_online = "select substring_index(online.ua,'@',1),nick,solved from online,users where substring_index(online.ua,'@',1)=users.user_id order by solved desc";
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
                if ($cnt % 6 == 0) {
                    echo "</tr>" . "<tr>";
                }
            }

            echo "</tr>";
            ?>
        </table>

    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
</body>
</html>
