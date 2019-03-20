<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes"/>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <!--<link href="../../highlight/Flvplayer/video-js.min.css" rel="stylesheet">
    <script src="../../highlight/Flvplayer/video.min.js"></script>
    <script src="../../highlight/Flvplayer/videojs-ie8.min.js"></script>-->
    <!--<script src="../../highlight/Flvplayer/Scripts/swfobject_modified.js" type="text/javascript"></script>-->
    <!--<script>
           videojs.options.flash.swf="../../highlight/Flvplayer/video-js.swf";
    </script>-->
    <title><?php echo $OJ_NAME . $MSG_VIDEOSTUDY ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php
    $id = $_GET["video_id"];
    $sql = "select video_total from video where video_id=?";
    $data = pdo_query($sql, $id);
    $num = $data[0]['video_total'];
    /*echo "<script>alert('$num');</script>";*/
    $num = $num + 1;
    /*echo "<script>alert('$num');</script>";*/
    $sql7 = "update video set video_total=? where video_id=?";
    $data2 = pdo_query($sql7, $num,$id);

    ?>
    <!-- <script src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script>-->
</head>

<body>
<!--//******************************************加style*******************************************************-->
<div class="container" style="width:100%">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron" style="height:100%">
        <div id="content_top" style="height:60%">
            <!--content_top_right div结束-->

            <!--视频播放器-->
            <div id="content_top_left" style=" float:left; width:65%">
                <?php
                //根据名字找地址
                $id = $_GET["video_id"];
                $name = $_GET["video_name"];
                //echo $name."</br>";
                $sql = "select video_address from video where video_id=''";
                $data = pdo_query($sql, $id);
                $address = "../" . $data[0]['video_address'];
                //echo $address."</br>";
                //$newname= ;
                ?>
                <p align="center" \>
                <div id="video_div" style="width:149%; height:600px">

                    <h2 align="center" style="color:#666">
                        <div style="float:left">
                            <button id="back" onClick="back()">Back</button>
                        </div>
                        <strong><?php echo $name; ?> </strong>
                    </h2>

                    <video style="background-color:#000" controls width="100%" height="100%" loop id="videoPlay1"
                           onclick="videoPlay1()" data-setup="{}" class="video-js vjs-default-skin">
                        <source src="<?php echo $address; ?>" type="video/ogg">
                        <source src="<?php echo $address; ?>" type="video/webm">
                        <source src="<?php echo $address; ?>" type="video/mp4">
                        <source src="<?php echo $address; ?>" type="application/x-shockwave-flash">
                        <!--<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                                codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"                  width="500" height="400">
                           <param name="movie" value="../../highlight/Flvplayer/FLVPlayer_Progressive.swf" />
                           <param name="quality" value="high" />
                           <param name="allowFullScreen" value="true" />
                           <embed src="../../highlight/Flvplayer/FLVPlayer_Progressive.swf" allowfullscreen="true"
                                  flashvars="vcastr_file=http://yourname.com/flv/ctdemo.flv&IsAutoPlay=1&LogoUrl=images/logo.jpg"                    quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer"
                                  type="application/x-shockwave-flash" width="960" height="540">
                           </embed>
                       </object>-->
                        您的浏览器不支持播放该视频！
                    </video>
                    <!--<object width="800px" height="374px" type="application/x-shockwave-flash"
                  data="<?php echo $address; ?>">   
              <param name="quality" value="high">
              <param name="wmode" value="opaque">
              <param name="scale" value="noscale">
              <param name="salign" value="lt">
              <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;
              skinName=Clear_Skin_3&amp;streamName=<?php echo $address; ?>&amp;autoPlay=false&amp;autoRewind=false" />
              <param name="swfversion" value="8,0,0,0">
              <param name="expressinstall" value="../../highlight/Flvplayer/Scripts/expressInstall.swf">-->
                    <!--<param name="movie" value="../../highlight/Flvplayer/expressInstall.swf" />
              <param name="flashvars" value="file=<?php echo $address; ?>" />-->
                    </object>
                    <!--<object id="flash_fallback_1" class="vjs-flash-fallback" width="280" height="210"
                  type="application/x-shockwave-flash" data="../../highlight/Flvplayer/Flvplayer.swf">
              <param name="movie" value="../../highlight/Flvplayer/Flvplayer.swf" />
              <param name="allowfullscreen" value="true" />
              <param name="flashvars" value='config={"playlist":["",
               {"url": "<?php echo $address; ?>","autoPlay":false,"autoBuffering":true}]}' />
          </object>-->


                </div>
                </p>
            </div>
            <div id="content_top_button" style="float:right; width:3%; padding-top:300px">
                <!--隐藏列表按钮-->
                <input type="button" id="showHidden"
                       style="height:50px; width:30px; background-color:#000;color:#FFF" value="<"></button>
            </div>

            <!--视频列表-->
            <div id="content_top_center" style="float:right; width:32%"><!--宽度在多出来一点都会把按钮覆盖-->
                <?php
                //根据id找source
                $sql_source = "select video_source from video where video_id=?";
                $source_data = pdo_query($sql_source, $id);
                $source = $source_data[0]['video_source'];

                //搜索信息当source确定
                $sql = "select video_id,video_name,video_upload_time,video_total from video 
			  where video_source=? and
		      (video_privilege=? or video_privilege=? or
		      video_privilege=?)";
                $res = pdo_query($sql, $source,$_SESSION[first_team],$_SESSION[second_team],$_SESSION[new_players]);
                /*$rows = mysql_affected_rows($conn);//获取行数
                $colums = mysql_num_fields($res);//获取列数*/
                //echo "jol数据库的".$table_name."表的所有用户数据如下：<br/>";
                // echo "共计".$rows."行 ".$colums."列<br/>";

                ?>
                <!--  <div class="list" style="background-color:#000;color:#FFF;display:block">
                     <p>视频列表</p>
                 </div>-->

                <div class="video_list" id="video_table" style="height:480px; display:none">
                    <h2 align="center" style="color:#666"><strong>相关视频列表</strong></h2>
                    <div style="height:480px;overflow-y:scroll;scrollbar-base-color:#FFF; scrollbar-face-color:#000">
                        <table id='videoplay' width='100%' class='table table-striped'>
                            <!--表头-->
                            <thead>
                            <tr class='toprow'>
                                <th class='hidden-xs' width='10%' align="center"> <?php echo $MSG_VIDEO_NAME ?> </th>
                                <th class='hidden-xs' width='10%'> <?php echo $MSG_VIDEO_UPLOAD_TIME ?> </th>
                                <th class='hidden-xs' style="cursor:hand"
                                    width='5%'> <?php echo $MSG_VIDEO_PLAY_NUMBER ?> </th>
                            </tr>
                            </thead>
                            <!--表头结束-->
                            <tbody>
                            <?php
                            foreach ($res as $row) {
                                echo "<tr>";
                                echo "<td class='hidden-xs'>".$row['video_id']."</td>";
                                echo "<td class='hidden-xs'>".$row['video_name']."</td>";
                                echo "<td class='hidden-xs'>".$row['video_upload_time']."</td>";
                                echo "<td class='hidden-xs'>".$row['video_total']."</td>";
                                echo "</tr>";
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--滑轮div结束-->
                </div>
                <!--video_table div结束-->
            </div>
            <!--top_center div结束-->
        </div>
        <!--top_video-->
    </div>
    <!--top div结束-->

    <!--解答板模块-->
    <div id="content_botton" style="height:40%; ">

    </div>

    <!--botton div结束-->
</div>
<!--jumbotron div结束-->
</div>
<!--container div结束-->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type='text/javascript'>
    //返回按钮
    function back() {
        window.location.href = 'videostudy.php';
    }

    //对隐藏按钮的控制

    function show_hidden(obj1, obj2, objbut, sh) {

        if (obj1.style.display == 'block') //当视频是大的的时候
        {
            obj1.style.display = 'none';//video列表隐藏
            whbig(obj2, objbut, sh);
        }
        else //当视频是小的的时候
        {
            obj1.style.display = 'block';//video列表显示
            whsmall(obj2, objbut, sh);
        }

    }

    function whbig(obj3, objbut, sh)//视频播放变大时的变化
    {
        var width = 149;//设置宽的值
        var height = 600;//设置高的值
        obj3.style.width = width + "%";//设置视频宽度
        obj3.style.height = height + "px";//设置视频高度
        objbut.style.float = 'right';//设置按钮float左右
        objbut.style.paddingTop = 300 + "px";//设置按钮距离顶端的距离
        sh.value = "<";//设置按钮的value值控制箭头方向


    }

    function whsmall(obj4, objbut, sh)//视频播放变小的时候变化
    {
        var width = 100;//设置宽的值
        var height = 480;//设置高的值
        obj4.style.width = width + "%";//设置视频宽度
        obj4.style.height = height + "px";//设置视频高度
        objbut.style.float = 'left';//设置按钮float左右
        objbut.style.paddingTop = 250 + "px";//设置按钮距离顶端的距离
        sh.value = ">";//设置按钮的value值控制箭头方向
    }

    var sh = document.getElementById("showHidden");//获取按钮的id

    sh.onclick = function () {
        //获取各个div的id
        var video_table = document.getElementById("video_table");//获取视频列表div的id
        var video_div = document.getElementById("video_div");//获取视频播放器的div的id
        var content_top_button = document.getElementById("content_top_button");//获取按钮div的id
        show_hidden(video_table, video_div, content_top_button, sh);//调用show_hidden函数传传id过去

        return false;

    }

</script>


<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
<script>
    $('.Select').click(function () {
        var tr = $(this).closest("tr");
        var video_id = tr.find("td:eq(0)").text();//获取列表所点击第一列的值
        var video_name = tr.find("td:eq(1)").text();//获取列表所点击第二列的值
        //alert(video_id);
        //alert(video_name);
        window.location.href = 'videoplay.php?video_id=' + video_id + '&video_name=' + video_name;//传参跳转
    });

</script>
<!--点击屏幕暂停功能-->
<script type="text/javascript">
    var video1 = document.getElementById("videoPlay1");
    video1.onclick = function () {
        video1.controls = true;
        if (video1.paused) {
            video1.play();
        } else {
            video1.pause();
        }
    };
    swfobject.registerObject("FLVPlayer");
</script>
</body>
</html>
