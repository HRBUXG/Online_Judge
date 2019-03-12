<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="template/bs3/echarts.js"></script><!-- 调用js目录下的echarts.js文件 -->
    <script src="template/bs3/jquery.min.js"></script><!-- 调用js目录下的jquery.js文件 -->
</head>
<body>
<div id="bing" style="width: 100%;height:400px;"></div><!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('bing'));// 基于准备好的dom，初始化echarts实例
    // 初始化counts = [], qw_i = [], qa_i = [], qd_i = []，四个数组，counts = [],盛装从数据库中获取到的数据, qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值
    var counts = [], Accepted_i = [], Presentation_Error_i = [], Wrong_Answer_i = [], Time_Limit_Exceed_i = [],
        Memory_Limit_Exceed_i = [], Output_Limit_Exceed_i = [], Runtime_Error_i = [], Compile_Error_i = [];
    //初始化qa,qs，qd两个整型，qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
    var Accepted = 0, Presentation_Error = 0, Wrong_Answer = 0, Time_Limit_Exceed = 0, Memory_Limit_Exceed = 0,
        Output_Limit_Exceed = 0, Runtime_Error = 0, Compile_Error = 0;

    function TestAjax() {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            url: "template/bs3/sql.php", //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        counts.push(result[i].result_i);//push()向数组的末尾添加一个或多个元素，并返回新的长度。
                        //console.log(result[i].result_i);//控制台输出
                        if (counts[i] === '4') {
                            Accepted++;
                        } else if (counts[i] === '5') {
                            Presentation_Error++;
                        } else if (counts[i] === '6') {
                            Wrong_Answer++;
                        } else if (counts[i] === '7') {
                            Time_Limit_Exceed++;
                        } else if (counts[i] === '8') {
                            Memory_Limit_Exceed++;
                        } else if (counts[i] === '9') {
                            Output_Limit_Exceed++;
                        } else if (counts[i] === '10') {
                            Runtime_Error++;
                        } else if (counts[i] === '11') {
                            Compile_Error++;
                        }
                    }
                    Accepted_i[0] = Accepted;
                    Presentation_Error_i[0] = Presentation_Error;
                    Wrong_Answer_i[0] = Wrong_Answer;
                    Time_Limit_Exceed_i[0] = Time_Limit_Exceed;
                    Memory_Limit_Exceed_i[0] = Memory_Limit_Exceed;
                    Output_Limit_Exceed_i[0] = Output_Limit_Exceed;
                    Runtime_Error_i[0] = Runtime_Error;
                    Compile_Error_i[0] = Compile_Error;
                }
            }
        })
    }

    //执行异步请求
    TestAjax();
    //=============================================================================================
    var app = {};
    app.title = '饼图';//标题
    option = null;
    option = {
        tooltip: {//提示框
            trigger: 'item',//当trigger为’item’时只会显示该点的数据
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {//实例组合表单中的相关元素    name[i]
            orient: 'vertical',//方向：垂直
            x: 'left'//矩形的左上角
        },
        series: [//一维数组结构
            {
                name: '访问来源',//标签
                type: 'pie',//类型：圆饼
                selectedMode: 'single',//为series属性的每一项添加一个selectedMode属性 'single':单选
                radius: [0, '50%'],//半径

                data: [
                    {value: Accepted_i, name: 'Accepted'}, //数据添加赋值
                    {value: Presentation_Error_i, name: 'Presentation_Error'},
                    {value: Wrong_Answer, name: 'Wrong_Answer'},
                    {value: Time_Limit_Exceed, name: 'Time_Limit_Exceed'},
                    {value: Memory_Limit_Exceed, name: 'Memory_Limit_Exceed'},
                    {value: Output_Limit_Exceed, name: 'Output_Limit_Exceed'},
                    {value: Runtime_Error, name: 'Runtime_Error'},
                    {value: Compile_Error, name: 'Compile_Error'},
                ]
            }
        ]
    };
    if (option && typeof option === "object") {//选项==选择选项==对象
        myChart.setOption(option, true);//set Option设置选项
    }
</script>
</body>
</html>
