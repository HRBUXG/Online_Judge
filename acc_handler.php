<?php
$filename = "upload/" . $uqnid . "." . $extends;
$PHPExcel = PHPExcel_IOFactory::createReaderForFile($filename);; //准备打开文件
$PHPExcel = $PHPExcel->load($filename);
$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
$highestRow = $sheet->getHighestRow(); // 取得总行数
$highestColumm = $sheet->getHighestColumn(); // 取得总列数
$record = array();
$now = 0;
if ($highestRow >= 2)
    for ($row = 2; $row <= $highestRow; $row++)    //行号从1开始
    {
        for ($column = 'A'; $column <= $highestColumm; $column++)  //列数是以A列开始
        {
            $dataset[] = $sheet->getCell($column . $row)->getValue();
            //echo $column.$row.":".$sheet->getCell($column.$row)->getValue()."<br\>";
            $record[$now] = $sheet->getCell($column . $row)->getValue();
            $now++;


        }

        //handleing
        $user_id = $record[0];
        $regrade = "20" . substr($user_id, 0, 2);
        $reclass = substr($user_id, 5, 1);
        //echo $regrade."     ".$reclass."<br/>";
        $sql = "select * from users where user_id = ?;";
        $rows1 = pdo_query($sql);
        if (count($rows1 == 0)) {
            $password = md5(123456);
            $nick = $record[1];
            $school = "哈尔滨学院";
            $defunct = "N";
            $grade = $record[2];
            $class = $record[3];
            $ip = ($_SERVER['REMOTE_ADDR']);
            if ($grade == $regrade && $class == $reclass) {
                $sql = "INSERT INTO `users` (" . "`user_id`,`ip`,`accesstime`,`password`,`reg_time`,`nick`,`school`,`defunct`,`grade`,`class`,`isimportacc`)" . "VALUES(" . '"' . $user_id . '"' . "," . '"' . $ip . '"' . ",NOW()," . '"' . $password . '",NOW(),' . '"' . $nick . '"' . "," . '"' . $school . '",' . '"' . $defunct . '",' . '"' . $grade . '",' . '"' . $class . '",1)';
                //echo "<br/>".$sql;
                $rows = pdo_query($sql);
            }
        }
        $now = 0;
    }
if (file_exists("upload/" . $uqnid . "." . $extends)) {
    if (!unlink("upload/" . $uqnid . "." . $extends)) {
    }
    echo "file delated!!!";
}
?>
