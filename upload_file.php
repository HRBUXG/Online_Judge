<?php
ini_set("display_errors", "On");
error_reporting(E_ALL);
require_once "Classes/PHPExcel.php";
require_once("include/my_func.inc.php");
require_once('include/db_info.inc.php');
if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    echo "you may not select any file!!!";
} else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    if (file_exists("upload/" . $_FILES["file"]["name"])) {
        if (!unlink("upload/" . $_FILES["file"]["name"])) {
        }
    }
    $uqnid = md5(uniqid());
    $parm = $_GET["parm"];
    $extends = strtolower(substr(strrchr($_FILES["file"]["name"], "."), 1));
    echo($_FILES["file"]["name"]);
    switch ($parm) {
        case "xls":
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            rename("upload/" . $_FILES["file"]["name"], "upload/" . $uqnid . "." . $extends);
            require_once("xls_handler.php");
            break;
        case "ico":
            move_uploaded_file($_FILES["file"]["tmp_name"], "ico/" . $_FILES["file"]["name"]);
            rename("ico/" . $_FILES["file"]["name"], "ico/" . $uqnid . "." . $extends);
            require_once("ico_handler.php");
            break;
        case "acc":
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            rename("upload/" . $_FILES["file"]["name"], "upload/" . $uqnid . "." . $extends);
            require_once("acc_handler.php");
            break;
    }
}
?>
