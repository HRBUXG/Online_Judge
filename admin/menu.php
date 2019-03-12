<?php
require_once("admin-header.php");

if (isset($OJ_LANG)) {
    require_once("../lang/$OJ_LANG.php");
}
?>
<html>
<head>
    <title>
        <?php echo $MSG_ADMIN ?>
    </title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src='bootstrap.min.js'></script>
    <style>
        li {
            list-style-type: none;
        }

        .buttuna {
            padding-left: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="../status.php" target="_top">
                    <div style="text-indent:15px"><?php echo $MSG_SEEOJ ?></div>
                </a>
            </h4>
        </div>
    </div>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'news_editor'])) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#new">
                        <div style="text-indent:15px">新闻</div>
                    </a>
                </h4>
            </div>
            <div id="new" class="panel-collapse collapse">
                <li>
                    <div style="text-indent:20px" class="buttuna"><a href="news_add_page.php" target="main"
                                                                     title="<?php echo $MSG_HELP_ADD_NEWS ?>">
                            <b><?php echo $MSG_ADD . $MSG_NEWS ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna"><a href="news_list.php" target="main"
                                                                     title="<?php echo $MSG_HELP_NEWS_LIST ?>">
                            <b><?php echo $MSG_NEWS . $MSG_LIST ?></b>
                        </a>
                    </div>
                </li>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor']) || isset($_SESSION[$OJ_NAME . '_' . 'contest_creator'])) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#problem">
                        <div style="text-indent:15px">问题</div>
                    </a>
                </h4>
            </div>
            <div id="problem" class="panel-collapse collapse">
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="problem_add_page.php" target="main" title="<?php echo $MSG_HELP_ADD_PROBLEM ?>">
                                <b><?php echo $MSG_ADD . $MSG_PROBLEM ?></b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="problem_list.php" target="main" title="<?php echo $MSG_HELP_PROBLEM_LIST ?>">
                            <b><?php echo $MSG_PROBLEM . $MSG_LIST ?></b>
                        </a>
                    </div>
                </li>
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="problem_import.php" target="main" title="<?php echo $MSG_HELP_IMPORT_PROBLEM ?>">
                                <b><?php echo $MSG_IMPORT . $MSG_PROBLEM ?></b>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="problem_export.php" target="main" title="<?php echo $MSG_HELP_EXPORT_PROBLEM ?>">
                                <b><?php echo $MSG_EXPORT . $MSG_PROBLEM ?></b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'video_editor'])) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#video">
                        <div style="text-indent:15px">视频</div>
                    </a>
                </h4>
            </div>
            <div id="video" class="panel-collapse collapse">
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="video_add_page.php" target="main"><b><?php echo $MSG_ADD . $MSG_VIDEO ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="video_update_page.php"
                           target="main"><b><?php echo $MSG_VIDEO . $MSG_UPLOAD . $MSG_LIST ?></b>
                        </a>
                    </div>
                </li>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'file_editor'])) { ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#file">
                        <div style="text-indent:15px">文件</div>
                    </a>
                </h4>
            </div>
            <div id="file" class="panel-collapse collapse">
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="add_file_page.php" target="main"><b><?php echo $MSG_ADD . $MSG_FILE ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="update_file_page.php"
                           target="main"><b><?php echo $MSG_UPDATE . $MSG_FILE . $MSG_LIST ?></b>
                        </a>
                    </div>
                </li>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) { ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#privilege">
                        <div style="text-indent:15px">权限</div>
                    </a>
                </h4>
            </div>
            <div id="privilege" class="panel-collapse collapse">
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="privilege_add.php" target="main" title="<?php echo $MSG_HELP_ADD_PRIVILEGE ?>">
                            <b><?php echo $MSG_ADD . $MSG_PRIVILEGE ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="privilege_list.php" target="main" title="<?php echo $MSG_HELP_PRIVILEGE_LIST ?>">
                            <b><?php echo $MSG_PRIVILEGE . $MSG_LIST ?></b>
                        </a>
                    </div>
                </li>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'contest_creator'])) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#contest">
                        <div style="text-indent:15px">比赛</div>
                    </a>
                </h4>
            </div>
            <div id="contest" class="panel-collapse collapse">
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="contest_add.php" target="main" title="<?php echo $MSG_HELP_ADD_CONTEST ?>">
                            <b><?php echo $MSG_ADD . $MSG_CONTEST ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="contest_list.php" target="main" title="<?php echo $MSG_HELP_CONTEST_LIST ?>">
                            <b><?php echo $MSG_CONTEST . $MSG_LIST ?></b>
                        </a>
                    </div>
                </li>
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="team_generate.php" target="main" title="<?php echo $MSG_HELP_TEAMGENERATOR ?>">
                                <b><?php echo $MSG_TEAMGENERATOR ?></b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'password_setter'])) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#user">
                        <div style="text-indent:15px">用户</div>
                    </a>
                </h4>
            </div>
            <div id="user" class="panel-collapse collapse">
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="user_list.php" target="main" title="<?php echo $MSG_HELP_ADD_PRIVILEGE ?>">
                                <b><?php echo $MSG_USER . $MSG_LIST ?></b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="changepass.php" target="main" title="<?php echo $MSG_HELP_SETPASSWORD ?>">
                            <b><?php echo $MSG_SETPASSWORD ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="add_playinformation_page.php" target="main"
                           title="<?php echo $MSG_HELP_PLAYINFORMATION ?>">
                            <b><?php echo $MSG_ADD . $MSG_PLAYINFORMATION ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="update_playinformation_page.php" target="main">
                            <b><?php echo $MSG_PLAYINFORMATION . $MSG_UPDATE ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="add_now_playinformation_page.php"
                           target="main"><b><?php echo $MSG_ADD . $MSG_NOW_PLAYINFORMATION ?></b></a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="update_now_playinformation_page.php"
                           target="main"><b><?php echo $MSG_NOW_PLAYINFORMATION . $MSG_UPDATE ?></b></a>
                    </div>
                </li>

                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="xml_import_account.php" target="main" title="">
                            <b><?php echo $MSG_IMPORTACC ?></b>
                        </a>
                    </div>
                </li>

            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'statistician'])) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#statistics">
                        <div style="text-indent:15px">统计</div>
                    </a>
                </h4>
            </div>

            <div id="statistics" class="panel-collapse collapse">

                <!--导出刷题名单-->
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="export.php" target="main" title="">
                            <b><?php echo "Export"; ?></b>
                        </a>
                    </div>
                </li>

            </div>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'file_editor']) || isset($_SESSION[$OJ_NAME . '_' . 'video_editor']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor'])) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#outher">
                        <div style="text-indent:15px">其他</div>
                    </a>
                </h4>
            </div>
            <div id="outher" class="panel-collapse collapse">
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="insertdata.php" target="main">
                            <b><?php echo "其他oj数据导入" ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="setmsg.php" target="main" title="<?php echo $MSG_HELP_SETMESSAGE ?>">
                            <b><?php echo $MSG_SETMESSAGE ?></b>
                        </a>
                    </div>
                </li>
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'root'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="rejudge.php" target="main" title="<?php echo $MSG_HELP_REJUDGE ?>">
                                <b><?php echo $MSG_REJUDGE ?></b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="source_give.php" target="main" title="<?php echo $MSG_HELP_GIVESOURCE ?>">
                            <b><?php echo $MSG_GIVESOURCE ?></b>
                        </a>
                    </div>
                </li>
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'root'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="update_db.php" target="main" title="<?php echo $MSG_HELP_UPDATE_DATABASE ?>">
                                <b><?php echo $MSG_UPDATE_DATABASE ?></b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="tag_management_page.php" target="main">
                            <b><?php echo $MSG_TAG . $MSG_MANAGE ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="../online.php" target="main">
                            <b><?php echo $MSG_ONLINE ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="main_background_page.php" target="main">
                            <b><?php echo $MSG_BACKGROUND . $MSG_UPDATE ?></b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="problem_copy.php" target="main" title="Create your own data">
                            <b>CopyProblem</b>
                        </a>
                    </div>
                </li>
                <li>
                    <div style="text-indent:20px" class="buttuna">
                        <a href="problem_changeid.php" target="main" title="Danger,Use it on your own risk">
                            <b>ReOrderProblem</b>
                        </a>
                    </div>
                </li>
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'root'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="edit_db_info.inc.php" target="main" title="Danger,Use it on your own risk">
                                <b>Edit DB Information</b>
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <?php if (isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor']) || isset($_SESSION[$OJ_NAME . '_' . 'contest_creator'])) { ?>
                    <li>
                        <div style="text-indent:20px" class="buttuna">
                            <a href="push_msg.php" target="main" title="Danger,Use it on your own risk">
                                <b>Push Message</b>
                            </a>
                        </div>
                    </li>
                <?php } ?>

            </div>
        </div>
    <?php } ?>
</div>
</body>

</html>
