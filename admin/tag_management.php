<?php
require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']))) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
?>
<?php require_once("../include/db_info.inc.php"); ?>
<?php
//修改标签
$flag = $_GET["flag"];
$add_flag = $_GET["add_flag"];
//echo "flag:".$flag;

//修改视频标签：
//修改视频描述标签：
//删除视频描述标签：

if ($flag == "delete_video_describe") {
    $video_describe_id = $_GET["video_describe_id"];

    $delete_tag_video_describe = "delete from tag_video_describe where tag_video_describe_id=?";
    $delete_tag_video_describe_result = pdo_query($delete_tag_video_describe, $video_describe_id);

    if ($delete_tag_video_describe_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改视频描述标签：

if ($flag == "update_video_describe") {
    $video_describe_id = $_GET["video_describe_id"];
    $select_tag_video_describe = "select tag_video_describe from tag_video_describe where tag_video_describe_id=?";
    $select_tag_video_describe_res = pdo_query($select_tag_video_describe, $video_describe_id); //判断是否有一样的名字的数据
    $video_describe = $select_tag_video_describe_res[0]['tag_video_describe'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_video_describe&video_describe_id=<?php echo $video_describe_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="video_describe" value="<?php echo $video_describe ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_video_describe") {
    $video_describe_id = $_GET["video_describe_id"];
    $new_video_describe = $_POST["video_describe"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_video_describe = "update tag_video_describe set tag_video_describe=? 
	 where tag_video_describe_id=?";
    $update_video_describe_result = mysql_query($update_video_describe, $new_video_describe, $video_describe_id);

    if ($update_video_describe_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加视频描述标签：

if ($add_flag == "add_video_describe") {
    $tag_video_describe = $_POST['add_video_describe'];
    $insert_video_describe = "insert into tag_video_describe values(?,?)";
    $insert_video_describe_result = pdo_query($insert_video_describe, $tag_video_describe, NULL);
    if ($insert_video_describe_result) {
        echo "<script>alert('添加视频描述标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加视频描述标签失败');</script>";
    }
}


//修改视频来源标签：

//删除视频来源标签：

if ($flag == "delete_video_source") {
    $video_source_id = $_GET["video_source_id"];

    $delete_tag_video_source = "delete from tag_video_source where tag_video_source_id=?";
    $delete_tag_video_source_result = pdo_query($delete_tag_video_source, $video_source_id);

    if ($delete_tag_video_source_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}

//更改视频来源标签：

if ($flag == "update_video_source") {
    $video_source_id = $_GET["video_source_id"];
    $select_tag_video_source = "select tag_video_source from tag_video_source where tag_video_source_id=?";
    $select_tag_video_source_res = pdo_query($select_tag_video_source, $video_source_id); //判断是否有一样的名字的数据
    $video_source = $select_tag_video_source_res[0]['tag_video_source'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_video_source&video_source_id=<?php echo $video_source_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="video_source" value="<?php echo $video_source ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_video_source") {
    $video_source_id = $_GET["video_source_id"];
    $new_video_source = $_POST["video_source"];
    //echo "video_source_id:".$video_source_id."<br>";
    //echo "new_video_source:".$new_video_source;

    $update_video_source = "update tag_video_source set tag_video_source=? where tag_video_source_id=?";
    $update_video_source_result = pdo_query($update_video_source, $new_video_source, $video_source_id);

    if ($update_video_source_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//增加视频来源标签：

if ($add_flag == "add_video_source") {
    $tag_video_source = $_POST['add_video_source'];
    $insert_video_source = "insert into tag_video_source values(?,?)";
    $insert_video_source_result = pdo_query($insert_video_source, $tag_video_source, NULL);
    if ($insert_video_source_result) {
        echo "<script>alert('添加视频来源标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php
    } else {
        echo "<script>alert('添加视频描述标签失败');</script>";
    }
}


//修改视频发布者标签：

//删除视频发布者标签：

if ($flag == "delete_video_framer") {
    $video_framer_id = $_GET["video_framer_id"];

    $delete_tag_video_framer = "delete from tag_video_framer where tag_video_framer_id=?";
    $delete_tag_video_framer_result = pdo_query($delete_tag_video_framer, $video_framer_id);

    if ($delete_tag_video_framer_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}

//更改视频发布者标签：

if ($flag == "update_video_framer") {
    $video_framer_id = $_GET["video_framer_id"];

    $select_tag_video_framer =
        "select tag_video_framer from tag_video_framer where tag_video_framer_id=?";
    $select_tag_video_framer_res = pdo_query($select_tag_video_framer, $video_framer_id); //判断是否有一样的名字的数据
    $video_framer = $select_tag_video_framer_res[0]['tag_video_framer'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_video_framer&video_framer_id=<?php echo $video_framer_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="video_framer" value="<?php echo $video_framer ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php
}
if ($flag == "upd_video_framer") {
    $video_framer_id = $_GET["video_framer_id"];
    $new_video_framer = $_POST["video_framer"];
    //echo "video_framer_id:".$video_framer_id."<br>";
    //echo "new_video_framer:".$new_video_framer;

    $update_video_framer = "update tag_video_framer set tag_video_framer=? where tag_video_framer_id=?";
    $update_video_framer_result = pdo_query($update_video_framer, $new_video_framer, $video_framer_id);

    if ($update_video_framer_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//增加视频发布者标签：

if ($add_flag == "add_video_framer") {
    $tag_video_framer = $_POST['add_video_framer'];
    $insert_video_framer = "insert into tag_video_framer values(?,?)";
    $insert_video_framer_result = pdo_query($insert_video_framer, $tag_video_framer, NULL);
    if ($insert_video_framer_result) {
        echo "<script>alert('添加视频发布者标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php
    } else {
        echo "<script>alert('添加视频发布者标签失败');</script>";
    }
}


//修改文件标签：

//修改文件描述标签：

//删除文件描述标签

if ($flag == "delete_file_describe") {
    $file_describe_id = $_GET["file_describe_id"];

    $delete_tag_file_describe = "delete from tag_file_describe where tag_file_describe_id=?";
    $delete_tag_file_describe_result = pdo_query($delete_tag_file_describe, $file_describe_id);

    if ($delete_tag_file_describe_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}

//更改文件描述标签

if ($flag == "update_file_describe") {
    $file_describe_id = $_GET["file_describe_id"];
    //echo "file_describe_id:".$file_describe_id."<br>.";

    $select_tag_file_describe =
        "select tag_file_describe from tag_file_describe where tag_file_describe_id=";
    $select_tag_file_describe_res = pdo_query($select_tag_file_describe, $file_describe_id); //判断是否有一样的名字的数据
    $file_describe = $select_tag_file_describe_res[0]['tag_file_describe'];
    //echo "file_describe:".$file_describe."<br>";
    ?>
    <form method=POST
          action="tag_management.php?flag=upd_file_describe&file_describe_id=<?php echo $file_describe_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="file_describe" value="<?php echo $file_describe ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php
}
if ($flag == "upd_file_describe") {
    $file_describe_id = $_GET["file_describe_id"];
    $new_file_describe = $_POST["file_describe"];
    //echo "file_describe_id:".$file_describe_id."<br>";
    //echo "new_file_describe:".$new_file_describe;

    $update_file_describe =
        "update tag_file_describe set tag_file_describe=?
	 where tag_file_describe_id=?";
    $update_file_describe_result = pdo_query($update_file_describe, $new_file_describe, $file_describe_id);

    if ($update_file_describe_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}
//增加文件描述标签

if ($add_flag == "add_file_describe") {
    $tag_file_describe = $_POST['add_file_describe'];
    $insert_file_describe = "insert into tag_file_describe values(?,?)";
    $insert_file_describe_result = pdo_query($insert_file_describe, $tag_file_describe, NULL);
    if ($insert_file_describe_result) {
        echo "<script>alert('添加文件描述签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php
    } else {
        echo "<script>alert('添加文件描述标签失败');</script>";
    }
}


//修改文件来源标签：

//删除文件来源标签：

if ($flag == "delete_file_source") {
    $file_source_id = $_GET["file_source_id"];

    $delete_tag_file_source = "delete from tag_file_source where tag_file_source_id=?";
    $delete_tag_file_source_result = pdo_query($delete_tag_file_source, $file_source_id);

    if ($delete_tag_file_source_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}

//更改文件来源标签：

if ($flag == "update_file_source") {
    $file_source_id = $_GET["file_source_id"];
    $select_tag_file_source =
        "select tag_file_source from tag_file_source where tag_file_source_id=?";
    $select_tag_file_source_res = pdo_query($select_tag_file_source, $file_source_id); //判断是否有一样的名字的数据
    $file_source = $select_tag_file_source_res[0]['tag_file_source'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_file_source&file_source_id=<?php echo $file_source_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="file_source" value="<?php echo $file_source ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php
}
if ($flag == "upd_file_source") {
    $file_source_id = $_GET["file_source_id"];
    $new_file_source = $_POST["file_source"];
    //echo "file_source_id:".$file_source_id."<br>";
    //echo "new_file_source:".$new_file_source;

    $update_file_source =
        "update tag_file_source set tag_file_source=? 
	 where tag_file_source_id=?";
    $update_file_source_result = pdo_query($update_file_source, $new_file_source, $file_source_id);

    if ($update_file_source_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//增加文件来源标签：

if ($add_flag == "add_file_source") {
    $tag_file_source = $_POST['add_file_source'];
    $insert_file_source = "insert into tag_file_source values(?,?)";
    $insert_file_source_result = pdo_query($insert_file_source, $tag_file_source, NULL);
    if ($insert_file_source_result) {
        echo "<script>alert('添加文件来源签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php
    } else {
        echo "<script>alert('添加文件来源标签失败');</script>";
    }
}


//修改文件发布者标签：

//删除文件发布者标签：

if ($flag == "delete_file_framer") {
    $file_framer_id = $_GET["file_framer_id"];

    $delete_tag_file_framer = "delete from tag_file_framer where tag_file_framer_id=?";
    $delete_tag_file_framer_result = pdo_query($delete_tag_file_framer, $file_framer_id);

    if ($delete_tag_file_framer_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}

//更改文件发布者标签：

if ($flag == "update_file_framer") {
    $file_framer_id = $_GET["file_framer_id"];

    $select_tag_file_framer =
        "select tag_file_framer from tag_file_framer where tag_file_framer_id=?";
    $select_tag_file_framer_res = pdo_query($select_tag_file_framer, $file_framer_id); //判断是否有一样的名字的数据
    $file_framer = $select_tag_file_framer_res[0]['tag_file_framer'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_file_framer&file_framer_id=<?php echo $file_framer_id ?>"
          enctype="multipart/form-data">

        <label>文件描述：</label><input type="text" name="file_framer" value="<?php echo $file_framer ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php
}
if ($flag == "upd_file_framer") {
    $file_framer_id = $_GET["file_framer_id"];
    $new_file_framer = $_POST["file_framer"];
    //echo "file_framer_id:".$file_framer_id."<br>";
    //echo "new_file_framer:".$new_file_framer;

    $update_file_framer = "update tag_file_framer set tag_file_framer=? where tag_file_framer_id=?";
    $update_file_framer_result = pdo_query($update_file_framer, $new_file_framer, $file_framer_id);

    if ($update_file_framer_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}
//增加文件发布者标签：

if ($add_flag == "add_file_framer") {
    $tag_file_framer = $_POST['add_file_framer'];
    $insert_file_framer = "insert into tag_file_framer values(?,?)";
    $insert_file_framer_result = pdo_query($insert_file_framer, $tag_file_framer, NULL);
    if ($insert_file_framer_result) {
        echo "<script>alert('添加文件发布者签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php
    } else {
        echo "<script>alert('添加文件发布者标签失败');</script>";
    }
}
//修改历届队员标签

//修改历届队员年级标签
//删除历届队员年级标签
if ($flag == "delete_player_grade") {
    $player_grade_id = $_GET["player_grade_id"];

    $delete_tag_player_grade = "delete from tag_player_grade where tag_player_grade_id=?";
    $delete_tag_player_grade_result = pdo_query($delete_tag_player_grade, $player_grade_id);

    if ($delete_tag_player_grade_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改历届队员年级标签：

if ($flag == "update_player_grade") {
    $player_grade_id = $_GET["player_grade_id"];
    $select_tag_player_grade =
        "select tag_player_grade from tag_player_grade where tag_player_grade_id=?";
    $select_tag_player_grade_res = pdo_query($select_tag_player_grade, $player_grade_id); //判断是否有一样的名字的数据
    $player_grade = $select_tag_player_grade_res[0]['tag_player_grade'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_player_grade&player_grade_id=<?php echo $player_grade_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="player_grade" value="<?php echo $player_grade ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_player_grade") {
    $player_grade_id = $_GET["player_grade_id"];
    $new_player_grade = $_POST["player_grade"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_player_grade =
        "update tag_player_grade set tag_player_grade=? 
	 where tag_player_grade_id=?";
    $update_player_grade_result = pdo_query($update_player_grade, $new_player_grade, $player_grade_id);

    if ($update_player_grade_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加历届队员年级标签：

if ($add_flag == "add_player_grade") {
    $tag_player_grade = $_POST['add_player_grade'];
    $insert_player_grade = "insert into tag_player_grade values(?,?)";
    $insert_player_grade_result = pdo_query($insert_player_grade, $tag_player_grade, NULL);
    if ($insert_player_grade_result) {
        echo "<script>alert('添加历届队员年级标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加历届队员年级标签失败');</script>";
    }
}

//修改历届队员专业标签
//删除历届队员专业标签
if ($flag == "delete_player_professional") {
    $player_professional_id = $_GET["player_professional_id"];

    $delete_tag_player_professional =
        "delete from tag_player_professional where tag_player_professional_id=?";
    $delete_tag_player_professional_result = pdo_query($delete_tag_player_professional, $player_professional_id);

    if ($delete_tag_player_professional_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改历届队员专业标签：

if ($flag == "update_player_professional") {
    $player_professional_id = $_GET["player_professional_id"];
    $select_tag_player_professional =
        "select tag_player_professional from tag_player_professional 
	where tag_player_professional_id=?";
    $select_tag_player_professional_res = pdo_query($select_tag_player_professional, $player_professional_id);
    $player_professional = $select_tag_player_professional_res[0]['tag_player_professional'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_player_professional&player_professional_id=<?php echo $player_professional_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="player_professional"
                                   value="<?php echo $player_professional ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_player_professional") {
    $player_professional_id = $_GET["player_professional_id"];
    $new_player_professional = $_POST["player_professional"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_player_professional =
        "update tag_player_professional set tag_player_professional=? 
	 where tag_player_professional_id=?";
    $update_player_professional_result = pdo_query($update_player_professional, $new_player_professional, $player_professional_id);

    if ($update_player_professional_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加历届队员专业标签：

if ($add_flag == "add_player_professional") {
    $tag_player_professional = $_POST['add_player_professional'];
    $insert_player_professional = "insert into tag_player_professional values(?,?)";
    $insert_player_professional_result = pdo_query($insert_player_professional, $tag_player_professional, NULL);
    if ($insert_player_professional_result) {
        echo "<script>alert('添加历届队员专业标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加历届队员专业标签失败');</script>";
    }
}

//修改历届队员学院标签
//删除历届队员学院标签
if ($flag == "delete_player_college") {
    $player_college_id = $_GET["player_college_id"];

    $delete_tag_player_college = "delete from tag_player_college where tag_player_college_id=?";
    $delete_tag_player_college_result = pdo_query($delete_tag_player_college, $player_college_id);

    if ($delete_tag_player_college_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改历届队员学院标签：

if ($flag == "update_player_college") {
    $player_college_id = $_GET["player_college_id"];
    $select_tag_player_college =
        "select tag_player_college from tag_player_college where tag_player_college_id=?";
    $select_tag_player_college_res = pdo_query($select_tag_player_college, $player_college_id); //判断是否有一样的名字的数据
    $player_college = $select_tag_player_college_res[0]['tag_player_college'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_player_college&player_college_id=<?php echo $player_college_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="player_college" value="<?php echo $player_college ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_player_college") {
    $player_college_id = $_GET["player_college_id"];
    $new_player_college = $_POST["player_college"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_player_college =
        "update tag_player_college set tag_player_college=? 
	 where tag_player_college_id=?";
    $update_player_college_result = pdo_query($update_player_college, $new_player_college, $player_college_id);

    if ($update_player_college_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加历届队员学院标签：

if ($add_flag == "add_player_college") {
    $tag_player_college = $_POST['add_player_college'];
    $insert_player_college = "insert into tag_player_college values(?,?)";
    $insert_player_college_result = pdo_query($insert_player_college, $tag_player_college, NULL);
    if ($insert_player_college_result) {
        echo "<script>alert('添加历届队员学院标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加历届队员学院标签失败');</script>";
    }
}
//修改问题标签
//修改历届队员职务标签
//删除历届队员职务标签
if ($flag == "delete_player_post") {
    $player_post_id = $_GET["player_post_id"];

    $delete_tag_player_post = "delete from tag_player_post where tag_player_post_id=?";
    $delete_tag_player_post_result = pdo_query($delete_tag_player_post, $player_post_id);

    if ($delete_tag_player_post_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改历届队员朱武标签：

if ($flag == "update_player_post") {
    $player_post_id = $_GET["player_post_id"];
    $select_tag_player_post =
        "select tag_player_post from tag_player_post where tag_player_post_id=?";
    $select_tag_player_post_res = pdo_query($select_tag_player_post, $player_post_id); //判断是否有一样的名字的数据
    $player_post = $select_tag_player_post_res[0]['tag_player_post'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_player_post&player_post_id=<?php echo $player_post_id ?>"
          enctype="multipart/form-data">

        <label>视频描述：</label><input type="text" name="player_post" value="<?php echo $player_post ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_player_post") {
    $player_post_id = $_GET["player_post_id"];
    $new_player_post = $_POST["player_post"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_player_post =
        "update tag_player_post set tag_player_post=? 
	 where tag_player_post_id=?";
    $update_player_post_result = pdo_query($update_player_post, $new_player_post, $player_post_id);

    if ($update_player_post_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加队员职务标签：

if ($add_flag == "add_player_post") {
    $tag_player_post = $_POST['add_player_post'];
    $insert_player_post = "insert into tag_player_post values(?,?)";
    $insert_player_post_result = pdo_query($insert_player_post, $tag_player_post, NULL);
    if ($insert_player_post_result) {
        echo "<script>alert('添加历届队员职务标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加历届队员职务标签失败');</script>";
    }
}
//修改问题一级标签
//删除问题一级标签
if ($flag == "delete_tag1") {
    $tag1_id = $_GET["tag1_id"];

    $delete_tag1 = "delete from tag1 where tag1_id=?";
    $delete_tag1_result = pdo_query($delete_tag1, $tag1_id);

    if ($delete_tag1_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改问题一级标签：

if ($flag == "update_tag1") {
    $tag1_id = $_GET["tag1_id"];
    $select_tag1 =
        "select tag1_name from tag1 where tag1_id=?";
    $select_tag1_res = pdo_query($select_tag1, $tag1_id); //判断是否有一样的名字的数据
    $tag1 = $select_tag1_res[0]['tag1_name'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_tag1&tag1_id=<?php echo $tag1_id ?>"
          enctype="multipart/form-data">

        <label>一级标签：</label><input type="text" name="tag1" value="<?php echo $tag1 ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_tag1") {
    $tag1_id = $_GET["tag1_id"];
    $new_tag1 = $_POST["tag1"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_tag1 =
        "update tag1 set tag1_name=? where tag1_id=?";
    $update_tag1_result = pdo_query($update_tag1, $new_tag1, $tag1_id);

    if ($update_tag1_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加问题一级标签：

if ($add_flag == "add_tag1") {
    $tag1_name = $_POST['add_tag1'];
    $insert_tag1 = "insert into tag1 values(?,?)";
    $insert_tag1_result = pdo_query($insert_tag1, NULL, $tag1_name);
    if ($insert_tag1_result) {
        echo "<script>alert('添加问题一级标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加问题一级标签失败');</script>";
    }
}

//修改问题二级标签
//删除问题二级标签
if ($flag == "delete_tag2") {
    $tag2_id = $_GET["tag2_id"];

    $delete_tag2 =
        "delete from tag2 where tag2_id=?";
    $delete_tag2_result = pdo_query($delete_tag2, $tag2_id);

    if ($delete_tag2_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改问题二级标签：

if ($flag == "update_tag2") {
    $tag2_id = $_GET["tag2_id"];
    $tag2_tag1_id = $_GET["tag2_tag1_id"];
    //搜索tag2_name
    $select_tag2_name =
        "select tag2_name from tag2 
	where tag2_id=?";
    $select_tag2_name_res = pdo_query($select_tag2_name, $tag2_id);
    $tag2_name = $select_tag2_name_res[0]['tag2_name'];
    //搜索tag1_name
    $select_tag1_name =
        "select tag1_name from tag1 
	where tag1_id=?";
    $select_tag1_name_res = pdo_query($select_tag1_name, $tag2_tag1_id);
    $tag1_name = $select_tag1_name_res[0]['tag1_name'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_tag2&tag2_id=<?php echo $tag2_id ?>"
          enctype="multipart/form-data">
        <label>问题一级标签：</label>
        <?php
        //搜索数据库找标签
        $select_tag1_name = "select tag1_name from tag1";
        $tag1_name_res = pdo_query($select_tag1_name);
        /*$rows = mysql_affected_rows($link_manage_tag);//获取行数
        $colums = mysql_num_fields($link_manage_tag);//获取列数*/

        ?>
        <select name="tag1_name">
            <?php

            foreach ($tag1_name_res as $row) {
                ?>
                <option <?php if ($row[0] == $tag1_name) {
                    echo("selected");
                } ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                <?php
            }

            ?>
        </select>

        <label>问题二级标签：</label><input type="text" name="tag2"
                                     value="<?php echo $tag2_name ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_tag2") {
    $tag2_id = $_GET["tag2_id"];
    $new_tag2_name = $_POST["tag2"];
    $new_tag1_name = $_POST["tag1_name"];
    //搜索tag1_id
    $select_tag1_id =
        "select tag1_id from tag1 
	where tag1_name=?";
    $select_tag1_id_res = pdo_query($select_tag1_id, $new_tag1_name);
    $new_tag2_tag1_id = $select_tag1_id_res[0]['tag1_id'];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    //更新的sql语句
    $update_tag2 =
        "update tag2 set tag2_name=?,tag2_tag1_id=?
	 where tag2_id=?";
    $update_tag2_result = pdo_query($update_tag2, $new_tag2_name, $new_tag2_tag1_id, $tag2_id);

    if ($update_tag2_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加问题二级标签：

if ($add_flag == "add_tag2") {
    $tag2_name = $_POST['add_tag2'];
    $tag1_name = $_POST['tag1'];
    //搜索tag1_id
    $sql = "select tag1_id from tag1 where tag1_name=?";
    $data = pdo_query($sql, $tag1_name);
    $tag1_id = $data[0]['tag1_id'];

    $insert_tag2 = "insert into tag2 values(?,?,?)";
    $insert_tag2_result = pdo_query($insert_tag2, NULL, $tag2_name, $tag1_id);
    if ($insert_tag2_result) {
        echo "<script>alert('添加问题二级标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加问题二级标签失败');</script>";
    }
}
//修改问题来源标签
//删除问题来源标签
if ($flag == "delete_tag_problem_source") {
    $tag_problem_source_id = $_GET["tag_problem_source_id"];

    $delete_tag_problem_source = "delete from tag_problem_source where tag_problem_source_id=?";
    $delete_tag_problem_source_result = pdo_query($delete_tag_problem_source, $tag_problem_source_id);

    if ($delete_tag_problem_source_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改问题来源标签：

if ($flag == "update_tag_problem_source") {
    $tag_problem_source_id = $_GET["tag_problem_source_id"];
    $select_tag_problem_source =
        "select tag_problem_source from tag_problem_source where tag_problem_source_id=?";
    $select_tag_problem_source_res = pdo_query($select_tag_problem_source, $tag_problem_source_id); //判断是否有一样的名字的数据
    $tag_problem_source = $select_tag_problem_source_res[0]['tag_problem_source'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_tag_problem_source&tag_problem_source_id=<?php echo $tag_problem_source_id ?>"
          enctype="multipart/form-data">

        <label>问题来源标签：</label><input style="width:500px" type="text" name="tag_problem_source"
                                     value="<?php echo $tag_problem_source ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_tag_problem_source") {
    $tag_problem_source_id = $_GET["tag_problem_source_id"];
    $new_tag_problem_source = $_POST["tag_problem_source"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_tag_problem_source = "update tag_problem_source set tag_problem_source=? where tag_problem_source_id=?";
    $update_tag_problem_source_result = pdo_query($update_tag_problem_source, $new_tag_problem_source, $tag_problem_source_id);

    if ($update_tag_problem_source_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添问题来源标签：

if ($add_flag == "add_tag_problem_source") {
    $tag_problem_source = $_POST['add_tag_problem_source'];
    $insert_tag_problem_source = "insert into tag_problem_source values(?,?)";
    $insert_tag_problem_source_result = pdo_query($insert_tag_problem_source, $tag_problem_source, NULL);
    if ($insert_tag_problem_source_result) {
        echo "<script>alert('添加问题来源标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加问题来源标签失败');</script>";
    }
}


//更改权限标签

//修改权限标签标签
//删除权限标签标签
if ($flag == "delete_tag_privilege") {
    $tag_privilege_id = $_GET["tag_privilege_id"];

    $delete_tag_privilege = "delete from tag_privilege where tag_privilege_id=?";
    $delete_tag_privilege_result = pdo_query($delete_tag_privilege, $tag_privilege_id);

    if ($delete_tag_privilege_result) {
        ?>
        <script>
            alert("删除成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("删除失败");
            //window.location.href="video_update_page.php";
        </script>
        <?php
    }
}


//更改权限标签：

if ($flag == "update_tag_privilege") {
    $tag_privilege_id = $_GET["tag_privilege_id"];
    $select_tag_privilege_name =
        "select tag_privilege_name from tag_privilege where tag_privilege_id=?";
    $select_tag_privilege_res = pdo_query($select_tag_privilege_name, $tag_privilege_id); //判断是否有一样的名字的数据
    $tag_privilege_name = $select_tag_privilege_res[0]['tag_privilege_name'];

    ?>
    <form method=POST
          action="tag_management.php?flag=upd_tag_privilege&tag_privilege_id=<?php echo $tag_privilege_id ?>"
          enctype="multipart/form-data">

        <label>权限名称：</label><input type="text" name="tag_privilege" value="<?php echo $tag_privilege_name ?>">

        <input type="submit" value="修改">
        <input type="button" value="返回" onClick="back()">


    </form>
    <?php

}
if ($flag == "upd_tag_privilege") {
    $tag_privilege_id = $_GET["tag_privilege_id"];
    $new_tag_privilege_name = $_POST["tag_privilege"];
    //echo "video_describe_id:".$video_describe_id."<br>";
    //echo "new_video_describe:".$new_video_describe;

    $update_tag_privilege = "update tag_privilege set tag_privilege_name=? where tag_privilege_id=?";
    $update_tag_privilege_result = pdo_query($update_tag_privilege, $new_tag_privilege_name, $tag_privilege_id);

    if ($update_tag_privilege_result) {
        ?>
        <script>
            alert("修改成功");
            window.location.href = "tag_management_page.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("修改失败");
            //window.location.href="tag_management_page.php";
        </script>
        <?php
    }
}

//添加历届队员学院标签：

if ($add_flag == "add_tag_privilege") {
    $tag_privilege_name = $_POST['add_tag_privilege'];
    $insert_tag_privilege = "insert into tag_privilege values(?,?)";
    $insert_tag_privilege_result = pdo_query($insert_tag_privilege, $tag_privilege_name,NULL);
    if ($insert_tag_privilege_result) {
        echo "<script>alert('添加权限标签成功');</script>";
        ?>
        <script>
            window.location.href = 'tag_management_page.php';
        </script>
        <?php

    } else {
        echo "<script>alert('添加权限标签失败');</script>";
    }
}
?>
<script>
    function back() {
        window.location.href = 'tag_management_page.php';
    }
</script>




