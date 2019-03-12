<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="js/echarts.js"></script><!-- 调用js目录下的echarts.js文件 -->
    <script src="js/jquery.js"></script><!-- 调用js目录下的jquery.js文件 -->
</head>
<body>
<div id="static" style="width: 1400px;height:600px;"></div><!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('static'));// 基于准备好的dom，初始化echarts实例
    //=============================================================================================
    var numbers = [], correct_numbers = [], Wrong_number = [], messages = []

    function TestAjax() {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            url: "template/bs3/sql_0312.php", //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        numbers.push(result[i].number);
                        correct_numbers.push(result[i].correct_number);
                        messages.push(result[i].message);
                        console.log(result[i].number);
                        console.log(result[i].correct_number);
                        console.log(result[i].message);
                        Wrong_number[i] = numbers[i] - correct_numbers[i];
                    }
                }
            }
        })
    }

    TestAjax(); //执行异步请求
    var app = {};
    app.title = '柱状图';//标题
    option = null;
    option = {
        title: {   //标题
            text: '柱状图',
            subtext: 'From ExcelHome',  //潜台词
        },
        grid: { //网格设计
            left: '5%', //左侧间距
            right: '5%',    //右侧间距
            bottom: '5%',   //底部间距
            containLabel: true  //包含标签
        },
        tooltip: { //提示框
            trigger: 'item',    //当trigger为’item’时只会显示该点的数据/axis 轴线
            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                type: 'line'        // 默认为直线，可选为：'line' | 'shadow'
            },
            formatter: "{a} <br/>{b}: {c}"
        },
        legend: {   //实例组合表单中的相关元素    name[i]
        },
        toolbox: {  //工具箱
            show: true,    //显示
            feature: { //特征
                mark: {show: true},    //标志
                dataView: {show: true, readOnly: false},   //数据视图 /readonly只读
                restore: {show: true}, //恢复
                saveAsImage: {show: true} //save As Image  另存为图片
            }
        },
        calculable: true, //可计算
        xAxis: [   //横坐标
            {
                type: 'category',  //类型
                data: messages
            }
        ],
        yAxis: [   //纵坐标
            {
                type: 'value', //默认为值类型
                boundaryGap: [0, 0.1]   //边界的差距
            }
        ],
        series: [
            {
                name: '正确量',  //标签
                type: 'bar', //类型：柱状
                //stack: 'sum',   //数据堆积
                barCategoryGap: '50%',  //柱形宽度
                itemStyle: {    //项目风格
                    normal: {   //标准化
                        color: 'Red',    //内部颜色
                        barBorderColor: '#fff',   //边框颜色
                        barBorderWidth: 2,  //边框宽度
                        barBorderRadius: 0,  //半径(圆弧度)
                        label: {   //标签
                            show: true, position: 'top'   //position: 'insideTop' 位置：在…之内的顶部
                        }
                    }
                },
                data: correct_numbers
            },
            {
                name: '错误量',
                type: 'bar',
                //stack: 'sum',
                itemStyle: {
                    normal: {
                        color: 'yellow',  //内部颜色
                        barBorderColor: '#fff',   //边框颜色
                        barBorderWidth: 2,  //边框宽度
                        barBorderRadius: 0,  //半径(圆弧度)
                        label: {   //标签
                            show: true, position: 'top',    //顶部
                            textStyle: {    //标签颜色
                                color: 'blue'
                            }
                        }
                    }
                },
                data: Wrong_number
            },

        ]
    };
    if (option && typeof option === "object") {//选项==选择选项==对象
        myChart.setOption(option, true);//set Option设置选项
    }
</script>
</body>
</html>
