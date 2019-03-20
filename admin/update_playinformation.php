<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">
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
    <script type="text/javascript">
        function preview(obj) {
            var img = document.getElementById("previewimg");
            img.src = window.URL.createObjectURL(obj.files[0]);
        }
    </script>
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
    $id = $_GET["team_member_id"];
    $flagupdate = $_GET["flagupdate"];
    $flagadd = $_GET["flagadd"];
    $flagup = $_GET["flagup"];
    $flagdel = $_GET["flagdel"];
    echo "flagadd: " . $flagadd . "</br>";
    echo "id: " . $id . "</br>";
    echo "flagupdate: " . $flagupdate . "</br>";
    echo "flagup: " . $flagup . "</br>";
    echo "flagdel: " . $flagdel . "</br>";
    if ($flagdel == "del") {
        //echo "进行删除操作:</br>";
        //echo "name: ".$name."</br>";
        $sql = "select picture from former_players where user_id=?";
        $data = pdo_query($sql, $id);
        $address = $data[0]['picture'];
        echo "address:" . $address;

        $delete_former_players = "delete from former_players where user_id=?";
        $delete_former_players_result = pdo_query($delete_former_players, $id);
        echo "<script>alert($delete_former_players_result)</script>";
        //echo "delete result: ".$res;
        if ($delete_former_players_result) {
            unlink($address);
            ?>
            <script>
                alert("删除成功");
                window.location.href = "update_playinformation_page.php";
            </script>
        <?php

        }
        else
        {
        ?>
            <script>
                alert("删除失败");
                //window.location.href="update_playinformation_page.php";
            </script>
            <?php
        }
    }

    if ($flagupdate == "upd") {
        $sql_info = "select username,grade,email,professional,college,work,awards,introduce,post,picture from former_players where user_id=?";
        $result = pdo_query($sql_info, $id);
        //echo $result[0]['username'];
        $picture = $result[0]['picture'];
        //姓名
        $username = $result[0]['username'];
        //echo "$username".$username;
        //年级
        $grade = $result[0]['grade'];
        //echo "$grade".$grade;
        //邮箱
        $email = $result[0]['email'];
        //echo "$email".$email;
        //专业
        $professional = $result[0]['professional'];
        //echo "$professional".$professional;
        //学院
        $college = $result[0]['college'];
        //echo "$college".$college;
        //工作
        $work = $result[0]['work'];
        //echo "$work".$work;
        //奖状
        $awards = $result[0]['awards'];
        //echo "$awards".$awards;
        //自我介绍
        $introduce = $result[0]['introduce'];
        //echo "$awards".$awards;
        //职务
        $post = $result[0]['post'];
        //处理awards
        //echo $u_awards.'<br />';
        //$arr=explode("\n",$u_awards);
        //print_r($arr);
        //echo count($arr).'<br />';//回车数
        $new_awards = br2nl($awards);//回车换成换行默认函数
        //处理introduce
        //echo $u_introduce.'<br />';
        //$arr=explode("\n",$u_introduce);
        //print_r($arr);
        //echo count($arr).'<br />';
        $new_introduce = br2nl($introduce);

        ?>
        <h2 align="center" style="color:#F00"> 修改<?php echo $username ?>的信息： </h2>
        <form method=POST
              action="update_playinformation.php?flagup=up&team_member_id=<?php echo $id; ?>&oddaddress=<?php echo $picture; ?>"
              enctype="multipart/form-data">
            <table border="0" bordercolor="#000000" align="center"
                   style="border-spacing:20px; border-collapse: separate; ">
                <tr>
                    <td><strong>姓名：</strong></td>
                    <td>
                        <input type="text" value="<?php echo $username ?>" name="u_uname" id="player_name"
                               onBlur="checkname()" style="float:left">
                        <div id="div_name" style="float:left"></div>
                    </td>
                </tr>
                <tr>
                    <td><strong>学号：</strong></td>
                    <td>
                        <input type="text" value="<?php echo $id ?>" name="u_id" id="player_id" onBlur="checkid()"
                               style="float:left">
                        <div id="div_id" style="float:left"></div>
                    </td>
                </tr>
                <td><strong>年级：</strong></td>
                <td><!--<input type="text" value="<?php echo $grade ?>" name="u_grade">-->
                    <?php
                    //搜索数据库找标签
                    $select_tag_player_grade = "select tag_player_grade from tag_player_grade";
                    $tag_player_grade_res = pdo_query($select_tag_player_grade);

                    ?>
                    <select name="u_grade">
                        <?php

                        foreach ($tag_player_grade_res as $row) {
                            ?>
                            <option <?php if ($row[0] == $grade) {
                                echo("selected");
                            } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </td>
                </tr>
                <tr>
                    <td><strong>邮箱：</strong></td>
                    <td><input type="text" value="<?php echo $email ?>" name="u_email"></td>
                </tr>
                <tr>
                    <td><strong>职务：</strong></td>
                    <td><!--<input type="text" value="<?php echo $post ?>" name="u_post">-->
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_post = "select tag_player_post from tag_player_post";
                        $tag_player_post_res = pdo_query($select_tag_player_post);


                        ?>
                        <select name="u_post">
                            <?php
                            foreach ($tag_player_post_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $post) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>专业：</strong></td>
                    <td><!--<input type="text" value="<?php echo $professional ?>" name="u_professional">-->
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_professional = "select tag_player_professional from tag_player_professional";
                        $tag_player_professional_res = pdo_query($select_tag_player_professional);


                        ?>
                        <select name="u_professional">
                            <?php
                            foreach ($tag_player_professional_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $professional) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>学院：</strong></td>
                    <td><!--<input type="text" value="<?php echo $college ?>" name="u_college">-->
                        <?php
                        //搜索数据库找标签
                        $select_tag_player_college = "select tag_player_college from tag_player_college";
                        $tag_player_college_res = pdo_query($select_tag_player_college);


                        ?>
                        <select name="u_college">
                            <?php
                            foreach ($tag_player_college_res as $row) {
                                ?>
                                <option <?php if ($row[0] == $college) {
                                    echo("selected");
                                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>工作/就读研究上学校：</strong></td>
                    <td><input type="text" value="<?php echo $work ?>" name="u_work"></td>
                </tr>
                <tr>
                    <td><strong>获奖状况：</strong></td>
                    <td><!--<input type="text" value="" name="u_awards">-->
                        <textarea name="u_awards" wrap="hard"
                                  style="width:900px; height:200px;resize:none;overflow:scroll">
			   <?php echo $new_awards ?>
            </textarea>
                    </td>
                </tr>
                <tr>
                    <td><strong>自我介绍：</strong></td>
                    <td><!--<input type="text" value="" name="u_introduce">-->
                        <textarea name="u_introduce" wrap="hard"
                                  style="width:900px; height:200px;resize:none;overflow:scroll">
			   <?php echo $new_introduce ?>
            </textarea>
                    </td>
                </tr>

                <tr>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000000"/>
                    <td><strong>选择照片：</strong></td>
                    <td><input type="file" name="upfile" onChange="preview(this)"/>
                        </br>
                        源图片：<img src="<?php echo $picture ?>" width="140px" height="220">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        所选图片：<img src="" id="previewimg" width="140px" height="220"/>
                    </td>
                    <!--************************************************修改开始******************************************************-->
                </tr>
                <tr>
                    <td><input type="button" value="返回" onClick="back()"></td>
                    <td><input type="submit" value="修改"></td>
                </tr>
            </table>
        </form>
        <?php
    }

    if ($flagup == "up") {
        echo "<pre>";
        /* print_r($_FILES);
         echo "修改操作";*/

        if (!empty($_FILES['upfile']['name'])) {
        if ($_FILES['upfile']['error'] > 0) {
            switch ($_FILES['upfile']['error']) {
                case 1:
                    $errorMsg = "上传文件超过了php.ini规定的大小！";
                    break;
                case 2:
                    $errorMsg = "文件大小超过了前台表单规定大小！";
                    break;
                case 3:
                    $errorMsg = "文件上传不完整！";
                    break;
                case 4:
                    $errorMsg = "没有上传文件！";
                    break;
            }
            echo "<div style='border:solid 8px #dcdcdc; width=500px; height:80px; font-size:14px;'>
	            <div style='border-bottom:solid; font-size:20px; font-weigth:bold'>
		           发上错误！！！！
		        </div>
		        {$errorMsg}
		       </div>
		     ";
        }
        else {

            $dirName = '../image/team_member_picture';
            $toFileName = $dirName . '/' . $_FILES['upfile']['name'];

            $oddaddress = $_GET["oddaddress"];
            $u_uname = $_POST["u_uname"];
            $u_id = $_POST["u_id"];
            $u_grade = $_POST["u_grade"];
            $u_post = $_POST["u_post"];
            $u_email = $_POST["u_email"];
            $u_professional = $_POST["u_professional"];
            $u_college = $_POST["u_college"];
            $u_work = $_POST["u_work"];
            $u_awards = $_POST["u_awards"];
            $u_introduce = $_POST["u_introduce"];

            //echo $u_awards.'<br />';
            //$arr=explode("\n",$u_awards);
            //print_r($arr);
            //echo count($arr).'<br />';//回车数
            $new_u_awards = nl2br($u_awards);//回车换成换行默认函数

            //echo $u_introduce.'<br />';
            //$arr=explode("\n",$u_introduce);
            //print_r($arr);
            //echo count($arr).'<br />';
            $new_u_introduce = nl2br($u_introduce);

            /*echo "dirName:".$dirName."<br>";
            echo "u_uname:".$u_uname."<br>";
            echo "toFileName:".$toFileName."<br>";
            echo "u_id:".$u_id."<br>";
            echo "u_grade:".$u_grade."<br>";
            echo "u_email:".$u_email."<br>";
            echo "u_professional:".$u_professional."<br>";
            echo "u_college:".$u_college."<br>";
            echo "u_work:".$u_work."<br>";
            echo "u_awards:".$u_awards."<br>";
            echo "u_introduce:".$u_introduce."<br>";*/

            $sql10 =
                "update former_players set 
		  picture=?,
		  username=?,user_id=?,post=?,grade=?,email=?
		   ,professional=?,college=?
		   ,work=?,awards=?,introduce=?
	       where user_id=?";
            $res10 = pdo_query($sql10, $toFileName, $u_uname, $u_id, $u_post, $u_grade, $u_email, $u_professional, $u_college, $u_work, $new_u_awards, $new_u_introduce, $id);
        if ($res10) {
            unlink($oddaddress);
            ?>
            <script>
                alert("修改成功");
                //window.location.href="update_playinformation_page.php";
            </script>
        <?php
        mysql_close();
        echo "  判断上传是否成功:<br>";
        if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
            /*echo "<pre>";
            print_r($_FILES);
            echo "name:";
            print_r($_FILES['ufile']['name']);
            echo "tmp_name:";
            print_r($_FILES['upfile']['tmp_name']);
            echo "<br/>";*/


            //echo $toFileName;
            if (move_uploaded_file($_FILES['upfile']['tmp_name'], $toFileName)) {
                chmod($toFileName, 0777);
                echo "<script>
					           alert('上传文件成功！');
					           window.location.href='update_playinformation_page.php';
					       </script>";
            } else {
                /* echo "toFileName:";
                 echo $toFileName;
                 echo "<br/>";
                 echo "tmp_name:";
                 echo $_FILES['upfile']['tmp_name'];
                 echo "<br/>";
                 echo "is_uploaded_file true or false:";
                 echo is_uploaded_file($_FILES['upfile']['tmp_name']);*/
                echo "<script>alert('上传失败');</script>";
            }
        } else {
            echo "<script>alert('错误！不是上传文件');</script>";
        }

        }
        else
        {
        ?>
            <script>
                alert("修改失败");
                <?php /*?>window.location.href="video_update_page.php";<?php */?>
            </script>
        <?php
        }

        }
        }
        else
        {
        $u_uname = $_POST["u_uname"];
        $u_id = $_POST["u_id"];
        $u_grade = $_POST["u_grade"];
        $u_post = $_POST["u_post"];
        $u_email = $_POST["u_email"];
        $u_professional = $_POST["u_professional"];
        $u_college = $_POST["u_college"];
        $u_work = $_POST["u_work"];
        $u_awards = $_POST["u_awards"];
        $u_introduce = $_POST["u_introduce"];

        //echo $u_awards.'<br />';
        //$arr=explode("\n",$u_awards);
        //print_r($arr);
        //echo count($arr).'<br />';//回车数
        $new_u_awards = nl2br($u_awards);//回车换成换行默认函数

        //echo $u_introduce.'<br />';
        //$arr=explode("\n",$u_introduce);
        //print_r($arr);
        //echo count($arr).'<br />';
        $new_u_introduce = nl2br($u_introduce);

        /* echo "dirName:".$dirName."<br>";
         echo "u_uname:".$u_uname."<br>";
         echo "toFileName:".$toFileName."<br>";
         echo "u_id:".$u_id."<br>";
         echo "u_grade:".$u_grade."<br>";
         echo "u_email:".$u_email."<br>";
         echo "u_professional:".$u_professional."<br>";
         echo "u_college:".$u_college."<br>";
         echo "u_work:".$u_work."<br>";
         echo "u_awards:".$u_awards."<br>";
         echo "u_introduce:".$u_introduce."<br>";*/
        $sql11 =
            "update former_players set 
		  username=?,user_id=?,post=?,grade=?,email=?
		   ,professional=?,college=?
		   ,work=?,awards=?,introduce=?
	       where user_id=?";
        $res11 = pdo_query($sql11, $u_uname, $u_id, $u_post, $u_grade, $u_email, $u_professional, $u_college, $u_work, $new_u_awards, $new_u_introduce, $id);
        if ($res11)
        {
        ?>
            <script>
                alert("修改成功");
                window.location.href = "update_playinformation_page.php";
            </script>
        <?php
        mysql_close();
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
    }
    if ($flagadd == "add") {
        /* echo "<pre>";
       print_r($_FILES);*/
        echo "添加操作";

        if (!empty($_FILES['upfile']['name'])) {
        if ($_FILES['upfile']['error'] > 0) {
            switch ($_FILES['upfile']['error']) {
                case 1:
                    $errorMsg = "上传文件超过了php.ini规定的大小！";
                    break;
                case 2:
                    $errorMsg = "文件大小超过了前台表单规定大小！";
                    break;
                case 3:
                    $errorMsg = "文件上传不完整！";
                    break;
                case 4:
                    $errorMsg = "没有上传文件！";
                    break;
            }
            echo "<div style='border:solid 8px #dcdcdc; width=500px; height:80px; font-size:14px;'>
	            <div style='border-bottom:solid; font-size:20px; font-weigth:bold'>
		           发上错误！！！！
		        </div>
		        {$errorMsg}
		       </div>
		     ";
        }
        else {

            $dirName = '../image/team_member_picture';
            $toFileName = $dirName . '/' . $_FILES['upfile']['name'];
            $u_picture = $toFileName;
            $u_uname = $_POST["u_uname"];
            $u_id = $_POST["u_id"];
            $u_grade = $_POST["u_grade"];
            $u_post = $_POST["u_post"];
            $u_email = $_POST["u_email"];
            $u_professional = $_POST["u_professional"];
            $u_college = $_POST["u_college"];
            $u_work = $_POST["u_work"];
            $u_awards = $_POST["u_awards"];
            $u_introduce = $_POST["u_introduce"];
            //echo $u_awards.'<br />';
            //$arr=explode("\n",$u_awards);
            //print_r($arr);
            //echo count($arr).'<br />';//回车数
            $new_u_awards = nl2br($u_awards);//回车换成换行默认函数

            //echo $u_introduce.'<br />';
            //$arr=explode("\n",$u_introduce);
            //print_r($arr);
            //echo count($arr).'<br />';
            $new_u_introduce = nl2br($u_introduce);

            /*echo "dirName:".$dirName."<br>";
            echo "u_uname:".$u_uname."<br>";
            echo "toFileName:".$toFileName."<br>";
            echo "u_id:".$u_id."<br>";
            echo "u_grade:".$u_grade."<br>";
            echo "u_email:".$u_email."<br>";
            echo "u_professional:".$u_professional."<br>";
            echo "u_college:".$u_college."<br>";
            echo "u_work:".$u_work."<br>";
            echo "u_awards:".$u_awards."<br>";
            echo "u_introduce:".$u_introduce."<br>";*/
            $sql10 = "insert into former_playersvalue(?,?,?,?,?,?,?,?,?,?,?)";
            $res10 = pdo_query($sql10, $u_id, $u_email, $u_grade, $u_picture, $u_professional, $u_uname, $new_u_awards, $new_u_introduce, $u_work, $u_college, $u_post);
        if ($res10) {
            ?>
            <script>
                alert("添加成功");
                //window.location.href="add_playinformation_page.php";
            </script>
        <?php
        echo "  判断上传是否成功:<br>";
        if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
            /*echo "<pre>";
            print_r($_FILES);
            echo "name:";
            print_r($_FILES['ufile']['name']);
            echo "tmp_name:";
            print_r($_FILES['upfile']['tmp_name']);
            echo "<br/>";*/


            //echo $toFileName;
            if (move_uploaded_file($_FILES['upfile']['tmp_name'], $toFileName)) {
                chmod($toFileName, 0777);
                echo "<script>
					           alert('上传文件成功！');
					           window.location.href='add_playinformation_page.php';
					       </script>";
            } else {
                /* echo "toFileName:";
                 echo $toFileName;
                 echo "<br/>";
                 echo "tmp_name:";
                 echo $_FILES['upfile']['tmp_name'];
                 echo "<br/>";
                 echo "is_uploaded_file true or false:";
                 echo is_uploaded_file($_FILES['upfile']['tmp_name']);*/
                echo "<script>alert('上传失败');</script>";
            }
        } else {
            echo "<script>alert('错误！不是上传文件');</script>";
        }

        }
        else
        {
        ?>
            <script>
                alert("添加失败");
                <?php /*?>window.location.href="add_playinformation_page.php";<?php */?>
            </script>
        <?php
        }

        }
        }
        else
        {
        $u_uname = $_POST["u_uname"];
        $u_id = $_POST["u_id"];
        $u_grade = $_POST["u_grade"];
        $u_post = $_POST["u_post"];
        $u_email = $_POST["u_email"];
        $u_professional = $_POST["u_professional"];
        $u_college = $_POST["u_college"];
        $u_work = $_POST["u_work"];
        $u_awards = $_POST["u_awards"];
        $u_introduce = $_POST["u_introduce"];
        //echo $u_awards.'<br />';
        //$arr=explode("\n",$u_awards);
        //print_r($arr);
        //echo count($arr).'<br />';//回车数
        $new_u_awards = nl2br($u_awards);//回车换成换行默认函数

        //echo $u_introduce.'<br />';
        //$arr=explode("\n",$u_introduce);
        //print_r($arr);
        //echo count($arr).'<br />';
        $new_u_introduce = nl2br($u_introduce);


        /* echo "dirName:".$dirName."<br>";
         echo "u_uname:".$u_uname."<br>";
         echo "toFileName:".$toFileName."<br>";
         echo "u_id:".$u_id."<br>";
         echo "u_grade:".$u_grade."<br>";
         echo "u_email:".$u_email."<br>";
         echo "u_professional:".$u_professional."<br>";
         echo "u_college:".$u_college."<br>";
         echo "u_work:".$u_work."<br>";
         echo "u_awards:".$u_awards."<br>";
         echo "u_introduce:".$u_introduce."<br>";*/
        $sql11 =
            "insert into former_players
		  value(?,?,?,?,?
		  ,?,?,?,?,?,?)";
        $res11 = pdo_query($sql11, $u_id, $u_email, $u_grade, "", $u_professional, $u_uname, $new_u_awards, $new_u_introduce, $u_work, $u_college, $u_post);
        if ($res11)
        {
        ?>
            <script>
                alert("添加成功");
                window.location.href = "add_playinformation_page.php";
            </script>
        <?php
        }
        else
        {
        ?>
            <script>
                alert("添加失败");
                //window.location.href="add_playinformation_page.php";
            </script>
            <?php
        }

        }
    }

    ?>

</div>
<script>
    function back() {

        window.location.href = 'update_playinformation_page.php';
    }
</script>
</body>
</html>
