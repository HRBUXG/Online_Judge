<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

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
    <input type="submit" value="导出">
</form>

</body>
</html>