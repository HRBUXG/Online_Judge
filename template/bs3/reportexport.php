<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>
        <?php echo $OJ_NAME ?>
    </title>
    <?php include("../../template/$OJ_TEMPLATE/css.php"); ?>
    <style>
    </style>
<body>
<table>
    <thead>
    <tr>
        <th rowspan="2">$MSG_CLASS</th>
        <th rowspan="2">$MSG_TEACHER</th>
        <th colspan="4">$MSG_AC_TOTAL</th>
        <th rowspan="2">$MSG_TOTAL_PRESENT</th>
    </tr>
    <tr>
        <th contenteditable="true"><input name="" id="" type="number" title=""></th>
        <th contenteditable="true"><input name="" id="" type="number" title=""></th>
        <th contenteditable="true"><input name="" id="" type="number" title=""></th>
        <th contenteditable="true"><input name="" id="" type="number" title=""></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $cnt = 0;
    foreach ($view_AC_total as $row) {
        if ($cnt)
            echo "<tr class='oddrow' align='center'>";
        else
            echo "<tr class='evenrow' align='center'>";
        $i = 0;
        foreach ($row as $table_cell) {
            echo "<td  class='hidden-xs' align='center'>";
            echo "\t" . $table_cell;
            echo "</td>";
            $i++;
        }
        $cnt = 1 - $cnt;
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


</body>
</head>
</html>