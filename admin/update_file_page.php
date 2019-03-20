<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>New Problem</title>
</head>
<body leftmargin="30">
<div class="container">

    <?php require_once("../include/db_info.inc.php"); ?>
    <?php require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php
    include_once("kindeditor.php");
    ?>

    <div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
        <h2><?php echo $MSG_UPDATE . $MSG_FILE ?></h2>
    </div>
    <br>

    <form action="update_file_page.php" class="center">
        <input name="fileinformation" type="text" style="width:250px">
        <input type="submit" value="搜索">
    </form>
    <?php
    if (isset($_GET['fileinformation'])) {
        $fileinformation = $_GET['fileinformation'];
        $fileinformation = "%$fileinformation%";
        $sql = "select file_id,file_name,file_describe,file_framer,file_upload_time,file_source,file_privilege
			from file
			where concat(file_name,file_describe,file_framer,file_source) like ?";
        $res = pdo_query($sql, $fileinformation);
        /*$rows = mysql_affected_rows($conn);//获取行数
        $colums = mysql_num_fields($res);//获取列数*/
        //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";
        // echo "共计".$rows."行 ".$colums."列<br/>";
    } else {
        $sql = "select file_id,file_name,file_describe,file_framer,file_upload_time,file_source,file_privilege from file";
        $res = pdo_query($sql);
        /*$rows = mysql_affected_rows($conn);//获取行数
        $colums = mysql_num_fields($res);//获取列数*/
        //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";
        // echo "共计".$rows."行 ".$colums."列<br/>";
    }

    ?>
    <table id='file_upload' width='100%' class='table table-striped'>
        <thead>
        <tr class='toprow'>
            <th class='hidden-xs' width='2%'>
                <?php echo $MSG_FILE_ID ?>
            </th>
            <th class='hidden-xs' width='15%'>
                <?php echo $MSG_FILE_NAME ?>
            </th>
            <th class='hidden-xs' width='15%'>
                <?php echo $MSG_FILE_DESCRRIBE ?>
            </th>
            <th class='hidden-xs' width='10%'>
                <?php echo $MSG_FILE_FRAMER ?>
            </th>
            <th class='hidden-xs' width='13%'>
                <?php echo $MSG_FILE_UPLOAD_TIME ?>
            </th>
            <th class='hidden-xs' style="cursor:hand" width='20%'>
                <?php echo $MSG_FILE_SOURCE ?>
            </th>
            <th class='hidden-xs' style="cursor:hand" width='15%'>
                <?php echo $MSG_FILE_PRIVILEGE ?>
            </th>
            <th class='hidden-xs' style="cursor:hand" width='10%'>
                <?php echo "操作"; ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($res as $row) {
            $t = 0;
            echo "<tr>";
            echo "<td class='hidden-xs'>" . $row['file_id'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['file_name'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['file_describe'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['file_framer'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['file_upload_time'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['file_source'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['file_privilege'] . "</td>";
            ?>
            <td class='hidden-xs'>
                <input class="delete" type="button"
                       value="删除" <?php if (!isset($_SESSION[$OJ_NAME . '_' . 'root'])) echo "disabled='disabled'" ?> >
                <input class="update" type="button" value="修改">
            </td>
            <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <?php require_once("../include/set_post_key.php"); ?>

</div>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
<script language='javascript'>
    function del() {

    }
</script>
<script>
    $('.delete').click(function () {
        var flagdel = "del";
        if (false === confirm('是否真的要删除当前记录?')) {
            return;
        }
        var tr = $(this).closest("tr");
        var file_id = tr.find("td:eq(0)").text();
        window.location.href = 'update_file.php?flag=' + flagdel + '&file_id=' + file_id;
    });

    $('.update').click(function () {
        var flagup = "update";
        var tr = $(this).closest("tr");
        var file_id = tr.find("td:eq(0)").text();
        window.location.href = 'update_file.php?flag=' + flagup + '&file_id=' + file_id;
    });
</script>
</body>
</html>

