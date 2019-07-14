<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/19
 * Time: 11:40
 */ ?>
<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/6/14
 * Time: 9:17
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="template/bs3/style-1.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="template/bs3/echarts.min.js"></script><!-- 调用js目录下的echarts.js文件 -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title><?php echo "Develop" ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>
</head>

<body>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">快捷搜索</a></li>
            <li><a href="#radar" data-toggle="tab">购买统计</a></li>
            <li><a href="#search" data-toggle="tab">推荐题解</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <form action="mypurchase.php" class="center">
                    <label>题目名称：</label> <input name="keyword" type="text">
                    <input type="submit" value="<?php echo $MSG_SEARCH ?>">
                </form>
                <?php

                //5.设置$page的默认值
                #$page = 1;

                //8.修改$page的值
                $page = empty($_GET['page']) ? 1 : $_GET['page'];
                $conn = mysqli_connect("localhost", "root", "HRBUXGOJ");
                mysqli_query($conn, "set names utf8");
                mysqli_query($conn, "SET time_zone = '+8:00'");
                if (!$conn) {
                    echo "失败";
                }
                mysqli_select_db($conn, "jol");
                $user_id = $_SESSION[$OJ_NAME . '_' . 'user_id'];

                //------------分页开始-------------------
                //1.求出总条数
                $sql = "select count(*) as count from purchase_record where user_id=" . $user_id;
                $result = mysqli_query($conn, $sql);
                $pageRes = mysqli_fetch_assoc($result);
                #var_dump($pageRes);   //13
                $count = $pageRes['count'];

                //2.每页显示数(5)
                $num = 10;

                //3.根据每页显示数求出总页数
                $pageCount = ceil($count / $num);  //向上取整
                #var_dump($pageCount);  //3

                //4.根据总页数求出偏移量
                $offset = ($page - 1) * $num;  //$page默认为 1, 下一步设置

                //------------分页结束-------------------


                //6.修改sql语句
                if (isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                    $keyword = "%$keyword%";
//                    $sql = "select * FROM purchase_record,problem where problem.problem_id=purchase_record.problem_id  and user_id=" . $user_id . " and problem.title like ? ";
                    $sql = "select * FROM purchase_record,problem where problem.problem_id=purchase_record.problem_id and user_id=" . $user_id . " and problem.title like  '{$keyword}'  limit " . $offset . ',' . $num;

                } else {
                    $sql = "select * FROM purchase_record,problem where problem.problem_id=purchase_record.problem_id and user_id=" . $user_id . "  limit " . $offset . ',' . $num;

                }
                $obj = mysqli_query($conn, $sql);
                // $sql = "select * FROM purchase_record,problem where problem.problem_id=purchase_record.problem_id and user_id=" . $user_id . "  limit " . $offset . ',' . $num;
                //$sql = "select * from pushmsg where groupflag='true' order by sendtime desc  limit " . $offset . ',' . $num;

                #$sql = "select * from bbs_user";
                //$obj = mysqli_query($conn, $sql);
                echo "<center>";
                //  echo "<h2>消息列表</h2>";
                echo "<table class=\"table table-hover table-striped\" border = 1 cellspacing = '0' cellpadding = '10'>";
                //echo "<th>用户编号</th><th>题目题号</th><th>评论内容</th><th>发布时间</th><th>操作</th>";
                //                echo "<th>消息内容</th><th>发布时间</th>";
                echo "<thead><tr><td>problem_id<td>title<td>purchase_time<td>purchase_score<td>outlook</tr></thead>";
                while ($row = mysqli_fetch_assoc($obj)) {
                    echo "<tr>";
                    // echo '<td>' . $row['user_id'] . '</td>';
                    //  echo '<td>' . $row['groupflag'] . '</td>';
                    echo "<td><a href='problem.php?id=" . $row['problem_id'] . "'>" . $row['problem_id'] . "</a>";
                    echo "<td>" . $row['title'];
                    echo '<td>' . $row['purchase_time'] . '</td>';
                    //  echo '<td>' . $row['groupflag'] . '</td>';
                    echo '<td>' . $row['purchase_score'] . '</td>';
                    echo "<td><button class='btn btn-info watch' name='btn' onclick='key(this)' value='" . $row['problem_id'] . "'>查看题解</button></td>";
                    echo "</tr>";
                }

                echo "</table>";
                #echo "<a href = 'add.php'>添加</a>";
                echo "<center>";

                //10.设置上一页下一页的$prev和$next
                $prev = $page - 1;
                $next = $page + 1;

                //11.设置页数限制
                if ($prev < 1) {
                    $prev = 1;
                }
                if ($next > $pageCount) {
                    $next = $pageCount;
                }

                //关闭连接
                mysqli_close($conn);
                ?>

                <!--7.添加首页、上一页、下一页、尾页(href没有链接)-->
                <!--9.给定链接,首页和尾页写死，首页就是page=1，尾页是总页数，上一页先用$prev表示，下一步设置，下一页同上一页-->
                <a href="mypurchase.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;
                <a href="mypurchase.php?page=<?php echo $prev; ?>">上一页</a>&nbsp;&nbsp;&nbsp;
                <!--混编简写-->
                <a href="mypurchase.php?page=<?= $next; ?>">下一页</a>&nbsp;&nbsp;&nbsp;
                <a href="mypurchase.php?page=<?= $pageCount; ?>">尾页</a>


            </div>
            <div class="tab-pane fade" id="radar">
                <center>
                    <!--                    <div id="bing" style="width: 1000px;height: 600px"></div>-->
                    <div id="rate" style="width: 1000px;height: 600px"></div>
                    <div id="lou" style="width: 1000px;height: 600px"></div>
                </center>


            </div>
            <div class="tab-pane fade" id="search">
                <div class="loader">
                    <div class="text">Loading...</div>
                    <div class="horizontal">
                        <div class="circlesup">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                        <div class="circlesdwn">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="vertical">
                        <div class="circlesup">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                        <div class="circlesdwn">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
