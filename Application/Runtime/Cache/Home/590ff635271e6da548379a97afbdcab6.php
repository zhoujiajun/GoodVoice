<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>测试ajax</title>
</head>

<body>

<form>
	政策解读：<input type="radio" name="type" value="政策解读" />
    <br />
    生活资讯：<input type="radio" name="type" value="生活资讯" />
    <br />
    求职帮助：<input type="radio" name="type" value="求职帮助" />
</form>
<script type="text/javascript">
	var type=<?php echo ($type); ?>;
	var tabs=document.getElementsByTagName("input");
	if (type==1) {
		tabs[0].checked="checked";
	}else if (type==2) {
		tabs[1].checked="checked";
	}else if (type==3) {
		tabs[2].checked="checked";
	}
</script>
</body>
</html>