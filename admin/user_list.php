<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="../bootstrap/css/layui.css" type="text/css" rel="stylesheet">

</head>

<?php require("admin-header.php");

        if(isset($OJ_LANG)){
                require_once("../lang/$OJ_LANG.php");
        }

echo "<title>User List</title>";
echo "<center><h2>User List</h2></center>";
require_once("../include/set_get_key.php");
$sql="";
if(isset($_GET['keyword'])){
	$keyword=$_GET['keyword'];
	$keyword="%$keyword%";
	 $sql="select `user_id`,`nick`,`reg_time`,`ip`,`school`,`defunct` FROM `users` where user_id like ? or nick like ? ";
	 $result=pdo_query($sql,$keyword);
}else{
     $sql="select `user_id`,`nick`,`reg_time`,`ip`,`school`,`defunct` FROM `users`  order by `user_id` ASC;";
	 $result=pdo_query($sql);
}
?>
<form action=user_list.php class=center><input name=keyword><input type=submit value="<?php echo $MSG_SEARCH?>" ></form>

<?php
echo "<center><table class='table table-striped' width=90% border=1>";
echo "<tr><td>UserID<td>Nick<td>Status<td>RegTime<td>IP<td>School";
echo "</tr>";
foreach($result as $row){
    echo "<tr>";
    echo "<td><a href='../userinfo.php?user=".$row['user_id']."'>".$row['user_id']."</a>";
    echo "<td>".$row['nick'];
    $cid=$row['user_id'];
    if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
        echo "<td><a href=user_df_change.php?cid=".$row['user_id']."&getkey=".$_SESSION[$OJ_NAME.'_'.'getkey'].">".($row['defunct']=="N"?"<span class=green>Available</span>":"<span class=red>Reserved</span>")."</a>";
    }else{
        echo "<td>No permissions";
    }
    echo "<td>".$row['reg_time'];
    echo "<td>".$row['ip'];
    echo "<td>".$row['school'];
    echo "</tr>";
}
echo "</table></center>";
require("../oj-footer.php");
?>

<body>
<center style="padding-top: 40px">

    <div style="width: 80%;padding-top: 20px">
        <!--以下为两个必须div元素-->
        <div id="table"></div>
        <div id="pageBar"></div>
    </div>

</center>

</body>

<script src="../bootstrap/js/jquery-1.10.2.js"></script>
<script language="Javascript" src="../bootstrap/js/layui.js"></script>
<script language="Javascript" src="../bootstrap/js/nicePage.js"></script>
<script LANGUAGE="javascript">
    //标准json格式 目前只支持[{a:b,c:d},{a:b,c:d}]此种格式
    foreach($result as $row)
    {
        var json = [{
            "UserID": "<a>哈哈哈</a>",
            "Nick": "Tom",
            "Status": "12",
            "RegTime": "12",
            "IP": "12",
            "School": "12"
        }/*, {
         "UserID": "2",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         },{
         "UserID": "5",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "6",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "7",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "8",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "9",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "10",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "11",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "12",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "13",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "14",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "15",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "16",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "17",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "18",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "19",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12",
         }, {
         "UserID": "20",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }, {
         "UserID": "21",
         "Nick": "Tom",
         "Status": "12",
         "RegTime": "12",
         "IP": "12",
         "School": "12"
         }*/];
    }

    //nameList与widthList的数组长度要一致
    var nameList = ['UserID', 'Nick', 'Status','RegTime', 'IP', 'School'] //table的列名
    var widthList = [50, 50, 50,50, 50, 50] //table每列的宽度

    /**
     * 初始化设置nicepage组件    v1.0
     *-------------------------------------------------------------
     * 进行数据组装,与layui交互进行元素渲染
     *-------------------------------------------------------------
     * @param    {string}  table     table的div id
     * @param    {string}  bar     底部分页的div id
     * @param    {int}  limit     每页默认行数
     * @param    {string}  color     底部分页的颜色
     * @param    {array}  layout     底部分页的布局,具体可参考layui api
     *
     * @date     2018-10-19
     * @author   duzhen wechat：wenxuejn
     */
    $(function () {
        nicePage.setCfg({
            table: 'table',
            bar: 'pageBar',
            limit: 20,
            color: '#1E9FFF',
            layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
        });
    }); //初始化完成
</script>

</html>
