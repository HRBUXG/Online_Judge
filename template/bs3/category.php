<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script type="text/javascript" src="template/bs3/tagcloud.js"></script>
    <title><?php echo $OJ_NAME ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .fl {
            float: left;
        }

        .fr {
            float: right;
        }

        .wrapper {
            width: 1200px;
            height: 300px;
            margin: 0 auto;
        }

        .wrapper p {
            padding-top: 150px;
            line-height: 27px;
            color: #999;
            font-size: 14px;
            text-align: center;
        }

        .tagcloud {
            position: relative;
            margin-top: -150px;
        }

        .tagcloud a {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            padding: 11px 30px;
            color: #333;
            font-size: 16px;
            border: 1px solid #e6e7e8;
            border-radius: 18px;
            background-color: #f2f4f8;
            text-decoration: none;
            white-space: nowrap;
            -o-box-shadow: 6px 4px 8px 0 rgba(151, 142, 136, .34);
            -ms-box-shadow: 6px 4px 8px 0 rgba(151, 142, 136, .34);
            -moz-box-shadow: 6px 4px 8px 0 rgba(151, 142, 136, .34);
            -webkit-box-shadow: 6px 4px 8px 0 rgba(151, 142, 136, .34);
            box-shadow: 6px 4px 8px 0 rgba(151, 142, 136, .34);
            -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4,Direction=135, Color='#000000')"; /*兼容ie7/8*/
            filter: progid:DXImageTransform.Microsoft.Shadow(color='#969696', Direction=125, Strength=9);
            /*strength是阴影大小，direction是阴影方位，单位为度，可以为负数，color是阴影颜色 （尽量使用数字）使用IE滤镜实现盒子阴影的盒子必须是行元素或以行元素显示（block或inline-block;）*/
        }

        .tagcloud a:hover {
            color: #3385cf;
        }

        /*小黄鸡*/
        .zySearch {
            position: relative;
            width: 520px;
            margin: 40px auto 0 auto;
        }

        .zySearch .search-img {
            background: url("template/bs3/chicken.gif") no-repeat scroll left top transparent;
            display: block;
            height: 0;
            left: 39%;
            margin-left: -12px;
            position: absolute;
            top: 10px;
            width: 24px;
        }

        .zySearch .search-input {
            color: #999;
            border: 1px solid #D0D0D0;
            height: 33px;
            line-height: 33px;
            margin-right: 5px;
            padding: 0 10px;
            width: 368px;
        }

        .zySearch .search-btn {
            background: none repeat scroll 0 0 #F04243;
            border: 0 none;
            border-radius: 0;
            color: #FFFFFF;
            cursor: pointer;
            height: 35px;
            line-height: 33px;
            padding: 0;
            vertical-align: baseline !important;
            width: 76px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            margin-bottom: 0;
            font-weight: normal;
            font-size: 14px;
            display: inline-block;
            position: relative;
        }
    </style>
</head>

<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <!--    <div class="jumbotron">
        <p>
        <center>
            <?php /*echo $view_category */ ?>
        </center>
        </p>
    </div>-->
    <div class="wrapper">
        <p><br/><br/></p>
        <div class="tagcloud fl">

            <?php

            foreach ($category1 as $cat) {
                if (trim($cat) == "") continue;
                $view_category = "<a  href='problemset.php?search=" . htmlentities($cat, ENT_QUOTES, 'UTF-8') . "'>" . $cat . "</a>";
                echo $view_category;
            }

            ?>

            <!--           <a href="#">文献综述</a>
                       <a href="#">对外投资</a>
                       <a href="#">机器人</a>
                       <a href="#">区块链</a>
                       <a href="#">科技创新</a>
                       <a href="#">计算机科学</a>
                       <a href="#">自动驾驶</a>
                       <a href="#">研究价值</a>
                       <a href="#">模式识别</a>
                       <a href="#">自然语言处理</a>-->
        </div>
        <div class="tagcloud fr">
            <?php

            foreach ($category2 as $cat) {
                if (trim($cat) == "") continue;
                $view_category = "<a href='problemset.php?search=" . htmlentities($cat, ENT_QUOTES, 'UTF-8') . "'>" . $cat . "</a>";
                echo $view_category;
            }

            ?>
        </div>
        <p><br/><br/><br/><br/></p>

        <div class="zySearch" id="zySearch"></div>

    </div><!--wrapper-->

</div> <!-- /container -->


