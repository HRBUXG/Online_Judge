<?php require("admin-header.php");
require_once("../include/set_get_key.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'news_editor']))){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
echo "<link rel='stylesheet' href='../bootstrap/css/normalize.min.css'>";
echo "<link rel='stylesheet' href='../bootstrap/css/style1.css'>";
echo "<title>ProblemSolution_NoChecked List</title>";

/*搜索框*/
$sql="";
if(isset($_GET['keyword'])){
    $keyword=$_GET['keyword'];
    $keyword0="%$keyword%";
    $sql="select problem.`problem_id`,problem.`title`,`problem_analyse`,`time`,`contest_id` FROM `problem_solution_user`,`problem`  where problem_solution_user.problem_id = problem.problem_id and (title like ? or problem_id = ?) and flag = 0";
    $result=pdo_query($sql,$keyword0,$keyword);
}else{
    $sql = "select problem.`problem_id`,problem.`title`,`problem_analyse`,`time`,`contest_id` FROM `problem_solution_user`,`problem`  where problem_solution_user.problem_id = problem.problem_id and flag = 0 order by `problem_id` ASC ";
    $result = pdo_query($sql);
}

echo "<h1 align='center'>ProblemSolution_NoChecked List</h1></br>";

echo "<form action='prosolution_list_noChecked.php' class='center'>";
echo "<input name='keyword' type='text'>";
echo "<input type='submit' class='btn btn-primary btn-sm' value='搜索'>";
echo "</form>";


echo "<div class='container'>";
echo "<center><table width=90% border=1 class=\"table table-bordered\">";

echo "<form method=post action=contest_add.php>";
require_once("../include/set_post_key.php");

echo "<thead><tr class='toprow'><td>PID<td id='title'>Title<td>Analyse<td>Date<td>Cid<td>Checked</tr></thead>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['problem_id'];
    echo "<td style='overflow:hidden;word-break: normal;'><a href='../problem.php?id=".$row['problem_id']."'>".$row['title']."</a>";
    echo "<td>" . $row['problem_analyse'];
    echo "<td>" . $row['time'];
    echo "<td>" . $row['contest_id'];
    echo "<td><input type='button' class='retired' value='通过审核'>" ;


    echo "</tr>";

}

echo "</tr></form>";
echo "</table></div>";

require_once("../include/set_post_key.php");

echo "<div style='text-align:center;clear:both'>
<script src='/gg_bd_ad_720x90.js' type='text/javascript'></script>
<script src='/follow.js' type='text/javascript'></script>
</div>"

?>
<script type="text/javascript" src='../template/bs3/jquery.min.js' ></script>
<script type="text/javascript" src="../include/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    function phpfm(pid){
        //alert(pid);
        $.post("phpfm.php",{'frame':3,'pid':pid,'pass':''},function(data,status){
            if(status=="success"){
                document.location.href="phpfm.php?frame=3&pid="+pid;
            }
        });
    }

    $('.del').click(function () {
        var flagdel = "del";
        if (false === confirm('是否真的要删除当前记录?')) {
            return;
        }
        var tr = $(this).closest("tr");  //closest() 方法返回被选元素的第一个祖先元素。
        var news_id = tr.find("td:eq(0)").text();
        window.location.href = 'news_del.php?flagdel=' + flagdel + '&news_id=' + news_id;

    });

</script>

<style>
    .toprow{
        background-color: #1A5CC8;
        color: #FFFFFF;
        font-weight: bold;
        white-space: nowrap;
        background: url("../image/menu_bg.png");
    }
</style>
