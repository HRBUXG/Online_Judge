<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type='text/javascript' src='./bootstrap/js/jquery-1.8.3.min.js'></script>
    <script src="./bootstrap/js/echarts.min.js"></script>
</head>
<?php
$cache_time = 10;
$OJ_CACHE_SHARE = false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");
// check user
$user = $_GET['user'];
if (!is_valid_user_name($user)) {
    echo "No such User!";
    exit(0);
}
$view_title = $user . "@" . $OJ_NAME;
$sql = "SELECT `school`,`email`,`nick` FROM `users` WHERE `user_id`=?";
$result = pdo_query($sql, $user);
$row_cnt = count($result);
if ($row_cnt == 0) {
    $view_errors = "No such User!";
    require("template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}

$row = $result[0];
$school = $row['school'];
$email = $row['email'];
$nick = $row['nick'];

// count solved
$sql = "SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`=? AND `result`=4";
$result = pdo_query($sql, $user);
$row = $result[0];
$AC = $row['ac'];

// count submission
$sql = "SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`=? and  problem_id>0";
$result = pdo_query($sql, $user);
$row = $result[0];
$Submit = $row['Submit'];

// update solved 
$sql = "UPDATE `users` SET `solved`='" . strval($AC) . "',`submit`='" . strval($Submit) . "' WHERE `user_id`=?";
$result = pdo_query($sql, $user);
$sql = "SELECT count(*) as `Rank` FROM `users` WHERE `solved`>?";
$result = pdo_query($sql, $AC);
$row = $result[0];
$Rank = intval($row[0]) + 1;

if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    $sql = "SELECT user_id,password,ip,`time` FROM `loginlog` WHERE `user_id`=? order by `time` desc LIMIT 0,10";
    $view_userinfo = pdo_query($sql, $user);
    echo "</table>";

}

$sql = "SELECT result,count(1) FROM solution WHERE `user_id`=? AND result>=4 group by result order by result";
$result = pdo_query($sql, $user);
$view_userstat = array();
$i = 0;
foreach ($result as $row) {
    $view_userstat[$i++] = $row;
}


$sql = "SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`=?  group by md order by md desc ";
$result = pdo_query($sql, $user);//mysql_escape_string($sql));
$chart_data_all = array();
//echo $sql;

foreach ($result as $row) {
    $chart_data_all[$row['md']] = $row['c'];
}

$sql = "SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`=? and result=4 group by md order by md desc ";
$result = pdo_query($sql, $user);//mysql_escape_string($sql));
$chart_data_ac = array();
//echo $sql;

foreach ($result as $row) {
    $chart_data_ac[$row['md']] = $row['c'];
}


/////////////////////////Template
require("template/" . $OJ_TEMPLATE . "/userinfo.php");

/////////////////////////Common foot
if (file_exists('./include/cache_end.php'))
    require_once('./include/cache_end.php');
?>

<!--<body>
<div id="chart" style="height: 450px;width: 450px"></div>
<script>
    var radar_chart = echarts.init(document.getElementById("chart"));
    var option = {
        title: {
            text: '基础雷达图'
        },
        tooltip: {},
//    legend: {
//      data: ['预算分配（Allocated Budget）', '实际开销（Actual Spending）']
//    },
        radar: {
            // shape: 'circle',
            name: {
                textStyle: {
                    color: '#fff',
                    backgroundColor: '#999',
                    borderRadius: 3,
                    padding: [3, 5]
                }
            },
            indicator: [
                { name: '销售', max: 6500},
                { name: '管理', max: 16000},
                { name: '信息技术', max: 30000},
                { name: '客服', max: 38000},
                { name: '研发', max: 52000},
                { name: '市场', max: 25000}
            ]
        },
        series: [{
            // name: '预算 vs 开销（Budget vs spending）',
            type: 'radar',
            // areaStyle: {normal: {}},
            itemStyle: {
                normal: {
                    color: '#a8bcd4'
                }
            },
            data : [
                {
                    value : [4300, 10000, 28000, 35000, 50000, 19000],
                    name : '预算分配（Allocated Budget）'
                },
                //  {
                //     value : [5000, 14000, 28000, 31000, 42000, 21000],
                //     name : '实际开销（Actual Spending）'
                // }
            ]
        }]
    };
    radar_chart.setOption(option);

</script>
</body>
</html>-->

<body style = "margin:10px">
<input type="text" value="" id="val" />
<script type="text/javascript">
    //配置
    var height = 400; //canvas的高度
    var width = 400; //canvas的宽度
    var edgeLength = 100; //六边形的边长
    var pointRadius = 6; //小圆的半径
    document.write('<canvas id="myCanvas" width="' + width + '" height="' + height + '" style="border:1px solid #c3c3c3;">');
</script>
Your browser does not support the canvas element.
</canvas>
<script type="text/javascript">
    //传入canvas的宽度和高度还有六边形的边长，就可以确定一个六边形的六个点的坐标了
    function getHexagonPoints(width, height, edgeLength)
    {
        var paramX = edgeLength * Math.sqrt(3) / 2;
        var marginLeft = (width - 2 * paramX) / 2;
        var x5 = x6 = marginLeft;
        var x2 = x3 = marginLeft + paramX * 2;
        var x1 = x4 = marginLeft + paramX;

        var paramY = edgeLength / 2;
        var marginTop = (height - 4 * paramY) / 2;
        var y1 = marginTop;
        var y2 = y6 = marginTop + paramY;
        var y3 = y5 = marginTop + 3 * paramY;
        var y4 = marginTop + 4 * paramY;

        var points = new Array();
        points[0] = [x1, y1];
        points[1] = [x2, y2];
        points[2] = [x3, y3];
        points[3] = [x4, y4];
        points[4] = [x5, y5];
        points[5] = [x6, y6];
        return points;
    }

    //画五个六边形
    function drawHexagon(sixParam)
    {
        for (var i = 0; i < 6; i++) {
            allPoints[i] = getHexagonPoints(width, height, sixParam - i * sixParam / 5);
            ctx.beginPath();
            ctx.fillStyle = "rgba(0,0,0,0.2)";
            ctx.moveTo(allPoints[i][5][0],allPoints[i][5][1]); //5
            for (var j = 0; j < 6; j++) {
                ctx.lineTo(allPoints[i][j][0],allPoints[i][j][1]); //1
            }
            ctx.stroke();
            ctx.closePath();
            ctx.fill();
        }
    }

    //画交叉的线
    function drawLines()
    {
        ctx.beginPath();
        for (var i = 0; i < 3; i++) {
            ctx.moveTo(allPoints[0][i][0],allPoints[0][i][1]); //1-4
            ctx.lineTo(allPoints[0][i+3][0],allPoints[0][i+3][1]); //1-4
            ctx.stroke();
        }
        ctx.closePath();
    }

    //画覆盖物
    function drawCover()
    {
        ctx.beginPath();
        ctx.fillStyle = "rgba(50,188,125,0.5)";
        ctx.moveTo(coverPoints[5][0],coverPoints[5][1]); //5
        for (var j = 0; j < 6; j++) {
            ctx.lineTo(coverPoints[j][0],coverPoints[j][1]);
        }
        ctx.stroke();
        ctx.closePath();
        ctx.fill();
    }

    //描点
    function drawPoints(pointRadius)
    {
        ctx.fillStyle="#808080";
        for (var i = 0; i < 5; i++) {
            for (var k = 0; k < 6; k++) {
                ctx.beginPath();
                ctx.arc(allPoints[i][k][0],allPoints[i][k][1],pointRadius,0,Math.PI*2);
                ctx.closePath();
                ctx.fill();
            }
        }
    }

    //判断用户点击的位置是否在小圆的范围内
    function judgeRange()
    {
        for (var i = 0; i < 5; i++) {
            for (var k = 0; k < 6; k++) {
                var distance = Math.sqrt((mx - allPoints[i][k][0]) * (mx - allPoints[i][k][0]) + (my - allPoints[i][k][1]) * (my - allPoints[i][k][1]));
                if (distance <= pointRadius) {
                    clickPoints[k] = 5 - i;
                    //将变化的值显示出来
                    $('#val').val(clickPoints);
                    //清空
                    ctx.clearRect(0, 0, width, height);
                    //重绘
                    drawHexagon(edgeLength);
                    drawLines();
                    //给覆盖物确定变化
                    coverPoints[k] = allPoints[i][k];
                    drawCover();
                    drawPoints(pointRadius);
                    return;
                }
            }
        }
    }

    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var allPoints = [];
    var clickPoints = [2, 2, 2, 2, 2, 2];
    var mx,my;
    drawHexagon(edgeLength);
    drawLines();
    //初始化覆盖物
    var coverPoints = allPoints[3];
    drawCover();
    drawPoints(pointRadius);
    $(function(){
        //显示用户选择的权重
        $('#val').val(clickPoints);
    });

    this.mousedown = function(e) {
        //判断浏览器的类型，IE和firefox的offset和layer属性需要减去当前标签到浏览器左上角的距离的。
        if (isFirefox = navigator.userAgent.indexOf("Firefox") > 0 || navigator.userAgent.indexOf("MSIE") > 0) {
            if (e.layerX || e.layerX == 0) {
                mx = e.layerX - c.offsetLeft;
                my = e.layerY - c.offsetTop;
            } else if (e.offsetX || e.offsetX == 0 ){
                mx = e.offsetX - c.offsetLeft;
                my = e.offsetY - c.offsetTop;
            }
        } else {
            if (e.layerX || e.layerX == 0) {
                mx = e.layerX;
                my = e.layerY;
            } else if (e.offsetX || e.offsetX == 0 ){
                mx = e.offsetX;
                my = e.offsetY;
            }
        }
        judgeRange();
    };
    c.addEventListener('mousedown', this.mousedown, false); //添加鼠标点击监听事件
</script>
</body>
</html>


