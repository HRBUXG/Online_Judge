<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <script src='https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js'></script>
    <script src='//cdn.bootcss.com/jquery/1.11.3/jquery.js'></script>
</head>
<body>

<div class="notification sticky hide">
    <p id="content"></p>
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

        <p><input id="mytext" name="message" type="text" value="" style="width:500px; height:20px;" required /></p>
        <p><input type="button" value="发送" onclick="send_to_all()"/></p>

<!--        可以通过url：
        <button id="send_to_one">向指定用户发送消息</button>
        <br>
        可以通过url：<a href="http://39.105.19.50:2121/?type=publish&to=&content=%E6%B6%88%E6%81%AF%E5%86%85%E5%AE%B9"
                   target="_blank" id="send_to_all"><font style="color:#91BD09">http://<font class="domain"></font>:2121?type=publish&to=&content=消息内容</font></a>
        向所有在线用户推送消息<br>
-->
    </div>
    <script>
        function send_to_all() {
            var uid = "16044325";
            var message = $("#mytext").val();
            alert(message);
            window.open('http://' + document.domain + ':2121/?type=publish&content=' + message)
            //$('#send_to_all').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=' + message);
            $('.uid').html(uid);
            $('.domain').html(document.domain)
        }


        // 使用时替换成真实的uid，这里方便演示使用时间戳
        /*     $('#send_to_one').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=' + message + '&to=' + uid);
             $('.uid').html(uid);*/

    </script>
</body>
</html>