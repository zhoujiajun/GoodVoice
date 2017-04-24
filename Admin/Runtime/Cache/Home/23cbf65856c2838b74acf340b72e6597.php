<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>Login</title>

    <link href="/jobBook/Public/css/style.css" rel="stylesheet">
    <link href="/jobBook/Public/css/style-responsive.css" rel="stylesheet">
    <style type="text/css">
    .login-bg{
        background-image: url(/jobBook/Public/images/bg.png);
    }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-bg">

<div class="container">

    <form class="form-signin" action="/jobBook/admin.php/Home/Index/doLogin" method="post">
        <div class="form-signin-heading text-center">
            <img src="/jobBook/Public/images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" name="username" class="form-control" placeholder="用户名" autofocus>
            <input type="password" name="password" class="form-control" placeholder="密码">

            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>
        </div>
    </form>

</div>


<!-- Placed js at the end of the document so the pages load faster -->
<script src="/jobBook/Public/js/jquery-1.10.2.min.js"></script>
<script src="/jobBook/Public/js/bootstrap.min.js"></script>
<script src="/jobBook/Public/js/modernizr.min.js"></script>

</body>
</html>