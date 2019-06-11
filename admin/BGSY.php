
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=webkit">
    <title>导出table表格到excel</title>
    <style type="text/css">
        .table{background-color: transparent;border-collapse: collapse;border-spacing: 0;border: 1px solid #ddd;}
        .tableStyles{font-size: 12px;margin-bottom: 10px;}
        .tableStyles>thead{background-color: #f4f4f4;}
        .tableStyles>thead>tr>td,.table-bordered>thead>tr>th{border-bottom-width: 1px;}
        .tableStyles>thead>tr>th,.tableStyles>tbody>tr>td{padding: 5px;line-height: normal;text-align: center;vertical-align: middle;color: #999;box-sizing: border-box;border: 1px solid #e6e6e6;}
        .tableStyles>tbody>tr{height: 68px;}
        .tableStyles>tbody>tr>td{color: #333;}
        .tableStyles>tbody>tr:hover{background-color: rgba(227,233,239,.5); }
        .tableStyles>tbody>tr>td:hover{background: #6AACF1;color: #fff!important; font-size: 12px; box-sizing: border-box; border: none;padding: 0;cursor: pointer;}
        .tableStyles>tbody>tr>td:hover .color11,.tableStyles>tbody>tr>td:hover .color21{color: #fff;}
    </style>
</head>
<body>
<table class="table tableStyles" id="tables">
    <caption> </caption><!--可以生成表格的标题-->
    <thead>
    <tr>
        <html>
<body>
<body>
    <tr>
        <form action="BGSY.php" method="GET">
            <th> 年级: <input type="text" name="nianji"></th>
            <th> NUMBER1: <input type="text" name="number1"></th>
            <th>  NUMBER2: <input type="text" name="number2"></th>
            <th> NUMBER3: <input type="text" name="number3"></th>
            <th>  NUMBER4: <input type="text" name="number4"></th>
            <th> <input type="submit" value="提交">
        </form></tr>
</body>

</html>
<?php

if(isset($_GET['nianji'])) {
    $_GET['nianji'];
    $_GET['number1'];
    $_GET['number2'];
    $_GET['number3'];
    $_GET['number4'];

    /*打开数据库*/
    $con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    $nianji = $_GET['nianji'];
    $jiaoshi = "aa";
    $ti1 = $_GET['number1'];
    $ti2 = $_GET['number2'];
    $ti3 = $_GET['number3'];
    $ti4 = $_GET['number4'];
    //判断是否是降序输入,如果不是将默认为100，80，50，20
    if($ti1<=$ti2||$ti2<=$ti3||$ti3<=$ti4){
        $ti1=100;
        $ti2=80;
        $ti3=50;
        $ti4=20;

    }
    //public function test3_1($con,$nianji,$jiaosji,$ti1,$ti2,$ti3,$ti4)

    //软件
    $array1 = array();//该年级专业的所有学生，数组定义、数组同步变量定义
    $array2 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//班级人数
    $array3 = $array2;//任课教师
    $array4 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//100
    $array5 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//80
    $array6 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//50
    $array7 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//20
    //计算机
    $array8 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//班级人数
    $array9 = $array2;//任课教师
    $array10 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//100
    $array11 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//80
    $array12 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//50
    $array13 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);//20
    $array14 = array();//年级
    $array15 = array();//班级
    $array16 = array();
    $num = 0;
    $con->query("SET NAMES utf8");//定义字符编码
    $sql = "SELECT user_id,grade,class FROM users WHERE grade = '" . $nianji . "'";//所有的题目
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array1[] = $row['user_id'];
        $array14[] = $row['grade'];
        $array15[] = $row['class'];
        $str = $row['user_id'];

        $hhm = substr($str, 4, 1);
        if ($hhm==4) {//软件
            $j = $row['class'];
            $array2[$j - 1] += 1;
        }elseif ($hhm==2){
            $j = $row['class'];
            $array8[$j - 1] += 1;
        }
        $num++;
    }
    $max = 0;//软件
    $max1 = 0;//计算机
    $con->query("SET NAMES utf8");//定义字符编码
    for ($i = 0; $i < count($array1); $i++) {
        $sql = "SELECT count(*) FROM solution WHERE user_id = '" . $array1[$i] . "'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $str = $array1[$i];

        $hhm = substr($str, 4, 1);
        if ($hhm==4) {//软件
            $j = $array15[$i];
            if ($max < $j) {
                $max = $j;
            }
            $a = $row['count(*)'];
            if ($a >= $ti1) {
                $array4[$j - 1] += 1;
                $array5[$j - 1] += 1;
                $array6[$j - 1] += 1;
                $array7[$j - 1] += 1;
            } elseif ($a >= $ti2) {
                $array5[$j - 1] += 1;
                $array6[$j - 1] += 1;
                $array7[$j - 1] += 1;
            } elseif ($a >= $ti3) {
                $array6[$j - 1] += 1;
                $array7[$j - 1] += 1;
            } elseif ($a >= $ti4) {
                $array7[$j - 1] += 1;
            }
        }elseif ($hhm==2){//计算机
            $j = $array15[$i];

            if ($max1 < $j) {
                $max1 = $j;
            }
            $a = $row['count(*)'];
            if ($a >= $ti1) {
                $array10[$j - 1] += 1;
                $array11[$j - 1] += 1;
                $array12[$j - 1] += 1;
                $array13[$j - 1] += 1;
            } elseif ($a >= $ti2) {
                $array11[$j - 1] += 1;
                $array12[$j - 1] += 1;
                $array13[$j - 1] += 1;
            } elseif ($a >= $ti3) {
                $array12[$j - 1] += 1;
                $array13[$j - 1] += 1;
            } elseif ($a >= $ti4) {
                $array13[$j - 1] += 1;
            }
        }
    }
    ?>
    <?php
    echo "<th>"."$nianji"."级班级"."</th>";
    echo "<th >"."$ti1"."</th>";
    echo "<th >"."$ti2"."</th>";
    echo "<th >"."$ti3"."</th>";
    echo "<th >"."$ti4"."</th>";
    echo "<th >"."合计"."</th>";
    echo "</tr>";
    $n1=0;
    $n2=0;
    $n3=0;
    $n4=0;
    for ($i=0;$i<$max;$i++){
        $b=$i+1;
        echo "<th>"."软件"."$b"."班"."</th>";
        echo "<th >".$array4[$i]."</th>";
        echo "<th >".$array5[$i]."</th>";
        echo "<th >".$array6[$i]."</th>";
        echo "<th >".$array7[$i]."</th>";
        $sum1=$array4[$i]+$array5[$i]+$array6[$i]+$array7[$i];
        echo "<th>".$sum1;
        $n1=$n1+$array4[$i];
        $n2=$n2+$array5[$i];
        $n3=$n3+$array6[$i];
        $n4=$n4+$array7[$i];
        echo "</tr>";
    }
    for ($i=0;$i<$max1;$i++){
        $b=$i+1;
        echo "<th>"."计算机"."$b"."班"."</th>";
        echo "<th >".$array10[$i]."</th>";
        echo "<th >".$array11[$i]."</th>";
        echo "<th >".$array12[$i]."</th>";
        echo "<th >".$array13[$i]."</th>";
        $sum=$array10[$i]+$array11[$i]+$array12[$i]+$array13[$i];
        echo "<th >".$sum."</th>";
        $n1=$n1+$array10[$i];
        $n2=$n2+$array11[$i];
        $n3=$n3+$array12[$i];
        $n4=$n4+$array13[$i];
        echo "</tr>";
    }
    echo "<th >"."合计"."</th>";
    echo "<th >".$n1."</th>";
    echo "<th >".$n2."</th>";
    echo "<th >".$n3."</th>";
    echo "<th >".$n4."</th>";
    $sum=$n1+$n2+$n3+$n4;
    echo "<th >".$sum."</th>";
    echo "</tr>";
    $b="%";
    if($sum==0){
        echo "<th >"."百分比"."</th>";
        echo "<th >".((round(0,4)*100).$b)."</th>";
        echo "<th >".((round(0,4)*100).$b)."</th>";
        echo "<th >".((round(0,4)*100).$b)."</th>";
        echo "<th >".((round(0,4)*100).$b)."</th>";
        echo "<th >"."0%";
    }else{
        echo "<th >"."百分比";
        echo "<th >".((round($n1/$sum,4)*100).$b)."</th>";
        echo "<th >".((round($n2/$sum,4)*100).$b)."</th>";
        echo "<th >".((round($n3/$sum,4)*100).$b)."</th>";
        echo "<th >".((round($n4/$sum,4)*100).$b)."</th>";
        echo "<th >"."100%";
    }

}
?>
</tbody>
</table>

<h3>使用js导出表格到excel</h3>
<p>1.只在谷歌/火狐下起作用，保留单元格合并的效果,下载之后的命名是:下载.xls</p>
<a id="dlink"  style="display:none;"></a>
<input type="button" onclick="tableToExcel('tables', 'name', 'myfile.xls')" value="Export to Excel">
<script type="text/javascript">
    var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) },
            format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) };
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
        }
    })()
