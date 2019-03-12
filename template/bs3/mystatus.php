<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="180">
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
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div id=center>
            <table id=result-tab class="table table-striped content-box-header" align=center width=1000px>
                <thead>
                <tr class='toprow'>
                    <th style='text-align:center'><?php echo $MSG_RUNID ?>
                    <th style='text-align:center'><?php echo $MSG_USER ?>
                    <th style='text-align:center'><?php echo $MSG_PROBLEM ?>
                    <th style='text-align:center'><?php echo $MSG_RESULT ?>
                    <th class='hidden-xs' style='text-align:center'><?php echo $MSG_MEMORY ?>
                    <th class='hidden-xs' style='text-align:center'><?php echo $MSG_TIME ?>
                    <th class='hidden-xs' style='text-align:center'><?php echo $MSG_LANG ?>
                    <th class='hidden-xs' style='text-align:center'><?php echo $MSG_CODE_LENGTH ?>
                    <th style='text-align:center'><?php echo $MSG_SUBMIT_TIME ?>
                    <th class='hidden-xs' style='text-align:center'><?php echo $MSG_JUDGER ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $cnt = 0;
                foreach ($view_mystatus as $row) {
                    if ($cnt)
                        echo "<tr class='oddrow' align='center'>";
                    else
                        echo "<tr class='evenrow' align='center'>";
                    $i = 0;
                    foreach ($row as $table_cell) {
                        if ($i > 3 && $i != 8)
                            echo "<td class='hidden-xs'>";
                        else
                            echo "<td>";
                        echo $table_cell;
                        echo "</td>";
                        $i++;
                    }
                    echo "</tr>\n";
                    $cnt = 1 - $cnt;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>var i = 0;
    var judge_result = [<?php
        foreach ($judge_result as $result) {
            echo "'$result',";
        }
        ?>''];

    var judge_color = [<?php
        foreach ($judge_color as $result) {
            echo "'$result',";
        }
        ?>''];
</script>
<script src="template/<?php echo $OJ_TEMPLATE ?>/auto_refresh.js?v=0.30"></script>
</body>
</html>
