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
        <table align=center width=90%>
            <thead>
            <tr>
                <td colspan=3 align=left>
                    <form class="form-inline" action="ranklist.php">
                        <?php echo $MSG_USER ?><input class="form-control" name="prefix"
                                                      value="<?php echo htmlentities($_GET['prefix'], ENT_QUOTES, "utf-8") ?>">
                        <input type=submit class="form-control" value=Search>
                        <!--
                        <input type=button class="form-control" style="margin-left:100px" value=2016>
                        <input type=button class="form-control" style="margin-left:30px" value=2017>
                        -->
                    </form>
                </td>
                <td colspan=3 align=left>
                    <form class="form-inline" action="ranklist.php">
                        <select id="grade" name="grade" style="border-radius:3px;font-size:15px" width='60px'
                                height='30px'>
                            <option value="">年级</option>
                            <option value="14">14级</option>
                            <option value="15">15级</option>
                            <option value="16">16级</option>
                            <option value="17">17级</option>
                            <option value="18">18级</option>
                        </select>
                        <select id="class" name="class" style="border-radius:3px;font-size:15px" width="50px"
                                height="30px">
                            <option value="">班级</option>
                        </select>
                        <input type=submit class="" value=Search
                               style="background:white;border:1px solid gray;border-radius:3px;font-size:15px;width:80px;height:30px">
                    </form>
                </td>
                <td colspan=3 align=right>
                    <a href=ranklist.php?scope=d>Day</a>
                    <a href=ranklist.php?scope=w>Week</a>
                    <a href=ranklist.php?scope=m>Month</a>
                    <a href=ranklist.php?scope=y>Year</a>
                </td>
            </tr>
            </thead>
        </table>
        <!--将表头独立上的搜索部分独立成一个table 结束-->


        <!--			给表格加上id  为  rank-->
        <table align=center width=90% id='rank'>
            <!--			给表格加上id  为  rank-->
            <thead>
            <tr class='toprow'>
                <th width=10% align=center style='text-align:center'><b><?php echo $MSG_Number ?></b></th>
                <th width=15% align=center style='text-align:center'><b><?php echo $MSG_USER ?></b></th>
                <th width=15% style='text-align:center'><b><?php echo $MSG_NICK ?></b></th>
                <!--	在NICK后面新加积分表头-->
                <th width=12.5% align=center style='text-align:center'><b><?php echo $MSG_SCORE ?></b></th>
                <!--	在NICK后面新加积分表头-->
                <th width=10% align=center style='text-align:center'><b><?php echo $MSG_AC ?></b></th>
                <th width=12.5% align=center style='text-align:center'><b><?php echo $MSG_SUBMIT ?></b></th>
                <th width=12.5% align=center style='text-align:center'><b><?php echo $MSG_OTHEROJAC ?></b></th>
                <th width=12.5% align=center style='text-align:center'><b><?php echo $MSG_RATIO ?></b></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $cnt = 0;
            foreach ($view_rank as $row) {
                if ($cnt)
                    echo "<tr class='oddrow' align='center'>";
                else
                    echo "<tr class='evenrow' align='center'>";
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
        <?php
        echo "<center>";
        $qs = "";
        if (isset($_GET['prefix'])) {
            $qs .= "&prefix=" . htmlentities($_GET['prefix'], ENT_QUOTES, "utf-8");
        }
        if (isset($scope)) {
            $qs .= "&scope=" . htmlentities($scope, ENT_QUOTES, "utf-8");
        }
        for ($i = 0; $i < $view_total; $i += $page_size) {
            echo "<a href='./ranklist.php?start=" . strval($i) . $qs . "'>";
            echo strval($i + 1);
            echo "-";
            echo strval($i + $page_size);
            echo "</a>&nbsp;";
            if ($i % 250 == 200)
                echo "<br>";
        }
        echo "</center>";
        ?>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<!--	添加js脚本实现积分排序效果-->

<script type="text/javascript" src="include/jquery.tablesorter.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#rank").tablesorter();
    });

    var select = document.getElementById("grade");
    select.onchange = function () {
        var selvalue = select.value;
        var val = document.getElementById("class");
        switch (selvalue) {
            case "14":
                val.innerHTML = "<option value=''>班级</option><option value ='41'>软件1班</option><option value ='42'>软件2班</option><option value ='43'>软件3班</option><option value ='44'>软件4班</option><option value ='45'>软件5班</option><option value ='46'>软件6班</option><option value ='47'>软件7班</option><option value ='48'>软件8班</option><option value ='49'>软件9班</option>";
                break;
            case "15":
                val.innerHTML = "<option value=''>班级</option><option value ='41'>软件1班</option><option value ='42'>软件2班</option><option value ='43'>软件3班</option><option value ='44'>软件4班</option><option value ='45'>软件5班</option><option value ='46'>软件6班</option><option value ='47'>软件7班</option><option value ='48'>软件8班</option><option value ='49'>软件9班</option>";
                break;
            case "16":
                val.innerHTML = "<option value=''>班级</option><option value ='41'>软件1班</option><option value ='42'>软件2班</option><option value ='43'>软件3班</option><option value ='44'>软件4班</option><option value ='45'>软件5班</option><option value ='46'>软件6班</option><option value ='47'>软件7班</option><option value ='48'>软件8班</option><option value ='49'>软件9班</option><option value ='21'>计算机1班</option><option value ='22'>计算机2班</option>";
                break;
            case "17":
                val.innerHTML = "<option value=''>班级</option><option value ='41'>软件1班</option><option value ='42'>软件2班</option><option value ='43'>软件3班</option><option value ='44'>软件4班</option><option value ='45'>软件5班</option><option value ='46'>软件6班</option><option value ='47'>软件7班</option><option value ='48'>软件8班</option><option value ='49'>软件9班</option><option value ='21'>计算机1班</option><option value ='22'>计算机2班</option>";
                break;
            case "18":
                val.innerHTML = "<option value=''>班级</option><option value ='41'>软件1班</option><option value ='42'>软件2班</option><option value ='43'>软件3班</option><option value ='44'>软件4班</option><option value ='45'>软件5班</option><option value ='46'>软件6班</option><option value ='47'>软件7班</option><option value ='21'>计算机1班</option><option value ='22'>计算机2班</option><option value ='23'>计算机3班</option><option value ='24'>计算机4班</option>";
                break;
        }
    }
</script>

<!--	添加js脚本实现积分排序效果-->
</body>
</html>


