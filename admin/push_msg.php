<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src='https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js'></script>
    <script src='//cdn.bootcss.com/jquery/1.11.3/jquery.js'></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<!--<div class="notification sticky hide">
    <p id="content"></p>
</div>-->
<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
    <h2>Push Message</h2>
</div>
<br/>
<div class="wrapper">
    <div style="width:60%;align:center;margin: 50px auto">

        <h3><span class="label label-primary">向所有人发送:</span></h3>

        <p><span class="label label-default">消息内容</span>&nbsp;<input id="all_text" name="all_message" type="text"
                                                                     value="" style="width:500px; height:20px;"
                                                                     required/></p>
        <p><input class="btn btn-primary" type="button" value="发送" onclick="send_to_all()"/></p>
        <h3><span class="label label-primary">向单用户发送:</span></h3>
        <p><span class="label label-default">用户id</span>&nbsp;&nbsp;&nbsp;&nbsp;<input id="one_uid" name="one_uid"
                                                                                       type="text" value=""
                                                                                       style="width:500px; height:20px;"
                                                                                       required/></p>
        <p><span class="label label-default">消息内容</span>&nbsp;<input id="one_text" name="one_message" type="text"
                                                                     value="" style="width:500px; height:20px;"
                                                                     required/></p>
        <p><input class="btn btn-primary" type="button" value="发送" onclick="send_to_one()"/></p>
        <!--        可以通过url：
                <button id="send_to_one">向指定用户发送消息</button>
                <br>
                可以通过url：<a href="http://39.105.19.50:2121/?type=publish&to=&content=%E6%B6%88%E6%81%AF%E5%86%85%E5%AE%B9"
                           target="_blank" id="send_to_all"><font style="color:#91BD09">http://<font class="domain"></font>:2121?type=publish&to=&content=消息内容</font></a>
                向所有在线用户推送消息<br>
        -->
    </div>
    <br/>
    <div style="width: 60%;text-align:center;margin:50px auto">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">使用帮助</h3>
            </div>
            <div class="panel-body">
                <p><b>HRBUOJ-msg-sender</b> 是一个web消息推送系统，基于PHPSocket.IO开发。</p>
                <ul>
                    <li>多浏览器支持</li>
                    <li>支持针对单个用户推送消息</li>
                    <li>支持向所有用户推送消息</li>
                    <li>长连接推送（websocket或者comet），消息即时到达</li>
                </ul>
                <p>若推送消息成功会返回<b>ok</b>,失败则返回<b>offline</b></p>
                <p><b>offline</b>原因可能：1.推送的用户不在线，2.服务器未开启<b>web-msg-sender</b>，3.检查防火墙端口是否开放</p>
            </div>
        </div>
    </div>
    <script>
        function send_to_all() {
            var uid = "";
            var message = $("#all_text").val();
            alert("发送给所有人：" + message);
            window.open('http://' + document.domain + ':2121/?type=publish&content=' + message);
            //$('#send_to_all').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=' + message);
            $('.uid').html(uid);
            $('.domain').html(document.domain);
            //  window.location.href('insert_push_msg.php?message='+message+'&groupflag='+groupflag)
            //window.open('insert_push_msg.php);
            $.ajax({
                type: "post",   //向指定资源提交数据，请求服务器进行处理
                async: false,   //异步执行
                url: "insert_push_msg.php", //SQL数据库文件
                data: {
                    uid: uid,
                    message: message,
                    groupflag: true,
                },           //发送给数据库的数据
                dataType: "json",   //json类型
                success: function (result) {
                    if (result) {
                        alert("success database");
                    } else {
                        alert("false database");
                    }
                }
            })
        }

        function send_to_one() {
            var uid = $("#one_uid").val();
            var message = $("#one_text").val();
            alert("发送给：" + uid + message);
            window.open('http://' + document.domain + ':2121/?type=publish&content=' + message + '&to=' + uid)
            //$('#send_to_all').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=' + message);
            $('.uid').html(uid);
            $('.domain').html(document.domain);
            $.ajax({
                type: "post",   //向指定资源提交数据，请求服务器进行处理
                async: false,   //异步执行
                url: "insert_push_msg.php", //SQL数据库文件
                data: {
                    uid: uid,
                    message: message,
                    groupflag: false,
                },           //发送给数据库的数据
                dataType: "json",   //json类型
                success: function (result) {
                    if (result) {
                        alert("success database");
                    } else {
                        alert("false database");
                    }
                }
            })

        }

        // 使用时替换成真实的uid，这里方便演示使用时间戳
        /*     $('#send_to_one').attr('href', 'http://' + document.domain + ':2121/?type=publish&content=' + message + '&to=' + uid);
             $('.uid').html(uid);*/


    </script>
</body>
</html>