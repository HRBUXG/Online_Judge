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
        <center style="float: left;width: 65%">

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
<!--                    <td><!--<a href="problemset.php">Reset</a>-->
<!--                        Tag Statu-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        <!--<button id="hid" style='border:none;border-radius:5px;font-size:18px;font-weight:none;width:60px;height:30px;background:#a8ff24;color:white'>tags</button>-->
<!--                        <input class="mui-switch mui-switch-animbg" id="hid" type="checkbox">-->
<!---->
<!--                    </td>-->
                </tr>
            </table>
            <table id='problemset' width='70%' class='table table-striped'>
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
                        <?php echo $MSG_AC ?><?php echo $MSG_SUBMIT ?>
                    </th>
                    <!--  <th style="cursor:hand" class="submit" width='5%'>
                        <?php /*echo $MSG_SUBMIT */ ?>
                    </th>
                    <th class="acradio" width='5%'>
                        <?php /*echo "Radio" */ ?>
                    </th>-->
                    <th style="cursor:hand" class="submit" width='5%'>
                        <?php echo $MSG_PROBLEM_LABEL ?>
                    </th>
                    <!--  <th style="cursor:hand;display: none" width='auto' class="hid">
                        <?php /*echo $MSG_PROBLEM_LABEL */ ?>
                    </th>-->
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
                        elseif ($i == 7) echo "<td class='hid' style=' display: none;border-radius:5px'>";
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
        <div style="float:right;width: 25%;height:1000px;border:1px dashed #fcfcfc;margin-top:10px; ">
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
            <!--============================================================================================================-->
            <!--综合推荐-->
            <input type="submit" value="综合推荐" onclick="display('lb')">
            <div id="lb" style="display:none">
                <font>
                    <table cellspacing="0">
                        <tr>
                            <html>
                            <head>
                                <style type="text/css">
                                    table {
                                        border: 0;
                                        cellspacing: 0;
                                        cellpadding: 0;
                                    }

                                    table tr {
                                        border: none;
                                        padding: 0;
                                        margin: 0;
                                    }

                                    table td {
                                        background: #ffffff;
                                        border-bottom: 3px solid whitesmoke;
                                        border-top: 3px solid powderblue;
                                        margin: 0;
                                        padding: 7px;
                                    }

                                    table td:hover {

                                        cursor: pointer;
                                    }
                                </style>
                                <meta charset="utf-8">
                                <title>Ascension</title>
                            </head>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: LIJICHEN
 * Date: 2019/4/10
 * Time: 18:27
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////
$NJ = $_SESSION[$OJ_NAME . '_' . 'user_id'];//学号接口
$problems = 30; //判断是否是新手的正确题数
$ranking = 50;//规定平台前多少名去开辟新题
$How_many_name_before = 50;//取用户前多少名走基于协同的cf算法 （切记 $How_many_name_before < $ranking）
$Question_number = 10;//输出的题数
////////////////////////////////////////////////////////////////////////////////////////////////////////
$no = $NJ;
$S = 0;
//==================================================================
$con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
$array1 = array();//存放在用户前三十名的用户的学号；
$array2 = array();//客户的做题题号
$array3 = array();//存放相似度高的用户的做题题号
$array4 = array();//存放相似度高的用户的做题题号
$array5 = array();//存放相似度高的用户的做题题号
$array6 = array();//存放相似度高的用户的做题题号
$array7 = array();//存放相似度高的用户的做题题号
$array8 = array();//存放相似度高的用户的做题题号
$array9 = array();//存放相似度高的用户的做题题号
$array10 = array();//存放相似度高的用户的做题题号
$array11 = array();//存放相似度高的用户的做题题号
$array12 = array();//存放相似度高的用户的做题题号
$array13 = array();//存放客户的相似度
$array14 = array();
$array15 = array();
$array16 = array();
$array17 = array();
$array18 = array();
$array100 = array();
$num = 0;
$con->query("SET NAMES utf8");//定义字符编码
$sql = "SELECT id FROM ranking WHERE  user_id = '" . $NJ . "'";   //提出年级
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
{
    $NJ = $row['id'];
}
$sql = "SELECT problem_id,result FROM solution where  user_id = '" . $no . "'and result=4";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $array1[] = $row['problem_id'];
}
$array2 = array_flip($array1);
$array2 = array_flip($array2);
$array2 = array_merge($array2);
//判断是否是新用户或者平台前多少名
echo "<td >" . "<font size=5>" . "题号" . "</font>";
echo "<td >" . "<font size=5>" . "题名" . "</font>";
echo "<td >" . "<font size=5>" . "来源" . "</font>";
echo "</tr>";
if ($NJ >= $ranking) {
    $array1 = $array3;
    $array2 = $array3;
    $NJ1 = $NJ - $How_many_name_before;
    $sql = "SELECT user_id FROM ranking WHERE  id >='" . $NJ1 . "'and id <= '" . $NJ . "'";   //提出年级

    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array1[] = $row['user_id'];
    }
    //取出用户的做题题号，去重后将题号存入array2
    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[0] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array2[] = $row['problem_id'];
    }
    $array2 = array_flip($array2);
    $array2 = array_flip($array2);
    $array2 = array_merge($array2);
    //
    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[1] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array3[] = $row['problem_id'];
    }
    $array3 = array_flip($array3);
    $array3 = array_flip($array3);
    $array3 = array_merge($array3);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[2] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array4[] = $row['problem_id'];
    }
    $array4 = array_flip($array4);
    $array4 = array_flip($array4);
    $array4 = array_merge($array4);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[3] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array5[] = $row['problem_id'];
    }
    $array5 = array_flip($array5);
    $array5 = array_flip($array5);
    $array5 = array_merge($array5);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[4] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array6[] = $row['problem_id'];
    }
    $array6 = array_flip($array6);
    $array6 = array_flip($array6);
    $array6 = array_merge($array6);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[5] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array7[] = $row['problem_id'];
    }
    $array7 = array_flip($array7);
    $array7 = array_flip($array7);
    $array7 = array_merge($array7);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[6] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array8[] = $row['problem_id'];
    }
    $array8 = array_flip($array8);
    $array8 = array_flip($array8);
    $array8 = array_merge($array8);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[7] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array9[] = $row['problem_id'];
    }
    $array9 = array_flip($array9);
    $array9 = array_flip($array9);
    $array9 = array_merge($array9);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[8] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array10[] = $row['problem_id'];
    }
    $array10 = array_flip($array10);
    $array10 = array_flip($array10);
    $array10 = array_merge($array10);

    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[9] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array11[] = $row['problem_id'];
    }
    $array11 = array_flip($array11);
    $array11 = array_flip($array11);
    $array11 = array_merge($array11);
    $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[10] . "'";   //提出年级
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array12[] = $row['problem_id'];
    }
    $array12 = array_flip($array12);
    $array12 = array_flip($array12);
    $array12 = array_merge($array12);
    $array13[0] = (double)(round((count($array2) - count(array_diff($array2, $array3))) / (count($array2) * count($array3)), 8) * 1000000);
    $array13[1] = (double)(round((count($array2) - count(array_diff($array2, $array4))) / (count($array2) * count($array4)), 8) * 1000000);
    $array13[2] = (double)(round((count($array2) - count(array_diff($array2, $array5))) / (count($array2) * count($array5)), 8) * 1000000);
    $array13[3] = (double)(round((count($array2) - count(array_diff($array2, $array6))) / (count($array2) * count($array6)), 8) * 1000000);
    $array13[4] = (double)(round((count($array2) - count(array_diff($array2, $array7))) / (count($array2) * count($array7)), 8) * 1000000);
    $array13[5] = (double)(round((count($array2) - count(array_diff($array2, $array8))) / (count($array2) * count($array8)), 8) * 1000000);
    $array13[6] = (double)(round((count($array2) - count(array_diff($array2, $array9))) / (count($array2) * count($array9)), 8) * 1000000);
    $array13[7] = (double)(round((count($array2) - count(array_diff($array2, $array10))) / (count($array2) * count($array10)), 8) * 1000000);
    $array13[8] = (double)(round((count($array2) - count(array_diff($array2, $array11))) / (count($array2) * count($array11)), 8) * 1000000);
    $array13[9] = (double)(round((count($array2) - count(array_diff($array2, $array12))) / (count($array2) * count($array12)), 8) * 1000000);

    $array18 = $array13;
    //冒泡排序
    for ($i = 0; $i < count($array13); $i++) {
        for ($i1 = 0; $i1 < $i; $i1++) {
            if ($array13[$i] < $array13[$i1]) {
                $temp = $array13[$i];
                $array13[$i] = $array13[$i1];
                $array13[$i1] = $temp;
            }
        }
    }

    for ($i = 11; $i < count($array1); $i++) {
        $sql = "SELECT problem_id FROM solution WHERE user_id= '" . $array1[$i] . "'";   //提出年级
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
        {
            $array14[] = $row['problem_id'];
        }
        $array14 = array_flip($array14);
        $array14 = array_flip($array14);
        $array14 = array_merge($array14);


        $a = (double)(round((count($array2) - count(array_diff($array2, $array14))) / (count($array2) * count($array14)), 8) * 1000000);
        for ($j = 0; $j < count($array13); $j++) {
            if ($a > $array13[$j]) {
                for ($j1 = 0; $j1 < count($array18); $j1++) {
                    if ($array18[$j1] == $array13[$j]) {
                        $array13[$j] = $a;
                        $b = $j1 + 1;
                        $array18[$j1] == $array13[$j];
                        if ($b == 1) {
                            $array3 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 2) {
                            $array4 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 3) {
                            $array5 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 4) {
                            $array6 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 5) {
                            $array7 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 6) {
                            $array8 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 7) {
                            $array9 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 8) {
                            $array10 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 9) {
                            $array11 = $array14;
                            $array14 = $array15;
                            break;
                        }
                        if ($b == 10) {
                            $array12 = $array14;
                            $array14 = $array15;
                            break;
                        }
                    }
                }
                //冒泡排序确保相似率是最高得10位用户
                for ($i = 0; $i < count($array13); $i++) {
                    for ($i1 = 0; $i1 < $i; $i1++) {
                        if ($array13[$i] < $array13[$i1]) {
                            $temp = $array13[$i];
                            $array13[$i] = $array13[$i1];
                            $array13[$i1] = $temp;
                        }
                    }
                }


            }
        }
    }
    //合并相似率最高的10个人的题
    $array16 = $array3 + $array4 + $array5 + $array6 + $array7 + $array8 + $array9 + $array10 + $array11 + $array12;
    //去重
    $array16 = array_flip($array16);
    $array16 = array_flip($array16);
    $array16 = array_merge($array16);
    //去掉和用户相同的题
    $array16 = array_diff($array16, $array2);
    $array16 = array_merge($array16);
    //去掉和用户相同的题
    $array3 = array_diff($array3, $array2);
    $array3 = array_merge($array3);
    //去掉和用户相同的题
    $array4 = array_diff($array4, $array2);
    $array4 = array_merge($array4);
    //去掉和用户相同的题
    $array5 = array_diff($array5, $array2);
    $array5 = array_merge($array5);
    //去掉和用户相同的题
    $array6 = array_diff($array6, $array2);
    $array6 = array_merge($array6);
    //去掉和用户相同的题
    $array7 = array_diff($array7, $array2);
    $array7 = array_merge($array7);
    //去掉和用户相同的题
    $array8 = array_diff($array8, $array2);
    $array8 = array_merge($array8);
    //去掉和用户相同的题
    $array9 = array_diff($array9, $array2);
    $array9 = array_merge($array9);
    //去掉和用户相同的题
    $array10 = array_diff($array10, $array2);
    $array10 = array_merge($array10);
    //去掉和用户相同的题
    $array11 = array_diff($array11, $array2);
    $array11 = array_merge($array11);
    //去掉和用户相同的题
    $array12 = array_diff($array12, $array2);
    $array12 = array_merge($array12);

