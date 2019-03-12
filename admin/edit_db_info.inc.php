<?php

include '../include/db_info.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="edit_regexp.php" method="post">
    <input type="text" name="DB_HOST" value="<?php echo $DB_HOST; ?>"/><br/>
    <input type="text" name="DB_NAME" value="<?php echo $DB_NAME; ?>"/><br/>
    <input type="text" name="DB_USER" value="<?php echo $DB_USER; ?>"/><br/>
    <input type="text" name="DB_PASS" value="<?php echo $DB_PASS; ?>"/><br/>
    <input type="submit" value="提交"/>
</form>

</body>
</html>
