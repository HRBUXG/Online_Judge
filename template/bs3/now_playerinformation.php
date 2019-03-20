<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>
        <?php echo $OJ_NAME ?>
    </title>

    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    function br2nl($text)
    {
        return preg_replace('/<br\\s*?\/??>/i', '', $text);
    }

    ?>
</head>

<body>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <?php
        //搜索历届队员信息
        $select_user_information = "select user_id,picture,username,grade,college,professional,post from now_players";
        $select_user_information_res = pdo_query($select_user_information);
        /*$rows = mysql_affected_rows($conn);//获取行数
        $colums = mysql_num_fields($select_user_information_res);//获取列数*/
        ?>
        <!--<div id="header" style="padding:5px;background-color:#000; color:#FFF;text-align:center;">
            <h2><?php echo $MSG_NOW_PLAYINFORMATION ?></h2>
         </div>-->
        <div id="page" class="container" style="width:100%;left:50%;top:50%;margin-left:100px;margin-top:0px;">
            <?php
            // echo "id:".$_SESSION[$OJ_NAME.'_'.'user_id'];
            foreach ($select_user_information_res as $row) {
                ?>
                <div style="float:left;margin-left:10px;margin-top:0px;" align="center">
                    <br>
                    <div style="float:left;width:50%; height:210px; margin-right:100px;">
                        <table border="0" style="border:1px #000000 solid;" cellpadding="1" cellspacing="1"
                               width='500px' height='210px'
                               style="word-wrap:break-word;word-break:break-all;table-layout:fixed;">
                            <?php

                            echo "<tr>";
                            echo "<td rowspan='6' width='125px' style='border:0'>
							            <a href='team_member_details.php?now_team_member_id=$row[0]'>
								           <img src='$row[1]' width='155px' height='210px' alt='无照片'>
								        </a>
								     </td>";
                            echo "<td height='20px'>
							            <strong>" . $MSG_PLAYER_UNAME . "：</strong>$row[2]
							         </td>";
                            echo "</tr>";
                            echo "<tr><td height='20px'>
							         <strong>" . $MSG_PLAYER_GRADE . "：</strong>$row[3]
							     </td> </tr>";
                            echo "<tr><td  height='20px'>
								    <strong>" . $MSG_PLAYER_COLLEGE . "：</strong>$row[4]
						    	 </td></tr>
									 
								 <tr><td  height='20px'>
							         <strong>" . $MSG_PLAYER_PROFESSIONAL . "：</strong>$row[5]
						    	 </td></tr>";
                            echo "<tr><td height='20px'>
									   <strong>" . $MSG_PLAYER_POST . "：</strong>$row[6]
								 </td></tr>";
                            /* echo "<tr>
                                       <td class='text_hidden' height='125px' >
                                          <strong>".$MSG_PLAYER_INTRODUCE."：</strong>
                                          <br>$row[3]
                                       </td>
                                   </tr>";
                               echo "<tr>
                                         <td class='text_hidden' height='125px'>
                                             <strong>".$MSG_PLAYER_AWARDS."：</strong>
                                            <br>
                                            $row[4]
                                         </td>
                                     </tr>";*/
                            if ($_SESSION[$OJ_NAME . '_' . 'user_id'] == $row[0]) {
                                echo "<tr>
							             <td height='20px' align='right'>
									        <a href='update_now_player.php?now_team_member_id=$row[0]
											&flagupdate=upd'>
											 <button><strong>" . $MSG_UPDATE . "</strong></button>
											 </a>
									      </td>
								     </tr>";
                            } else {
                                echo "<tr>
							             <td  height='30px' align='center'>  
									      </td>
								     </tr>";
                            }
                            echo "</table>";
                            ?>

                    </div>
                </div>
                <?php
            }
            ?>
        </div><!--page div结束-->
    </div><!--jumbotron div结束-->
</div><!--container div结束-->

<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script type="text/javascript" src="include/jquery.tablesorter.js"></script>
<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
<style type="text/css">
    .text_hidden {
        overflow: hidden;
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;

    }

</style>
</body>
</html>
