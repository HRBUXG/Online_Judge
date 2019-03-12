<html>
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="../template/bs3/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <title>New Problem</title>

</head>

<body leftmargin="30">
<br>
<div class="container">

    <?php require_once("../include/db_info.inc.php"); ?>
    <?php require_once("admin-header.php");
    if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator']) || isset($_SESSION[$OJ_NAME . '_' . 'problem_editor']) || isset($_SESSION[$OJ_NAME . '_' . 'data_importer']))) {
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
    }
    ?>
    <?php
    include_once("ueditor.php");

    ?>
    <!--查询动态标签-->
    <?php
    $sql_tag = "SELECT  `tag1_id`,`tag1_name` from `tag1`";
    $result_tag1 = pdo_query($sql_tag);
    $view_tags = Array();
    foreach ($result_tag1 as $temp_tag1) {
        $sql_tag = "SELECT `tag2_name` from `tag2` where `tag2_tag1_id`=" . $temp_tag1['tag1_id'];
        $result_tag2 = pdo_query($sql_tag);
        $result_tage['tag1'] = $temp_tag1['tag1_name'];
        $result_tage['tag2'] = $result_tag2;
        array_push($view_tags, $result_tage);
    }
    ?>
    <!--		查询动态标签  结束-->

    <form method=POST action=problem_add.php>


        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div data-toggle="collapse" data-target="#no1" data-parent="#accordion">Problem Info</div>
                    </h4>
                </div>

                <div id="no1" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <input type=hidden name=problem_id value="New Problem">
                        <p align=left>
                            <?php echo $MSG_TITLE ?>:<input class="input input-xxlarge" type=text name=title size=71>
                        </p>
                        <p align=left>
                            <?php echo $MSG_Time_Limit ?>
                            <!--					:<input class="input input-mini" type=text list="time_list" name=time_limit size=20>-->
                            <select name=time_limit>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                            </select>S
                            <?php echo $MSG_Memory_Limit ?>

                            <!--					:<input class="input input-mini" type=text list="memory_list" name=memory_limit size=20>-->
                            <select name=memory_limit>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="8">8</option>
                                <option value="16">16</option>
                                <option value="32">32</option>
                                <option value="64">64</option>
                                <option value="128">128</option>
                                <option value="256">256</option>
                            </select>
                            MByte

                        </p>

                        <!--				新增难度系数和标签-->
                        <?php echo $MSG_PROBLEM_LABEL ?>:<input class="input input-mini" type=text name=tags size=40
                                                                style="width:500px" id="tags"><br>

                        <select id=tag1 onChange="fun()">
                            <?php
                            foreach ($view_tags as $row) {
                                echo "<option value='" . $row['tag1'] . "'>" . $row['tag1'] . "</option>";
                            }
                            ?>
                        </select>
                        <select id=tag2>
                            <?php
                            foreach ($view_tags[0]['tag2'] as $row) {
                                echo "<option value='" . $row['tag2_name'] . "'>" . $row['tag2_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="button" id="addtag">add_tag</button>
                        <button type="button" id="empty">empty</button>
                        <br>


                        <?php echo $MSG_DEGREE_OF_DIFFICULTY ?>:
                        <input type="number" step="0.1" name=difficulty min="0" max="10"/>
                        <!--							新增题目分级-->
                        题目分级:<select name=level>
                            <option value="1">一队题目</option>
                            <option value="12">二队题目</option>
                            <option value="123">三队题目</option>
                        </select>
                        <!--							新增题目分级 结束-->

                        <!--				新增难度系数和标签   结束-->

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div data-toggle="collapse" data-target="#no2" data-parent="#accordion">Description</div>
                    </h4>
                </div>

                <div id="no2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align=left>
                            <?php echo $MSG_Description ?>:<br>
                            <textarea class="kindeditor" rows=13 name=description cols=80 style="width:1px"></textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div data-toggle="collapse" data-target="#no3" data-parent="#accordion">Input and output
                            requirements
                        </div>
                    </h4>
                </div>

                <div id="no3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align=left>
                            <?php echo $MSG_Input ?>:<br>
                            <!--<textarea class="kindeditor" rows=13 name=input cols=80 style="width:1px"></textarea>-->
                            <textarea name="content" id="UEditor"
                                      style="width: 800px; height: 400px; margin: 0 auto;"></textarea>

                        </p>

                        </p>
                        <p align=left>
                            <?php echo $MSG_Output ?><br>
                            <textarea class="kindeditor" rows=13 name=output cols=80 style="width:1px"></textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div data-toggle="collapse" data-target="#no4" data-parent="#accordion">Input and output
                            sample
                        </div>
                    </h4>
                </div>

                <div id="no4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align=left>
                            <?php echo $MSG_Sample_Input ?><textarea class="input input-large" rows=13 name=sample_input
                                                                     cols=40></textarea>
                            <?php echo $MSG_Sample_Output ?><textarea class="input input-large" rows=13
                                                                      name=sample_output cols=40></textarea>
                        </p>
                        <!--			动态添加样例 开始-->

                        <button type="button" id="button">ADD</button>
                        <p align=left style="display: none" id="sample_input1">
                            <?php echo $MSG_Sample_Input ?>2<textarea class="input input-large" rows=13
                                                                      name=sample_input2 cols=40></textarea>
                            <?php echo $MSG_Sample_Output ?>2<textarea class="input input-large" rows=13
                                                                       name=sample_output2 cols=40></textarea>
                        </p>
                        <p align=left style="display: none" id="sample_input2">
                            <?php echo $MSG_Sample_Input ?>3<textarea class="input input-large" rows=13
                                                                      name=sample_input3 cols=40></textarea>
                            <?php echo $MSG_Sample_Output ?>3<textarea class="input input-large" rows=13
                                                                       name=sample_output3 cols=40></textarea>
                        </p>
                        <!--动态添加样例 结束-->
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div data-toggle="collapse" data-target="#no5" data-parent="#accordion">Input and output test
                        </div>
                    </h4>
                </div>

                <div id="no5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align=left>
                            <?php echo $MSG_Test_Input ?><textarea class="input input-large" rows=13 name=test_input
                                                                   cols=40></textarea>
                            <?php echo $MSG_Test_Output ?><textarea class="input input-large" rows=13 name=test_output
                                                                    cols=40></textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div data-toggle="collapse" data-target="#no6" data-parent="#accordion">Other</div>
                    </h4>
                </div>

                <div id="no6" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p align=left>
                            <?php echo $MSG_HELP_MORE_TESTDATA_LATER ?>
                        </p>
                        <p align=left>
                            <?php echo $MSG_HINT ?>:<br>
                            <textarea class="kindeditor" rows=13 name=hint cols=80 style="width:1px"></textarea>
                        </p>
                        <p>
                            <?php echo $MSG_SPJ ?>: N<input type=radio name=spj value='0' checked>Y<input type=radio
                                                                                                          name=spj
                                                                                                          value='1'>
                            <?php echo $MSG_HELP_SPJ ?>
                        </p>
                        <p align=left>
                            <?php echo $MSG_Source ?>:<br><textarea name=source rows=1 cols=70
                                                                    style="width:500px"></textarea>
                        </p>
                        <p align=left>
                            <?php echo $MSG_CONTEST ?>:
                            <select name=contest_id>
                                <?php

                                $sql = "SELECT `contest_id`,`title` FROM `contest` WHERE `start_time`>NOW() order by `contest_id`";
                                $result = pdo_query($sql);
                                echo "<option value=''>none</option>";
                                if (count($result) == 0) {
                                } else {
                                    foreach ($result as $row) {
                                        echo "<option value='{$row['contest_id']}'>{$row['contest_id']} {$row['title']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div align=center>
            <?php require_once("../include/set_post_key.php"); ?>
            <input type=submit value=Submit name=submit>
        </div>
    </form>
    <p>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //  动态添加样例
        var sample_inputs = 1;
        $("#button").click(function () {
            if (sample_inputs == 1) {
                $("#sample_input1").css("display", "block");
                sample_inputs++;
            } else if (sample_inputs == 2) {
                $("#sample_input2").css("display", "block");
                sample_inputs++;
            }
        });
        //  动态添加样例 结束

        //  从select中取值赋给  标签输入框
        $("#addtag").click(function () {
            var tag_1 = $("#tag1").val();
            var tag_2 = $("#tag2").val();
            var tagvalue = $("#tags").val();
            if (tagvalue.length == 0) {
                $("#tags").val(tag_1 + ',' + tag_2);
            } else {
                var temp = tagvalue.split(",");
                var index = $.inArray(tag_1, temp);
                if (index == -1) {
                    $("#tags").val(tagvalue + ',' + tag_1);
                    var tagvalue = $("#tags").val();
                }
                index = $.inArray(tag_2, temp);
                if (index == -1) {
                    $("#tags").val(tagvalue + ',' + tag_2);
                }
            }
        });
        //  从select中取值赋给  标签输入框  结束

        //  清空标签输入框
        $("#empty").click(function () {
            $("#tags").val("");
        });
        //  清空标签输入框 结束
    });

    // 初始化二级联动标签选择数组
    var tags = new Array();
    var tag1 = new Array();
    var tag2 = new Array();
    <?php
    foreach ($view_tags as $row) {
        echo "tag1['tag1']='" . $row['tag1'] . "';";
        foreach ($row['tag2'] as $raw) {
            echo "tag2.push('" . $raw['tag2_name'] . "');";
        }
        echo "tag1['tag2']=tag2;";
        echo "tags.push(tag1);";
        echo "tag1=[];";
        echo "tag2=[];";
    }
    ?>
    // 初始化二级联动标签选择数组 结束

    function fun() {
        var a = $("#tag1").val();
        var t2 = $("#tag2");
        $("#tag2").empty();
        for (var i = 0; i < tags.length; i++) {
            if (tags[i]['tag1'] == a) {
                for (var j = 0; j < tags[i]['tag2'].length; j++) {
                    $("#tag2").append("<option value='" + tags[i]['tag2'][j] + "'>" + tags[i]['tag2'][j] + "</option>");
                }
            }
        }
    }
</script>
</body>
</html>
