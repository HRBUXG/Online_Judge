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
    <!-- <script src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script>-->
    <?php
    $conn = mysql_connect("localhost", "root", "HRBUXGOJ");
    if (!$conn) {
        alert("连接失败");
    }
    mysql_select_db("jol", $conn);
    mysql_query("set names utf8");
    ?>
    <?php
    //根据id找地址
    if (isset($_GET["team_member_id"])) {
        $id = $_GET["team_member_id"];

        //照片
        $select_picture = "select picture from former_players where user_id='$id'";
        $select_picture_res = mysql_query($select_picture, $conn);
        $picture = mysql_result($select_picture_res, 0);
        //名字:

        $select_username = "select username from former_players where user_id='$id'";
        $select_username_res = mysql_query($select_username, $conn);
        $username = mysql_result($select_username_res, 0);

        //年级
        $select_grade = "select grade from former_players where user_id='$id'";
        $select_grade_res = mysql_query($select_grade, $conn);
        $grade = mysql_result($select_grade_res, 0);

        //学院
        $select_college = "select college from former_players where user_id='$id'";
        $select_college_res = mysql_query($select_college, $conn);
        $college = mysql_result($select_college_res, 0);

        //专业
        $sql6 = "select professional from former_players where user_id='$id'";
        $res6 = mysql_query($sql6, $conn);
        $professional = mysql_result($res6, 0);

        //邮箱
        $select_email = "select email class from former_players where user_id='$id'";
        $select_email_res = mysql_query($select_email, $conn);
        $email = mysql_result($select_email_res, 0);

        //工作研究生就读学校
        $select_work = "select work from former_players where user_id='$id'";
        $select_work_res = mysql_query($select_work, $conn);
        $work = mysql_result($select_work_res, 0);

        //自我介绍
        $select_introduce = "select introduce from former_players where user_id='$id'";
        $select_introduce_res = mysql_query($select_introduce, $conn);
        $introduce = mysql_result($select_introduce_res, 0);

        //奖状
        $select_awards = "select awards from former_players where user_id='$id'";
        $select_awards_res = mysql_query($select_awards, $conn);
        $awards = mysql_result($select_awards_res, 0);
//********************************************修改开始*********************************************************
        //职位
        $select_post = "select post from former_players where user_id='$id'";
        $select_post_res = mysql_query($select_post, $conn);
        $post = mysql_result($select_post_res, 0);
//********************************************修改结束*********************************************************

    } else {
        $id = $_GET["now_team_member_id"];

        //照片
        $select_picture = "select picture from now_players where user_id='$id'";
        $select_picture_res = mysql_query($select_picture, $conn);
        $picture = mysql_result($select_picture_res, 0);
        //名字:

        $select_username = "select username from now_players where user_id='$id'";
        $select_username_res = mysql_query($select_username, $conn);
        $username = mysql_result($select_username_res, 0);

        //年级
        $select_grade = "select grade from now_players where user_id='$id'";
        $select_grade_res = mysql_query($select_grade, $conn);
        $grade = mysql_result($select_grade_res, 0);

        //学院
        $select_college = "select college from now_players where user_id='$id'";
        $select_college_res = mysql_query($select_college, $conn);
        $college = mysql_result($select_college_res, 0);

        //专业
        $sql6 = "select professional from now_players where user_id='$id'";
        $res6 = mysql_query($sql6, $conn);
        $professional = mysql_result($res6, 0);

        //邮箱
        $select_email = "select email class from now_players where user_id='$id'";
        $select_email_res = mysql_query($select_email, $conn);
        $email = mysql_result($select_email_res, 0);

        //工作研究生就读学校
        $select_work = "select work from now_players where user_id='$id'";
        $select_work_res = mysql_query($select_work, $conn);
        $work = mysql_result($select_work_res, 0);

        //自我介绍
        $select_introduce = "select introduce from now_players where user_id='$id'";
        $select_introduce_res = mysql_query($select_introduce, $conn);
        $introduce = mysql_result($select_introduce_res, 0);

        //奖状
        $sql9 = "select awards from now_players where user_id='$id'";
        $res9 = mysql_query($sql9, $conn);
        $awards = mysql_result($res9, 0);
//********************************************修改开始**********************************************************
        //职位
        $select_post = "select post from now_players where user_id='$id'";
        $select_post_res = mysql_query($select_post, $conn);
        $post = mysql_result($select_post_res, 0);
//********************************************修改结束*********************************************************
    };
    ?>>
    <?php
    function br2nl($text)
    {   //取消换行
        return preg_replace('/<br\\s*?\/??>/i', '', $text);
    }

    ?>
</head>

<body>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->

    <button onClick="back()">返回</button>

    <table border="3" width="800" height="800" align="center" style="word-wrap:break-word;word-break:break-all;">
        <tr style="border:#000 solid">
            <td rowspan="3" width="160" height="220">
                <img src="<?php echo $picture; ?>" width="160" height="220" alt="无照片">
            </td>
            <td height="50" width="300">
                <strong><?php echo $MSG_PLAYER_UNAME ?>：</strong>
                <?php echo $username; ?>
                <!--//*******************************************修改开始*****************************************************-->
                <strong>(<?php echo $MSG_PLAYER_POST ?>: <?php echo $post; ?>)</strong>
                <!--//*******************************************修改开始****************************************************-->
            </td>
            <td>
                <strong><?php echo $MSG_PLAYER_GRADE ?>：</strong>
                <?php echo $grade; ?>
            </td>
        </tr>
        <tr style="border:#000 solid">
            <td height="50">
                <strong><?php echo $MSG_PLAYER_COLLEGE ?>：</strong>
                <?php echo $college; ?>
            </td>
            <td height="50">
                <strong><?php echo $MSG_PLAYER_PROFESSIONAL ?>：</strong>
                <?php echo $professional; ?>
            </td>
        </tr>
        <tr style="border:#000 solid">
            <td height="50">
                <strong><?php echo $MSG_PLAYER_EMAIL ?>：</strong>
                <?php echo $email; ?>
            </td>
            <td>
                <strong><?php echo $MSG_PLAYER_WORK ?>：</strong>
                <?php echo $work; ?>
            </td>
        </tr>
        <tr style="border:#000 solid">
            <td colspan="3" valign="top">
                <p><strong><?php echo $MSG_PLAYER_INTRODUCE ?>:</strong></p>
                <?php echo $introduce; ?>
            </td>

        </tr>
        <tr style="border:#000 solid">
            <td colspan="3" valign="top">
                <p><strong><?php echo $MSG_PLAYER_AWARDS ?>:</strong></p>
                <?php echo $awards; ?>
            </td>
        </tr>
    </table>
</div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script>
    function back() {
        history.go(-1);
    }
</script>
</body>
</html>
