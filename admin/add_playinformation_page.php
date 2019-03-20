<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="7">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>New Problem</title>
    <script language="javascript" type="text/javascript">
        function checkname() {
            var player_name = $("#player_name").val();
            if (player_name == "") {
                $("#div_name").html("<font color=red><strong>&nbsp;&nbsp;&nbsp;&nbsp;名字不能为空!</strong></font>");
                return false;
            }
            else if (player_name.length == 0 || player_name.match(/^\s+$/g)) {
                $("#div_name").html("<font color=red><strong>&nbsp;&nbsp;&nbsp;&nbsp;名字不能为空格或都是空格!</strong></font>");
                return false;
            }
            else {
                $("#div_name").html("<strong>&nbsp;&nbsp;&nbsp;&nbsp;OK</strong>");
                return true;
            }
        }

        function checkid() {
            var player_id = $("#player_id").val();
            var reg = /^[0-9]+.?[0-9]*$/;
            if (player_id == "") {
                $("#div_id").html("<font color=red><strong>&nbsp;&nbsp;&nbsp;&nbsp;学号不能为空!</strong></font>");
                return false;
            }
            else if (!reg.test(player_id)) {
                $("#div_id").html("<font color=red><strong>&nbsp;&nbsp;&nbsp;&nbsp;学号应该为数字！请修改!</strong></font>");
                return false;
            }
            else {
                $("#div_id").html("<strong>&nbsp;&nbsp;&nbsp;&nbsp;OK</strong>");
                return true;
            }
        }

        function check() {
            if (checkname() && checkid()) {
                return true;
            }
            else {
                return false;
            }
        }
    </script>
</head>
<body leftmargin="30">
<!--********************************************加一个style************************************************-->
<div class="container" style="width:100%">

    <?php require_once("../include/db_info.inc.php"); ?>
    <?php require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'player_editor']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php
    include_once("kindeditor.php");
    ?>
    <!--添加队员标题-->
    <div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
        <h2><?php echo $MSG_ADD . $MSG_PLAYINFORMATION ?></h2>
    </div>
    <!--添加历届队员-->
    <div id="add_former_players" style="width:100%">
        <form method="POST" action="update_playinformation.php?flagadd=add" name="playinformation"
              onSubmit="return check()" enctype="multipart/form-data">
            </br>
            </br>
            <table border="0" bordercolor="#000000" align="center"
                   style="word-wrap:break-word;word-break:break-all;border-spacing:20px; border-collapse: separate">
                <tr>
                    <td><strong>姓名：</strong></td>
                    <td>
                        <input type="text" value="" name="u_uname" id="player_name" onBlur="checkname()"
                               style="float:left">
                        <div id="div_name" style="float:left"></div>
                    </td>
                </tr>
                <tr>
                    <td><strong>学号：</strong></td>
                    <td>
                        <input type="text" value="" name="u_id" id="player_id" onBlur="checkid()" style="float:left">
                        <div id="div_id" style="float:left"></div>
                    </td>
                </tr>
                <tr>
                    <td><strong>年级：</strong></td>
                    <td>
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_grade = "select tag_player_grade from tag_player_grade";
                        $tag_player_grade_res = pdo_query($select_tag_player_grade);
                        /*
           	            $rows=mysql_affected_rows($conn);//获取行数
                        $colums=mysql_num_fields($conn);//获取列数
                        */

                        ?>
                        <select name="u_grade">
                            <?php
                            foreach ($tag_player_grade_res as $row) {
                                ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>邮箱：</strong></td>
                    <td><input type="text" value="" name="u_email"></td>
                </tr>
                <tr>
                    <td><strong>职务：</strong></td>
                    <td>
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_post = "select tag_player_post from tag_player_post";
                        $tag_player_post_res = pdo_query($select_tag_player_post);
                        /*$rows = mysql_affected_rows($conn);//获取行数
                        $colums = mysql_num_fields($conn);//获取列数*/


                        ?>
                        <select name="u_post">
                            <?php
                            foreach ($tag_player_post_res as $row) {
                                ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>专业：</strong></td>
                    <td>
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_professional = "select tag_player_professional from tag_player_professional";
                        $tag_player_professional_res = pdo_query($select_tag_player_professional);
                        /*$rows = mysql_affected_rows($conn);//获取行数
                        $colums = mysql_num_fields($conn);//获取列数*/


                        ?>
                        <select name="u_professional">
                            <?php
                            foreach ($tag_player_professional_res as $row) {
                                ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td><strong>学院：</strong></td>
                    <td>
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_college = "select tag_player_college from tag_player_college";
                        $tag_player_college_res = pdo_query($select_tag_player_college);
                        /*$rows = mysql_affected_rows($conn);//获取行数
                        $colums = mysql_num_fields($conn);//获取列数*/


                        ?>
                        <select name="u_college">
                            <?php
                            foreach ($tag_player_college_res as $row) {
                                ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>工作/就读研究上学校：</strong></td>
                    <td><input type="text" value="" name="u_work"></td>
                </tr>
                <!--*******************************************修改开始********************************************************-->
                <tr>
                    <td><strong>获奖状况：</strong></td>
                    <td>
               <textarea name="u_awards" role="100" rows="4" wrap="hard"
                         style="width:900px; height:200px;resize:none;overflow:scroll"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><strong>自我介绍：</strong></td>
                    <td>
               <textarea name="u_introduce" role="100" rows="4" wrap="hard"
                         style="width:900px; height:200px;resize:none;overflow:scroll"></textarea>
                    </td>
                </tr>
                <!--*******************************************修改结束********************************************************-->
                <tr>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000000"/>
                    <td><strong>选择照片：</strong></td>
                    <td><input type="file" name="upfile"/>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="添加" style="width:100px"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php require_once("../include/set_post_key.php"); ?>

</div>
</body>
</html>

