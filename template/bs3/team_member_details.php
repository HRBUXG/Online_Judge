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
    //根据id找地址
    if (isset($_GET["team_member_id"])) {
        $id = $_GET["team_member_id"];

        $sql = "select picture,username,grade,email,professional,college,work,awards,introduce,post from former_players where user_id=?";
        $result = pdo_query($sql, $id);
        //照片
        $picture = $result[0]['picture'];
        //名字:
        $username = $result[0]['username'];
        //年级
        $grade = $grade = $result[0]['grade'];
        //学院
        $college = $result[0]['college'];
        //专业
        $professional = $result[0]['professional'];
        //邮箱
        $email = $result[0]['email'];
        //工作研究生就读学校
        $work = $result[0]['work'];
        //自我介绍
        $introduce = $result[0]['introduce'];
        //奖状
        $awards = $result[0]['awards'];
        //职位
        $post = $result[0]['post'];
    } else {
        $id = $_GET["now_team_member_id"];
        $sql = "select picture,username,grade,email,professional,college,work,awards,introduce,post from now_players where user_id=?";
        $result = pdo_query($sql, $id);
        //照片
        $picture = $result[0]['picture'];
        //名字:
        $username = $result[0]['username'];
        //年级
        $grade = $grade = $result[0]['grade'];
        //学院
        $college = $result[0]['college'];
        //专业
        $professional = $result[0]['professional'];
        //邮箱
        $email = $result[0]['email'];
        //工作研究生就读学校
        $work = $result[0]['work'];
        //自我介绍
        $introduce = $result[0]['introduce'];
        //奖状
        $awards = $result[0]['awards'];
        //职位
        $post = $result[0]['post'];
    };
    ?>
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
                <strong>(<?php echo $MSG_PLAYER_POST ?>: <?php echo $post; ?>)</strong>
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
