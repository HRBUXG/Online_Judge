<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Edit ProblemSolution</title>
</head>
<body>
<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");

require_once("../include/my_func.inc.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])
    ||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])
)){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
?>
<?php
include_once("kindeditor.php") ;
?>
<div class="container">
    <?php if(isset($_GET['id'])){
    ;//	require_once("../include/check_get_key.php");
    ?>
    <form method=POST action=prosolution_edit.php>

        <p align=center style="padding-top: 20px"><font size=7 color=#333399><b>Edit ProblemSolution</b></font></p></br>

        <?php $sql="SELECT * FROM `problem_solution` WHERE `problem_id`=?";
        $result=pdo_query($sql,intval($_GET['id']));
        $row=$result[0];
        ?>
        <p>Problem Id: <?php echo $row['problem_id']?></p>
        <input type=hidden name=problem_id value='<?php echo $row['problem_id']?>'>
        <p><?php echo $MSG_TITLE?>:
            <input class="input-xxlarge" type='text' name='problem_title' value='<?php echo htmlentities($row['problem_title'],ENT_QUOTES,"UTF-8")?>'></p>

        <p><?php echo $MSG_SUMMARY?>:
            <input class="input-xxlarge" type='text' name='problem_analyse_summary' value='<?php echo htmlentities($row['problem_analyse_summary'],ENT_QUOTES,"UTF-8")?>'></p>

        <p><?php echo $MSG_Description?>:<br>
            <textarea class="kindeditor" rows=13 name='problem_analyse' cols=120><?php echo htmlentities($row['problem_analyse'],ENT_QUOTES,"UTF-8")?></textarea></p>

        <div align='center'>
            <?php require_once("../include/set_post_key.php"); ?>
            <button type="submit" class="btn btn-primary btn-sm" id="submit" value="Submit" name="submit"
                    style="font-size: 14px;border-radius: 4px;margin-top:20px;margin-left: 120px;">Submit
            </button>
        </div>
    </form>
    <p>

        <?php }else{
            require_once("../include/check_post_key.php");
            $id=intval($_POST['problem_id']);
            if(!(isset($_SESSION[$OJ_NAME.'_'."p$id"])||isset($_SESSION[$OJ_NAME.'_'.'administrator']))) exit();
            $title=$_POST['problem_title'];
            $title = str_replace(",", "&#44;", $title);

            $descriptionSummary=$_POST['problem_analyse_summary'];
            $description=$_POST['problem_analyse'];


            if (get_magic_quotes_gpc ()) {
                $title = stripslashes ( $title);
                $descriptionSummary = stripslashes ( $descriptionSummary);
                $description = stripslashes ( $description);


            }
            $title=$title;
            $descriptionSummary=$descriptionSummary;
            $description=$description;


            $sql="UPDATE `problem_solution` set `problem_title`=?,`problem_analyse_summary`=?,`problem_analyse`=? WHERE `problem_id`=?";

            pdo_query($sql,$title,$descriptionSummary,$description,$id) ;

            header("location:prosolution_list.php");
            exit();
        }
        ?>
</div>
</body>
</html>

