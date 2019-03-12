<?php require_once ("admin-header.php");
ini_set("display_errors","On");
require_once("../include/check_get_key.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'news_editor']))){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
?>
<?php
//echo  isset($_GET['news_id']);
if($OJ_SAE||function_exists('system')){
    $news_id=intval($_GET['news_id']);
    //$news_id=$_GET['news_id'];
    $sql="delete FROM `news` WHERE `news_id`=?";

    pdo_query($sql,$news_id) ;

    ?>
    <script language=javascript>
        history.go(-1);
    </script>
    <?php
}else{
    ?>
    <script language=javascript>
        alert("Nees enable system() in php.ini");
        history.go(-1);
    </script>
    <?php

}

?>
