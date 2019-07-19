<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Problem Solution</title>
</head>
<body leftmargin="30">
<div class="container">
    <?php
    require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php
    function br2nl($text)
    {
        return preg_replace('/<br\\s*?\/??>/i', '', $text);
    }

    ?>

    <?php
    $id = $_GET["problem_id"];
    $flagdel = $_GET["flagdel"];


    if ($flagdel == "del") {

        $delete_prosolution = "delete from problem_solution where problem_id=?";
        $delete_prosolution_result = pdo_query($delete_prosolution, $id);
       /* echo "<script>alert($delete_prosolution_result)</script>";*/

        if ($delete_prosolution_result) {

            ?>
            <script>
                alert("删除成功");
                window.location.href = "prosolution_list.php";
            </script>
        <?php

        }
        else
        {
        ?>
            <script>
                alert("删除失败");

            </script>
            <?php
        }
    }
    ?>

</div>
<script>
    function back() {

        window.location.href = 'prosolution_list.php';
    }
</script>
</body>
</html>
