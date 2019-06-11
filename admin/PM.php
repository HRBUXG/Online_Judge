<table cellspacing="0">
    <tr>
        <html>
        <head>
            <style type="text/css">
                table{
                    border:0;
                    cellspacing:0;
                    cellpadding:0;
                }

                table tr{
                    border:none;
                    padding:0;
                    margin:0;
                }

                table td{
                    background:#cccc99;
                    border-bottom:3px solid red;
                    border-top:3px solid blue;
                    margin:0;
                    padding:7px;
                }

                table td:hover{
                    background:#ccdd00;
                    cursor:pointer;
                }

            </style>
            <meta charset="utf-8">
            <title>排名</title>
        </head>
        <tr>

        <form action="PM.php" method="GET">
            <td>年级: <input type="text" name="nianji"></td>
            <td>前多少名: <input type="text" name="pm"></td>
            <td> <input type="submit" value="提交"> <a>导出表格</a>
        </form>
        </tr>
        </body>
        </html>

        <?php
        if(isset($_GET['nianji'])) {
            $NJ = $_GET['nianji'] . "";//   接受的参数在NJ里面
            $PM = $_GET['pm'] . "";

//==================================================================
            $con = new mysqli('localhost', 'root', 'HRBUXGOJ', 'jol');
            if (!$con) {
                die('Could not connect: ' . mysql_error());
            }





            $array1 = array();//该年级所有学生
            $array2 = array();//正确题数
            $array3 = array();//错误题数
            $array4 = array();//总体数题数
            $array5 = array();//正确率对应

            $array6 = array();//该年级所有学生+前十
            $array7 = array();//正确题数+前十
            $array8 = array();//错误题数+前十
            $array9 = array();//总体数题数+前十
            $array10 = array();//正确率对应+前十

            $num = 0;
            $con->query("SET NAMES utf8");//定义字符编码
            if ($NJ=="") {
                $sql = "SELECT nick,result FROM solution,users WHERE solution.user_id=users.user_id";//所有的题目
            }else{
                $sql = "SELECT nick,result FROM solution,users WHERE solution.user_id=users.user_id and users.grade = '" . $NJ . "'";//所有的题目
            }
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result))//取当前数据，放入两个数组
            {

                if ($num==0) {
                    $array1[] = $row['nick'];
                    if($row['result']==4) {//T
                        $array2[] = 1;
                        $array3[] = 0;//错误题数
                    }
                    elseif ($row['result']==6){//F
                        $array2[] = 0;
                        $array3[] = 1;//错误题数
                    }
                    else{
                        $array2[] = 0;//错误题数
                        $array3[] = 0;//错误题数
                    }

                    $array4[] = 1;//sum
                }else {

                    for ($i=0; $i < count($array1); $i++) {
                        if ($array1[$i] == $row['nick']) {
                            if ($row['result'] == 4) {//T
                                $array2[$i]=$array2[$i]+1;
                            }
                            if ($row['result'] == 6) {//F
                                $array3[$i]=$array3[$i]+1;
                            }
                            $array4[$i]=$array4[$i]+1;
                            break;
                        }
                        if ($i == count($array1) - 1) {
                            $array1[] = $row['nick'];
                            if($row['result']==4) {//T
                                $array2[] = 1;
                                $array3[] = 0;//错误题数
                            }
                            elseif ($row['result']==6){//F
                                $array2[] = 0;
                                $array3[] = 1;//错误题数
                            }
                            else{
                                $array2[] = 0;//错误题数
                                $array3[] = 0;//错误题数
                            }
                            $array4[] = 1;//sum
                        }
                    }
                }
                $num++;
            }

            for ($i=0; $i < count($array1); $i++) {
                if ($array4[$i]==0){
                    $array5[]=0;
                }else{
                    $array5[]=round($array2[$i]/$array4[$i],4)*100;;
                }
            }


            $lishi = $array2;
            if(100<=count($array1)) {
                for ($i = 0; $i < $PM  && $PM  <= count($array1); $i++) {
                    $max = 0;
                    $max1 = 0;
                    for ($j = 0; $j < count($array1); $j++) {
                        if ($lishi[$j] > $max1) {
                            $max1 = $lishi[$j];
                            $max = $j;
                        }
                    }

                    $lishi[$max] = 0;

                    $array6[] = $array1[$max];//该年级所有学生+前十
                    $array7[] = $array2[$max];//正确题数+前十
                    $array8[] = $array3[$max];//错误题数+前十
                    $array9[] = $array4[$max];//总体数题数+前十
                    $array10[] = $array5[$max];//正确率对应+前十


                }
            }else if(count($array1)!=0){
                for ($i = 0; $i <count($array1); $i++) {
                    $max = 0;
                    $max1 = 0;
                    for ($j = 0; $j < count($array1); $j++) {
                        if ($lishi[$j] > $max1) {
                            $max1 = $lishi[$j];
                            $max = $j;
                        }
                    }

                    $lishi[$max] = 0;

                    $array6[] = $array1[$max];//该年级所有学生+前十
                    $array7[] = $array2[$max];//正确题数+前十
                    $array8[] = $array3[$max];//错误题数+前十
                    $array9[] = $array4[$max];//总体数题数+前十
                    $array10[] = $array5[$max];//正确率对应+前十


                }
            }
            echo "<td >"."<font size=5>"."名字"."</font>";
            echo "<td >"."<font size=5>"."正确数"."</font>";
            echo "<td >"."<font size=5>"."错误数"."</font>";
            echo "<td >"."<font size=5>"."总数"."</font>";
            echo "<td >"."<font size=5>"."AC率"."</font>";
            echo "</tr>";
          for($i=0;$i<count($array8);$i++){
              echo "<td >"."<font size=5>"."$array6[$i]"."</font>";
              echo "<td >"."<font size=5>".$array7[$i]."</font>";
              echo "<td >"."<font size=5>".$array8[$i]."</font>";
              echo "<td >"."<font size=5>".$array9[$i]."</font>";
              echo "<td >"."<font size=5>".$array10[$i]."%"."</font>";
              echo "</tr>";
          }

//==================================================================

        }
        ?>
        <script>
            // 使用outerHTML属性获取整个table元素的HTML代码（包括<table>标签），然后包装成一个完整的HTML文档，设置charset为urf-8以防止中文乱码
            var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
            // 实例化一个Blob对象，其构造函数的第一个参数是包含文件内容的数组，第二个参数是包含文件类型属性的对象
            var blob = new Blob([html], { type: "application/vnd.ms-excel" });
            var a = document.getElementsByTagName("a")[0];
            // 利用URL.createObjectURL()方法为a元素生成blob URL
            a.href = URL.createObjectURL(blob);
            // 设置文件名
            a.download = "排名.xls";
        </script>

</table>