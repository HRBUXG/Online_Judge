<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <title><?php echo $OJ_NAME ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .colockbox {
            width: 283px;
            height: 76px;
            margin-left: 50px;
            margin-top: 15px;
            text-align: center;
            background: url(image/colockbg.png) no-repeat;
        }

        .colockbox span {
            float: left;
            display: block;
            width: 58px;
            height: 48px;
            line-height: 48px;
            font-size: 26px;
            text-align: center;
            color: #ffffff;
            margin: 0 17px 0 0;
        }

        .colockbox span.second {
            margin: 0;
        }
    </style>
</head>

<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron" style="width: 100%;height:auto;overflow:hidden;">
        <div style="width: 70%;height:auto;float: right;overflow:hidden;float: left">
            <h3 style="text-align: center"><?php echo $view_title ?></h3>
            <p><?php echo $view_description ?></p>
            <table id='problemset' class='table table-striped' width='100%'>
                <thead>
                <tr align=center class='toprow'>
                    <td width='10%' style='text-align:center'>
                    <td width='5%' style="cursor:hand;text-align:center"
                        onclick="sortTable('problemset', 1, 'int');"><?php echo $MSG_PROBLEM_ID ?>
                    <td width='50%' style='text-align:center'><?php echo $MSG_TITLE ?></td>
                    <!--<td width='10%'><?php echo $MSG_SOURCE ?></td>-->
                    <td style="cursor:hand;text-align:center" onclick="sortTable('problemset', 4, 'int');"
                        width='10%'><?php echo $MSG_AC ?></td>
                    <td style="cursor:hand;text-align:center" onclick="sortTable('problemset', 5, 'int');"
                        width='10%'><?php echo $MSG_SUBMIT ?></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $cnt = 0;
                foreach ($view_problemset as $row) {
                    if ($cnt)
                        echo "<tr class='oddrow' style='text-align:center'>";
                    else
                        echo "<tr class='evenrow' style='text-align:center'>";
                    foreach ($row as $table_cell) {
                        echo "<td>";
                        echo "\t" . $table_cell;
                        echo "</td>";
                    }
                    echo "</tr>";
                    $cnt = 1 - $cnt;
                }
                ?>
                </tbody>
            </table>
        </div>
        <div style="width: 29%;height:auto;overflow:hidden;border:1px solid #e9e4e8;border-radius:4px;float: right">
            <div class="colockbox" id="demo01" style="width: 100%;">
                <span class="day">-</span>
                <span class="hour">-</span>
                <span class="minute">-</span>
                <span class="second">-</span>
            </div>
            <table width="100%" style="font-size: 16px">
                <tr id="beginTime">
                    <td width="30%" align="right"
                        style="padding-right: 5px;padding-top: 15px"><?php echo "Begin Time: " ?></td>
                    <td width="70%" align="left"
                        style="padding-left: 5px;padding-top: 15px;color: #993399"><?php echo $view_start_time ?></td>
                </tr>
                <tr id="endTime">
                    <td width="30%" align="right"
                        style="padding-right: 5px;padding-top: 15px"><?php echo "End Time: " ?></td>
                    <td width="70%" align="left"
                        style="padding-left: 5px;padding-top: 15px;color: #993399"><?php echo $view_end_time ?></td>
                </tr>
                <tr id="endTime">
                    <td width="30%" align="right"
                        style="padding-right: 5px;padding-top: 15px"><?php echo "Current Time: " ?></td>
                    <td width="70%" align="left"
                        style="padding-left: 5px;padding-top: 15px;color: #993399"><span
                                id=nowdate> <?php echo date("Y-m-d H:i:s") ?></span></td>
                </tr>
                <tr>
                    <td width="30%" align="right"
                        style="padding-right: 5px;padding-top: 15px"><?php echo "Status: " ?></td>
                    <td width="70%" align="left"
                        style="padding-left: 5px;padding-top: 15px;color: #993399">
                        <?php
                        if ($now > $end_time)
                            echo "<span class=red>Ended</span>";
                        else if ($now < $start_time)
                            echo "<span class=red>Not Started</span>";
                        else
                            echo "<span class=red>Running</span>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"
                        style="padding-right: 5px;padding-top: 15px"><?php echo "Privilege: " ?></td>
                    <td width="70%" align="left"
                        style="padding-left: 5px;padding-top: 15px;color: #993399">
                        <?php
                        if ($view_private == '0')
                            echo "<span style='color: blue'>Public</font>";
                        else
                            echo "&nbsp;&nbsp;<span style='color: red'>Private</font>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"
                        style="padding-right: 5px;padding-top: 15px"><?php echo "People: " ?></td>
                    <td width="70%" align="left"
                        style="padding-left: 5px;padding-top: 15px;color: black">
                        <?php echo "x ".$contest_people_count ?></td>
            </table>
            <div style="width: 100%;padding-top: 15px;padding-left: 25px;padding-bottom: 20px">
                <button class="btn btn-info">
                    <a style="text-decoration-line: none" href='status.php?cid=<?php echo $view_cid ?>'><i
                                class="fa fa-pie-chart"
                                style="color:white"></i><span
                                style='color:white;padding-left: 8px'>Status</span></a>
                </button>
                <butto class="btn btn-warning" style="margin-left: 10px">
                    <a style="text-decoration-line: none" href='contestrank.php?cid=<?php echo $view_cid ?>'><i
                                class="fa fa-bar-chart-o"
                                style="color:white"></i><span
                                style='color:white;padding-left: 8px'>Standing</span></a>
                </butto>
                <butto class="btn btn-primary" style="margin-left: 10px">
                    <a style="text-decoration-line: none" href='conteststatistics.php?cid=<?php echo $view_cid ?>'><i
                                class="fa fa-area-chart"
                                style="color:white"></i><span
                                style='color:white;padding-left: 8px'>Statistics</a>
                </butto>
            </div>
        </div>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script src="include/sortTable.js"></script>
