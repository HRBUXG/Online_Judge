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
    $conn = mysql_connect("localhost", "root", "HRBUXGOJ");
    if (!$conn) {
        echo "连接失败";
    }
    mysql_select_db("jol", $conn);
    mysql_query("set names utf8");
    ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <script src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script>-->
</head>

<body>
<!--//******************************************加style*******************************************************-->
<div class="container" style="width:100%">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <!--分页div-->
        <h2 align="center" style="color:blue;font-weight:bold">Video Study</h2>
        <div style="width:1000px; position:relative">
            <div class="box" id="box"></div>
        </div>
        <?php
        session_start();
        $video_source = $_GET["video_source"];
        if ($video_source) {
            $_SESSION["video_source"] = $video_source;
        }
        $sql_source = "select count(*) from video 
		 where video_source='$_SESSION[video_source]' 
		 and (video_privilege='$_SESSION[first_team]' or video_privilege='$_SESSION[second_team]' or
		 video_privilege='$_SESSION[new_players]')";
        //$sql_source="select count(*) from video";

        $count = mysql_query($sql_source, $conn);
        $count = mysql_result($count, 0);
        $page_a = $_GET["page"];

        //echo "page_a:".$page_a;
        $page_row = 10;//每页想显示多少数据
        if ($_GET["page"]) {
            $begin_page = ($page_a - 1) * $page_row;
        } else {
            $page_a = 1;
            $begin_page = 0;
        }
        //判断总页数。
        if ($count % $page_row == 0) {
            $total_page = $count / $page_row;
        } else {
            $total_page = floor($count / $page_row) + 1;
        }

        if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
            $sql = "select video_id,video_name,video_describe,video_source,video_framer,video_upload_time,video_total
                from video where video_source='$_SESSION[video_source]' limit $begin_page,$page_row ";
        } else {

            $sql = "select video_id,video_name,video_describe,video_source,video_framer,video_upload_time,video_total 
		from video 
		where video_source='$_SESSION[video_source]' and
		(video_privilege='$_SESSION[first_team]' or video_privilege='$_SESSION[second_team]' or
		 video_privilege='$_SESSION[new_players]')
		limit $begin_page,$page_row ";
        }
        $res = mysql_query($sql, $conn);
        $rows = mysql_affected_rows($conn);//获取行数
        $colums = mysql_num_fields($res);//获取列数
        //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";  
        // echo "共计".$rows."行 ".$colums."列<br/>";

        ?>
        <br>
        <br>
        <button id="back" onClick="back()">Back</button>
        <table id='videostudy' width='100%' class='table table-striped' border="0">
            <thead>
            <tr class='toprow'>
                <th class='hidden-xs' width='5%'> <?php echo $MSG_VIDEO_ID ?> </th>
                <th style='cursor:hand' class='hidden-xs' width='19%'
                    align="center"> <?php echo $MSG_VIDEO_NAME ?> </th>
                <th class='hidden-xs' width='20%' align="center"> <?php echo $MGE_VIDEO_DESCRRIBE ?> </th>
                <th class='hidden-xs' style="cursor:hand" width='20%'
                    align="center"> <?php echo $MSG_VIDEO_SOURCE ?> </th>
                <th class='hidden-xs' width='8%' align="center"> <?php echo $MSG_VIDEO_FRAMER ?> </th>
                <th class='hidden-xs' width='8%' align="center"> <?php echo $MSG_VIDEO_UPLOAD_TIME ?> </th>
                <th class='hidden-xs' style="cursor:hand" width='10%'> <?php echo $MSG_VIDEOTOTAL ?> </th>
                <th class='hidden-xs' style="cursor:hand" width='10%' align="center"> <?php echo "播放"; ?> </th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysql_fetch_row($res)) {

                echo "<tr>";
                echo "<td></td>";
//********************************************修改开始******************************************************** 
                echo "<td style='display:none'>$row[0]</td>";
//********************************************修改结束********************************************************							
                echo "<td class='Select' >$row[1]</td>";
                for ($i = 2; $i < $colums - 1; $i++) {
                    echo "<td class='hidden-xs' >$row[$i]</td>";

                }
                echo "<td class='hidden-xs' align='center'>$row[6]</td>";
                ?>
                <td class='hidden-xs' align="center"><input class="Select" type="button"
                                                            style='width:80px;height:30px;margin-right:10px;border-radius:5px;border:none;background:#00ffff;color:white;font-weight:bold;font-size:18px'
                                                            value="播 放"></td>
                <?php
                echo "</tr>";
            }

            ?>
            </tbody>
        </table>
        <!--<div style="width:1000" >
              <div class="box" id="box" ></div>
            </div>
        -->
    </div>

</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
<script>
    function back() {
        window.location.href = 'videostudy_source.php';
    }

    //********************************************修改开始********************************************************
    $(function () {
        //$('table tr:not(:first)').remove();
        var len = $('table tr').length;
        for (var i = 1; i < len; i++) {
            $('table tr:eq(' + i + ') td:first').text(i);
        }
    });
    //********************************************修改结束********************************************************
    $('.Select').click(function () {
        var tr = $(this).closest("tr");
//********************************************td:eq(0)改成1********************************************************
        var video_id = tr.find("td:eq(1)").text();
//********************************************td:eq(1)改成2********************************************************
        var video_name = tr.find("td:eq(2)").text();
        //alert(video_name);
        window.location.href = 'videoplay.php?video_id=' + video_id + '&video_name=' + video_name;
    });

</script>
<!--<script src="../../highlight/page/jquery-1.11.1.min.js"></script>-->
<script src="../../highlight/page/paging.js"></script>
<script>
    var setTotalCount = <?php echo $count ?>;
    $('#box').paging({
        initPageNo: <?php echo $page_a ?>, // 初始页码
        totalPages: <?php echo $total_page ?>, //总页数
        totalCount: '合计' + setTotalCount + '条数据', // 条目总数
        slideSpeed: 1000, // 缓动速度。单位毫秒
        jump: true, //是否支持跳转
        callback: function (page) { // 回调函数
            console.log(page);
            //alert(page);
        }

    });

</script>
</body>
</html>
