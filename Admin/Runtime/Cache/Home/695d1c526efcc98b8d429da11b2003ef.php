<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <title>后台管理系统</title>
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/common.css">
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/adsystem.css">
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/tcsystem.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/tcquitlogin.js"></script>
</head>
<body>
      <div class="bgbox topbg-1">
           <div class="topbg">
                 <img src="/EasyTalk/BackendPublic/images/easytalklogo.png" alt="Easytalk">
                 <a href="#">退出登录</a>
           </div>
      </div>
      <div class="bgbox navbg-1">
           <div class="navbg">
               <ul>
                  <a href="/EasyTalk/admin.php/Home/administration/adminlogin" class="ab"><li>管理员</li></a>
                  <a href="/EasyTalk/admin.php/Home/Teacher/teacherlogin" class="ab nowa"><li>教师</li></a>
               </ul>
           </div>
      </div>
      <div class="bgbox centerbg-1">
            <div class="centerbg">
                  <div class="ctop">
                        <p>后台管理系统</p>
                        <span>管理员：11232</span>
                  </div>
                  <div class="ccenter">
                        <div class="tnav">
                              <ul>
                                   <a href="/EasyTalk/admin.php/Home/Teacher/tcclass?lan=21"><li>完成课程</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Teacher/tcunclass?lan=22"><li>未完成课程</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Teacher/tcacc-psw" class="now-a seca"><li>账户管理</li></a>
                              </ul>
                        </div>
                        <div class="searchbox">
                              <div class="searchdiv"></div>
                              <p>账号管理</p>
                        </div>
                        <div class="conbox">
                              <table class="tcacc-table" cellpadding="0" cellspacing="40" style="margin-left: 190px;">
                                      <tr>
                                           <td></td>
                                           <td style="text-align: center;">密码修改</td>
                                      </tr>
                                      <tr>
                                           <td>旧密码</td>
                                           <td><input type="password" class="inputcss" id="psw-1"></td>
                                      </tr>
                                      <tr>
                                           <td>新密码</td>
                                           <td><input type="password" class="inputcss" id="psw-2"></td>
                                      </tr>
                                      <tr>
                                           <td>确认密码</td>
                                           <td><input type="password" class="inputcss" id="psw-3"></td>
                                      </tr>
                                      <tr> 
                                           <td></td>
                                           <td><input type="button" value="确认修改" class="inputbu" id="upbu-psw"></td>
                                      </tr>
                              </table>
                        </div>
                        <div class="call">
                        </div>
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