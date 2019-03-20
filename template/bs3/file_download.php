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
    <?php

    $id = $_GET["file_id"];
    $sql = "select file_download_total from file where file_id=?";
    $data = pdo_query($sql, $id);
    $num = $data[0]['file_download_total'];
    /* echo "<script>alert('$num');</script>";*/
    $num = $num + 1;
    /*echo "<script>alert('$num');</script>";*/
    $sql1 = "update file set file_download_total=? where file_id=?";
    $data2 = pdo_query($sql1, $num, $id);

    ?>

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
        <h2 align="center" style='color:blue'>Download </h2>
        <?php
        session_start();
        $file_source = $_GET["file_source"];
        if ($file_source) {
            $_SESSION["file_source"] = $file_source;
        }
        if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
            $sql =
                "select file_address,file_id,file_name,file_describe,file_framer,file_upload_time,file_source,file_download_total
          from file where file_source=?";
            $res = pdo_query($sql, $_SESSION[file_source]);
        } else {
            $sql =
                "select file_address,file_id,file_name,file_describe,file_framer,file_upload_time,file_source,file_download_total 
		from file where file_source=? and (file_privilege=? or file_privilege=? or file_privilege=?)";
            $res = pdo_query($sql, $_SESSION[file_source], $_SESSION[first_team], $_SESSION[second_team], $_SESSION[new_players]);
        }
        /*
                $rows = mysql_affected_rows($conn);//获取行数
                $colums = mysql_num_fields($res);//获取列数*/
        //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";  
        // echo "共计".$rows."行 ".$colums."列<br/>";

        ?>
        <button id="back" onClick="back()">Back</button>
        <table id='file_upload' width='100%' class='table table-striped'>
            <thead>
            <tr class='toprow'>

                <th class='hidden-xs' width='5%'>
                    <?php echo $MSG_FILE_ID ?>
                </th>
                <th class='hidden-xs' width='15%'>
                    <?php echo $MSG_FILE_NAME ?>
                </th>
                <th class='hidden-xs' width='20%'>
                    <?php echo $MSG_FILE_DESCRRIBE ?>
                </th>
                <th class='hidden-xs' width='10%'>
                    <?php echo $MSG_FILE_FRAMER ?>
                </th>
                <th class='hidden-xs' width='15%'>
                    <?php echo $MSG_FILE_UPLOAD_TIME ?>
                </th>
                <th class='hidden-xs' style="cursor:hand" width='15%'>
                    <?php echo $MSG_FILE_SOURCE ?>
                </th>
                <th class='hidden-xs' style="cursor:hand" width='10%'>
                    <?php echo $MSG_FILE_DOWNLOAD_TOTAL ?>
                </th>
                <th class='hidden-xs' style="cursor:hand" width='10%'>
                    <?php echo "下载"; ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($res as $row) {
                $t = 0;
                echo "<tr>";
                echo "<td class='hidden-xs'>" . $row['file_id'] . "</td>";
                echo "<td class='hidden-xs'>" . $row['file_name'] . "</td>";
                echo "<td class='hidden-xs'>" . $row['file_describe'] . "</td>";
                echo "<td class='hidden-xs'>" . $row['file_framer'] . "</td>";
                echo "<td class='hidden-xs'>" . $row['file_upload_time'] . "</td>";
                echo "<td class='hidden-xs'>" . $row['file_source'] . "</td>";
                echo "<td class='hidden-xs'>" . $row['file_download_total'] . "</td>";

                ?>
                <td class='hidden-xs'>
                    <button class="down"
                            style='width:80px;height:30px;border-radius:5px;border:none;background:#00ffff;color:white;font-size:18px;font-weight:bold'>
                        <a style='text-decoration:none;color:white' href="<?php echo($row[0]) ?>">下 载</a>
                    </button>
                </td>
                <?php
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>


    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
<script>
    function back() {
        window.location.href = 'filedownload_source.php';
    }

    $(function () {
        //$('table tr:not(:first)').remove();
        var len = $('table tr').length;
        for (var i = 1; i < len; i++) {
            $('table tr:eq(' + i + ') td:first').text(i);
        }
    });
    $('.down').click(function () {
        var tr = $(this).closest("tr");
        var file_id = tr.find("td:eq(0)").text();
        //alert(file_id);
        //window.location.href="filedown.php?file_id="+file_id;
        $.ajax
        ({
            type: 'GET',
            url: "filedown.php",
            data: {fid: file_id},

        });
    });
</script>
<script src="../../highlight/page/paging.js"></script>
</body>
</html>
