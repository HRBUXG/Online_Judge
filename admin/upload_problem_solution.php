<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="referrer" content="origin"/>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/font-awesome.min.css">
    <script src="../bootstrap/js/jquery-2.1.4.min.js"></script>
    <script src="../template/bs3/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>

    <!-- 配置文件-->
    <script type="text/javascript" src="../ueditor/ueditor.config.js"></script>
    <!--编辑器源码文件-->
    <script type="text/javascript" src="../ueditor/ueditor.all.min.js"></script>

    <script type="text/javascript" src="../ueditor/lang/zh-cn/zh-cn.js"></script>


    <title>上传问题题解</title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>

</head>
<body>
<h1 align="center" style="margin-top: 10px">上传题解</h1><br/>
<hr width="90%" style="margin-top:-5px;border:1px solid blue;margin-left: 50px"/>
<div class="container">
    <?php require_once("../include/db_info.inc.php"); ?>
    <?php require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'news_editor']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php include_once("ueditor.php"); ?>

    <form action="upload.php" method="post">

        <p>
        <div align=left style="font-family: 'Times New Roman';font-size: 18px;margin-top: 5px;margin-left: 120px">
            <?php echo $MSG_PROBLEM_ID ?>&nbsp;:&nbsp;&nbsp;
            <input type=text id="problemId" name="problemId" style="width: 550px;margin-bottom: 10px"
                   placeholder="Please input the id of problem"><br/>
            <?php echo $MSG_PROBLEM_SUMMARY  ?>&nbsp;:&nbsp;&nbsp;
            <input type=text id="problemSummary" name="problemSummary" style="width: 500px;margin-bottom: 8px"
                   placeholder="Please input the summary of solutions(<=20)"><br/>
        </div>
       <textarea name="content" id="content" style="width: 800px; height: 400px;margin-left: 120px;"></textarea>
        </p>


        <div>
            <?php require_once("../include/set_post_key.php"); ?>
            <button type="submit" class="btn btn-primary btn-sm" id="submit" value="Submit" name="submit"
                style="font-size: 14px;border-radius: 4px;margin-top:3px;margin-left: 120px" disabled>Submit
            </button>
        </div>

    </form>
</div>

<script type="text/javascript">

    /*实例化编辑器*/
    UE.getEditor('content', {initialFrameWidth: 800, initialFrameHeight: 300});


    $("input[name=problemId]").on("input", function () {
        if ($(this).val().trim().length) {
            $("#submit").removeAttr("disabled");
        }
        else {
            $("#submit").prop("disabled", "disabled");
        }
    });

    //利用ajax把 富文本编辑器里的内容传给upload.php，进而保存到数据库
    $('#submit').click(function (){
        $.post("upload.php",
            {content:"UE.getEditor('content').getPlainTxt()"},  //获取编辑器内容
            function (data) {

            });
    });

</script>

</body>
</html>
