<!DOCTYPE html>
<?php
//ini_set("display_errors", "On");
//error_reporting(E_ALL);
$platnames = array();
$platnames[1] = "牛客网";
$platnames[2] = "计蒜客";
$platnames[3] = "哈理工";
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
    <title><?php echo $OJ_NAME ?></title>
    <style type="text/css">
        td {
            align: center;
            text-align: center;
            vertical-align: middle;
            border: 3px;
            border-style: solid;
        }
    </style>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");
    $p = $_GET["p"]; ?>
    <!-- Main component for a primary marketing message or call to action -->
    <?php if (!isset($p)) { ?>
        <table border="3px" border-style="solid" width="98%" align="center">
            <tr height="66px" border="3px" border-style="solid">

                <td style="font-weight:bold"><?php echo $MSG_NEWCODE ?></td>
                <td style="font-weight:bold"><?php echo $MSG_JISUANKE ?></td>
                <td style="font-weight:bold"><?php echo $MSG_HRBUST ?></td>
            </tr>
            <tr height="70px">
                <?php

                $user_id = $_GET["user_id"];
                //echo($user_id);
                $aaar = array();
                foreach ($result2 as $res) {
                    $pltid = $res["platformname"];
                    $account = $res["account"];
                    $aaar[$pltid] = $account;
                }
                for ($i = 1; $i <= 3; $i++) {
                    if (isset($aaar[$i])) {

                    } else {
                        $aaar[$i] = 0;
                    }
                }
                //echo(var_dump($aaar));
                if (count($result2) == 0) {
                    $text = "<td>0</td><td>0</td><td>0</td>";
                    echo($text);
                } else {
                    $text = "<td>" . "<a href='viewotheroj.php?user_id=$user_id&p=1'>" . $aaar[1] . "</a></td><td>" . "<a href='viewotheroj.php?user_id=$user_id&p=2'>" . $aaar[2] . "</a></td><td>" . "<a href='viewotheroj.php?user_id=$user_id&p=3'>" . $aaar[3] . "</a></td>";
                    echo($text);
                }

                ?>
            </tr>
        </table>
    <?php } ?>
    <?php if (isset($p)) { ?>
        <table border="3px" border-style="solid" width="98%" align="center">
            <tr height="66px" border="3px" border-style="solid">
                <td style="font-weight:bold"><?php echo $MSG_USERIDS ?></td>
                <td style="font-weight:bold"><?php echo $MSG_ACCOUNTS ?></td>
                <td style="font-weight:bold"><?php echo $MSG_PLATFORM ?></td>
                <td style="font-weight:bold"><?php echo $MSG_CONTESTNAME ?></td>
                <td style="font-weight:bold"><?php echo $MSG_SCORE ?></td>
            </tr>
            <?php
            $user_id = $_GET["user_id"];
            if (count($result3) > 0) {
                for ($i = 0; $i < count($result3); $i++) {
                    $text = "<tr height='100px' ><td>$user_id</td><td>" . $result3[$i]['account'] . "</td><td>" . $platnames[$result3[$i]['platformname']] . "</td><td>" . $result3[$i]["contestname"] . "</td><td>" . $result3[$i]["score"] . "</td></tr>";
                    echo($text);
                }
            } else {
                $text = "<tr height='100px' ><td>$user_id</td><td>" . "0" . "</td><td>" . "-" . "</td><td>" . "-" . "</td><td>" . "-" . "</td></tr>";
                echo($text);
            }
            ?>

        </table>
    <?php } ?>
</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>

</body>
</html>