</script>

<hr />
<p>2.谷歌/qq浏览器（极速行，兼容不行）都可以，没有合并单元格的效果;</p>
<p>IE需要装OFFICE excel???</p>
<p>火狐下载的文件不能进行命名</p>
<input id="Button1" type="button" value="导出EXCEL" onclick="javascript:excels('tables')" />
<script type="text/javascript">
    var timer;
    function getExplorer(){//获取浏览器
        var explorer=window.navigator.userAgent;
        if(explorer.indexOf("MSIE") >= 0|| (explorer.indexOf("Windows NT 6.1;") >= 0 && explorer.indexOf("Trident/7.0;") >= 0)){
            return 'ie';
        }else if (explorer.indexOf("Firefox") >= 0) {
            return 'Firefox';
        }else if(explorer.indexOf("Chrome") >= 0){
            return 'Chrome';
        }else if(explorer.indexOf("Opera") >= 0){
            return 'Opera';
        }else if(explorer.indexOf("Safari") >= 0){
            return 'Safari';
        }
    }
    function excels(table){
        if(getExplorer()=='ie'){
            var curTbl = document.getElementById(table);
            var oXl=new ActiveXObject("Excel.Application");//创建AX对象excel
            var oWB = oXL.Workbooks.Add();//获取workbook对象
            var xlsheet = oWB.Worksheets(1);//激活当前sheet
            var sel = document.body.createTextRange();
            sel.moveToElementText(curTbl);//把表格中的内容移到TextRange中
            sel.select;//全选TextRange中内容
            sel.execCommand("Copy");//复制TextRange中内容
            xlsheet.Paste();//粘贴到活动的EXCEL中
            oXL.Visible = true;//设置excel可见属性
            try{
                var filename = oXL.Application.GetSaveAsFilename("Excel.xls", "Excel Spreadsheets (*.xls), *.xls");
            }catch(e){
                window.print("Nested catch caught " + e);
            }finally{
                oWB.SaveAs(filename);
                oWB.Close(savechanges = false);
                oXL.Quit();
                oXL = null;//结束excel进程，退出完成
                timer = window.setInterval("Cleanup();", 1);
            }
        }else{
            tableToExcel("tables");
        }
    }
    function Cleanup(){
        window.clearInterval(timer);
        CollectGarbage();//CollectGarbage,是IE的一个特有属性,用于释放内存的
    }
    var tableToExcel=(function(){
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g,
                    function(m, p) { return c[p]; }) };
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table);
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML};
            window.location.href = uri + base64(format(template, ctx))
        }
    })();
</script>
</body>
</html>