</div> <!-- /container -->

<!--<script>
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
            // url: "template/bs3/purchase_sql.php", //SQL数据库文件
            url: "template/bs3/purchase_sql.php?uid=" +<?php /*echo $user_id*/ ?>, //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                console.log(result);
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        counts.push(result[i].result_i);//push()向数组的末尾添加一个或多个元素，并返回新的长度。
                        console.log(result[i].result_i);//控制台输出
                        if (counts[i] <= 3) {
                            Accepted++;
                        } else if (counts[i] <= 6) {
                            Presentation_Error++;
                        } else {
                            Wrong_Answer++;
                        }
                    }
                    Accepted_i[0] = Accepted;
                    Presentation_Error_i[0] = Presentation_Error;
                    Wrong_Answer_i[0] = Wrong_Answer;
                    // Time_Limit_Exceed_i[0] = Time_Limit_Exceed;
                    // Memory_Limit_Exceed_i[0] = Memory_Limit_Exceed;
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
        title: {
            text: '题解难度比率图',
            subtext: '---对你购买的题解进行统计',
            x: 'center'
        },
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
                radius: ['10%', '50%'],//半径
                center: ['48%', '50%'],
                roseType: 'area',
                data: [
                    {value: Accepted_i, name: '简单题'}, //数据添加赋值
                    {value: Presentation_Error_i, name: '中等题'},
                    {value: Wrong_Answer, name: '困难题'},
                    /*   {value: Time_Limit_Exceed, name: '四星难度'},
                       {value: Memory_Limit_Exceed, name: '五星难度'},*/
                ]
            }
        ]
    };
    if (option && typeof option === "object") {//选项==选择选项==对象
        myChart.setOption(option, true);//set Option设置选项
    }
</script>-->
<!--仪表盘图-->
<script>
    var myChart2 = echarts.init(document.getElementById('rate'));// 基于准备好的dom，初始化echarts实例
    // 初始化counts = [], qw_i = [], qa_i = [], qd_i = []，四个数组，counts = [],盛装从数据库中获取到的数据, qa_i = [],获取qa值,qs_i = [];获取qs值,qd_i = [];获取qd值
    function TestAjax() {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            // url: "template/bs3/purchase_sql.php", //SQL数据库文件
            url: "template/bs3/purchase_rate_sql.php?uid=" +<?php echo $user_id?>, //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                console.log(result);
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        counts.push(result[i].result_i);//push()向数组的末尾添加一个或多个元素，并返回新的长度。
                        console.log(result[i].result_i);//控制台输出
                        if (counts[i] <= 3) {
                            Accepted++;
                        } else if (counts[i] <= 6) {
                            Presentation_Error++;
                        } else {
                            Wrong_Answer++;
                        }
                    }
                    Accepted_i[0] = Accepted;
                    Presentation_Error_i[0] = Presentation_Error;
                    Wrong_Answer_i[0] = Wrong_Answer;
                    // Time_Limit_Exceed_i[0] = Time_Limit_Exceed;
                    // Memory_Limit_Exceed_i[0] = Memory_Limit_Exceed;
                }
            }
        })
    }

    //执行异步请求
    TestAjax();

    var app = {};
    app.title = '仪表';//标题
    option2 = null;
    option2 = {
        tooltip: {
            formatter: "{a} <br/>{b} : {c}%"
        },
        toolbox: {
            feature: {
                restore: {},
                saveAsImage: {}
            }
        },
        series: [
            {
                name: '购买率',
                type: 'gauge',
                detail: {formatter: '{value}%'},
                data: [{value: 50, name: '题解财富排行'}]
            }
        ]
    };

    setInterval(function () {
        option2.series[0].data[0].value = 20;
        myChart2.setOption(option2, true);
    }, 2000);