<script>
    var diff = new Date("<?php echo date("Y/m/d H:i:s")?>").getTime() - new Date().getTime();

    //alert(diff);
    function clock() {
        var x, h, m, s, n, xingqi, y, mon, d;
        var x = new Date(new Date().getTime() + diff);
        y = x.getYear() + 1900;
        if (y > 3000) y -= 1900;
        mon = x.getMonth() + 1;
        d = x.getDate();
        xingqi = x.getDay();
        h = x.getHours();
        m = x.getMinutes();
        s = x.getSeconds();
        n = y + "-" + (mon >= 10 ? mon : "0" + mon) + "-" + (d >= 10 ? d : "0" + d) + " " + (h >= 10 ? h : "0" + h) + ":" + (m >= 10 ? m : "0" + m) + ":" + (s >= 10 ? s : "0" + s);
//alert(n);
        document.getElementById('nowdate').innerHTML = n;
        setTimeout("clock()", 1000);
    }

    clock();
    $(function () {
        var endTime="<?php echo $view_end_time?>";
        console.log(endTime);
        countDown(endTime, "#demo01 .day", "#demo01 .hour", "#demo01 .minute", "#demo01 .second");
    });

    function countDown(time, day_elem, hour_elem, minute_elem, second_elem) {
        //if(typeof end_time == "string")
        var end_time = new Date(time).getTime(),//月份是实际月份-1
            //current_time = new Date().getTime(),
            sys_second = (end_time - new Date().getTime()) / 1000;
        var timer = setInterval(function () {
            if (sys_second > 0) {
                sys_second -= 1;
                var day = Math.floor((sys_second / 3600) / 24);
                var hour = Math.floor((sys_second / 3600) % 24);
                var minute = Math.floor((sys_second / 60) % 60);
                var second = Math.floor(sys_second % 60);
                day_elem && $(day_elem).text(day);//计算天
                $(hour_elem).text(hour < 10 ? "0" + hour : hour);//计算小时
                $(minute_elem).text(minute < 10 ? "0" + minute : minute);//计算分
                $(second_elem).text(second < 10 ? "0" + second : second);// 计算秒

            } else {
                clearInterval(timer);
            }
        }, 1000);

    }

</script>
</body>
</html>
