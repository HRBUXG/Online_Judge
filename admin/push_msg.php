<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="main.css" rel="stylesheet" type="text/css"/>
    <script src='https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js'></script>
    <script src='//cdn.bootcss.com/jquery/1.11.3/jquery.js'></script>
    <script src='/notify.js'></script>
</head>
<body>

<div class="notification sticky hide">
    <p id="content"></p>
    <a class="close" href="javascript:"> <img src="./icon-close.png"/></a>
</div>
<div class="wrapper">
    <div style="width:850px;">
        <h3>介绍:</h3>
        <b>HRBUOJ-msg-sender</b> 是一个web消息推送系统，基于PHPSocket.IO开发。<br><br><br>
        <h3>支持以下特性：</h3>
        <ul>
            <li>多浏览器支持</li>
            <li>支持针对单个用户推送消息</li>
            <li>支持向所有用户推送消息</li>
            <li>长连接推送（websocket或者comet），消息即时到达</li>
            <li>支持在线用户数实时统计推送（见页脚统计）</li>
            <li>支持在线页面数实时统计推送（见页脚统计）</li>
        </ul>
        <h3>测试:</h3>
        当前用户uid：<b class="uid"></b> <?php echo $_SESSION[$OJ_NAME . '_' . 'user_id'] ?><br>
        可以通过url：<a id="send_to_one"
                   href="http://192.168.200.129:2121/?type=publish&to=1445590039000&content=%E6%B6%88%E6%81%AF%E5%86%85%E5%AE%B9"
                   target="_blank"><font style="color:#91BD09">http://<font class="domain"></font>:2121?type=publish&to=<b
                        class="uid"></b>&content=消息内容</font></a> 向当前用户发送消息<br>
        可以通过url：<a href="http://192.168.200.129:2121/?type=publish&to=&content=%E6%B6%88%E6%81%AF%E5%86%85%E5%AE%B9"
                   target="_blank" id="send_to_all"><font style="color:#91BD09">http://<font class="domain"></font>:2121?type=publish&to=&content=消息内容</font></a>
        向所有在线用户推送消息<br>
        <script>
            // 使用时替换成真实的uid，这里方便演示使用时间戳
            var uid = Date.parse(new Date());
            $('#send_to_one').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=%E6%B6%88%E6%81%AF%E5%86%85%E5%AE%B9&to=' + uid);
            $('.uid').html(uid);
            $('#send_to_all').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=%E6%B6%88%E6%81%AF%E5%86%85%E5%AE%B9');
            $('.uid').html(uid);
            $('.domain').html(document.domain);
        </script>
    </div>

    <script>
        $(document).ready(function () {
            // 连接服务端
            var socket = io('http://' + document.domain + ':2120');
            // 连接后登录
            socket.on('connect', function () {
                socket.emit('login', uid);
            });
            // 后端推送来消息时
            socket.on('new_msg', function (msg) {
                $('#content').html('收到消息：' + msg);
                $('.notification.sticky').notify();
            });
            // 后端推送来在线数据时
            socket.on('update_online_count', function (online_stat) {
                $('#online_box').html(online_stat);
            });
        });
    </script>
</body>
</html>