</script>
<!--漏斗图-->
<script>
    var myChart3 = echarts.init(document.getElementById('lou'));// 基于准备好的dom，初始化echarts实例
    var counts = [], dif1_i = [], dif2_i = [], dif3_i = [], dif4_i = [], dif5_i = [];
    //初始化qa,qs，qd两个整型，qa用于进行做题次数计数，qs用于对做题正确次数计数,qd错误量计数
    var dif1 = 0, dif2 = 0, dif3 = 0, dif4 = 0, dif5 = 0, cnt = 0;

    function TestAjax() {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            // url: "template/bs3/purchase_sql.php", //SQL数据库文件
            url: "template/bs3/purchase_sql.php?uid=" +<?php echo $user_id?>, //SQL数据库文件
            data: {},           //发送给数据库的数据
            dataType: "json",   //json类型
            success: function (result) {
                console.log(result);
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        counts.push(result[i].result_i);//push()向数组的末尾添加一个或多个元素，并返回新的长度。
                        console.log(result[i].result_i);//控制台输出
                        if (counts[i] <= 1.5) {
                            dif1++;
                            cnt++;
                        } else if (counts[i] <= 3) {
                            dif2++;
                            cnt++;
                        } else if (counts[i] <= 4.5) {
                            dif3++;
                            cnt++;
                        } else if (counts[i] <= 6) {
                            dif4++;
                            cnt++;
                        } else {
                            dif5++;
                            cnt++;
                        }
                    }
                    /*           dif1_i[0] = dif1 / cnt;
                               dif2_i[0] = dif2 / cnt;
                               dif3_i[0] = dif3 / cnt;
                               dif4_i[0] = dif4 / cnt;
                               dif5_i[0] = dif5 / cnt;*/
                    dif1 = dif1 / cnt * 100;
                    dif2 = dif2 / cnt * 100;
                    dif3 = dif3 / cnt * 100;
                    dif4 = dif4 / cnt * 100;
                    dif5 = dif5 / cnt * 100;
                }
            }
        })
    }

    //执行异步请求
    TestAjax();
    var app = {};
    app.title = '比率';//标题
    option3 = null;
    option3 = {
        title: {
            text: '题解构成图',
            subtext: '分析你的题解组成'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c}%"
        },
        toolbox: {
            feature: {
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        legend: {
            data: ['入门题', '简单题', '中等题', '进阶题', '困难题']
        },
        calculable: true,
        series: [
            {
                name: '漏斗图',
                type: 'funnel',
                left: '10%',
                top: 60,
                //x2: 80,
                bottom: 60,
                width: '80%',
                // height: {totalHeight} - y - y2,
                min: 0,
                max: 100,
                minSize: '0%',
                maxSize: '100%',
                sort: 'descending',
                gap: 2,
                label: {
                    show: true,
                    position: 'inside'
                },
                labelLine: {
                    length: 10,
                    lineStyle: {
                        width: 1,
                        type: 'solid'
                    }
                },
                itemStyle: {
                    borderColor: '#fff',
                    borderWidth: 1
                },
                emphasis: {
                    label: {
                        fontSize: 20
                    }
                },
                data: [
                    {value: dif1, name: '入门题'},
                    {value: dif2, name: '简单题'},
                    {value: dif3, name: '中等题'},
                    {value: dif4, name: '进阶题'},
                    {value: dif5, name: '困难题'}
                ]
            }
        ]
    };
    if (option3 && typeof option3 === "object") {//选项==选择选项==对象
        myChart3.setOption(option3, true);//set Option设置选项
    }

</script>
<!--弹出框-->
<script src="template/bs3/layer.js"></script>
<!--题解ajax-->
<script>
    function key(x) {

        var key = x.value;

        TAjax(key);

    }

    function TAjax(key) {
        $.ajax({
            type: "post",   //向指定资源提交数据，请求服务器进行处理
            async: false,   //异步执行
            url: "template/bs3/answer_ajax.php", //SQL数据库文件
            data: "problem_id=" + key,           //发送给数据库的数据
            dataType: "text",   //json类型
            success: function (result) {
                console.log(result);
                layer.open({
                    type: 1,
                    title: "题解【" + key + "】",
                    skin: 'layui-layer-rim', //加上边框
                    area: ['800px', '600px'], //宽高
                    content: result
                });
            }
        })
    }

</script>
</body>
</html>
