<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>上传头像</title>
</head>
<body>
    <form action="/jobBook/index.php/Home/Person/upload"  enctype="multipart/form-data" method="post">
    	<input type="file" name="photo" />
        <input type="submit" value="提交" >
    </form>
</body>
</html>