<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script language="JavaScript" src="/test/Public/js/jquery-2.1.3.min.js"></script>
    <script language="JavaScript">
        function changeVerify(){
            var v=document.getElementById("V");
            v.src="/test/index.php/Home/Ajax/verify?"+ new Date().getTime();//Math.random()
        }
        function check(){
            var core=document.getElementById('ve').value;
            $.ajax({
                'url':"/test/index.php/Home/Ajax/check_verify",
                'type':'GET',
                'data':{'core':core},
                'dataType':'json',
                'success': function(data){
                    if(data.status){
                        if(data.data){
                            $("#tip").html('对');
                        }
                        else{
                            $("#tip").html('错');
                        }
                    }
                    else{
                        alert('获取数据出错');
                    }
                }
            });
        }

    </script>
</head>
<body>

<div style="background-color: aquamarine;width: 400px; height: 300px;float: left;">
    <h1>视图展示区</h1>
    <form action="/test/index.php/Home/Ajax/check_verify" method="get">
        验证码：
        <img src="/test/index.php/Home/Ajax/verify" onclick="changeVerify()" id="V">
        <input type="text" id="ve" name="core" onblur="check()"><span id="tip"></span>
        <br/><input type="submit">
    </form>
</div>
</body>
</html>