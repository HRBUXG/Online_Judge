
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="echarts.js"></script>
    <script src="jquery.js"></script
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例

    var str = window.location.href;
    console.log(str);

    var times = [], nums = [],y=1,r=1,n1=2019,y1=3,r1=10, start = str.slice(str.length-25,str.length-15), end = str.slice(str.length-10);
    var a = start.split('-');
    var b = end.split('-');
    document.write(start);//在页面上显示a的值1

    function TestAjax(){

        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            url: "time4.php", //SQL数据库文件
            data: {n:a[0],y:a[1],r:a[2],n1:b[0],y1:b[1],r1:b[2]},//发送给数据库的数据
            dataType: "json",   //json类型
            success: function(result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        times.push(result[i].time);
                        nums.push(result[i].num);

                        console.log(result[i].time);
                        console.log(result[i].num);
                    }
                }
            }
        })

    }
    TestAjax(); //执行异步请求

    var myChart = echarts.init(document.getElementById('main'));
    // 指定图表的配置项和数据
    var date = [];//鼠标显示,最小单位天,初始化
    var data = [];//数据的值，初始化

    for (var i = 1; i < times.length; i++) {//可以上n-1条数据，天数

            date.push(times[i]);//鼠标显示,最小单位天
            data.push(nums[i]);//数据的值
    }

    var option = {
        tooltip: {
            trigger: 'axis',
            position: function (pt) {
                return [pt[0], '10%'];
            }
        },
        title: {
            left: 'center',
            text: '大数据量面积图',
        },
        toolbox: {
            feature: {
                dataZoom: {
                    yAxisIndex: 'none'
                },
                restore: {},
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: date
        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, '100%']
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 10
        }, {
            start: 0,
            end: 10,
            handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
            handleSize: '80%',
            handleStyle: {
                color: '#fff',
                shadowBlur: 3,
                shadowColor: 'rgba(0, 0, 1, 0.6)',
                shadowOffsetX: 2,
                shadowOffsetY: 2
            }
        }],
        series: [
            {
                name:'模拟数据',
                type:'line',
                smooth:true,
                symbol: 'none',
                sampling: 'average',
                itemStyle: {
                    color: 'rgb(255, 70, 131)'
                },
                areaStyle: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgb(255, 158, 68)'
                    }, {
                        offset: 1,
                        color: 'rgb(255, 70, 131)'
                    }])
                },
                data: data
            }
        ]
    };


        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);

</script>
</body>
</html>