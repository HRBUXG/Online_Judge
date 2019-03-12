<?php

$db = new mysqli("localhost", "root", "HRBUXGOJ", "jol");
$db->query("set names utf8");
$grade = $_POST['grade'];
$beginTime = $_POST['startdate'] . " " . $_POST['shour'] . ":" . $_POST['sminute'] . ":00";
$endTime = $_POST['enddate'] . " " . $_POST['ehour'] . ":" . $_POST['eminute'] . ":00";
//查询一段时间内的刷题数量
$getData = "SELECT DISTINCT solution.user_id,`nick`,\"{$beginTime}\",\"{$endTime}\",count(solution.user_id)
FROM `solution`,`users`
WHERE solution.user_id=users.user_id AND solution.user_id like \"{$grade}\" AND  `result` = 4  AND `judgetime`>\"{$beginTime}\" AND `judgetime`<\"{$endTime}\"
GROUP BY user_id
ORDER BY user_id ASC ";
$result = $db->query($getData);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<script type="text/javascript">
    (function fun() {
        alert("ok");
        var jsonData = [
            <?php
            // 输出数据
            if ($result->num_rows > 0) {
                // 输出数据
                while ($row = $result->fetch_assoc()) {
                    echo "{id:\"" . $row["user_id"] . "\",Name:\"" . $row["nick"] . "\",solveProblem:" . $row["count(solution.user_id)"] . "},";

                    //"\"BeginTime:".$beginTime.",EndTime:".$endTime.
                }
            } else {
                echo "{id:" . "'数据库'" . ",Name:" . " '结果'" . ",solveProblem:" . " '为空!'" . "},";
            }
            ?>
        ]
        //列标题，逗号隔开，每一个逗号就是隔开一个单元格
        let str = `学号,姓名,刷题数目\n`;
        //增加\t为了不让表格显示科学计数法或者其他格式
        for (let i = 0; i < jsonData.length; i++) {
            for (let item in jsonData[i]) {
                str += `${jsonData[i][item] + '\t'},`;
            }
            str += '\n';
        }
        //encodeURIComponent解决中文乱码
        let uri = 'data:text/csv;charset=utf-8,\ufeff' + encodeURIComponent(str);
        //通过创建a标签实现
        var link = document.createElement("a");
        link.href = uri;
        //对下载的文件命名
        link.download = "刷题情况统计表.csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.history.back(-1);
    }());

</script>
</body>
</html>

