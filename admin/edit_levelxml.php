<?php
$level1 = $_POST['level1'];
$level2 = $_POST['level2'];
$level3 = $_POST['level3'];
$level4 = $_POST['level4'];

$getlevel = array($level1, $level2, $level3, $level4);
sort($getlevel);
$doc = new DOMDocument();
$doc->load('.././template/bs3/level.xml');

$levels = $doc->getElementsByTagName("level");
//遍历
foreach ($levels as $level) {
    //将id=3的title设置为33333
    if ($level->getAttribute('id') == 1) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("total")->item(0)->nodeValue = $getlevel[0];
        echo "<br>";
    }
    if ($level->getAttribute('id') == 2) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("total")->item(0)->nodeValue = $getlevel[1];
        echo "<br>";
    }
    if ($level->getAttribute('id') == 3) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("total")->item(0)->nodeValue = $getlevel[2];
        echo "<br>";
    }
    if ($level->getAttribute('id') == 4) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("total")->item(0)->nodeValue = $getlevel[3];
        echo "<br>";
    }
}
//对文件做修改后，一定要记得重新sava一下，才能修改掉原文件
$doc->save('.././template/bs3/level.xml');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
</body>
</html>
