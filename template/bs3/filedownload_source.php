<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../highlight/page/paging.css">
    <title><?php echo $OJ_NAME ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <script src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script>-->
</head>

<body>
<div class="container" style="width:100%">

    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h2 align="center" style="color:#666"><strong><?php echo $$MSG_FILE_CLASSIFY; ?></strong></h2>
        <div id="all_File_list">
            <?php
            $sql = "select file_id,file_source,file_framer,sum(file_download_total) from file
		        group by file_source";
            $res = pdo_query($sql);
            /*$rows = mysql_affected_rows($conn);//获取行数
            $colums = mysql_num_fields($res);//获取列数*/
            //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";
            // echo "共计".$rows."行 ".$colums."列<br/>";

            ?>

            <br>
            <table id='filesource' width='100%' class='table table-striped' border="0" cellspacing="0" cellpadding="0">
                <thead border="0" cellspacing="0" cellpadding="0">
                <tr class='toprow' border="0" cellspacing="0" cellpadding="0">
                    <th class='hidden-xs' width='10%'> <?php echo $MSG_FILE_ID ?> </th>
                    <th class='hidden-xs' style="cursor:hand" width='50%'
                        align="center"> <?php echo $MSG_FILE_SOURCE ?> </th>
                    <th class='hidden-xs' width='20%' align="center"> <?php echo $MSG_FILE_FRAMER ?> </th>
                    <th class='hidden-xs' style="cursor:hand" width='20%'> <?php echo $MSG_FILE_DOWNLOAD_TOTAL ?> </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($res as $row) {
                    echo "<tr>";
                    //echo "<td></td>";
                    echo "<td class='hidden-xs' align='right'>" . $row['file_id'] . "</td>";
                    echo "<td class='Select' style='cursor:pointer'>" . $row['file_source'] . "</td>";
                    echo "<td class='hidden-xs' align='right'>" . $row['file_framer'] . "</td>";
                    echo "<td class='hidden-xs' align='right'>$row[3]</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
<script>
    $(function () {
        //$('table tr:not(:first)').remove();
        var len = $('table tr').length;
        for (var i = 0; i < len; i++) {
            $('table tr:eq(' + i + ') td:first').text(i);
        }
    });
    $('.Select').click(function () {
        var tr = $(this).closest("tr");
        var file_source = tr.find("td:eq(1)").text();
        //alert(file_source);
        window.location.href = 'file_download.php?file_source=' + file_source;
    });


</script>
</body>
</html>
