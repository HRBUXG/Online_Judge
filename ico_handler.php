<?php
$filename = "ico/" . $uqnid . "." . $extends;
$sql = "select `icopath` from `users` where `user_id` = ?";
$res = pdo_query($sql, $user_id);
unlink($res[0]['icopath']);
$sql = "UPDATE `users` set `icopath` = ? where `user_id` = ?";
pdo_query($sql, $filename, $user_id);
?>
