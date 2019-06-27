<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
</head>
<body>
<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
    <h2>Set Compiler Infomation</h2>
</div>
<br/>
<!--<center><h1>Set Level Rule</h1></center>-->

<div style="width: 80%;text-align:center;margin:0 auto">
    <?php

    $doc = new DOMDocument();
    $doc->load('.././compiler_info.xml');
    $levelss = array();
    $levels = $doc->getElementsByTagName("compiler");
    //遍历
    foreach ($levels as $level) {
        //echo $level->getAttribute('id') . "-";
        // echo $level->getElementsByTagName("total")->item(0)->nodeValue;
        // echo "<br>";
        array_push($levelss, $level->getElementsByTagName("content")->item(0)->nodeValue);
    }
    ?>
    <form action="edit_compiler.php" method="post">
        <div>
            <span class="label label-default">C</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"
                                                                                                                   name="c"
                                                                                                                   value="<?php echo $levelss[0] ?>"
            />
        </div>
        <br/>
        <div>
            <span class="label label-default">C++</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"
                                                                                                   name="cplus"
                                                                                                   value="<?php echo $levelss[1] ?>"
            />
        </div>
        <br/>
        <!--<div>
            <span class="label label-default">Pascal</span>&nbsp;&nbsp;&nbsp;<input type="text"
                                                                                    name="pascal"
                                                                                    value="<?php /*echo $levelss[2] */?>"
            />
        </div>-->
        <br/>
        <div>
            <span class="label label-default">Java</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"
                                                                                              name="java"
                                                                                              value="<?php echo $levelss[3] ?>"
            />
        </div>
        <br/>
        <input class="btn btn-primary" type="submit" value="提交"/>

    </form>

</div>
<div style="width: 60%;text-align:center;margin:50px auto">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">使用帮助</h3>
        </div>
        <div class="panel-body">
            <p>管理员/老师，输入框内默认为旧的编译参数。</p>
            <p>你可以输入新的编译参数，系统会更改。</p>
            <p>更改后会立即生效，前台[常见问答]重新定义</p>
        </div>
    </div>
</div>
</body>
</html>

