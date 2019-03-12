<?php

$string = file_get_contents('../include/db_info.inc.php');


//DB_HOST    localhost

foreach ($_POST as $key => $val) {
    //定义正则来查找内容，这里面的key为form表单里面的name
    //$yx = "/define\('$key','.*?'\);/";
    $yx = "/$key\s*=\s*\"(.*)?\"\s*;/";
    // define('DB_NAME','neirong');
    // static 	$DB_USER="root";
    //将内容匹配成对应的key和修改的值
    // $re = "define('$key','$val');";
    $re = "$key=\"$val\";";
    //替换内容
    $string = preg_replace($yx, $re, $string);
}

//写入成功
file_put_contents('../include/db_info.inc.php', $string);

echo '修改成功';

?>
