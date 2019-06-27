<?php
$level1 = $_POST['c'];
$level2 = $_POST['cplus'];
$level3 = $_POST['pascal'];
$level4 = $_POST['java'];
echo $level1;
echo $level2;
echo $level3;
echo $level4;
echo '<hr />';

$getlevel = array($level1, $level2, $level3, $level4);
sort($getlevel);
$doc = new DOMDocument();
$doc->load('.././compiler_info.xml');

$levels = $doc->getElementsByTagName("compiler");
//遍历
foreach ($levels as $level) {
    //将id=3的title设置为33333
    if ($level->getAttribute('id') == 1) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("content")->item(0)->nodeValue = $getlevel[0];
        echo "<br>";
    }
    if ($level->getAttribute('id') == 2) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("content")->item(0)->nodeValue = $getlevel[1];
        echo "<br>";
    }
    if ($level->getAttribute('id') == 3) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("content")->item(0)->nodeValue = $getlevel[2];
        echo "<br>";
    }
    if ($level->getAttribute('id') == 4) {
        //echo $book->getAttribute('id')."-";
        echo $level->getElementsByTagName("content")->item(0)->nodeValue = $getlevel[3];
        echo "<br>";
    }
}
//对文件做修改后，一定要记得重新sava一下，才能修改掉原文件
$doc->save('.././compiler_info.xml');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
</body>
</html>
