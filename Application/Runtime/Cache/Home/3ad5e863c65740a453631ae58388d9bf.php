<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>意见反馈</title>
	<link rel="stylesheet" type="text/css" href="/easytalk/Public/css/pccenter.css">
	<link rel="stylesheet" type="text/css" href="/easytalk/Public/css/common.css">
      <script type="text/javascript" src="/easytalk/Public/js/jquery-3.1.1.js"></script>
      <script type="text/javascript" src="/easytalk/Public/js/jquery.form.js"></script>
      <script type="text/javascript" src="/easytalk/Public/js/nav.js"></script>
      <script type="text/javascript" src="/easytalk/Public/js/pccenter.js"></script>
      <script type="text/javascript" src="/easytalk/Public/js/pccomment.js"></script>
      <script type="text/javascript" src="/easytalk/Public/js/common.js"></script>
</head>
<body>
      <div class="bgbox topbg-1">
      	   <div class="topbg">
      	   	     <img src="/easytalk/Public/src/images/easytalklogo.png" alt="Easytalk">
      	   	     <a href="#">退出登录</a>
      	   	     <p>您好，请先登录</p>
      	   </div>
      </div>
      <div class="bgbox navbg-1">
      	   <div class="navbg">
      	   	   <ul>
      	   	   	  <a href="/easytalk/index.php/"><li id="nav1">首页</li></a>
      	   	   	  <a href="#" class="nava"><li id="nav2">课程体系</li></a>
      	   	   	  <a href="#" class="nava"><li id="nav3">老师介绍</li></a>
      	   	   	  <a href="/easytalk/index.php/home/course/buyclass_vie" class="nava"><li id="nav4">课程购买</li></a>
      	   	   	  <a href="/easytalk/index.php/home/user/pccenter" class="nava nowa"><li id="nav5">个人中心</li></a>
      	   	   	  <a href="/easytalk/index.php/home/exercise/practiceclass?lan=01" class="nava"><li id="nav6">练习中心</li></a>
      	   	   </ul>
      	   </div>
      </div>
      <div class="bgbox centerbg-1">
            <div class="centerbg">
                  <div class="cleft">
                        <div class="chead">
                             <form action="/easytalk/index.php/home/user/updateHead" method="post" id="upheadform" enctype="multipart/form-data">
                                    <img src="#" name="userhead" alt="head" id="imghead">
                                    <label for="headfile">
                                           <div class="forhead cheadb">
                                                <div>修改头像</div>
                                           </div>
                                    </label>
                                    <input type="file" accept="image/jpeg image/jpg image/png" id="headfile" style="display: none;" name="photo">
                                    <label for="uphead">
                                           <div class="forhead upheadbu" style="display: none;">
                                                <div>确定</div>
                                           </div>
                                    </label>
                                    <input type="button" value="uphead" style="display: none;" id="uphead">
                              </form>
                        </div>
                        <a href="/easytalk/index.php/home/user/pccenter" class="pcnava">账号信息</a>
                        <a href="/easytalk/index.php/home/user/pcmyclass" class="pcnava">我的课程</a>
                        <a href="/easytalk/index.php/home/user/pccomment" class="pcnava nowa">我的课程</a>

                  </div>
                  <div class="cright">
                        <p class="pccomment-title">意见与建议</p>
                        <textarea class="practiceclass-area" id="pccom-area"></textarea>
                        <input type="button" name="up" value="提交" class="pccomment-up" id="pccomm-up">
                  </div>
            </div>
      </div>
      <div class="bgbox bottombg-1">
      	   <div class="bottombg">
      	   	   <p>Copyright &copy Easy talk 小语种在线一对一学习社区 | 版权所有 京ICP证008719-5</p>
      	   </div>
      </div>
</body>
</html>