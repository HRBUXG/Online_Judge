<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>
        <?php echo $OJ_NAME?>
    </title>
    <?php include("template/$OJ_TEMPLATE/css.php");?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!--------------------------------------修改开始--------------------------------------------------------->
<style type="text/css">
    .biankuang{
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.42857143;
        color: #333;
        word-break: break-all;
        word-wrap: break-word;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

</style>
<!--------------------------------------修改结束--------------------------------------------------------->
<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <!--------------------------------------修改开始--------------------------------------------------------->
        <div style='float: left;'>
            <?php echo $next_page0?>
        </div>
        <div style='float: right;'>
            <?php echo $next_page1?>
        </div>
        <!--------------------------------------修改结束--------------------------------------------------------->
        <?php
        if ( $pr_flag ) {
            echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row[ 'title' ] . "</title>";
            echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row[ 'title' ] . "</h2>";
        } else {
            //$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $id = $row[ 'problem_id' ];
            echo "<title style='color:#1a5cc8;font-weight:bold'>" . $row[ 'title' ] . " </title>";
            echo "<center><h2 style='color:#1a5cc8;font-weight:bold'>" . $row[ 'title' ] . "</h2>";
        }
        echo "<span class=green style='color:green;font-weight:bold;'>$MSG_Time_Limit:&nbsp;" . $row[ 'time_limit' ] . " Sec&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
        echo "<span class=green style='color:green;font-weight:bold'>$MSG_Memory_Limit:&nbsp;" . $row[ 'memory_limit' ] . " MB</span>";
        if ( $row[ 'spj' ] )echo "&nbsp;&nbsp;<span class=red style='color:red;font-weight:bold'>Special Judge</span>";
        echo "<br><span class=green style='color:green;font-weight:bold'>$MSG_SUBMIT:&nbsp;" . $row[ 'submit' ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
        echo "<span class=green style='color:green;font-weight:bold'>$MSG_SOVLED:&nbsp;" . $row[ 'accepted' ] . "</span><br>";
        /*****************************************添加开始***************************************************************************/
        $tagsbiao = "";
        if ( !empty( $row[ 'tags' ] ) ) {
            $tags = explode( ",", $row[ 'tags' ] );
            foreach ( $tags as $val ) {
                $tagsbiao = $tagsbiao . "&nbsp;&nbsp" . $val;
            }
        } else {
            $tagsbiao = "无";
        }
        echo "<span class=green style='color:green;font-weight:bold;text-align:center'>$MSG_DEGREE_OF_DIFFICULTY:&nbsp;" . $row[ 'difficulty' ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
        echo "<span class=green style='color:green;font-weight:bold;'>$MSG_PROBLEM_LABEL:&nbsp;" . $tagsbiao . "</span><br>";
        /*****************************************添加结束***************************************************************************/
        if ( $pr_flag ) {
            echo "<a href='submitpage.php?id=$id'><input style='width:70px;height:30px;margin-top:10px;border-radius:5px;background:red;border-width:0px;margin-left:20px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center' type='button' value='$MSG_SUBMIT'></a>";
        } else {
            echo "<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'><input style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:red;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center' type='button' value='$MSG_SUBMIT'></a>";
        }
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='problemstatus.php?id=" . $row[ 'problem_id' ] . "'><input style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:#1e90ff;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:white;bold:none;text-align:center' type='button' value='$MSG_STATUS'></a>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='bbs.php?pid=" . $row[ 'problem_id' ] . "$ucid'><input style='width:70px;height:30px;margin-top:10px;margin-left:20px;border-radius:5px;background:yellow;border-width:0px;cursor:pointer;outline:none;font-family:Microsoft YaHei;font-size:15px;color:#1e90ff;bold:none;text-align:center' type='button' value='$MSG_BBS'></a>";
        if ( isset( $_SESSION[ 'administrator' ] ) )
            echo "[$MSG_Creator:<span id='creator'></span>]";
        if ( isset( $_SESSION[ 'administrator' ] ) ) {
            require_once( "include/set_get_key.php" );
            ?> [
            <a href="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION[$OJ_NAME.'_'.'getkey']?>">Edit</a>] [
            <a href='javascript:phpfm(<?php echo $row[' problem_id '];?>)'>TestData</a>]
            <?php
        }
        echo "</center>";
        echo "<!--StartMarkForVirtualJudge-->";
        /*****************************************修改开始***************************************************************************/
        echo "<h2 style='color:#7CA9ED'>$MSG_Description</h2>
			<div class=content style='display: block;padding: 9.5px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;width:95%'>" . $row[ 'description' ] . "</div>";
        echo "<div ><h2 style='color:#7CA9ED'>$MSG_Input </h2><div class=content style='display: block;padding: 9.5px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;width:95%'>" . $row[ 'input' ] . "</div></div>";
        echo "<div ><h2 style='color:#7CA9ED'>$MSG_Output</h2><div class=content style='display: block;padding: 9.5px;margin: 0 0 10px;font-size: 13px;line-height: 1.42857143;color: #333;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;width:95%'>" . $row[ 'output' ] . "</div></div>";
        $sinput = str_replace( "<", "&lt;", $row[ 'sample_input' ] );
        $sinput = str_replace( ">", "&gt;", $sinput );
        $soutput = str_replace( "<", "&lt;", $row[ 'sample_output' ] );
        $soutput = str_replace( ">", "&gt;", $soutput );
        if ( strlen( $sinput ) && strlen( $soutput ) ) {
            echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input</h2>
				<pre class=content id='sinputleft' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $sinput ) . "</span></pre></div>";
            echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output</h2>
<pre class=content id='sinputright' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $soutput ) . "</span></pre></div>";
        } else if ( strlen( $sinput ) ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input</h2>
<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><span class=sampledata>" . ( $sinput ) . "</span></pre>";

        } else if ( strlen( $soutput ) ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output</h2>
<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $soutput ) . "</span></pre>";
        }

        $sinput2 = str_replace( "<", "&lt;", $row[ 'sample_input2' ] );
        $sinput2 = str_replace( ">", "&gt;", $sinput2 );
        $soutput2 = str_replace( "<", "&lt;", $row[ 'sample_output2' ] );
        $soutput2 = str_replace( ">", "&gt;", $soutput2 );
        if ( strlen( $sinput2 ) && strlen( $soutput2 ) ) {
            echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input 2</h2>
			<pre class=content id='sinputleft2' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $sinput2 ) . "</span></pre></div>";
            echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output 2</h2>
			<pre class=content id='sinputright2' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $soutput2 ) . "</span></pre></div>";
        } else if ( strlen( $sinput2 ) ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input 2</h2>
			<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy'style='float: right'>copy</a><br><span class=sampledata>" . ( $sinput2 ) . "</span></pre>";

        } else if ( strlen( $soutput2 ) ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output 2</h2>
			<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $soutput2 ) . "</span></pre>";
        }

        $sinput3 = str_replace( "<", "&lt;", $row[ 'sample_input3' ] );
        $sinput3 = str_replace( ">", "&gt;", $sinput3 );
        $soutput3 = str_replace( "<", "&lt;", $row[ 'sample_output3' ] );
        $soutput3 = str_replace( ">", "&gt;", $soutput3 );
        if ( strlen( $sinput3 ) && strlen( $soutput3 ) ) {
            echo "<div style='float: left;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Input 3</h2>
<pre class=content id='sinputleft3' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $sinput3 ) . "</span></pre></div>";
            echo " <div  style='float: right;width: 50%;'><h2 style='color:#7CA9ED'>$MSG_Sample_Output 3</h2>
