<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="template/bs3/echarts.js"></script><!-- 调用js目录下的echarts.js文件 -->
    <script src="template/bs3/jquery.min.js"></script><!-- 调用js目录下的jquery.js文件 -->
</head>
<body>
<div id="main" style="width: 100%;height: 400px;"></div><!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));// 基于准备好的dom，初始化echarts实例
    // 初始化counts = [], qw_i = [], qa_i = [], qd_i = []，四个数组，counts = [],盛装从数据库中获取到的数据, qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值
    var counts = [], qa_i = [], qs_i = [], qd_i = [];
    //初始化qa,qs，qd两个整型，qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
    var qa = 0, qs = 0, qd = 0;

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
                            qs++;
                        }
                        qa
                        qa_i[0] = qa;//qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值,qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
                        qs_i[0] = qs;

                        qd = qa - qs;
                        qd_i[0] = qd;
                    }
                }
            })
    }

    //执行异步请求
    TestAjax();
    //=============================================================================================
    var app = {};
    app.title = '饼图';//标题++;
    }
    option = null;
    option = {
        tooltip: {//提示框
            trigger: 'item',//当trigger为’item’时只会显示该点的数据
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {//实例组合表单中的相关元素    name[i]
            orient: 'vertical',//方向：垂直
            x: 'right'//矩形的左上角
        },
        series: [//一维数组结构
            {
                name: '访问来源',//标签
                type: 'pie',//类型：圆饼
                selectedMode: 'single',//为series属性的每一项添加一个selectedMode属性 'single':单选
                radius: [0, '50%'],//半径
                label: {//标签
                    normal: {
                        position: 'inner'//位置：内部
                    }
                },
                labelLine: {//加标签
                    normal: {
                        show: false
                    }
                },
                data: [
                    {value: qa_i, name: '题目提交量'},//value 数值  value:[123]
                    {value: qs_i, name: '答题正确量'},
                    {value: qd_i, name: '答题错误量'}
                ]
//                data:[
//                    {value:nums[0], name:places[0]}, //数据添加赋值
//                    {value:nums[1], name:places[1]},
//                    {value:nums[2], name:places[2]},
//                    {value:nums[3], name:places[3]},
//                    {value:nums[4], name:places[4]},
//                    {value:nums[5], name:places[5]},
//                    {value:nums[6], name:places[6]},
//                    {value:nums[7], name:places[7]},
//                    {value:nums[8], name:places[8]},
//                    {value:nums[9], name:places[9]},
//                    {value:nums[10], name:places[10]},
//                    {value:nums[11], name:places[11]},
//                    {value:nums[12], name:places[12]},
//                    {value:nums[13], name:places[13]},
//                    {value:nums[14], name:places[14]}
//                ]
            }
        ]
    };
    if (option && typeof option === "object") {//选项==选择选项==对象
        myChart.setOption(option, true);//set Option设置选项
    }
</script>
</body>
</html>
