<!Doctype html>
<html>
<head>
    <script src="template/bs3/jquery.min.js"></script>
</head>
<body>

<script language="javascript">
    $('button').click(function () {
        var Time = new Date();
        $.ajax({
            type: 'GET',
            url: 'test.php',
            data: {text: Time},
            success: function (data) {
                alert(data);
            }
        });
        return false;
    })
</script>
<button id="btn">Get Time</button>
<label><?php echo $_GET['text'] ?></label>
</body>
<html>

