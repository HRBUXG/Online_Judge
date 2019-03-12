<?php
require_once( "admin-header.php" );

if ( isset( $OJ_LANG ) ) {
	require_once( "../lang/$OJ_LANG.php" );
}
?>
<html> 
<head>
	<title>
		<?php echo $MSG_ADMIN?>
	</title>
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src='bootstrap.min.js'></script>
	<style>
		li {
			list-style-type: none;
		}
        body {
            font-family: 'Open Sans', sans-serif;
            background-color:#d0c93163 ;
        }
		.buttuna {
			padding-left: 20px;
			padding-top: 5px;
			padding-bottom: 5px;
            background-color: #283643;
		}
        .a_class{
            color:white;
        }
        .divclass{
            color:#283643;
            font-weight: bold;
            text-indent:15px;
        }
    </style>
</head>

<body>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default" >
			<div class="panel-heading">
				<h4 class="panel-title">
				<a href="../status.php" target="_top">
					<div  class="divclass"><?php echo $MSG_SEEOJ?></div>
				</a>
			</h4>
			</div>
		</div>
		<?php if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'news_editor'])){ ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title" >
				<a data-toggle="collapse" data-parent="#accordion" href="#new">
					<div class="divclass" >新闻</div>
				</a>
			</h4>
			</div>
			<div id="new" class="panel-collapse collapse">
				<li>
					<div style="text-indent:20px "  class="buttuna"><a style="visited:" class="a_class" href="news_add_page.php" target="main" title="<?php echo $MSG_HELP_ADD_NEWS?>">
						<?php echo $MSG_ADD.$MSG_NEWS?>
					</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna"><a class="a_class" href="news_list.php" target="main" title="<?php echo $MSG_HELP_NEWS_LIST?>">
						<?php echo $MSG_NEWS.$MSG_LIST?>
					</a>
					</div>
				</li>
			</div>
		</div>
		<?php }?>

		<?php if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])){
?>
		<div class="panel panel-default">
			<div class="panel-heading" >
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#problem">
						<div  class="divclass">问题</div>
					</a>
				</h4>
			</div>
			<div id="problem" class="panel-collapse collapse">
				<?php		if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="problem_add_page.php" target="main" title="<?php echo $MSG_HELP_ADD_PROBLEM?>">
							<?php echo $MSG_ADD.$MSG_PROBLEM?>
						</a>
					</div>
				</li>
				<?php } ?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="problem_list.php" target="main" title="<?php echo $MSG_HELP_PROBLEM_LIST?>">
							<?php echo $MSG_PROBLEM.$MSG_LIST?>
						</a>
					</div>
				</li>
				<?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){ ?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="problem_import.php" target="main" title="<?php echo $MSG_HELP_IMPORT_PROBLEM?>">
							<?php echo $MSG_IMPORT.$MSG_PROBLEM?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="problem_export.php" target="main" title="<?php echo $MSG_HELP_EXPORT_PROBLEM?>">
							<?php echo $MSG_EXPORT.$MSG_PROBLEM?>
						</a>
					</div>
				</li>
				<?php } ?>
			</div>
		</div>
		<?php }?>
		<?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'video_editor'])){ ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#video">
					<div class="divclass">视频</div>
				</a>
			</h4>
			</div>
			<div id="video" class="panel-collapse collapse">
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="video_add_page.php" target="main">
                            <?php echo $MSG_ADD.$MSG_VIDEO?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="video_update_page.php" target="main">
                            <?php echo $MSG_VIDEO.$MSG_UPLOAD.$MSG_LIST?>
						</a>
					</div>
				</li>
			</div>
		</div>
		<?php }?>
		<?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'file_editor'])){ ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#file">
					<div style="text-indent:15px" class="divclass">文件</div>
				</a>
			</h4>
			</div>
			<div id="file" class="panel-collapse collapse">
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="add_file_page.php" target="main">
                            <?php echo $MSG_ADD.$MSG_FILE?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="update_file_page.php" target="main">
                            <?php echo $MSG_UPDATE.$MSG_FILE.$MSG_LIST?>
						</a>
					</div>
				</li>
			</div>
		</div>
		<?php }?>
 <?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])){ ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#privilege">
					<div class="divclass">权限</div>
				</a>
			</h4>
			</div>
			<div id="privilege" class="panel-collapse collapse">
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="privilege_add.php" target="main" title="<?php echo $MSG_HELP_ADD_PRIVILEGE?>">
							<?php echo $MSG_ADD.$MSG_PRIVILEGE?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="privilege_list.php" target="main" title="<?php echo $MSG_HELP_PRIVILEGE_LIST?>">
							<?php echo $MSG_PRIVILEGE.$MSG_LIST?>
						</a>
					</div>
				</li>
			</div>
		</div>
		<?php }?>
               <?php  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])){  ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#contest">
					<div class="divclass">比赛</div>
				</a>
			</h4>
			</div>
			<div id="contest" class="panel-collapse collapse">
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="contest_add.php" target="main" title="<?php echo $MSG_HELP_ADD_CONTEST?>">
							<?php echo $MSG_ADD.$MSG_CONTEST?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="contest_list.php" target="main" title="<?php echo $MSG_HELP_CONTEST_LIST?>">
							<?php echo $MSG_CONTEST.$MSG_LIST?>
						</a>
					</div>
				</li>
				<?php   if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="team_generate.php" target="main" title="<?php echo $MSG_HELP_TEAMGENERATOR?>">
							<?php echo $MSG_TEAMGENERATOR?>
						</a>
					</div>
				</li>
				<?php } ?>
			</div>
		</div>
		<?php }?>
                <?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'password_setter'])){?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#user">
					<div  class="divclass">用户</div>
				</a>
			</h4>
			</div>
			<div id="user" class="panel-collapse collapse">
			<?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>	
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="user_list.php" target="main" title="<?php echo $MSG_HELP_ADD_PRIVILEGE?>">
							<?php echo $MSG_USER.$MSG_LIST?>
						</a>
					</div>
				</li>
				<?php }?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="changepass.php" target="main" title="<?php echo $MSG_HELP_SETPASSWORD?>">
							<?php echo $MSG_SETPASSWORD?>
						</a>
					</div>
				</li>
				 <li>
                                        <div style="text-indent:20px" class="buttuna">
                                                <a class="a_class" href="add_playinformation_page.php" target="main" title="<?php echo $MSG_HELP_PLAYINFORMATION?>">
                                                       <?php echo $MSG_ADD.$MSG_PLAYINFORMATION?>
                                                </a>
                                        </div>
                                </li>
				<li>
                                        <div style="text-indent:20px" class="buttuna">
                                                <a class="a_class" href="update_playinformation_page.php" target="main">
                                                        <?php echo $MSG_PLAYINFORMATION.$MSG_UPDATE?>
                                                </a>
                                        </div>
                                </li>
				 <li>
                                        <div style="text-indent:20px" class="buttuna">
                                        <a  class="a_class" href="add_now_playinformation_page.php" target="main">
                                            <?php echo $MSG_ADD.$MSG_NOW_PLAYINFORMATION?></a>
					</div>
                                </li>
				 <li>
                                        <div style="text-indent:20px" class="buttuna">
                                        <a  class="a_class" href="update_now_playinformation_page.php" target="main">
                                            <?php echo $MSG_NOW_PLAYINFORMATION.$MSG_UPDATE?></a>
                                        </div>
                                </li>

				<li>
	           <div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="xml_import_account.php" target="main" title="">
							<?php echo $MSG_IMPORTACC?>
						</a>
					</div>
        </li>

			</div>
		</div>
                <?php }?>
		<?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#outher">
					<div class="divclass">其他</div>
				</a>
			</h4>
			</div>
			<div id="outher" class="panel-collapse collapse">
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="insertdata.php" target="main">
							<?php echo "其他oj数据导入"?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="setmsg.php" target="main" title="<?php echo $MSG_HELP_SETMESSAGE?>">
							<?php echo $MSG_SETMESSAGE?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="rejudge.php" target="main" title="<?php echo $MSG_HELP_REJUDGE?>">
							<?php echo $MSG_REJUDGE?>
						</a>				
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="source_give.php" target="main" title="<?php echo $MSG_HELP_GIVESOURCE?>">
							<?php echo $MSG_GIVESOURCE?>
						</a>
					</div>
				</li>
				<?php if(isset($_SESSION[$OJ_NAME.'_'.'root'])){?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="update_db.php" target="main" title="<?php echo $MSG_HELP_UPDATE_DATABASE?>">
							<?php echo $MSG_UPDATE_DATABASE?>
						</a>
					</div>
				</li>
				<?php } ?>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="tag_management_page.php" target="main">
							<?php echo $MSG_TAG.$MSG_MANAGE?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="../online.php" target="main">
							<?php echo $MSG_ONLINE?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="main_background_page.php" target="main">
							<?php echo $MSG_BACKGROUND.$MSG_UPDATE?>
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="problem_copy.php" target="main" title="Create your own data">
							CopyProblem
						</a>
					</div>
				</li>
				<li>
					<div style="text-indent:20px" class="buttuna">
						<a class="a_class" href="problem_changeid.php" target="main" title="Danger,Use it on your own risk">
							ReOrderProblem
						</a>
					</div>
				</li>
			</div>
		</div>
		<?php } ?>
	</div>
</body>

</html>
