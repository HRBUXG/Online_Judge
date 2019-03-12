<!DOCTYPE html>
<?php
//ini_set("display_errors", "On"); 
//error_reporting(E_ALL);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">
        function js_method(dump) {
            //alert(dump);
            $.ajax({
                type: 'post',
                url: 'viewadd.php',
                data: {"news_id": dump},
                success: function (data) {

                }
            });
        }
    </script>
    <style type="text/css">
        td {
            align: center;
            vertical-align: middle;
        }

        a:link {
            color: black;
            text-decoration: none;
        }

        a:visited {
            color: black;
            text-decoration: none;
        }

    </style>
    <style type="text/css">

        .chooseblocks {
            display: block;
            width: 30px;
            height: 30px;
            font-size: 20px;
            margin: 0 auto;
            border: solid #D4D4D4 1px;
            color: black;
            text-decoration: none;
        }

        .chooseblocks:hover {

            background-color: aquamarine;
            text-decoration: none;
        }
    </style>
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
    <?php
    $pagelenth = $_GET["pl"];
    if (isset($nid)){
    ?>
    <?php echo($_SESSION['$_GET["nid"]']); ?>
    <div align="left">
        <h4>ACM要闻</h4>
    </div>
    <hr color="black" size="1"
        style="border-style: dotted dotted none; border-bottom: medium 						none;">
    <table width='65%' align="center">

        <td>
            <h3 align="center" style="font-weight: bold">
                <?php echo $result[0]['title']; ?>
            </h3>
        </td>

        </tr>

        <tr>
            <td align="center">
                <small><?php echo $result[0]['time']; ?></small>
            </td>
        </tr>
        <tr>
            <td align="center">
                <small>
                    <?php echo "total views:" . $result[0]['view'] ?>
                </small>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $result[0]['content'];
                $c = ""; ?>
            </td>
        </tr>
        <tr>
            <td align="right">
                <a href="viewnews.php">返回新闻列表&nbsp;&nbsp;</a>
            </td>
        </tr>
        <table>

            <br>
            <br>
            <hr color="black" size="1"
                style="border-style: dotted dotted none; border-bottom: medium 						none;">
            <div>
                <p align="left">更多新闻</p>
                <table width='80%' align="center" style="font-size: 16px;">

                    <?php foreach ($morenews as $row) {
                        if ($_GET["nid"] == $row['news_id']) {
                            $c = $c . "<tr>" .
                                "<td >" . "<p align='left' ;>" . "<a  href='viewnews.php?nid=" . $row['news_id'] . "'>" . $row['title'] . "</a>" . "</p>" . "</td>" .
                                //"<td>"."<small align='left' style='font-weight: bold'>-".$row['user_id']."-</small >"."</td>".
                                //"<td>"."<small align='left' style=''>".$row['time']."</small >"."</td>".
                                //"</tr>";
                                "<td>" . "<p align='left' style='font-weight:normal'>" . $row['time'] . "</p >" . "</td>" .
                                "</tr>";
                        } else {
                            $c = $c . "<tr>" .
                                "<td>" . "<p align='left'>" . "<a id='" . $row['news_id'] . "' onclick='
							 js_method(this.id);' href='viewnews.php?nid=" . $row['news_id'] . "'>" . $row['title'] . "</a>" . "</p>" . "</td>" .
                                //"<td>"."<small align='left' style='font-weight: bold'>-".$row['user_id']."-</small >"."</td>".
                                //"<td>"."<small align='left' style=''>".$row['time']."</small >"."</td>".
                                //"</tr>";
                                "<td>" . "<p align='left' style='font-weight:normal'>" . $row['time'] . "</p >" . "</td>" .
                                "</tr>";
                        }
                    }
                    echo $c; ?>

                    <table>
            </div>
            <?php }

            else {
                if (isset($result)) {
                    $view_news = "";
                    $step = 1;
                    $content = "<h1 align='center'>$MSG_CONTENT</h1>";
                    echo($content);
                    $view_news .= "<table id='viewnews' width='100%' class='table table-striped' border='0' >
                                <thead>
                                       <tr class='toprow'>
                                       <th class='hidden-xs' width='10%'>  </th>
                                       <th class='hidden-xs' width='50%' align='center'> News Title </th>
                                       <th class='hidden-xs' width='20%' align='center'> News Framer </th>
                                       <th class='hidden-xs' width='20%' align='center'> News Upload Time </th> 
                                       </tr>
                                </thead>
                          <tbody>";
                    foreach ($result as $row) {
                        if ($step % 2 == 1) {
                            $view_news .= "<tr class='evenrow'>" .
                                "<td>" . $step . "</td>" .
                                "<td>" . "<a id='" . $row['news_id'] . "' onclick='
							 js_method(this.id);' href='viewnews.php?nid=" . $row['news_id'] . "'>" . $row['title'] . "</a>" . "</td>" .
                                "<td>" . $row['user_id'] . "</td>" .
                                "<td>" . $row['time'] . "</td>" .
                                "</tr>";
                        } else {
                            $view_news .= "<tr class='oddrow'>" .
                                "<td>" . $step . "</td>" .
                                "<td>" . "<a id='" . $row['news_id'] . "' onclick='
							 js_method(this.id);' href='viewnews.php?nid=" . $row['news_id'] . "'>" . $row['title'] . "</a>" . "</td>" .
                                "<td>" . $row['user_id'] . "</td>" .
                                "<td>" . $row['time'] . "</td>" .
                                "</tr>";
                        }
                        $step++;
                    }
                    $view_news .= "</tbody>";
                    $view_news .= "</table>";
                    echo $view_news;
                    $pages = "<div style='text-align:center'>";
                    // $pages=$pages."<br>";
                    $pages = $pages . "转到第" .
                        "<input id='nowpage' type='text' value='1'  style='width:50px;'></input>" . "页" .
                        "<button id='btn_submit' type='submit' onclick=\"
						  if($('#nowpage').val()==0||$('#nowpage').val()>" . $page . ")
						  alert('page input error!!!');
						  else
						  window.location.href='viewnews.php?nowpage='+$('#nowpage').val()+'&pl='+$('#pl').val();\">Go</button>";
                    $pages = $pages . "</div>";
                    echo $pages;
                }
                $selcet = "selected = 'selected'";
                $pages = "<div style='text-align:center'>";
                $pages = $pages . "每页显示" . "<select id='pl'>";
                if (!isset($pagelenth)) {
                    $pages = $pages . "<option value ='10'>10</option>" .
                        "<option value ='20' selected = 'selected'>20</option>" .
                        "<option value ='50'>50</option>" .
                        "<option value ='100'>100</option>";

                } else {
                    //echo ($pagelenth);
                    if ($pagelenth == 10) {
                        $pages = $pages . "<option value ='10' selected = 'selected'>10</option>";
                    } else {
                        $pages = $pages . "<option value ='10' >10</option>";
                    }
                    if ($pagelenth == 20) {
                        $pages = $pages . "<option value ='20' selected = 'selected'>20</option>";
                    } else {
                        $pages = $pages . "<option value ='20' >20</option>";
                    }
                    if ($pagelenth == 50) {
                        $pages = $pages . "<option value ='50' selected = 'selected'>50</option>";
                    } else {
                        $pages = $pages . "<option value ='50' >50</option>";
                    }
                    if ($pagelenth == 100) {
                        $pages = $pages . "<option value ='100' selected = 'selected'>100</option>";
                    } else {
                        $pages = $pages . "<option value ='100' >100</option>";
                    }
                }
                $pages = $pages . "</select>" . "条新闻";
                $pages = $pages . "<button id='btn_submit' type='submit' onclick=\"
			              if($('#nowpage').val()==0||$('#nowpage').val()>" . $page . ")
						  alert('page input error!!!');
						  else
						  window.location.href='viewnews.php?nowpage='+$('#nowpage').val()+'&pl='+$('#pl').val();\">Go</button>";
                $pages = $pages . "</div>";
                echo($pages);
                $pages = "<div style='text-align:center'>" . "总计" . $countnews . "条新闻 共" . $page . "页" . "</div>";
                echo($pages);
            }
            ?>
</div> <!-- /container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>

</body>
</html>