<pre class=content id='sinputright3' style='width:90%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $soutput3 ) . "</span></pre></div>";
        } else if ( strlen( $sinput3 ) ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Input 3</h2>
<pre class=content style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $sinput3 ) . "</span></pre>";

        } else if ( strlen( $soutput3 ) ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Sample_Output 3</h2>
<pre class=content  style='width:95%'><a href='javascript:void(0)' class='CopyToClipboard' title='copy' style='float: right'>copy</a><br><span class=sampledata>" . ( $soutput3 ) . "</span></pre>";
        }
        if ( $row[ 'hint' ] )
            echo "<h2 style='color:#7CA9ED'>$MSG_HINT</h2>
<div class=content>" . $row[ 'hint' ] . "</div>";
        /*****************************************修改结束***************************************************************************/
        if ( $pr_flag ) {
            echo "<h2 style='color:#7CA9ED'>$MSG_Source</h2><div class=content><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $cats = explode( " ", $row[ 'source' ] );
            foreach ( $cats as $cat ) {
                echo "<a href='problemset.php?search=" . htmlentities( $cat, ENT_QUOTES, 'utf-8' ) . "'>" . htmlentities( $cat, ENT_QUOTES, 'utf-8' ) . "</a>&nbsp;";
            }
            echo "</p></div>";
        }
        echo "<center>";
        echo "<!--EndMarkForVirtualJudge-->";
        if ( $pr_flag ) {
            echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
        } else {
            echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
        }
        echo "[<a href='problemstatus.php?id=" . $row[ 'problem_id' ] . "'>$MSG_STATUS</a>]";
        //echo "[<a href='bbs.php?pid=".$row['problem_id']."$ucid'>$MSG_BBS</a>]";
        if ( isset( $_SESSION[ $OJ_NAME . '_' . 'administrator' ] ) ) {
            require_once( "include/set_get_key.php" );
            ?> [
            <a href="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION[$OJ_NAME.'_'.'getkey']?>">Edit</a>] [
            <a href='javascript:phpfm(<?php echo $row['problem_id'];?>)'>TestData</a>]
            <?php
        }
        echo "</center>";
        ?>
    </div>

