<?php require_once("admin-header.php");
if ($_SERVER['REQUEST_METHOD']=="POST"){
    require_once("../include/check_post_key.php");
}else{
    require_once("../include/check_get_key.php");

}
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
?>
<?php
$plist="";
sort($_POST['pid']);
foreach($_POST['pid'] as $i){
    if ($plist)
        $plist.=','.intval($i);
    else
        $plist=$i;
}
//echo "===".$plist;
if(isset($_POST['delete'])&&$plist){
    $sql="delete from problem_solution where problem_id in ($plist)";
    pdo_query($sql);
}
?>
<script language=javascript>
    history.go(-1);
</script>