//算K
    for ($i = 0; $i < count($array16); $i++) {
        $sum = 0;
        for ($i1 = 0; $i1 < count($array3); $i1++) {
            if ($array3[$i1] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array3)), 8) * 1000000;
                break;
            }
        }
        for ($i2 = 0; $i2 < count($array4); $i2++) {
            if ($array4[$i2] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array4)), 8) * 1000000;
                break;
            }
        }
        for ($i3 = 0; $i3 < count($array5); $i3++) {
            if ($array5[$i3] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array5)), 8) * 1000000;
                break;
            }
        }
        for ($i4 = 0; $i4 < count($array6); $i4++) {
            if ($array6[$i4] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array6)), 8) * 1000000;
                break;
            }
        }
        for ($i5 = 0; $i5 < count($array7); $i5++) {
            if ($array7[$i5] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array7)), 8) * 1000000;
                break;
            }
        }
        for ($i6 = 0; $i6 < count($array8); $i6++) {
            if ($array8[$i6] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array8)), 8) * 1000000;
                break;
            }
        }
        for ($i7 = 0; $i7 < count($array9); $i7++) {
            if ($array9[$i7] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array9)), 8) * 1000000;
                break;
            }
        }
        for ($i8 = 0; $i8 < count($array10); $i8++) {
            if ($array10[$i8] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array10)), 8) * 10000000;
                break;
            }
        }
        for ($i9 = 0; $i9 < count($array11); $i9++) {
            if ($array11[$i9] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array11)), 8) * 1000000;
                break;
            }
        }
        for ($i10 = 0; $i10 < count($array12); $i10++) {
            if ($array12[$i10] == $array16[$i]) {
                $sum += round(1 / (count($array2) * count($array12)), 8) * 1000000;
                break;
            }
        }
        $array17[$i] = $sum;
    }
//冒泡排序
    for ($i = 0; $i < count($array17); $i++) {
        for ($i1 = 0; $i1 < $i; $i1++) {
            if ($array17[$i] > $array17[$i1]) {
                $temp = $array17[$i];
                $array17[$i] = $array17[$i1];
                $array17[$i1] = $temp;
                $T = $array16[$i];
                $array16[$i] = $array16[$i1];
                $array16[$i1] = $T;
            }
        }
    }
