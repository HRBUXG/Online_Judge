<!DOCTYPE html>
<html>
<?php require("admin-header.php");
if(isset($OJ_LANG)){
    require_once("../lang/$OJ_LANG.php");
}
require_once("../include/set_get_key.php");

if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])
    ||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])
    ||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])
)){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
echo "<head lang='en'>";
echo "<meta charset='utf-8'>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
echo "<link rel='stylesheet' href='../bootstrap/css/normalize.min.css'>";
echo "<link rel='stylesheet' href='../bootstrap/css/style1.css'>";
//多条件筛选资源
echo "<link rel='stylesheet' href='../bootstrap/css/index.css'>";
echo "<script src='../bootstrap/js/jquery1.js' type='text/javascript'></script>";

echo "<title>ProblemSolution List</title>";
echo "</head>";
echo "<body>";

echo "<h1 align='center'>ProblemSolution List</h1></br>";


$sql="SELECT max(`problem_id`) as upid FROM `problem_solution`";
$page_cnt=100;
$result=pdo_query($sql);
$row=$result[0];
$cnt=intval($row['upid'])-1000;
$cnt=intval($cnt/$page_cnt)+(($cnt%$page_cnt)>0?1:0);
if (isset($_GET['page'])){
    $page=intval($_GET['page']);
}else $page=$cnt;
$pstart=1000+$page_cnt*intval($page-1);
$pend=$pstart+$page_cnt;
echo "<div class='container'>";
echo "<form action=prosolution_list.php>";


echo "<select style='font-size: 13px' class='input-mini' onchange=\"location.href='prosolution_list.php?page='+this.value;\">";
for ($i=1;$i<=$cnt;$i++){
    if ($i>1) echo '&nbsp;';
    if ($i==$page) echo "<option value='$i' selected>";
    else  echo "<option value='$i'>";
    echo $i+9;
    echo "</option>";
}
echo "</select>";

/*搜索框*/
$sql="";
if(isset($_GET['keyword'])){
    $keyword=$_GET['keyword'];
    $myKeyword = str_replace(",","%",$keyword);
    $myKeyword="%$myKeyword%";
    //echo $myKeyword;

    /*$var=explode(",",$keyword);
     $result = array();

     for ($i = 0; $i < count($var); ++$i) {
         $var[$i] = '%'.$var[$i] . '%';
         //echo $var[$i]."</br>";
         //$result = array_merge_recursive($result,$result0); 合并多个php数组

     }*/

    $sql="select `problem_id`,`problem_title`,`problem_analyse_summary`,`source`,`time` FROM `problem_solution` where `problem_title` like ? or `problem_analyse_summary` like ? or `source` like ? or `time` like ? ";

/*    select `problem_id`,`problem_title`,`problem_analyse_summary`,`source`,`time` FROM
(select `problem_id`,`problem_title`,`problem_analyse_summary`,`source`,`time` FROM
(select `problem_id`,`problem_title`,`problem_analyse_summary`,`source`,`time` FROM
(select `problem_id`,`problem_title`,`problem_analyse_summary`,`source`,`time` FROM `problem_solution` where `problem_title` like "%例题%") as a where `source` like "%C语言%") as b where `time` like "%2019%") as c where `problem_analyse_summary` like "%hh%"*/

    $result=pdo_query($sql,$myKeyword,$myKeyword,$myKeyword,$myKeyword);

    //echo gettype($result);
}else{
    $sql = "select `problem_id`,`problem_title`,`problem_analyse_summary`,`source`,`time` FROM `problem_solution`  where problem_id>=? and problem_id<=? order by `problem_id` ASC ";
    $result=pdo_query($sql,$pstart,$pend);
}

/*echo "<form action='prosolution_list.php' class='center' method='post'>";
echo "<input placeholder='请输入附加筛选条件' style='font-size: 12px' id='keyword''>";
echo "<input class='btn btn-primary btn-sm' type='submit' value='搜索' onclick='show()'>";
echo "<input type='hidden' style='font-size: 12px' id='mytext' name='keyword'>";
echo "</form>";*/
?>


<?php
echo "<center><table width='1000px' border='1' class='table table-bordered'>";
echo "<form method=post action=contest_add.php>";
require_once("../include/set_post_key.php");
echo "<tr>";

echo "<input type='checkbox' onchange='$(\"input[type=checkbox]\").prop(\"checked\", this.checked)'>";
echo "<input type='submit' name='delete' style='font-size: 15px;background-color: lightgray' value='点击删除选中的数据' onclick='$(\"form\").attr(\"action\",\"prosolution_df_change.php\")'>";

echo "</tr>" ;

echo "<thead><tr class='toprow' style='font-size: 16px'><td>Pid<td id='title'>Title<td>AnalyseSummary<td>Source<td>Date<td>Edit</tr></thead>";
foreach ($result as $row) {
    echo "<tr style='font-size: 15px'>";
    echo "<td>" . $row['problem_id'];
    echo "</br>";
    echo "<input type=checkbox name='pid[]' value='".$row['problem_id']."'>";
    echo "<td style='overflow:hidden;word-break: normal;'><a href='../problem.php?id=".$row['problem_id']."'>".$row['problem_title']."</a>";
    echo "<td>" . $row['problem_analyse_summary'];
    echo "<td>" . $row['source'];
    echo "<td>" . $row['time'];
    echo "<td><a href=prosolution_edit.php?id=" . $row['problem_id'] . "&getkey=".$_SESSION[$OJ_NAME.'_'.'getkey'].">Edit</a>";
    echo "</tr>";

}

echo "</tr></form>";
echo "</table></center></div>";

require_once("../include/set_post_key.php");

echo "<div style='text-align:center;clear:both'>
<script src='/gg_bd_ad_720x90.js' type='text/javascript'></script>
<script src='/follow.js' type='text/javascript'></script>
</div>"

?>
<script type="text/javascript" src='../template/bs3/jquery.min.js' ></script>
<script type="text/javascript" src="../include/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    function show() {
        var str = $('.options').text();  //选中的所有标签的值
        var keyword = document.getElementById("keyword");  //搜索框里面的附加条件值
        var strs= new Array();
        strs = str.split("x");

        var content = strs + keyword.value;  //原始input域中的值
        var content0 = content.replace("清除全部",""); //处理后的input域中的值
        document.getElementById('mytext').value= content0;

    }


    function phpfm(pid){
        //alert(pid);
        $.post("phpfm.php",{'frame':3,'pid':pid,'pass':''},function(data,status){
            if(status=="success"){
                document.location.href="phpfm.php?frame=3&pid="+pid;
            }
        });
    }

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

<script src="../bootstrap/js/index1.js" type="text/javascript"></script>
</body>
</html>





