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
    <style type="text/css">
        .hide {
            display: none;
        }

        .c1 {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 2;
        }

        .c2 {
            background-color: #FFF;
            border-radius: 10px 10px 10px 10px;
            position: fixed;
            width: 600px;
            height: 710px;
            top: 50%;
            left: 50%;
            z-index: 3;
            margin-top: -350px;
            margin-left: -290px;
        }

        #modal p {
            margin-left: 80px;
        }

        * {
            margin: 0px;
            padding: 0px;
        }

        .x {
            margin: 10px;
            width: 20px;
            height: 5px;
            background: #000;
            transform: rotate(45deg);
        }

        .x:hover {
            transform: scale(1.2);

        }

        .x:after {
            content: '';
            display: block;
            width: 20px;
            height: 5px;
            background: #000;
            transform: rotate(-90deg);
        }

        option {
            text-align: center;
        }

        select {
            width: auto;
            padding: 0 6%;
            margin: 0;
        }
    </style>

</head>

<body>
<?php include("template/$OJ_TEMPLATE/main.php"); ?>
<?php //include("template/$OJ_TEMPLATE/nav.php");?>
<a href="#" onclick="Show();" id="go"></a>

<!-- Main component for a primary marketing message or call to action -->
<div id="shade" class="c1 hide"></div>
<div id="modal" class="c2 hide" style="background-image: url(../../ico/background.jpg);background-size:100% 100%">

    <div id="x" class="x" style="float:right;cursor:pointer" onClick="Hide();"></div>
    <form action="register.php" method="post">
        <center>
            <table>
                <br/>
                <br/>
                <tr style="padding-top:50px;padding-left:30px">
                    <td colspan=2 height=10 width=500 align="center">&nbsp;&nbsp;&nbsp;<strong
                                style="color:white;font-size:30px;padding-left:20px;font-family:Times New Roman;"><?php echo $MSG_REG_INFO ?></strong>
                    </td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_USER_ID ?>
                        &nbsp;*:
                    </td>
                    <td width=75%><input name="user_id" size=20 type=text style="margin-top:20px"
                                         placeholder="*Please input your studentID"></td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_NICK ?>
                        &nbsp;*:
                    </td>
                    <td width=75%><input name="nick" size=50 type=text style="margin-top:20px"
                                         placeholder="*Please input your real name"></td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_PASSWORD ?>
                        &nbsp;*:
                    </td>
                    <td><input name="password" size=20 type=password style="margin-top:20px"
                               placeholder="*Please input your password"></td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_REPEAT_PASSWORD ?>
                        &nbsp;*:
                    </td>
                    <td><input name="rptpassword" size=20 type=password style="margin-top:20px"
                               placeholder="*Please confirm your password"></td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_SCHOOL ?>
                        &nbsp;:
                    </td>
                    <td><input name="school" size=30 type=text style="margin-top:20px"></td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_EMAIL ?>
                        &nbsp;*:
                    </td>
                    <td><input name="email" size=30 type=text style="margin-top:20px"></td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_GRADE ?>
                        *:
                    </td>
                    <td>
                        <select name="grade" style="width:110px;margin-top:20px">
                            <option value="2014">14级</option>
                            <option value="2015">15级</option>
                            <option value="2016">16级</option>
                            <option value="2017">17级</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_CLASS ?>
                        &nbsp;*:
                    </td>
                    <td>
                        <select name="class" style="width:110px;margin-top:20px">
                            <option value="1">1班</option>
                            <option value="2">2班</option>
                            <option value="3">3班</option>
                            <option value="4">4班</option>
                            <option value="5">5班</option>
                            <option value="6">6班</option>
                            <option value="7">7班</option>
                            <option value="8">8班</option>
                            <option value="9">9班</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" width=25%
                        style="font-size:16px;font-family:Times New Roman;color:white;padding-right:20px;padding-top:20px"><?php echo $MSG_PHONENUMBER ?>
                        :
                    </td>
                    <td><input name="phonenumber" size=30 type=text style="margin-top:20px">
                    </td>
                </tr>
                <?php if ($OJ_VCODE) { ?>
                    <tr>
                        <td><?php echo $MSG_VCODE ?>:</td>
                        <td><input name="vcode" size=4 type=text><img alt="click to change" src="vcode.php"
                                                                      onclick="this.src='vcode.php?'+Math.random()">*
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td><input value="Submit" name="submit" type="submit"
                               style="width:30%;margin-top:50px;margin-left:40px" class="btn btn-info"><input
                                value="Reset" name="reset" type="reset"
                                style="width:30%;margin-top:-35px;margin-left:220px"></td>
                </tr>
            </table>
        </center>
        <br><br>
    </form>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php //include("template/$OJ_TEMPLATE/js.php");?>
<script>

    function Show() {
        document.getElementById('shade').classList.remove('hide');
        document.getElementById('modal').classList.remove('hide');
    }

    function Hide() {
        document.getElementById('shade').classList.add('hide');
        document.getElementById('modal').classList.add('hide');
    }

    $(document).ready(function () {

        $("#go").trigger("click");
    });
    $("input").attr("class", "form-control");
</script>
</body>
</html>