//////////////////输出模块1

    for ($i = 0; $i < count($array16); $i++) {
        $b = $array16[$i];
        $sql = "SELECT  problem_id,title,source,accepted, submit FROM problem  WHERE problem_id= '" . $b . "'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr><td>' . $row['problem_id'] . '</td><td>' . $row['title'] . '</td><td>' . $row['source'] . '</td></tr>';
            $S++;
        }
        if ($S == $Question_number) {
            break;
        }
    }
    $array100 = $array16;
//////////////////输出模块1结束
//==============================================================================================================================前30开新题模块
} else {
    $array1 = array();//存放所有题题号 =============存放题库标签
    $array2 = array();//所有题的做题情况===========存放题图标签对应的难度系数
    $array4 = array();//存放各个题的标签============存放题图标签对应的standard_ac
    $array5 = array();//赛选出来的错误题号==========存放题图标签对应的standard_person
    $array6 = array();//所有标签==================存放题图标签对应的difficulty1的题数
    $array8 = array();//每个标签的正确量==================存放题图标签对应的difficulty2的题数
    $array9 = array();//每个标签的错误量==================存放题图标签对应的difficulty3的题数
    $array10 = array();//每个标签的提交量==================存放题图标签对应的difficulty4的题数
    $array11 = array();//来源==================存放题图标签对应的difficulty5的题数
    $array12 = array();//用户对应题的难度系数==================存放题图标签对应的difficulty6的题数
    $array25 = array();//存放题图标签对应的difficulty7的题数
    $array26 = array();//存放题图标签对应的difficulty8的题数
    $array27 = array();//存放题图标签对应的difficulty9的题数
    $array28 = array();//存放题图标签对应的difficulty10的题数
    $array29 = array();//存放题图标签对应的difficulty11的题数
    $array30 = array();
    $array31 = array();//每个标签的题总数
//////
    $array7 = array();//查重后的标签
    $array3 = array();//查重后的题号     ==========
    $array13 = array(); //0
    $array14 = array(); //0.1
    $array15 = array();//0.2
    $array16 = array();//0.3
    $array17 = array();//0.4
    $array18 = array();//0.5
    $array19 = array();//0.6
    $array20 = array();//0.7
    $array21 = array();//0.8
    $array22 = array();//0.9
    $array23 = array();//1
    $array24 = array();//
    $array32 = array();//用户每个标签的AC总数;
    $array33 = array();//推荐的题号
    $array34 = array();//推荐的题名
    $array35 = array();//推荐的题来源
    $con->query("SET NAMES utf8");//定义字符编码

    $sql = "SELECT problem_id,result FROM solution where user_id='" . $no . "' ";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array1[] = $row['problem_id'];
        $array2[] = $row['result'];
    }
    $array3 = $array1;
    $array3 = array_flip($array3);
    $array3 = array_flip($array3);
    $array3 = array_merge($array3);

    for ($i = 0; $i < count($array3); $i++) {
        for ($j = 0; $j < count($array2); $j++) {
            if ($array3[$i] == $array1[$j]) {
                if ($array2[$j] == 4) {
                    $array24[$i] = 4;
                    break;
                } else {
                    $array24[$i] = $array2[$j];
                }
            }
        }
    }
    $array2 = $array24;
    $array24 = $array23;
    for ($i = 0; $i < count($array3); $i++) {
        $sql = "SELECT tags,difficulty FROM problem where problem_id='" . $array3[$i] . "' ";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
        {
            $array4[] = strtr($row['tags'], ';', ',');
            $array12[] = $row['difficulty'];
        }
    }
    $sq2 = "SELECT nick FROM users where user_id='" . $no . "' ";
    $result = mysqli_query($con, $sq2);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $name = $row['nick'];
    }
    $array5 = array_flip($array4);
    $array5 = array_flip($array5);
    $array5 = array_merge($array5);
    $sum = 0;
    for ($i = 0; $i < count($array5); $i++) {
        $BQ = explode(',', $array5[$i]);
        for ($j = 0; $j < count($BQ); $j++) {
            $array6[$sum] = $BQ[$j];
            $sum++;
        }
    }
    $array7 = array_flip($array6);
    $array7 = array_flip($array7);
    $array7 = array_merge($array7);
//条件筛选题
    for ($i = 0; $i < count($array7); $i++) {
        $sum1 = 0;
        $sum2 = 0;
        $NL = 0;
        $n0 = 0;
        $n1 = 0;
        $n2 = 0;
        $n3 = 0;
        $n4 = 0;
        $n5 = 0;
        $n6 = 0;
        $n7 = 0;
        $n8 = 0;
        $n9 = 0;
        $n10 = 0;
        for ($j = 0; $j < count($array4); $j++) {
            $BQ1 = explode(',', $array4[$j]);
            for ($k = 0; $k < count($BQ1); $k++) {
                if ($array7[$i] == $BQ1[$k]) {
                    if ($array2[$j] == 4) {
                        $sum1++;
                        if ($array12[$j] == 0) {
                            $n0++;
                        }
                        if ($array12[$j] == 0.1) {
                            $n1++;
                        }
                        if ($array12[$j] == 0.2) {
                            $n2++;
                        }
                        if ($array12[$j] == 0.3) {
                            $n3++;
                        }
                        if ($array12[$j] == 0.4) {
                            $n4++;
                        }
                        if ($array12[$j] == 0.5) {
                            $n5++;
                        }
                        if ($array12[$j] == 0.6) {
                            $n6++;
                        }
                        if ($array12[$j] == 0.7) {
                            $n7++;
                        }
                        if ($array12[$j] == 0.8) {
                            $n8++;
                        }
                        if ($array12[$j] == 0.9) {
                            $n9++;
                        }
                        if ($array12[$j] == 1) {
                            $n10++;
                        }
                    } else {
                        $sum2++;
                    }
                }
            }
        }
        /*
         * $array8[$i]=$sum1;     //正确数
        $array9[$i]=$sum2;      //错误数
        $array10[$i]=$sum2+$sum1;   //提交量
     */
        $array8[$i] = $sum1;
        $array9[$i] = $sum2;
        $array10[$i] = $sum2 + $sum1;
        $array13[$i] = $n0;
        $array14[$i] = $n1;
        $array15[$i] = $n2;
        $array16[$i] = $n3;
        $array17[$i] = $n4;
        $array18[$i] = $n5;
        $array19[$i] = $n6;
        $array20[$i] = $n7;
        $array21[$i] = $n8;
        $array22[$i] = $n9;
        $array23[$i] = $n10;
    }
    $array32 = $array8;
    $array1 = $array30;
    $array2 = $array30;
/////////////////////                                    //////////标签难度系数排序
    $sql = "SELECT tags,difficulty FROM lable";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $array1[] = strtr($row['tags'], ';', ',');
        $array2[] = $row['difficulty'];
    }
//冒泡排序对标签进行难度系数排序
    for ($i = 0; $i < count($array1) - 1; $i++) {
        for ($j = 0; $j < count($array1) - $i - 1; $j++) {
            $a = $j;
            $a = $a + 1;
            if ($array2[$j] > $array2[$a]) {

                $tmp1 = $array1[$a];
                $array1[$a] = $array1[$j];
                $array1[$j] = $tmp1;
                $tmp = $array2[$a];
                $array2[$a] = $array2[$j];
                $array2[$j] = $tmp;
            }
        }
    }