</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php");?>
<script type="text/javascript" src="include/clipboard.js"></script>
<script>
    function phpfm( pid ) {
        //alert(pid);
        $.post( "admin/phpfm.php", {
            'frame': 3,
            'pid': pid,
            'pass': ''
        }, function ( data, status ) {
            if ( status == "success" ) {
                document.location.href = "admin/phpfm.php?frame=3&pid=" + pid;
            }
        } );
    }
    /*****************************************修改开始***************************************************************************/
    $( document ).ready( function () {
        $( "#creator" ).load( "problem-ajax.php?pid=<?php echo $id?>" );
        var left = $( "#sinputleft" ).height();
        var right = $( "#sinputright" ).height();
        if ( left < right ) {
            $( "#sinputleft" ).height( right );
        } else if ( left > right ) {
            $( "#sinputright" ).height( left );
        }
        left = $( "#sinputleft2" ).height();
        right = $( "#sinputright2" ).height();
        if ( left < right ) {
            $( "#sinputleft2" ).height( right );
        } else if ( left > right ) {
            $( "#sinputright2" ).height( left );
        }
        left = $( "#sinputleft3" ).height();
        right = $( "#sinputright3" ).height();
        if ( left < right ) {
            $( "#sinputleft3" ).height( right );
        } else if ( left > right ) {
            $( "#sinputright3" ).height( left );
        }
    } );
    var fuzhi;
    $( '.CopyToClipboard' ).click( function () {
        fuzhi = this.nextElementSibling.nextElementSibling.firstChild.nodeValue;
    } );
    var clipboard = new Clipboard( '.CopyToClipboard', {
        text: function () {
            alert( "复制成功" );
            return fuzhi;
        }
    } );
    clipboard.on( 'success', function ( e ) {
        console.log( e );
    } );

    clipboard.on( 'error', function ( e ) {
        console.log( e );
    } );
    /*****************************************修改结束***************************************************************************/
</script>
</body>
</html>