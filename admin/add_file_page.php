<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="stylesheet" href="../bootstrap/css/style2.css">

    <title>New Problem</title>
</head>
<body leftmargin="30">
<div class="container">

    <?php require_once("../include/db_info.inc.php"); ?>
    <?php require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'file_editor']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php
    include_once("kindeditor.php");
    ?>
    <!--文件添加表-->
    <table align="center" border="2" bordercolor="#000000">
        <form method=POST action="add_file.php" enctype="multipart/form-data">

            <br/>
            <div class="wrapper">

                <div class="icon" style="float: left ;margin-right: 30px">
                    <div class="book">
                        <div class="top"></div>
                        <div class="pages">
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                            <div class="page"></div>
                        </div>
                        A
                        <div class="bookmark"></div>
                    </div>
                </div>

            </div>


            <div>
                <label for="file" style="float: left"><h2 style="color:black;">选择上传文件：</h2></label>
            </div>


            <input type="hidden" name="MAX_FILE_SIZE" value="500000000"/><br/><br/><br/>
            <input type="file" name="upfile"/><br/>

            <p style="color:#666">文件简介:
                <!--<input type="text" name="file_describe">-->
                <?php
                //搜索数据库找标签
                $select_tag_file_describe = "select tag_file_describe from tag_file_describe";
                $tag_file_describe_res = pdo_query($select_tag_file_describe);
                /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
                $colums=mysql_num_fields($link_manage_tag);//获取列数*/

                ?>
                <select name="file_describe" style="width: 415px">
                    <?php
                    foreach ($tag_file_describe_res as $row) {
                        ?>
                        <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                        <?php
                    }

                    ?>
                </select>
            </p>

            <p style="color:#666">文件来源:
                <!--<input type="text" name="file_source">-->
                <?php
                //搜索数据库找标签
                $select_tag_file_source = "select tag_file_source from tag_file_source";
                $tag_file_source_res = pdo_query($select_tag_file_source);
                /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
                $colums=mysql_num_fields($link_manage_tag);//获取列数*/

                ?>
                <select name="file_source" style="width: 415px">
                    <?php
                    foreach ($tag_file_source_res as $row) {
                        ?>
                        <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                        <?php
                    }

                    ?>
                </select>
            </p>

            <p style="color:#666">文件发布者:
                <!--<input type="text" name="file_framer">-->
                <?php
                //搜索数据库找标签
                $select_tag_file_framer = "select tag_file_framer from tag_file_framer";
                $tag_file_framer_res = pdo_query($select_tag_file_framer);
                /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
                $colums=mysql_num_fields($link_manage_tag);//获取列数*/

                ?>
                <select name="file_framer" style="width: 402px">
                    <?php
                    foreach ($tag_file_framer_res as $row) {
                        ?>
                        <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                        <?php
                    }

                    ?>
                </select>
            </p>
            <p style="color:#666">文件权限：
                <!--：<input type="text" name="file_privilege"  />-->
                <?php
                //搜索数据库找标签
                $select_tag_privilege_name = "select tag_privilege_name from tag_privilege";
                $tag_privilege_name_res = pdo_query($select_tag_privilege_name);
                /*$rows=mysql_affected_rows($link_manage_tag);//获取行数
                $colums=mysql_num_fields($link_manage_tag);//获取列数*/

                ?>
                <select name="file_privilege" style="width: 405px">
                    <?php
                    foreach ($tag_privilege_name_res as $row) {
                        ?>
                        <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                        <?php
                    }

                    ?>
                </select>
            </p>
            <br/>

            <div align="center">
                <input type="submit" style=" background:#000;color:#FFF" value="上传文件"/>
            </div>

        </form>
    </table>
    <br/>
    <?php require_once("../include/set_post_key.php"); ?>

</div>
</body>


<div style="text-align:center;clear:both">
    <script src="../bootstrap/js/index.js" type="text/javascript"></script>
</div>

</html>

