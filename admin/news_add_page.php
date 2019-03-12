<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>New Problem</title>
</head>
<body leftmargin="30">
<hr>
<h1 align="center">Add News</h1>
<div class="container">
    <?php require_once("../include/db_info.inc.php"); ?>
    <?php require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'news_editor']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php include_once("ueditor.php"); ?>
    <form method=POST action=news_add.php>

        <p align=left style="font-family: 'Times New Roman';font-size: 18px;margin-top: 15px;margin-left: 100px"><?php echo $MSG_TITLE ?>
            &nbsp;:&nbsp;&nbsp;<input type=text id="title" name=title style="width: 300px"
                                      placeholder="Please input the topic of News"></p>
        <br/>
        <textarea name="content" id="UEditor" style="width: 800px; height: 500px; margin-left: 100px;"></textarea>
        </p>
        <button type="button" class="btn btn-primary btn-sm" id="submit" value="Submit" name="submit"
                style="font-size: 14px;border-radius: 4px;margin-top:20px;margin-left: 100px" disabled>Submit
        </button>
        <?php require_once("../include/set_post_key.php"); ?>
    </form>
</div>
<script type="text/javascript">
    $("input[name=title]").on("input", function () {
        if ($(this).val().trim().length) {
            $("#submit").removeAttr("disabled");
        }
        else {
            $("#submit").prop("disabled", "disabled");
        }
    });
</script>

</body>
</html>

