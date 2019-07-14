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
            <li class="active">
                <a href="#home" data-toggle="tab">
                    我通过的题
                </a>
            </li>
            <li><a href="#wrong" data-toggle="tab">我的错题集</a></li>
            <li><a href="#day" data-toggle="tab">刷题日分析</a></li>
            <li><a href="#login" data-toggle="tab">登录记录</a></li>
            <li><a href="#info" data-toggle="tab">个人信息</a></li>

        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>

                        </tr>
                        </thead>
                        <tbody>
                        <?php


                        $servername = "localhost";
                        $username = "root";
                        $password = "HRBUXGOJ";
                        $dbname = "jol";

                        // 创建连接
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        // Check connection
                        if (!$conn) {
                            die("连接失败: " . mysqli_connect_error());
                        }
                        $sql = "select distinct problem_id from solution where result=4 and  user_id='" . $user . "';";
                        $result = mysqli_query($conn, $sql);


                        $cnt = 0;
                        echo "<tr>";
                        foreach ($result as $row) {
                            echo "<td>";
                            echo '<span class="label label-success">' . $row['problem_id'] . '</span>' . '</td>';
                            $cnt++;
                            if ($cnt % 8 == 0) {
                                echo "</tr>" . "<tr>";
                            }
                        }

                        echo "</tr>";
                        ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="wrong">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>

                        </tr>
                        </thead>
                        <tbody>
                        <?php


                        $servername = "localhost";
                        $username = "root";
                        $password = "HRBUXGOJ";
                        $dbname = "jol";

                        // 创建连接
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        // Check connection
                        if (!$conn) {
                            die("连接失败: " . mysqli_connect_error());
                        }
                        $sql = "select distinct problem_id from solution where result!=4 and   user_id='" . $user . "';";
                        $result = mysqli_query($conn, $sql);


                        $cnt = 0;
                        echo "<tr>";
                        foreach ($result as $row) {
                            echo "<td>";
                            echo '<span class="label label-danger">' . $row['problem_id'] . '</span>' . '</td>';
                            $cnt++;
                            if ($cnt % 8 == 0) {
                                echo "</tr>" . "<tr>";
                            }
                        }

                        echo "</tr>";
                        ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="day">
                <center>
                    <div id=submission style="width:1000px;height:400px"></div>
                </center>

            </div>
            <div class="tab-pane fade" id="login">
                <center>
                    <table border=1>
                        <tr class=toprow>
                            <td>UserID
                            <td>Password
                            <td>IP
                            <td>Time
                        </tr>
                        <tbody>
                        <?php
                        $cnt = 0;
                        foreach ($view_userinfo as $row) {
                            if ($cnt)
                                echo "<tr class='oddrow'>";
                            else
                                echo "<tr class='evenrow'>";
                            for ($i = 0; $i < count($row) / 2; $i++) {
                                echo "<td>";
                                echo "\t" . $row[$i];
                                echo "</td>";
                            }
                            echo "</tr>";
                            $cnt = 1 - $cnt;
                        }
                        ?>
                        </tbody>
                    </table>
                </center>

            </div>
            <div class="tab-pane fade" id="info">
                <center>
                    <table class="table table-striped" id=statics width=70%>
                        <caption>
                            <?php echo $user . "--" . htmlentities($nick, ENT_QUOTES, "UTF-8") ?>
                            <?php
                            echo "<a href=mail.php?to_user=$user>$MSG_MAIL</a>";
                            ?>
                        </caption>
                        <tr>
                            <td width=15%><?php echo $MSG_Number ?>
                            <td width=25% align=center><?php echo $Rank ?>
                           <!-- <td width=70% align=center>Solved Problems List-->
                        </tr>
                       <!-- <tr>
                            <td><?php /*echo $MSG_SOVLED */?>
                            <td align=center><a
                                        href='status.php?user_id=<?php /*echo $user */?>&jresult=4'><?php /*echo $AC */?></a>
                            <td rowspan=14 align=center>
                                <script language='javascript'>
                                    function p(id, c) {
                                        document.write("<a href=problem.php?id=" + id + ">" + id + " </a>(<a href='status.php?user_id=<?php /*echo $user*/?>&problem_id=" + id + "'>" + c + "</a>)");

                                    }
                                    <?php /*$sql = "SELECT `problem_id`,count(1) from solution where `user_id`=? and result=4 group by `problem_id` ORDER BY `problem_id` ASC";
                                    if ($result = pdo_query($sql, $user)) {
                                        foreach ($result as $row)
                                            echo "p($row[0],$row[1]);";
                                    }

                                    */?>
                                </script>
                                <!--                        <div id=submission style="width:600px;height:300px"></div>-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $MSG_SUBMIT ?>
                            <td align=center><a href='status.php?user_id=<?php echo $user ?>'><?php echo $Submit ?></a>
                        </tr>
                        <?php
                        foreach ($view_userstat as $row) {
//i++;
                            echo "<tr ><td>" . $jresult[$row[0]] . "<td align=center><a href=status.php?user_id=$user&jresult=" . $row[0] . " >" . $row[1] . "</a></tr>";
                        }
                        //}
                        echo "<tr id=pie ><td>Statistics<td><div id='PieDiv' style='position:relative;height:105px;width:120px;'></div></tr>";
                        ?>
                        <script type="text/javascript" src="include/wz_jsgraphics.js"></script>
                        <script type="text/javascript" src="include/pie.js"></script>
                        <script language="javascript">
                            var y = new Array();
                            var x = new Array();
                            var dt = document.getElementById("statics");
                            var data = dt.rows;
                            var n;
                            for (var i = 3; dt.rows[i].id != "pie"; i++) {
                                n = dt.rows[i].cells[0];
                                n = n.innerText || n.textContent;
                                x.push(n);
                                n = dt.rows[i].cells[1].firstChild;
                                n = n.innerText || n.textContent;
//alert(n);
                                n = parseInt(n);
                                y.push(n);
                            }
                            var mypie = new Pie("PieDiv");
                            mypie.drawPie(y, x);
                            //mypie.clearPie();
                        </script>
                        <tr>
                            <td>School:
                            <td align=center><?php echo $school ?></tr>
                        <tr>
                            <td>Email:
                            <td align=center>***<?php // echo $email?></tr>
                    </table>
                    <!--    <?php
                    /*            if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
                                    */ ?>
                <table border=1>
                    <tr class=toprow>
                        <td>UserID
                        <td>Password
                        <td>IP
                        <td>Time
                    </tr>
                    <tbody>
                    <?php
                    /*                    $cnt = 0;
                                        foreach ($view_userinfo as $row) {
                                            if ($cnt)
                                                echo "<tr class='oddrow'>";
                                            else
                                                echo "<tr class='evenrow'>";
                                            for ($i = 0; $i < count($row) / 2; $i++) {
                                                echo "<td>";
                                                echo "\t" . $row[$i];
                                                echo "</td>";
                                            }
                                            echo "</tr>";
                                            $cnt = 1 - $cnt;
                                        }
                                        */ ?>
                    </tbody>
                </table>
                --><?php
                    /*            }
                                */ ?>
                </center>
            </div>


        </div>

    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>

<script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
<script type="text/javascript">
    $(function () {
        var d1 = [];
        var d2 = [];
        <?php
        foreach($chart_data_all as $k=>$d){
        ?>
        d1.push([<?php echo $k?>, <?php echo $d?>]);
        <?php }?>
        <?php
        foreach($chart_data_ac as $k=>$d){
        ?>
        d2.push([<?php echo $k?>, <?php echo $d?>]);
        <?php }?>
//var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
// a null signifies separate line segments
        var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];
        $.plot($("#submission"), [
            {label: "<?php echo $MSG_SUBMIT?>", data: d1, lines: {show: true}},
            {label: "<?php echo $MSG_AC?>", data: d2, bars: {show: true}}], {
            xaxis: {
                mode: "time"
//, max:(new Date()).getTime()
//,min:(new Date()).getTime()-100*24*3600*1000
            },
            grid: {
                backgroundColor: {colors: ["#fff", "#333"]}
            }
        });
    });
    //alert((new Date()).getTime());
</script>
</body>
</html>
