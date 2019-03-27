<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div>
    <?php

    $doc = new DOMDocument();
    $doc->load('.././template/bs3/level.xml');
    $levelss = array();
    $levels = $doc->getElementsByTagName("level");
    //遍历
    foreach ($levels as $level) {
        //echo $level->getAttribute('id') . "-";
        // echo $level->getElementsByTagName("total")->item(0)->nodeValue;
        // echo "<br>";
        array_push($levelss, $level->getElementsByTagName("total")->item(0)->nodeValue);
    }
    ?>
    <form action="edit_levelxml.php" method="post">
    <div>
        <label>level 1</label><input type="text" name="level1" value="<?php echo $levelss[0] ?>"  onkeyup= "if(/\D/g.test(this.value)){alert('只能整数');this.value='';}" />
    </div>
    <div>
        <label>level 2</label><input type="text" name="level2" value="<?php echo $levelss[1] ?>" onkeyup= "if(/\D/g.test(this.value)){alert('只能整数');this.value='';}" />
    </div>
    <div>
        <label>level 3</label><input type="text" name="level3" value="<?php echo $levelss[2] ?>" onkeyup= "if(/\D/g.test(this.value)){alert('只能整数');this.value='';}" />
    </div>
    <div>
        <label>level 4</label><input type="text" name="level4" value="<?php echo $levelss[3] ?>" onkeyup= "if(/\D/g.test(this.value)){alert('只能整数');this.value='';}" />
    </div>
        <input type="submit" value="提交"/>

    </form>

</div>
</body>
</html>

