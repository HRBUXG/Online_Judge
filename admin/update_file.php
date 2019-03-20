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
    <?php
    require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    video update
    <?php

    $id = $_GET["file_id"];
    $flag = $_GET["flag"];
    echo "flag: " . $flag . "</br>";
    echo "id: " . $id . "</br>";
    if ($flag == "del") {
        echo "进行删除操作:</br>";


        $sql2 = "select file_address from file where file_id=?";
        $result = pdo_query($sql2, $id);
        $address = $result[0]['file_address'];
        echo "address:" . $address;

        $sql1 = "delete from file where file_id=?";
        $res = pdo_query($sql1, $id);
        //echo "delete result: ".$res;

        if ($res) {
            unlink($address);
            ?>
            <script>
                alert("删除成功");
                window.location.href = "update_file_page.php";
            </script>
        <?php

        }
        else
        {
        ?>
            <script>
                alert("删除失败");
                //window.location.href="video_update_page.php";
            </script>
            <?php
        }

    }
    if ($flag == "update") {
        $sql = "select file_address,file_name,file_describe,file_framer,file_source,file_privilege from file where file_id=?";
        $result = pdo_query($sql, $id);
        $address = $result[0]['file_address'];
        echo "address:" . $address;
        $name = $result[0]['file_name'];
        echo $name;
        $describe = $result[0]['file_describe'];
        echo $describe;
        $framer = $result[0]['file_framer'];
        echo $framer;
        $source = $result[0]['file_source'];
        echo $source;
        $privilege = $result[0]['file_privilege'];
        //echo $privilege;
        ?>
        <h2 align="center" style="color:#F00">
            修改<?php echo $name ?>的信息：
        </h2>
        <form method=POST action="update_file.php?flag=upd&id=<?php echo $id ?>&oldname=<?php echo $address; ?>"
              enctype="multipart/form-data">
            <table border="2" bordercolor="#000000" width="500" align="center" height="250">
                <tr>
                    <td><p>文件名：</p></td>
                    <td><input type="text" value="<?php echo $name ?>" name="f_name"></td>
                </tr>
                <tr>
                    <td><p>文件描述：</p></td>
                    <td><!--<input type="text" value="<?php echo $describe ?>" name="f_describe">-->
                        <?php
                        //搜索数据库找标签
                        $select_file_describe = "select tag_file_describe from tag_file_describe";
                        $file_describe_res = pdo_query($select_file_describe);

                        ?>
                        <select name="f_describe">
                            <?php
                            foreach ($file_describe_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $describe) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p>文件发布者：</p></td>
                    <td><!--<input type="text" value="<?php echo $framer ?>" name="f_farmer">-->
                        <?php
                        //搜索数据库找标签
                        $select_file_framer = "select tag_file_framer from tag_file_framer";
                        $file_framer_res = pdo_query($select_file_framer);
                        /*$rows = mysql_affected_rows($conn);//获取行数
                        $colums = mysql_num_fields($conn);//获取列数*/

                        ?>
                        <select name="f_framer">
                            <?php

                            foreach ($file_framer_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $framer) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p>文件来源</p></td>
                    <td><!--<input type="text" value="<?php echo $source ?>" name="f_source">-->
                        <?php
                        //搜索数据库找标签
                        $select_file_source = "select tag_file_source from tag_file_source";
                        $file_source_res = pdo_query($select_file_source);
                        /*$rows = mysql_affected_rows($conn);//获取行数
                        $colums = mysql_num_fields($conn);//获取列数*/

                        ?>
                        <select name="f_source">
                            <?php

                            foreach ($file_source_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $source) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p>文件权限</p></td>
                    <td><!--<input type="text" value="<?php echo $privilege ?>" name="f_source">-->
                        <?php
                        //搜索数据库找标签
                        $select_file_privilege = "select tag_privilege_name from tag_privilege";
                        $file_privilege_res = pdo_query($select_file_privilege);
                        /*$rows = mysql_affected_rows($conn);//获取行数
                        $colums = mysql_num_fields($conn);//获取列数*/

                        ?>
                        <select name="f_privilege">
                            <?php

                            foreach ($file_privilege_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $privilege) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="button" value="返回" onClick="back()"></td>
                    <td><input type="submit" value="修改"></td>
                </tr>
            </table>
        </form>
        <?php
    }
    if ($flag == "upd") {
        echo "修改操作";
        $oldname = $_GET["oldname"];
        $f_name = $_POST["f_name"];
        $f_describe = $_POST["f_describe"];
        $f_framer = $_POST["f_framer"];
        $f_source = $_POST["f_source"];
        $f_privilege = $_POST["f_privilege"];
        $f_id = $_GET["id"];
        //newname
        echo "url:" . dirname($oldname) . "</br>";
        $newname = dirname($oldname) . "/" . $f_name;

        echo "name:" . $f_name . "</br>";
        echo "discribe:" . $f_describe . "</br>";
        echo "framer:" . $f_framer . "</br>";
        echo "source:" . $f_source . "</br>";

        echo "oldname:" . $oldname . "</br>";
        echo "newname:" . $newname . "</br>";

        $sql7 = "update file set file_name=?,file_describe=?,file_framer=?,file_source=?,file_address=?,file_privilege=? where file_id=?";
        $res6 = mysql_query($sql7, $f_name, $f_describe, $f_framer, $f_source, $newname, $f_privilege, $f_id);
        if (rename($oldname, $newname)) {
            echo "成功重命名";
        }
        if ($res6) {

            ?>
            <script>
                alert("修改成功");
                window.location.href = "update_file_page.php";
            </script>
        <?php

        }
        else
        {
        ?>
            <script>
                alert("修改失败");
                //window.location.href="video_update_page.php";
            </script>
            <?php
        }
    }


    ?>

</div>
<script>
    function back() {

        window.location.href = 'update_file_page.php';
    }

    //function update()
    //	{
    //		var flagup="upd";
    //		window.location.href='video_update.php?flag='+flagup;
    //	}
</script>
</body>
</html>

