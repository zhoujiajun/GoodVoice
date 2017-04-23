<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script language="JavaScript" src="/test/Public/js/jquery-2.1.3.min.js"></script>
    <script language="JavaScript">
        $.ajax({
            'url':"/test/index.php/Home/Index/ajaxtest",
            'success':function(a){
                console.log(a);
            }
        });
    </script>
    <title></title>
</head>
<body>

</body>
</html>