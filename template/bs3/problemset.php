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
        <?php echo $OJ_NAME ?>
    </title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>
    <style type="text/css">
        .l1 {
            font-size: 24px;
        }

        .ul {
            font-size: 20px;
            display: none;
        }

        li {
            list-style-type: none;
        }

        .mui-switch {
            width: 52px;
            height: 31px;
            position: relative;
            border: 1px solid #dfdfdf;
            background-color: #fdfdfd;
            box-shadow: #dfdfdf 0 0 0 0 inset;
            border-radius: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            background-clip: content-box;
            display: inline-block;
            -webkit-appearance: none;
            user-select: none;
            outline: none;
        }

        .mui-switch:before {
            content: '';
            width: 29px;
            height: 29px;
            position: absolute;
            top: 0px;
            left: 0;
            border-radius: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        .mui-switch:checked {
            border-color: #64bd63;
            box-shadow: #64bd63 0 0 0 16px inset;
            background-color: #64bd63;
        }

        .mui-switch:checked:before {
            left: 21px;
        }

        .mui-switch.mui-switch-animbg {
            transition: background-color ease 0.4s;
        }

        .mui-switch.mui-switch-animbg:before {
            transition: left 0.3s;
        }

        .mui-switch.mui-switch-animbg:checked {
            box-shadow: #dfdfdf 0 0 0 0 inset;
            background-color: #64bd63;
            transition: border-color 0.4s, background-color ease 0.4s;
        }

        .mui-switch.mui-switch-animbg:checked:before {
            transition: left 0.3s;
        }

        /*  .mui-switch.mui-switch-anim {
              transition: border cubic-bezier(0, 0, 0, 1) 0.4s, box-shadow cubic-bezier(0, 0, 0, 1) 0.4s;
          }

          .mui-switch.mui-switch-anim:before {
              transition: left 0.3s;
          }

          .mui-switch.mui-switch-anim:checked {
              box-shadow: #64bd63 0 0 0 16px inset;
              background-color: #64bd63;
              transition: border ease 0.4s, box-shadow ease 0.4s, background-color ease 1.2s;
          }

          .mui-switch.mui-switch-anim:checked:before {
              transition: left 0.3s;
          }*/
    </style>


</head>

<body>
<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <div class="jumbotron">
        <center style="float: left;width: 85%">

            <nav id="page" class="center">
                <ul class="pagination">
                    <li class="page-item">
                        <?php
                        if ($tag != 'null') {
                            ?>
                            <a href="problemset.php?page=1&tags=<?php echo $tag; ?>" class="atag1">&lt;&lt;</a>
                            <?php
                        } else {
                            ?><a
                            href="problemset.php?page=1&h=0&type=<?php echo($type_qian); ?>&search=<?php echo $search_qian; ?>"
                            class="atag1">&lt;&lt;</a>
                            <?php
                        }
                        ?>
                    </li>
                    <?php
                    if (!isset($page)) $page = 1;
                    $page = intval($page);
                    $section = 8;
                    $start = $page > $section ? $page - $section : 1;
                    $end = $page + $section > $view_total_page ? $view_total_page : $page + $section;
                    for ($i = $start; $i <= $end; $i++) {
                        if ($tag != 'null') {
                            echo "<li class='" . ($page == $i ? "active " : "") . "page-item'>
        <a href='problemset.php?page=" . $i . "&tags=" . $tag . "'class='atags'>" . $i . "</a></li>";
                        } else {
                            echo "<li class='" . ($page == $i ? "active " : "") . "page-item'>
        <a href='problemset.php?page=" . $i . "&h=0&type=" . $type_qian . "&search=" . $search_qian . "' class='atags'>" . $i . "</a></li>";
                        }
                    }
                    ?>
                    <li class="page-item">
                        <?php
                        if ($tag != 'null') {
                            ?>
                            <a href="problemset.php?page=<?php echo $view_total_page ?>&tags=<?php echo $tag; ?>"
                               class="atag1">&gt;&gt;</a>
                            <?php
                        } else {
                            ?><a
                            href="problemset.php?page=<?php echo $view_total_page ?>&h=0&type=<?php echo($type_qian); ?>&search=<?php echo $search_qian; ?>"
                            class="atagmax">&gt;&gt;</a>
                            <?php
                        }
                        ?>
                        <!--<a href="problemset.php?page=<?php echo $view_total_page ?>&h=0&type=<?php echo($type_qian); ?>&search=<?php echo $search_qian; ?>" class="atagmax">&gt;&gt;</a>-->
                    </li>
                </ul>
                <span style="color:dimgrey;float: right;display: inline-block;padding-left: 0;margin: 20px 0;border-radius: 4px;">
								每页显示题数：<select name=page_cnt id=page_cnt style="height: 28px;width: 50px;r>
										<option value=" 10" <?php if ($page_cnt == 10) echo "selected = 'selected'"; ?>
                    >10</option>
                    <option value="20" <?php if ($page_cnt == 20) echo "selected = 'selected'"; ?>>20</option>
										<option value="50" <?php if ($page_cnt == 50) echo "selected = 'selected'"; ?>>50</option>
										<option value="100" <?php if ($page_cnt == 100) echo "selected = 'selected'"; ?>>100</option>
                    </select>
							</span>
            </nav>
            <table>
                <tr align='center' class='evenrow'>
                    <td width='5'></td>
                    <td colspan='1'>
                        <div class=form-inline>
                            <input class="form-control search-query" type='text' name='search' id='search'
                                   placeholder="Enter the search content here" style="width: 300px"
                                   value="<?php echo $search_qian ?>">
                            <select name="type" id="type" class="form-control search-query">
                                <option value="id">id</option>
                                <option value="difficulty" <?php if (!strcmp($type_qian, 'difficulty')) {
                                    echo("selected");
                                } ?> >difficulty
                                </option>
                                <option value="KTS" <?php if (!strcmp($type_qian, 'KTS')) {
                                    echo("selected");
                                } ?> >Keywords Title or Source
                                </option>
                            </select>
                            <button class="form-control" type="button" id="searchbutton">
                                Go or <?php echo $MSG_SEARCH ?>
                            </button>


                        </div>
                    </td>
                    <td><!--<a href="problemset.php">Reset</a>-->
                        Tag Statu
                    </td>
                    <td>
                        <!--<button id="hid" style='border:none;border-radius:5px;font-size:18px;font-weight:none;width:60px;height:30px;background:#a8ff24;color:white'>tags</button>-->
                        <input class="mui-switch mui-switch-animbg" id="hid" type="checkbox">

                    </td>
                </tr>
            </table>
            <table id='problemset' width='80%' class='table table-striped'>
                <thead>
                <tr class='toprow' style='text-align:center;'>
                    <th width='5%'></th>
                    <th width='10%' class='hidden-xs' style='text-align:center;'>
                        <?php echo $MSG_PROBLEM_ID ?>
                    </th>
                    <th width='25%' class="title">
                        <?php echo $MSG_TITLE ?>
                    </th>
                    <th class='hidden-xs resource' width='20%'>
                        <?php echo $MSG_SOURCE ?>
                    </th>
                    <th style="cursor:hand" width='5%'>
                        <?php echo $MSG_DEGREE_OF_DIFFICULTY ?>
                    </th>
                    <th style="cursor:hand" class="ac" width='5%'>
                        <?php echo $MSG_AC ?>
                    </th>
                    <th style="cursor:hand" class="submit" width='5%'>
                        <?php echo $MSG_SUBMIT ?>
                    </th>
                    <th class="acradio" width='5%'>
                        <?php echo "Radio" ?>
                    </th>
                    <th style="cursor:hand;display: none" width='auto' class="hid">
                        <?php echo $MSG_PROBLEM_LABEL ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $cnt = 0;
                foreach ($view_problemset as $row) {
                    if ($cnt)
                        echo "<tr class='oddrow' align='center'>";
                    else
                        echo "<tr class='evenrow' align='center'>";
                    $i = 0;
                    foreach ($row as $table_cell) {
                        if ($i == 1 || $i == 3) echo "<td  class='hidden-xs' align='center'>";
                        //								添加标签栏输出数据
                        elseif ($i == 8) echo "<td class='hid' style=' display: none;border-radius:5px'>";
                        //								添加标签栏输出数据结束
                        else echo "<td align='center'>";
                        echo "\t" . $table_cell;
                        echo "</td>";
                        $i++;
                    }
                    echo "</tr>";
                    $cnt = 1 - $cnt;
                }
                ?>
                </tbody>
            </table>
        </center>
        <div style="float:right;width: 15%;height:1000px;border:1px dashed #fcfcfc;margin-top:10px; ">
            <!--     <?php /*include("../../category.php")*/ ?>
            --><?php /*include("template/".$OJ_TEMPLATE."/category.php")*/ ?>
            <h1 style="font-size: 25px">Tags</h1>
            <div id="tag">

                <?php
                echo("<ul>");
                foreach ($view_tags as $row) {
                    echo "<li ><span class='l1' >" . $row['tag1'] . "</span><ul class='ul'>";
                    foreach ($row['tag2'] as $l) {
                        echo "<li class='tags'><span>" . $l['tag2_name'] . "<span></li>";
                    }
                    echo "</ul></li>";
                }
                echo("</ul>");
                ?>
            </div>
        </div>
    </div>

</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script type="text/javascript" src="include/jquery.tablesorter.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#problemset").tablesorter();
        $("#problemset").after($("#page").prop("outerHTML"));
        var h = 0;
        $("#searchbutton").click(function () {
            var type = $("#type").val();
            var search = $("#search").val();
            if (type == 'id' && search != '') {
                window.location.href = "problem.php?id=" + search;
            } else if (search != '') {
                window.location.href = "problemset.php?type=" + type + "&search=" + search + "&h=" + h + "&page=1";
            }
        });
        $(".l1").click(function () {
            var val1 = this;
            //val1 = val1.firstChild;
            val1 = val1.nextElementSibling;
            var dis_v = val1.style.display;
            if (dis_v == "block")
                val1.style.display = "none";
            else
                val1.style.display = "block";
        });
        //二级菜单展开部分 结束


        //			对于标签和隐藏内容的处理

        $(".tags").click(function () {
            var a = this.firstChild.firstChild.nodeValue;
            window.location.href = "problemset.php?page=1&tags=" + a;
        });

        //用于标签显示与隐藏和页面跳转链接重写
        $("#hid").click(function () {
            if (h == 0) {
                $(".hid").css("display", "block");
                h = 1;
                var $atag = $(".atags");
                $atag.each(function () {
                    var $this = $(this);
                    var temp = $this.attr("href");
                    var index1 = temp.indexOf("h=");
                    temp = temp.substring(0, index1 + 2) + h;
                    temp = temp + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>";
                    $this.attr("href", temp);
                });
                $(".atag1").attr("href", "problemset.php?page=1&h=" + h + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>");
                $(".atagmax").attr("href", "problemset.php?page=" + <?php echo $view_total_page?> +"&h=" + h + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>");
            } else {
                $(".hid").css("display", "none");
                h = 0;
                var $atag = $(".atags");
                $atag.each(function () {
                    var $this = $(this);
                    var temp = $this.attr("href");
                    var index1 = temp.indexOf("h=");
                    temp = temp.substring(0, index1 + 2) + h;
                    temp = temp + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>";
                    $this.attr("href", temp);
                });
                $(".atag1").attr("href", "problemset.php?page=1&h=" + h + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>");
                $(".atagmax").attr("href", "problemset.php?page=" + <?php echo $view_total_page?> +"&h=" + h + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>");
            }
        });
        //用于标签显示与隐藏和页面跳转链接重写 结束

        var a = 1;
        if (a == <?php echo $tage_kaiguan ?> ) {
            $(".hid").css("display", "block");
            h = 1;
        }
        //               对于标签和隐藏内容的处理  结束

        //翻页跳转部分
        function paging1() {
            window.location.href = "problemset.php";
        }

        //添加如下代码，用于处理  是否默认显示标签
        if (1 == <?php echo $h ?> ) {
            $(".hid").css("display", "block");
            h = 1;
            var $atag = $(".atags");
            $atag.each(function () {
                var $this = $(this);
                var temp = $this.attr("href");
                var index1 = temp.indexOf("h=");
                temp = temp.substring(0, index1 + 2) + h;
                temp = temp + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>";
                $this.attr("href", temp);
            });
            $(".atag1").attr("href", "problemset.php?page=1&h=" + h + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>");
            $(".atagmax").attr("href", "problemset.php?page=" + <?php echo $view_total_page?> +"&h=" + h + "&type=<?php echo($type_qian);?>&search=<?php echo $search_qian;?>");
        }
        //分页跳转
        $("#page_cnt").change(function () {
            var href_ = window.location.href;
            href_ = changeUrlArg(href_, 'page', 1);
            if (href_.indexOf("page_cnt") >= 0) {
                window.location.href = changeUrlArg(href_, 'page_cnt', $("#page_cnt").val());
            } else if (href_.indexOf("?") >= 0) {
                window.location.href = href_ + "&page_cnt=" + $("#page_cnt").val();
            } else {
                window.location.href = href_ + "?page_cnt=" + $("#page_cnt").val();
            }

        });

        function changeUrlArg(url, arg, val) {
            var pattern = arg + '=([^&]*)';
            var replaceText = arg + '=' + val;
            return url.match(pattern) ? url.replace(eval('/(' + arg + '=)([^&]*)/gi'), replaceText) : (url.match('[\?]') ? url + '&' + replaceText : url + '?' + replaceText);
        }
    });
</script>
</body>
</html>
