<!DOCTYPE html>
<?php //ini_set("display_errors", "On");
//error_reporting(E_ALL);?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <?php $conment = "<script src='tempate/$OJ_TEMPLATE/bootstrap.min.js'></script>";
    echo $conment;
    ?>
    <style type="text/css">
        p {
            font-size: 14px
        }

        a {
            text-decoration: none;
            color: black
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
    <div>
        <?php
        include("admin/kindeditor.php");
        ?>
        <form method=POST action=createxml.php?parm=s>


            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c0">
                            <h4 class="panel-title">
                                <?php echo $MSG_PROBLEMINFO ?>:
                            </h4>
                        </a>
                    </div>
                    <div id="c0" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_TITLE ?>:
                                <input class="input input-xxlarge" type=text name=title size=50>
                                <?php echo $MSG_Time_Limit ?>:
                                <select name="time_limit">
                                    <option value="1" selected="selected">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>S
                                <?php echo $MSG_Memory_Limit ?>:
                                <select name="memory_limit">
                                    <option value="32">32</option>
                                    <option value="64">64</option>
                                    <option value="128" selected="selected">128</option>
                                    <option value="256">256</option>
                                    <option value="512">512</option>
                                </select>MByte
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c1">
                            <h4 class="panel-title">
                                <?php echo $MSG_Description ?>:
                            </h4>
                        </a>
                    </div>
                    <div id="c1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_Description ?>:
                                <textarea class="kindeditor" rows=13 name=description cols=40
                                          style="width:700px;height:300px;"></textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c2">
                            <h4 class="panel-title">
                                <?php echo $MSG_Input ?>:
                            </h4>
                        </a>
                    </div>
                    <div id="c2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_Input ?>:
                                <textarea class="kindeditor" rows=13 name=input cols=80
                                          style="width:700px;height:300px;"></textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c3">
                            <h4 class="panel-title">
                                <?php echo $MSG_Output ?>:
                            </h4>
                        </a>
                    </div>
                    <div id="c3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_Output ?>:
                                <textarea class="kindeditor" rows=13 name=output cols=80
                                          style="width:700px;height:300px;"></textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c4">
                            <h4 class="panel-title">
                                样例输入输出:
                            </h4>
                        </a>
                    </div>
                    <div id="c4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_Sample_Input ?>
                                <textarea class="input input-large" rows=13 name=sample_input cols=40></textarea>
                                <?php echo $MSG_Sample_Output ?>
                                <textarea class="input input-large" rows=13 name=sample_output cols=40></textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c5">
                            <h4 class="panel-title">
                                <?php echo $MSG_HINT ?>:<br>
                            </h4>
                        </a>
                    </div>
                    <div id="c5" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_HINT ?>:
                                <textarea class="kindeditor" style="width:700px;height:300px;" rows=13 name=hint
                                          cols=80></textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#c6">
                            <h4 class="panel-title">
                                <?php echo $MSG_Source ?>:
                            </h4>
                        </a>
                    </div>
                    <div id="c6" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p align=center>
                                <?php echo $MSG_Source ?>:
                                <textarea name=source rows=1 style="width:700px;height:300px;" cols=70></textarea>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div align=center>
                <?php require_once("include/set_post_key.php"); ?>
                <input type=submit value=Submit name=submit>
            </div>
        </form>
    </div>
</div> <!-- /container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
</body>
</html>
