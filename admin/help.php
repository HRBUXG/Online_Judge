<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <script src="../template/bs3/jquery.min.js"></script>
    <title>Document</title>

    <style>

        body{
            background-image:url(../image/p5.jpg);
            background-repeat: no-repeat;
            width:100%;
            height:660px;
        }

        h2{
            padding-top: 5% !important;
            color: #275b28;
            font-family: comic sans ms !important;
        }

        .time{
            width: 200px;
            height: 200px;
            align:right;

        }

    </style>

</head>
<body>

<div class="setbg">
    <!--欢迎字段显示-->
    <div class="pageTitle">

        <h2 align="center" style="font-size: 60px">Welcome to ACM backstage</h2>
    </div>
    <!--日历和时间的显示-->
    <!--<div class="time" style="padding: 0px 80% 0px 0px">
       <?php /* require_once("./index.html"); */?>
    </div>-->


    <?php require_once("./index.html"); ?>





</div>


</body>
<script type="text/javascript">
    //鼠标特效
    var a_idx = 0;
    jQuery(document).ready(function ($) {
        $("body").click(function (e) {
            var a = new Array(
                "广度优先遍历", "深度优先遍历", "拓扑排序", "栈", "队列", "链表", "哈希表", "哈希数组", " 堆", "棋盘分割", "Prim算法", "最短路径");
            var $i = $("<span/>").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX,
                y = e.pageY;
            $i.css({
                "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                    "top": y - 180,
                    "opacity": 0
                },
                1500,
                function () {
                    $i.remove();
                });
        });
    });




</script>
</html>


