<?php /*require_once("admin-header.php");

if(isset($OJ_LANG)){
    require_once("../lang/$OJ_LANG.php");
}
*/?><!--
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Button Up</title>
    <style>
        *{margin: 0px; padding: 0px;}
    </style>


    <link rel="stylesheet" href="..\..\bootstrap\css\style.css">


</head>

<body>
<div class="panel panel-light">
    <div class="wrap">
        <a class="SeeOJ"  href="../status.php" target="_top">SeeOJ</a>
        <?php /*if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="AddNews"  href="news_add_page.php" target="main">AddNews</a>
            <a class="NewsList" href="news_list.php" target="main">NewsList</a>
            <a class="UserList"  href="user_list.php" target="main">UserList</a><br/>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="AddVideo" href="video_add_page.php" target="main">AddVideo</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="Video" href="video_update_page.php" target="main">Video</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="AddFile" href="add_file_page.php" target="main">AddFile</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="File" href="update_file_page.php" target="main">File</a><br/>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="AddPlays" href="add_playinformation_page.php" target="main">AddPlays</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="Plays" href="update_playinformation_page.php" target="main">Plays</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="AddProblem" href="problem_add_page.php" target="main">AddProblem</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
            */?>
            <a class="ProblemList" href="problem_list.php" target="main">ProblemList</a><br/>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])){
            */?>
            <a class="AddContest" href="contest_add.php" target="main">AddContest</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])){
            */?>
            <a class="ContestList" href="contest_list.php" target="main">ContestList</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="TeamGenerator" href="team_generate.php" target="main">TeamGenerator</a>
            <a class="SetMessage" href="setmsg.php" target="main">SetMessage</a><br/>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset( $_SESSION[$OJ_NAME.'_'.'password_setter'] )){
            */?>
            <a class="ChangePassWD" href="changepass.php" target="main">ChangePassWD</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="Rejudge" href="rejudge.php" target="main">Rejudge</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="AddPrivilege" href="privilege_add.php" target="main">AddPrivilege</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="PrivilegeList" href="privilege_list.php" target="main">PrivilegeList</a><br/>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="GiveSource" href="source_give.php" target="main">GiveSource</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="ExportProblem" href="problem_export.php" target="main">ExportProblem</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="ImportProblem" href="problem_import.php" target="main">ImportProblem</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
            */?>
            <a class="UpdateDatabase" href="update_db.php" target="main">UpdateDatabase</a>
        <?php /*}
        if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
        */?>
        <a class="TagManage" href="tag_management_page.php" target="main">TagManage</a><br/>

        <!--<?php /*}
        if (isset($OJ_ONLINE)&&$OJ_ONLINE){
            */?><li>
      <a class='btn btn-infos' href="../online.php" target="main"><b><?php /*echo $MSG_ONLINE*/?></b></a><?php /*echo $MSG_HELP_ONLINE*/?>
      <?php /*}
        */?>

      </ul>
      <?php /*if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])&&!$OJ_SAE){
            */?>
      <a href="problem_copy.php" target="main" title="Create your own data"><font color="eeeeee">CopyProblem</font></a> <br>
      <a href="problem_changeid.php" target="main" title="Danger,Use it on your own risk"><font color="eeeeee">ReOrderProblem</font></a>

      <?php /*}
        */?>
    </div>
</div>


</body>
</html>
-->










<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <script src="../template/bs3/jquery.min.js"></script>
    <title>Document</title>

    <style>

        body{
            background-image:url(../image/p5.jpg);
            background-repeat: no-repeat;
            width:100%;
            height:660px;
        }

        h2{
            padding-top: 5% !important;
            color: #275b28;
            font-family: comic sans ms !important;
        }

        .time{
            width: 200px;
            height: 200px;
            align:right;

        }

    </style>

</head>
<body>

<div class="setbg">
    <!--欢迎字段显示-->
    <div class="pageTitle">

  <h2 align="center" style="font-size: 60px">Welcome to ACM backstage</h2>
    </div>
    <!--日历和时间的显示-->
    <!--<div class="time" style="padding: 0px 80% 0px 0px">
       <?php /* require_once("./index.html"); */?>
    </div>-->


    <?php require_once("./index.html"); ?>





</div>


</body>
<script type="text/javascript">
    //鼠标特效
    var a_idx = 0;
    jQuery(document).ready(function ($) {
        $("body").click(function (e) {
            var a = new Array(
                "广度优先遍历", "深度优先遍历", "拓扑排序", "栈", "队列", "链表", "哈希表", "哈希数组", " 堆", "棋盘分割", "Prim算法", "最短路径");
            var $i = $("<span/>").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX,
                y = e.pageY;
            $i.css({
                "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                    "top": y - 180,
                    "opacity": 0
                },
                1500,
                function () {
                    $i.remove();
                });
        });
    });




</script>
</html>


