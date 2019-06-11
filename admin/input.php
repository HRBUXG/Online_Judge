
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <!-- 引入 echarts.js -->
    <script src="echarts.js"></script>
    <script src="jquery.js"></script
</head>
<body>
<form name="fro" method="get" action="time2.php" onsubmit="return foo()" target="frame1">

    起始日期: <input name="start" type="date" value="" index="2016">
    终止日期: <input name="end" type="date" value="" index="2016">
    <input type="submit">
</form>
<iframe name="frame1"src="time2.php" frameborder="0" width="600" scrolling="No" height="400" leftmargin="10" topmargin="60">
</iframe>
<script type="text/javascript">
    function foo() {

        return true;
    }
    </script>

</body>
</html>