//////////////////////////////标签难度系数排序

////////////////////////////获取数据lable
    $array4 = $array30;
    $array5 = $array30;
    $array6 = $array30;
    $array8 = $array30;
    $array9 = $array30;
    $array10 = $array30;
    $array11 = $array30;
    $array12 = $array30;
    $array25 = $array30;
    $array26 = $array30;
    $array27 = $array30;
    $array28 = $array30;
    $array29 = $array30;
    for ($i = 0; $i < count($array1); $i++) {
        $sql = "SELECT standard_ac,standard_ac,difficulty1,difficulty2,difficulty3,
 difficulty4,difficulty5,difficulty6,difficulty7,difficulty8,difficulty9,difficulty10,
 difficulty11,sum FROM lable where tags='" . $array1[$i] . "' ";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $array4[] = $row['standard_ac'];
            $array5[] = $row['standard_ac'];
            $array6[] = $row['difficulty1'];
            $array8[] = $row['difficulty2'];
            $array9[] = $row['difficulty3'];
            $array10[] = $row['difficulty4'];
            $array11[] = $row['difficulty5'];
            $array12[] = $row['difficulty6'];
            $array25[] = $row['difficulty7'];
            $array26[] = $row['difficulty8'];
            $array27[] = $row['difficulty9'];
            $array28[] = $row['difficulty10'];
            $array29[] = $row['difficulty11'];
            $array31[] = $row['sum'];
        }
    }
    $a = 0;
    $b = 0;
    $c = 0;
    for ($i = 0; $i < count($array1); $i++) {
        for ($j = 0; $j < count($array7); $j++) {
            if ($array1[$i] == $array7[$j]) {
                if (round($array32[$j] / $array31[$i], 4) * 100 >= $array4[$i]) {
                    break;
                } else {

                    //difficulty1
                    if ($array6[$i] != 0) {
                        if (round($array13[$j] / $array6[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array6[$i] - $array13[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty2
                    if ($array8[$i] != 0) {
                        if (round($array16[$j] / $array8[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array8[$i] - $array14[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.1 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty3
                    if ($array9[$i] != 0) {
                        if (round($array15[$j] / $array9[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array9[$i] - $array15[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.2 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty4
                    if ($array10[$i] != 0) {
                        if (round($array16[$j] / $array10[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array10[$i] - $array16[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.3 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty5
                    if ($array11[$i] != 0) {
                        if (round($array17[$j] / $array11[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array11[$i] - $array17[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.4 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty6
                    if ($array12[$i] != 0) {
                        if (round($array18[$j] / $array12[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array12[$i] - $array18[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.5 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty7
                    if ($array25[$i] != 0) {
                        if (round($array19[$j] / $array25[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array25[$i] - $array19[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.6 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty8
                    if ($array26[$i] != 0) {
                        if (round($array20[$j] / $array26[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array26[$i] - $array20[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.7 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty9
                    if ($array27[$i] != 0) {
                        if (round($array21[$j] / $array27[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array27[$i] - $array21[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.8 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty10
                    if ($array28[$i] != 0) {
                        if (round($array22[$j] / $array28[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array28[$i] - $array22[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.9 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    //difficulty11
                    if ($array29[$i] != 0) {
                        if (round($array23[$j] / $array29[$i], 4) * 100 >= $array5[$i]) {
                            break;
                        } else {
                            $b = $b + ($array29[$i] - $array23[$j]);
                            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 1 . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $array33[$c] = $row['problem_id'];
                                $array34[$c] = $row['source'];
                                $array35[$c] = $row['title'];
                                $c++;
                            }
                        }
                    }
                    if ($b >= 10) {
                        break;
                    }
                    ////////////////////
                    break;
                }
                $a++;

            }
        }
        if ($b >= 10 || $a == count($array7)) {
            break;
        }
    }
//==================================================开新标签
    if ($b < 10) {
        $array1 = array_diff($array1, $array7);
        $array1 = array_merge($array1);
        for ($i = 0; $i < count($array1); $i++) {
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.1 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.2 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.3 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.4 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.5 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.6 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.7 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.8 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 0.9 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
            $sql = "SELECT problem_id,source,title FROM problem where tags like '%" . $array1[$i] . "%' and difficulty='" . 1 . "' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $array33[$c] = $row['problem_id'];
                $array34[$c] = $row['source'];
                $array35[$c] = $row['title'];
                $c++;
            }
            if ($c >= 10) {
                break;
            }
        }
    }
    $array24 = $array33;//推荐的题来源
    $array24 = array_diff($array24, $array3);
    $array24 = array_merge($array24);
    ////////////////////////////=============================================================================================//////////////////输出模块2

    for ($i = 0; $i < count($array24); $i++) {
        for ($j = 0; $j < count($array33); $j++) {
            if ($array24[$i] == $array33[$j]) {
                echo '<td>' . $array33[$i] . '</td><td>' . $array35[$i] . '</td><td>' . $array34[$i] . '</td></tr>';
                $S++;
                break;
            }
        }
        if ($S == $Question_number) {
            break;
        }
    }
////////////////////////////=============================================================================================//////////////////输出模块2结束
    /*
     *
     *  echo '<tr><td>' . $array1[$i] . '</td><td>' . $array2[$i] . '</td><td>' . $array4[$i] . '</td>
                   <td>' . $array5[$i] . '</td><td>' . $array6[$i] . '</td><td>' . $array8[$i] . '</td>
                   <td>' . $array9[$i] . '</td><td>' . $array10[$i] . '</td><td>' . $array11[$i] . '</td>
                   <td>' . $array12[$i] . '</td><td>' . $array25[$i] . '</td><td>' . $array26[$i] . '</td>
                   <td>' . $array27[$i] . '</td><td>' . $array28[$i] . '</td><td>' . $array29[$i] . '</td>
                   <td>' . $array31[$i] . '</td></tr>';
    */
//=====================================================更新数据库表lable对应的属性值
    /*
    $array2 = array();//存放全部标签
    $array3 = array();//存放筛选出来的标签
    $array4 = array();//存放各个标签做的题数
    $array5 = array();//存放各个标签做题的正确题数
    $array6= array();
    $array7= array();
    $array8= array();
    $array9= array();
    $array10= array();
    $array11= array();
    $array12= array();
    $array13= array();
    $array14= array();
    $array15= array();
    $array16= array();
    $array17= array();
    $con->query("SET NAMES utf8");//定义字符编码
    $sql = "SELECT problem_id,tags FROM problem ";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)) //取当前数据放入数组
    {
        $array2[]=strtr($row['tags'],';',',');//对数据进行处理，将；换成，
    }
    $num=0;
    for ($i=0;$i<count($array2);$i++){
        $foo = explode(',',$array2[$i]);//对单个数据进行条件分割
        for ($j=0;$j<count($foo);$j++){
            $F=true;
            for ($k=0;$k<count($array3);$k++){//查看数组是否元素重复
                if($foo[$j]==$array3[$k]){
                    $F=false;
                }
            }
            if($F==true){
                $array3[$num]=$foo[$j];$num++;//不重复进行数组元素添加
            }
        }
    }
    for($i=0;$i<count($array3);$i++){//处理后的标签查询
        $sum1=0;
        $num1=0;
        $num2=0;
        $a0=0;$a1=0;$a2=0;$a3=0;$a4=0;$a5=0;$a6=0;$a7=0;$a8=0;$a9=0;$a10=0;
        $sql = "SELECT problem_id,tags,accepted,submit,difficulty FROM problem where tags like '%" . $array3[$i] . "%'";
        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
        {
            $num1+= $row['accepted'];
            $num2+= $row['submit'];
            if($row['difficulty']==0){$a0++;}
            if($row['difficulty']==0.1){$a1++;}
            if($row['difficulty']==0.2){$a2++;}
            if($row['difficulty']==0.3){$a3++;}
            if($row['difficulty']==0.4){$a4++;}
            if($row['difficulty']==0.5){$a5++;}
            if($row['difficulty']==0.6){$a6++;}
            if($row['difficulty']==0.7){$a7++;}
            if($row['difficulty']==0.8){$a8++;}
            if($row['difficulty']==0.9){$a9++;}
            if($row['difficulty']==1){$a10++;}
            $sum1++;
        }
        $array4[$i]=$num1;
        $array5[$i]=$num2;
        $array6[$i]=$sum1;
        $array7[$i]= $a0;
        $array8[$i]= $a1;
        $array9[$i]= $a2;
        $array10[$i]= $a3;
        $array11[$i]= $a4;
        $array12[$i]= $a5;
        $array13[$i]= $a6;
        $array14[$i]= $a7;
        $array15[$i]= $a8;
        $array16[$i]= $a9;
        $array17[$i]= $a10;
    }

    //////////////////////////////////

    $sql = "delete from lable";
    mysqli_query($con,$sql);
    $BM='lable';
    // $tmpstr='(';
    $tmpstr = "'". $array3[0] ."','". (round($array4[0]/$array5[0],3)*10) ."','". $array6[0] ."','". (round($array4[0]/$array5[0],4)*100) ."',
    '". (round($array4[0]/$array5[0],4)*100)."','". $array7[0] ."'
    ,'". $array8[0] ."','". $array9[0] ."','". $array10[0] ."','". $array11[0] ."','". $array12[0] ."','". $array13[0] ."'
    ,'". $array14[0] ."','". $array15[0] ."','". $array16[0] ."','". $array17[0] ."','". 0 ."'";
    $sql2="INSERT INTO ". $BM." (tags,difficulty,sum,standard_ac,standard_person,difficulty1,difficulty2,difficulty3,difficulty4,
    difficulty5,difficulty6,difficulty7,difficulty8,difficulty9,
    difficulty10,difficulty11,id) VALUES(".$tmpstr.")";
    $sql2 .= ",";
    for($i=1;$i<count($array3);$i++){
        if($array5[$i]!=0){

            $tmpstr = "'". $array3[$i] ."','". (round($array4[$i]/$array5[$i],3)*10) ."','". $array6[$i] ."','". (round($array4[$i]/$array5[$i],4)*100) ."',
    '". (round($array4[$i]/$array5[$i],4)*100)."','". $array7[$i] ."'
    ,'". $array8[$i] ."','". $array9[$i] ."','". $array10[$i] ."','". $array11[$i] ."','". $array12[$i] ."','". $array13[$i] ."'
    ,'". $array14[$i] ."','". $array15[$i] ."','". $array16[$i] ."','". $array17[$i] ."','". $i ."'";
        }
        else{
            $tmpstr = "'". $array3[$i] ."','". 1 ."','". $array6[$i] ."'
            ,'". 20 ."','". 20 ."','". $array7[$i] ."'
    ,'". $array8[$i] ."','". $array9[$i] ."','". $array10[$i] ."','". $array11[$i] ."','". $array12[$i] ."','". $array13[$i] ."'
    ,'". $array14[$i] ."','". $array15[$i] ."','". $array16[$i] ."','". $array17[$i] ."','". $i ."'";
        }
        $sql2 .= "(".$tmpstr."),";
    }
    echo $sql2;
    $sql2 = substr($sql2,0,-1);   //去除最后的逗号
    mysqli_query($con,$sql2);*/
    if (count($array24) == 0) {
        echo "你做完了平台的题！你太强了！";
    }
}
//================================================================================ 前30开新题模块
//======================================================================题数不够补充模块，用于走基于协同的算法的用户，如果题数不够，此模块补充出用户短推的标签的题推荐
if ($S < $Question_number) {
    $array1 = array();//存放所有题题号
    $array2 = array();//所有题的做题情况
    $array3 = array();//查重后的题号
    $array4 = array();//存放各个题的标签
    $array5 = array();//赛选出来的错误题号
    $array6 = array();//所有标签
    $array7 = array();//查重后的标签
    $array8 = array();//每个标签的正确量
    $array9 = array();//每个标签的错误量
    $array10 = array();//每个标签的提交量
    $array11 = array();//来源
    $array12 = array();//各个标签的百分比
    $array13 = array();//筛选后满足条件的标签
    $array14 = array();//难度系数
    $array15 = array();//要推荐的题号
    $array16 = array();//要推荐的题的标签
    $array17 = array();//要推荐的题的来源
    $array18 = array();//要推荐的题的难度系数
    $array19 = array();
    $array20 = array();
    $array22 = array();

    $con->query("SET NAMES utf8");//定义字符编码

    $sql = "SELECT problem_id,result FROM solution where user_id='" . $no . "' ";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $array1[] = $row['problem_id'];
        $array2[] = $row['result'];
    }
    $array3 = $array1;
    $array3 = array_flip($array3);
    $array3 = array_flip($array3);
    $array3 = array_merge($array3);
    for ($i = 0; $i < count($array3); $i++) {
        $sql = "SELECT tags,difficulty,source FROM problem where problem_id='" . $array3[$i] . "' ";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
        {
            $array4[] = strtr($row['tags'], ';', ',');
            $array14[] = $row['difficulty'];
            $array11[] = $row['source'];

        }
    }
    $sq2 = "SELECT nick FROM users where user_id='" . $no . "' ";
    $result = mysqli_query($con, $sq2);
    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
    {
        $name = $row['nick']; //用户名
    }
//去重
    $array5 = array_flip($array4);
    $array5 = array_flip($array5);
    $array5 = array_merge($array5);
//$array5=$array4;
    $sum = 0;
    for ($i = 0; $i < count($array5); $i++) {
        $BQ = explode(',', $array5[$i]);
        for ($j = 0; $j < count($BQ); $j++) {
            $array6[$sum] = $BQ[$j];
            $sum++;
        }
    }
//去重
    $array7 = array_flip($array6);
    $array7 = array_flip($array7);
    $array7 = array_merge($array7);
//条件筛选题/////////////////////////////
    for ($i = 0; $i < count($array7); $i++) {
        $sum1 = 0;
        $sum2 = 0;
        for ($j = 0; $j < count($array4); $j++) {
            $BQ1 = explode(',', $array4[$j]);
            for ($k = 0; $k < count($BQ1); $k++) {
                if ($array7[$i] == $BQ1[$k]) {
                    $f1 = true;
                    for ($n = 0; $n < count($array1); $n++) {
                        if ($array3[$j] == $array1[$n]) {
                            if ($array2[$n] == 4) {
                                $sum1++;
                                $f1 = false;
                                break;
                            }
                        }
                    }
                    if ($f1 == true) {
                        $sum2++;
                    }
                }
            }
        }
        /*
         * $array8[$i]=$sum1;     //正确数
        $array9[$i]=$sum2;      //错误数
        $array10[$i]=$sum2+$sum1;   //提交量
     */
        $array8[$i] = $sum1;
        $array9[$i] = $sum2;
        $array10[$i] = $sum2 + $sum1;
    }
    /*
     计算每个标签的百分比，赋值给array12
      */
    for ($i = 0; $i < count($array7); $i++) {
        $array12[$i] = (round($array8[$i] / $array10[$i], 4) * 100);
    }
    $a = 0;
    /*
     for($i=0;$i<count($array12);$i++){
        for($j=0;$j<count($array12);$j++){
          if($array12[$i]<$array12[$j]){
              百分比交换
              $a=$array12[$i];
              $array12[$i]=$array12[$j];
              $array12[$j]=$a;
              标签交换
              $b=$array7[$i];
              $array7[$i]=$array7[$j];
              $array7[$j]=$b;
              难度系数交换
              $a=$array14[$i];
              $array14[$i]=$array14[$j];
              $array14[$j]=$a;
             //来源交换
              $b=$array11[$i];
              $array11[$i]=$array11[$j];
              $array11[$j]=$b;

          }
        }
    }
     */
    for ($i = 0; $i < count($array12); $i++) {
        for ($j = 0; $j < count($array12); $j++) {
            if ($array12[$i] < $array12[$j]) {
                $a = $array12[$i];
                $array12[$i] = $array12[$j];
                $array12[$j] = $a;
                $b = $array7[$i];
                $array7[$i] = $array7[$j];
                $array7[$j] = $b;
                $a = $array14[$i];
                $array14[$i] = $array14[$j];
                $array14[$j] = $a;
                $b = $array11[$i];
                $array11[$i] = $array11[$j];
                $array11[$j] = $b;

            }
        }
    }
    $a = 0;
    $sum3 = 0;
    for ($i = 0; $i < count($array12); $i++) {
        if ($array12[$i] > 0 && $array12[$i] < 100) {
            //
            $sql = "SELECT problem_id,tags,difficulty ,source,title FROM problem where tags like '%" . $array7[$i] . "%'and difficulty='" . $array14[$i] . "' and  source like '%" . $array11[$i] . "%'";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {
                $array15[] = $row['problem_id'];
                $array16[] = $row['tags'];
                $array17[] = $row['source'];
                $array18[] = $row['difficulty'];
                $array20[] = $row['title'];
                $sum3++;
            }
            $array22 = array_diff($array15, $array3);
            $array22 = array_merge($array22);

            //
            if (count($array22) > 10) {
                break;
            }
        }
    }
    $array21 = array();
//
    if (count($array22) < 10) {
        $a = 0;
        for ($i = 0; $i < count($array12); $i++) {
            if ($array12[$i] > 0 && $array12[$i] < 100) {

                //
                $sql = "SELECT problem_id,tags,difficulty ,source,title FROM problem where tags like '%" . $array7[$i] . "%'and difficulty='" . $array14[$i] . "'";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                {
                    $array15[$sum3] = $row['problem_id'];
                    $array16[$sum3] = $row['tags'];
                    $array17[$sum3] = $row['source'];
                    $array18[$sum3] = $row['difficulty'];
                    $array20[$sum3] = $row['title'];
                    $sum3++;
                }
                $array21 = array_diff($array15, $array3);
                $array21 = array_merge($array21);
                $array21 = array_diff($array21, $array22);
                $array21 = array_merge($array21);
                $array19 = $array22 + $array21;
            }
            if (count($array19) >= 10) {
                break;
            }
        }
    }
    if (count($array22) >= 10) {
        $array19 = $array22;
    }

    $array19 = array_flip($array19);
    $array19 = array_flip($array19);
    $array19 = array_merge($array19);
    $array19 = array_diff($array19, $array100);
    $array19 = array_merge($array19);
    $numbers = range(0, count($array19) - 1);
//shuffle 将数组顺序随即打乱
    shuffle($numbers);
//array_slice 取该数组中的某一段
    $num = count($array19);
    $result = array_slice($numbers, 0, $num);

//////////////////////////////=============================================================================================//////////////////输出模块3

    for ($j = 0; $j < count($result); $j++) {
        for ($i = 0; $i < count($array15); $i++) {
            if ($array19[$result[$j]] == $array15[$i]) {
                echo '<tr><td>' . $array15[$i] . '</td><td>' . $array20[$i] . '</td><td>' . $array17[$i] . '</td></tr>';
                $S++;
                break;
            }
        }
        if ($S == $Question_number) {
            break;
        }
    }

//////////////////////////////=============================================================================================//////////////////输出模块3结束
}
?>
<script>
    // 使用outerHTML属性获取整个table元素的HTML代码（包括<table>标签），然后包装成一个完整的HTML文档，设置charset为urf-8以防止中文乱码
    var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
    // 实例化一个Blob对象，其构造函数的第一个参数是包含文件内容的数组，第二个参数是包含文件类型属性的对象
    var blob = new Blob([html], {type: "application/vnd.ms-excel"});
    var a = document.getElementsByTagName("a")[0];
    // 利用URL.createObjectURL()方法为a元素生成blob URL
    a.href = URL.createObjectURL(blob);
    // 设置文件名
    a.download = "推荐系统.xls";
</script>
</table>


</font>
</div>
<!--综合推荐-->
<!--=============================================错题集======================================================-->
<input type="submit" value="错题集" onclick="display1('lb1')">
<div id="lb1" style="display:none">
    <font>
        <table cellspacing="0">
            <tr>
                <html>
                <head>
                    <style type="text/css">
                        table {
                            border: 0;
                            cellspacing: 0;
                            cellpadding: 0;
                        }

                        table tr {
                            border: none;
                            padding: 0;
                            margin: 0;
                        }

                        table td {
                            background: #ffffff;
                            border-bottom: 3px solid whitesmoke;
                            border-top: 3px solid powderblue;
                            margin: 0;
                            padding: 7px;
                        }

                        table td:hover {

                            cursor: pointer;
                        }
                    </style>
                    <meta charset="utf-8">
                    <title>Ascension</title>

                </head>
                </body>
                </html>

                <?php
                /**
                 * Created by PhpStorm.
                 * User: LIJICHEN
                 * Date: 2019/1/29
                 * Time: 16:19
                 */
                $con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
                ////////////////////////////////////////////////////////////////
                $name = $_SESSION[$OJ_NAME . '_' . 'user_id'];              //学号接口
                $Question_number = 10;//输出题数接口
                ////////////////////////////////////////////////////////////////
                $array2 = array();//存放所有题题号
                $array3 = array();//查重后的题号
                $array4 = array();//存放各个题的做题情况
                $array5 = array();//赛选出来的错误题号
                $array6 = array();//正确数
                $array7 = array();//错误数
                $array8 = array();//标签
                $array9 = array();//来源
                $con->query("SET NAMES utf8");//定义字符编码
                $sql = "SELECT problem_id,result FROM solution where user_id='" . $name . "' ";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                {
                    $array2[] = $row['problem_id'];
                    $array4[] = $row['result'];
                }
                $array3 = $array2;
                $array3 = array_flip($array3);
                $array3 = array_flip($array3);
                $array3 = array_merge($array3);
                $c = 0;
                for ($i = 0; $i < count($array3); $i++) { //查重后循环对所有题进行对比查看
                    $a = 0; //计算正确题数
                    $b = 0; //计算错误题数
                    for ($j = 0; $j < count($array2); $j++) {
                        if ($array3[$i] == $array2[$j]) {
                            if ($array4[$j] == 4) {
                                $a++;
                            } else {
                                $b++;
                            }
                        }
                    }
                    if ($a < 2 && $b >= 1) {
                        $array5[$c] = $array3[$i];
                        $array6[$c] = $a;
                        $array7[$c] = $b;
                        $c++;
                    }
                }
                $b = "%";
                $s = 0;
                echo "<td >" . "<font size=5>" . "题号" . "</font>";
                echo "<td >" . "<font size=5>" . "标签" . "</font>";
                echo "<td >" . "<font size=5>" . "来源" . "</font>";
                echo "<td >" . "<font size=5>" . "AC" . "</font>";
                echo "</tr>";
                for ($i = 0; $i < count($array5); $i++) {
                    $sql = "SELECT submit,accepted,title,source FROM problem where problem_id='" . $array5[$i] . "' ";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                    {
                        if ($row['submit'] > 0) {
                            echo '<tr><td>' . $array5[$i] . '</td><td>' . $row['title'] . '</td><td>' . $row['source'] . '</td><td>' . (round($row['accepted'] / $row['submit'], 4) * 100) . $b . '</td></tr>';
                        } else {
                            echo '<tr><td>' . $array5[$i] . '</td><td>' . $row['title'] . '</td><td>' . $row['source'] . '</td><td>' . "0" . $b . '</td></tr>';
                        }
                        $s++;
                    }
                    if ($s == $Question_number) {
                        break;
                    }
                }

                if (count($array5) == 0) {
                    echo '<tr><td>' . "没有满足条件的错题！" . '</td></tr>';
                }
                ?>
                <script>
                    // 使用outerHTML属性获取整个table元素的HTML代码（包括<table>标签），然后包装成一个完整的HTML文档，设置charset为urf-8以防止中文乱码
                    var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
                    // 实例化一个Blob对象，其构造函数的第一个参数是包含文件内容的数组，第二个参数是包含文件类型属性的对象
                    var blob = new Blob([html], {type: "application/vnd.ms-excel"});
                    var a = document.getElementsByTagName("a")[0];
                    // 利用URL.createObjectURL()方法为a元素生成blob URL
                    a.href = URL.createObjectURL(blob);
                    // 设置文件名
                    a.download = "推荐系统.xls";
                </script>
        </table>


    </font>
</div>
<!--=============================================错题集======================================================-->

<!--=============================================断腿训练======================================================-->
<input type="submit" value="断腿训练" onclick="display2('lb2')">
<div id="lb2" style="display:none">
    <font>
        <table cellspacing="0">
            <tr>
                <html>
                <head>
                    <style type="text/css">
                        table {
                            border: 0;
                            cellspacing: 0;
                            cellpadding: 0;
                        }

                        table tr {
                            border: none;
                            padding: 0;
                            margin: 0;
                        }

                        table td {
                            background: #ffffff;
                            border-bottom: 3px solid whitesmoke;
                         /*   border-top: 3px solid powderblue;*/
                            border-top: #ffffff;
                            margin: 0;
                            padding: 7px;
                        }

                        table td:hover {

                            cursor: pointer;
                        }
                    </style>
                    <meta charset="utf-8">
                    <title>Ascension</title>
                </head>
                </body>
                </html>
                <?php
                /**
                 * Created by PhpStorm.
                 * User: LIJICHEN
                 * Date: 2019/2/26
                 * Time: 19:33
                 */
                $con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
                //////////////////////////////////////
                $no = $_SESSION[$OJ_NAME . '_' . 'user_id'];//学号接口
                $Question_number = 10;//输出题数接口
                ///////////////////////////////////////

                $array1 = array();//存放所有题题号
                $array2 = array();//所有题的做题情况
                $array3 = array();//查重后的题号
                $array4 = array();//存放各个题的标签
                $array5 = array();//赛选出来的错误题号
                $array6 = array();//所有标签
                $array7 = array();//查重后的标签
                $array8 = array();//每个标签的正确量
                $array9 = array();//每个标签的错误量
                $array10 = array();//每个标签的提交量
                $array11 = array();//来源
                $array12 = array();//各个标签的百分比
                $array13 = array();//筛选后满足条件的标签
                $array14 = array();//难度系数
                $array15 = array();//要推荐的题号
                $array16 = array();//要推荐的题的标签
                $array17 = array();//要推荐的题的来源
                $array18 = array();//要推荐的题的难度系数
                $array19 = array();
                $array20 = array();
                $array22 = array();

                $con->query("SET NAMES utf8");//定义字符编码

                $sql = "SELECT problem_id,result FROM solution where user_id='" . $no . "' ";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                {
                    $array1[] = $row['problem_id'];
                    $array2[] = $row['result'];
                }
                $array3 = $array1;
                $array3 = array_flip($array3);
                $array3 = array_flip($array3);
                $array3 = array_merge($array3);
                for ($i = 0; $i < count($array3); $i++) {
                    $sql = "SELECT tags,difficulty,source FROM problem where problem_id='" . $array3[$i] . "' ";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                    {
                        $array4[] = strtr($row['tags'], ';', ',');
                        $array14[] = $row['difficulty'];
                        $array11[] = $row['source'];

                    }
                }
                $sq2 = "SELECT nick FROM users where user_id='" . $no . "' ";
                $result = mysqli_query($con, $sq2);
                while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                {
                    $name = $row['nick']; //用户名
                }
                //去重
                $array5 = array_flip($array4);
                $array5 = array_flip($array5);
                $array5 = array_merge($array5);
                //$array5=$array4;
                $sum = 0;
                for ($i = 0; $i < count($array5); $i++) {
                    $BQ = explode(',', $array5[$i]);
                    for ($j = 0; $j < count($BQ); $j++) {
                        $array6[$sum] = $BQ[$j];
                        $sum++;
                    }
                }
                //去重
                $array7 = array_flip($array6);
                $array7 = array_flip($array7);
                $array7 = array_merge($array7);
                //条件筛选题/////////////////////////////
                for ($i = 0; $i < count($array7); $i++) {
                    $sum1 = 0;
                    $sum2 = 0;
                    for ($j = 0; $j < count($array4); $j++) {
                        $BQ1 = explode(',', $array4[$j]);
                        for ($k = 0; $k < count($BQ1); $k++) {
                            if ($array7[$i] == $BQ1[$k]) {
                                $f1 = true;
                                for ($n = 0; $n < count($array1); $n++) {
                                    if ($array3[$j] == $array1[$n]) {
                                        if ($array2[$n] == 4) {
                                            $sum1++;
                                            $f1 = false;
                                            break;
                                        }
                                    }
                                }
                                if ($f1 == true) {
                                    $sum2++;
                                }
                            }
                        }
                    }
                    /*
                     * $array8[$i]=$sum1;     //正确数
                    $array9[$i]=$sum2;      //错误数
                    $array10[$i]=$sum2+$sum1;   //提交量
                 */
                    $array8[$i] = $sum1;
                    $array9[$i] = $sum2;
                    $array10[$i] = $sum2 + $sum1;
                }
                /*
                 计算每个标签的百分比，赋值给array12
                  */
                for ($i = 0; $i < count($array7); $i++) {
                    $array12[$i] = (round($array8[$i] / $array10[$i], 4) * 100);
                }
                $a = 0;
                /*
                 for($i=0;$i<count($array12);$i++){
                    for($j=0;$j<count($array12);$j++){
                      if($array12[$i]<$array12[$j]){
                          百分比交换
                          $a=$array12[$i];
                          $array12[$i]=$array12[$j];
                          $array12[$j]=$a;
                          标签交换
                          $b=$array7[$i];
                          $array7[$i]=$array7[$j];
                          $array7[$j]=$b;
                          难度系数交换
                          $a=$array14[$i];
                          $array14[$i]=$array14[$j];
                          $array14[$j]=$a;
                         //来源交换
                          $b=$array11[$i];
                          $array11[$i]=$array11[$j];
                          $array11[$j]=$b;

                      }
                    }
                }
                 */
                for ($i = 0; $i < count($array12); $i++) {
                    for ($j = 0; $j < count($array12); $j++) {
                        if ($array12[$i] < $array12[$j]) {
                            $a = $array12[$i];
                            $array12[$i] = $array12[$j];
                            $array12[$j] = $a;
                            $b = $array7[$i];
                            $array7[$i] = $array7[$j];
                            $array7[$j] = $b;
                            $a = $array14[$i];
                            $array14[$i] = $array14[$j];
                            $array14[$j] = $a;
                            $b = $array11[$i];
                            $array11[$i] = $array11[$j];
                            $array11[$j] = $b;

                        }
                    }
                }
                $a = 0;
                $sum3 = 0;
                for ($i = 0; $i < count($array12); $i++) {
                    if ($array12[$i] > 0 && $array12[$i] < 100) {
                        //
                        $sql = "SELECT problem_id,tags,difficulty ,source,title FROM problem where tags like '%" . $array7[$i] . "%'and difficulty='" . $array14[$i] . "' and  source like '%" . $array11[$i] . "%'";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                        {
                            $array15[] = $row['problem_id'];
                            $array16[] = $row['tags'];
                            $array17[] = $row['source'];
                            $array18[] = $row['difficulty'];
                            $array20[] = $row['title'];
                            $sum3++;
                        }
                        $array22 = array_diff($array15, $array3);
                        $array22 = array_merge($array22);

                        //
                        if (count($array22) > 10) {
                            break;
                        }
                    }
                }
                $array21 = array();
                //
                if (count($array22) < 10) {
                    $a = 0;
                    for ($i = 0; $i < count($array12); $i++) {
                        if ($array12[$i] > 0 && $array12[$i] < 100) {

                            //
                            $sql = "SELECT problem_id,tags,difficulty ,source,title FROM problem where tags like '%" . $array7[$i] . "%'and difficulty='" . $array14[$i] . "'";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
                            {
                                $array15[$sum3] = $row['problem_id'];
                                $array16[$sum3] = $row['tags'];
                                $array17[$sum3] = $row['source'];
                                $array18[$sum3] = $row['difficulty'];
                                $array20[$sum3] = $row['title'];
                                $sum3++;
                            }
                            $array21 = array_diff($array15, $array3);
                            $array21 = array_merge($array21);
                            $array21 = array_diff($array21, $array22);
                            $array21 = array_merge($array21);
                            $array19 = $array22 + $array21;
                        }
                        if (count($array19) >= 10) {
                            break;
                        }
                    }
                }
                if (count($array22) >= 10) {
                    $array19 = $array22;
                }
                $array19 = array_flip($array19);
                $array19 = array_flip($array19);
                $array19 = array_merge($array19);
                $numbers = range(0, count($array19) - 1);
                //shuffle 将数组顺序随即打乱
                shuffle($numbers);
                //array_slice 取该数组中的某一段
                $num = count($array19);
                $result = array_slice($numbers, 0, $num);
                echo "<td >" . "<font size=5>" . "题号" . "</font>";
                echo "<td >" . "<font size=5>" . "题名" . "</font>";
                echo "<td >" . "<font size=5>" . "来源" . "</font>";
                echo "<td >" . "<font size=5>" . "标签" . "</font>";
                echo "<td >" . "<font size=5>" . "难度" . "</font>";
                echo "</tr>";
                $a = 0;
                for ($j = 0; $j < count($result); $j++) {
                    for ($i = 0; $i < count($array15); $i++) {
                        if ($array19[$result[$j]] == $array15[$i]) {
                            echo '<tr><td>' . $array15[$i] . '</td><td>' . $array20[$i] . '</td><td>' . $array17[$i] . '</td><td>' . $array16[$i] . '</td><td>' . $array18[$i] . '</td></tr>';
                            $a++;
                            break;
                        }
                    }
                    if ($a == $Question_number) {
                        break;
                    }
                }

                ?>
                <script>
                    // 使用outerHTML属性获取整个table元素的HTML代码（包括<table>标签），然后包装成一个完整的HTML文档，设置charset为urf-8以防止中文乱码
                    var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
                    // 实例化一个Blob对象，其构造函数的第一个参数是包含文件内容的数组，第二个参数是包含文件类型属性的对象
                    var blob = new Blob([html], {type: "application/vnd.ms-excel"});
                    var a = document.getElementsByTagName("a")[0];
                    // 利用URL.createObjectURL()方法为a元素生成blob URL
                    a.href = URL.createObjectURL(blob);
                    // 设置文件名
                    a.download = "推荐系统.xls";
                </script>
        </table>


    </font>
</div>
<!--=============================================断腿训练======================================================-->

<!--=============================================近期推荐======================================================-->
<input type="submit" value="近期推荐" onclick="display3('lb3')">
<div id="lb3" style="display:none">
    <font>

    </font>
</div>
<!--=============================================近期推荐======================================================-->

</div>
</div>
</div>
<!-- /container -->
<script type="text/javascript">
    function display(id) {
        var traget = document.getElementById(id);
        if (traget.style.display == "none") {
            traget.style.display = "";
        } else {
            traget.style.display = "none";
        }
    }
</script>

<script type="text/javascript">
    function display1(id) {
        var traget = document.getElementById(id);
        if (traget.style.display == "none") {
            traget.style.display = "";
        } else {
            traget.style.display = "none";
        }
    }

</script>

<script type="text/javascript">
    function display2(id) {
        var traget = document.getElementById(id);
        if (traget.style.display == "none") {
            traget.style.display = "";
        } else {
            traget.style.display = "none";
        }
    }
</script>

<script type="text/javascript">
    function display3(id) {
        var traget = document.getElementById(id);
        if (traget.style.display == "none") {
            traget.style.display = "";
        } else {
            traget.style.display = "none";
        }
    }
</script>
<!--==========================================================================-->

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
