<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <title>后台管理系统</title>
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/common.css">
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/adsystem.css">
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/quitlogin.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/adexe.js"></script>
</head>
<body>
      <div class="bgbox topbg-1">
           <div class="topbg">
                 <img src="/EasyTalk/BackendPublic/images/easytalklogo.png" alt="Easytalk">
                 <a href="#" style="display: block;">退出登录</a>
           </div>
      </div>
      <div class="bgbox navbg-1">
           <div class="navbg">
               <ul>
                  <a href="/EasyTalk/admin.php/Home/Administration/adminlogin" class="ab nowa"><li>管理员</li></a>
                  <a href="/EasyTalk/admin.php/Home/teacher/teacherlogin" class="ab"><li>教师</li></a>
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
                        <div class="cnav">
                              <ul>
                                   <a href="/EasyTalk/admin.php/Home/Administration/aduser?html=11" class="labg"><li>用户管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adteacher?html=12" class="labg"><li>教师管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adtradata?html=13" class="labg"><li>交易数据</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adclass?html=14" class="labg"><li>课程管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adexe_index?html=15" class="now-a"><li>练习管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adlangindex?html=16" class="labg"><li>语种管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adpicindex" class="labg" id="moreul"><li>图片上传</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adnav" class="labg"><li>导航栏</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adcomment" class="labg"><li>意见反馈</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/ad-cpsw" class="labg"><li>密码修改</li></a>
                              </ul>
                        </div>
                        <div class="searchbox">
                              <div class="searchdiv"></div>
                              <p>添加新练习</p>
                        </div>
                        <div class="exe-conbox" style="position: relative;">
                             <ul class="ulmore">
                                  <a href="/EasyTalk/admin.php/Home/Administration/adpicindex"><li>首页图片</li></a>
                                  <a href="/EasyTalk/admin.php/Home/Administration/adpiccl"><li>课程体系</li></a>
                              </ul>
                              <table class="exe_ni_table" cellpadding="0" cellspacing="31">
                                     <tr>
                                         <td>练习名称</td>
                                         <td><input type="text" class="exe_ni_input" id="exe_ni_name"></td>
                                     </tr>
                                     <tr>
                                         <td>语种</td>
                                         <td><select name="" class="exe_ni_input" id="exe_ni_lang">
                                                  <option value=""></option>  
                                                  <option value="越南语">越南语</option>
                                                  <option value="泰语">泰语</option>
                                                  <option value="印尼语">印尼语</option>
                                                  <option value="阿拉伯语">阿拉伯语</option>
                                             </select>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>难度</td>
                                         <td>
                                            <select name="" class="exe_ni_input" id="exe_ni_rank">
                                                  <option value=""></option>  
                                                  <option value="初级">初级</option>
                                                  <option value="中级">中级</option>
                                                  <option value="高级">高级</option>
                                            </select>
                                         </td>
                                     </tr>
                              </table>
                        </div>
                        <div class="call">
                              <div class="call-2">
                                    <input type="button" value="确定" class="call-bu call-bu1" id="exe_ni_up">
                                    <input type="button" value="取消" class="call-bu call-bu2" id="exe_ni_can">
                              </div>
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