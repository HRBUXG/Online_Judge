<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Title</title>
</head>
<body>
<div id="header" style="padding:5px;margin-bottom:50px;background-color:#000; color:#FFF;text-align:center;">
    <h2>Export Excel</h2>
</div>
<center>


    <form action="makecsv.php" method="post">
        <lable>选择年级：</lable>
        <select id="grade" name="grade">
            <option value="16______">2016级</option>
            <option value="17______">2017级</option>
            <option value="18______">2018级</option>
        </select>
        <br>
        <lable>开始时间：</lable>
        <input class=input-large type=date name='startdate'
               value='<?php echo date('Y') . '-' . date('m') . '-' . date('d') ?>'
               size=4>
        Hour:<input class=input-mini type=text name=shour size=2 value=<?php echo date('H') ?>>&nbsp;
        Minute:<input class=input-mini type=text name=sminute value=00 size=2>
        <br>
        <lable>结束时间：</lable>
        <input class=input-large type=date name='enddate'
               value='<?php echo date('Y') . '-' . date('m') . '-' . date('d') ?>'
               size=4>
        Hour:<input class=input-mini type=text name=ehour size=2 value=<?php echo (date('H') + 4) % 24 ?>>&nbsp;
        Minute:<input class=input-mini type=text name=eminute value=00 size=2>
        <br>
        <br>
        <br>
        <input type="submit" value="导出">
    </form>
</center>

<div style="width: 60%;text-align:center;margin:50px auto">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">使用帮助</h3>
        </div>
        <div class="panel-body">
            <p>管理员/老师，选择一段区间内时间。</p>
            <p>你可以导出该时间段内的学生刷题情况统计表格。</p>
        </div>
    </div>
</div>
</body>
</html>