<script>
    /*
     * zySearch.js 搜索插件 小黄鸡
    */

    (function ($, undefined) {
        $.fn.zySearch = function (options, param) {
            var otherArgs = Array.prototype.slice.call(arguments, 1);
            if (typeof options == 'string') {
                var fn = this[0][options];
                if ($.isFunction(fn)) {
                    return fn.apply(this, otherArgs);
                } else {
                    throw ("zySearch - No such method: " + options);
                }
            }

            return this.each(function () {
                var para = {};    // 保留参数
                var self = this;  // 保存组件对象

                var defaults = {
                    "width": "355",
                    "height": "33",
                    "callback": function (keyword) {
                        console.info("搜索的关键字");
                        console.info(keyword);
                    }
                };

                para = $.extend(defaults, options);

                this.init = function () {
                    this.createHtml();  // 创建组件html
                };

                /**
                 * 功能：创建上传所使用的html
                 * 参数: 无
                 * 返回: 无
                 */
                this.createHtml = function () {

                    var html = '';
                    html += '<b class="search-img"></b>';
                    html += '<input id="searchInput" class="search-input" type="text" placeholder="搜索你想要的题目标签？">';
                    html += '<button class="search-btn btn">搜索</button>';

                    $(self).append(html);

                    // 初始化html之后绑定按钮的点击事件
                    this.addEvent();
                };


                /**
                 * 功能：绑定事件
                 * 参数: 无
                 * 返回: 无
                 */
                this.addEvent = function () {
                    // 判断现在是否在移动设备上或屏幕小的情况下点击
                    if ($("." + para.parentClass).css("width") != "320px") {  // 不是
                        // 解除事件
                        $('#searchInput').unbind('focus').unbind('blur');
                        // 需要修改图片当前top值
                        $(".search-img").css({"top": "0px", "height": "0px"});
                        $('#searchInput').blur();  // 移除焦点
                        $("#searchInput").bind("focus", function () {
                            $(".search-img").animate({"top": "-23px", "height": "24px"}, "slow");
                        });
                        $("#searchInput").bind("blur", function () {
                            $(".search-img").animate({"top": "0px", "height": "0"}, "slow");
                        });
                    } else {  // 是
                        $('#searchInput').unbind('focus').unbind('blur');
                        $(".search-img").css({"top": "1px", "height": "0px"});
                        $('#searchInput').blur();  // 移除焦点
                        $("#searchInput").bind("focus", function () {
                            $(".search-img").animate({"top": "-40px", "height": "24px"}, "slow");
                        });
                        $("#searchInput").bind("blur", function () {
                            $(".search-img").animate({"top": "1px", "height": "0px"}, "slow");
                        });
                    }

                    // 监听浏览器变化
                    $(window).resize(function () {
                        if ($("." + para.parentClass).css("width") != "320px") {  // 不是
                            // 解除事件
                            $('#searchInput').unbind('focus').unbind('blur');
                            // 需要修改图片当前top值
                            $(".search-img").css({"top": "0px", "height": "0px"});
                            $('#searchInput').blur();  // 移除焦点
                            $("#searchInput").bind("focus", function () {
                                $(".search-img").animate({"top": "-23px", "height": "24px"}, "slow");
                            });
                            $("#searchInput").bind("blur", function () {
                                $(".search-img").animate({"top": "0px", "height": "0"}, "slow");
                            });
                        } else {
                            $('#searchInput').unbind('focus').unbind('blur');
                            $(".search-img").css({"top": "1px", "height": "0px"});
                            $('#searchInput').blur();  // 移除焦点
                            $("#searchInput").bind("focus", function () {
                                $(".search-img").animate({"top": "-40px", "height": "24px"}, "slow");
                            });
                            $("#searchInput").bind("blur", function () {
                                $(".search-img").animate({"top": "1px", "height": "0px"}, "slow");
                            });
                        }
                    });

                    // 添加搜索回车事件
                    document.onkeydown = function (event) {
                        var e = event || window.event || arguments.callee.caller.arguments[0];
                        if (e && e.keyCode == 13) { // enter 键
                            // 回调方法
                            para.callback($("#searchInput").val());
                        }
                    };

                    $(".search-btn").bind("click", function () {
                        // 回调方法

                       // alert($("#searchInput").val());
                        window.location.href="problemset.php?search="+$("#searchInput").val();
                        para.callback($("#searchInput").val());
                    });

                };


                // 初始化上传控制层插件
                this.init();
            });
        };
    })(jQuery);


</script>
<script type="text/javascript">
    $("#zySearch").zySearch({
        "width": "355",
        "height": "33",
        "parentClass": "pageTitle",
        "callback": function (keyword) {
            console.info("搜索的关键字");
            console.info(keyword);
        }
    });
</script>
<script type="text/javascript">
    /*3D标签云*/
    tagcloud({
        selector: ".tagcloud",  //元素选择器
        fontsize: 16,       //基本字体大小, 单位px
        radius: 100,         //滚动半径, 单位px
        mspeed: "normal",   //滚动最大速度, 取值: slow, normal(默认), fast
        ispeed: "normal",   //滚动初速度, 取值: slow, normal(默认), fast
        direction: 135,     //初始滚动方向, 取值角度(顺时针360): 0对应top, 90对应left, 135对应right-bottom(默认)...
        keep: false          //鼠标移出组件后是否继续随鼠标滚动, 取值: false, true(默认) 对应 减速至初速度滚动, 随鼠标滚动
    });
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
</body>
</html>
