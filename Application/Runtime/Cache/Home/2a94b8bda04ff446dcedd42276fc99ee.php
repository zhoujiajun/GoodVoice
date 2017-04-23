<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify</title>
    <script language="JavaScript" src="/test/Public/js/jquery-2.1.3.min.js"></script>
    <script language="JavaScript">
        function changeVerify(){
            var v=document.getElementById("yzm");
            v.src="/test/index.php/Home/Index/verify";
        }
        function changeVerify1(){
            var v1=document.getElementById("yzm1");
            v1.src="/test/index.php/Home/Index/verify1";
        }
        function changeVerify2(){
            var v2=document.getElementById("yzm2");
            v2.src="/test/index.php/Home/Index/verify2";
        }
    </script>
</head>
<body>
<div >
    <h1>验证码</h1>
<form action="/test/index.php/Home/Index/check_verify" method="get">
    验证码：
    <img src="/test/index.php/Home/Index/verify" onclick="changeVerify()" id="yzm">
    <input type="text" name="core">
    <input type="submit">
</form>
</div>
<div >
    <h1>第一个验证码</h1>
    <form action="/test/index.php/Home/Index/check_verify/id/1" method="get">
        验证码：
        <img src="/test/index.php/Home/Index/verify1" onclick="changeVerify1()" id="yzm1">
        <input type="text" id="ve1" name="core">
        <input type="submit">
    </form>
</div>
<div >
    <h1>第二个验证码</h1>
    <form action="/test/index.php/Home/Index/check_verify/id/2" method="get">
        验证码：
        <img src="/test/index.php/Home/Index/verify2" onclick="changeVerify2()" id="yzm2">
        <input type="text" id="ve2" name="core">
        <input type="submit">
    </form>
</div>
</body>
</html>