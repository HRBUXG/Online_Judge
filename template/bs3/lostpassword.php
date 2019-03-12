<!DoCTYPE html>
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
        <form action=lostpassword.php method=post>
            <center>
                <table width=400 algin=center style="margin-top:10px">
                    <tr style="margin-top:20px">
                        <td width=100 align="right"
                            style="font-size:18px;font-family:Times New Roman;padding-right:30px;"><?php echo $MSG_USER_ID ?>
                            :
                        <td width=250><input name="user_id" type="text" size=40
                                             style="border-radius:5px;border:1px solid gray">
                    </tr>
                    <tr style="margin-top:20px">
                        <td width=100 align="right"
                            style="font-size:18px;font-family:Times New Roman;padding-right:30px;padding-top:20px"><?php echo $MSG_EMAIL ?>
                            :
                        <td><input name="email" type="text" size=40
                                   style="border-radius:5px;border:1px solid gray;margin-top:20px">
                    </tr>
                    <tr style="margin-top:20px">
                        <td width=200 align="right"
                            style="font-size:18px;font-family:Times New Roman;padding-right:30px;padding-top:20px"><?php echo $MSG_VCODE ?>
                            :
                        </td>
                        <td><input name="vcode" size=10 type=text
                                   style="border-radius:5px;border:1px solid gray;margin-top:20px"><img
                                    alt="click to change" style="padding-left:5px" src=vcode.php
                                    onclick="this.src='vcode.php#'+Math.random()">*
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <td><input name="submit" type="submit" size=10 value="Submit" class="btn btn-info"
                                   style="margin-top:10px;margin-left:200px">
                    </tr>
                </table>
                <center>
        </form>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
</body>
</html>

