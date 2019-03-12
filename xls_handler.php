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
            //echo ("   ");
        }
        $sql = "SELECT * FROM `users` where user_id = ?;";
        $result = pdo_query($sql, $record[0]);
        if ($result != "") {
            $sql = "UPDATE `users` set `otherscore`=`otherscore`+$record[1] where user_id = ?;";
            $result = pdo_query($sql, $record[0]);
            $sql = "INSERT INTO `otherojaccount` (`user_id`,`account`,`contestname`,`platformname`,`score`) VALUES (" . '"' . $record[0] . '"' . ",$record[2]," . '"' . $record[3] . '"' . ",$record[4]," . '"' . $record[1] . '")';
            $result = pdo_query($sql, $record[0]);
            if (count($result) == 0) {
                $sql = "INSERT INTO `otherojaccount` VALUES(?,$record[2],$record[3],$record[4]);";
                $result = pdo_query($sql, $record[0]);
                //echo $sql."     ";
            } else {
                $sql = "UPDATE `otherojaccount` 
						   set `newcode`=`newcode`+$record[2],
						   `jisuanke`=`jisuanke`+$record[3],
						   `hrbust`=`hrbust`+$record[4] 
						   where user_id = ?;";
                $result = pdo_query($sql, $record[0]);
                //echo $sql."     ";
            }
            $sql = "UPDATE `users` set `othersolved`=`othersolved`+$record[2]+$record[3]+$record[4]
						    where user_id = ?";
            $result = pdo_query($sql, $record[0]);
            //echo $sql;
        }
        $now = 0;
    }
if (file_exists("upload/" . $uqnid . "." . $extends)) {
    if (!unlink("upload/" . $uqnid . "." . $extends)) {
    }
    echo "file delated!!!";
}
?>
