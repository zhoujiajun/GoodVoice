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
                                   <a href="#" class="now-a"><li>练习管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adlangindex?html=16" class="labg"><li>语种管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adpicindex" class="labg" id="moreul"><li>图片上传</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adnav" class="labg"><li>导航栏</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/ad-cpsw" class="labg"><li>密码修改</li></a>
                              </ul>
                        </div>
                        <div class="searchbox">
                              <div class="searchdiv"></div>
                              <p>法语练习1</p>
                        </div>
                        <div class="exe-conbox" style="position: relative;">
                              <table class="exe2_table" cellspacing="26" cellpadding="0">
                                     <tr>
                                         <td>难度</td>
                                         <td>初级</td>
                                         <td>总分</td>
                                         <td>100</td>
                                         <td>题量</td>
                                         <td>40</td>
                                         <td>上传时间</td>
                                         <td>2016-10-10</td>
                                     </tr>
                              </table>
                              <div class="exe_single">
                                   <table class="exe_title_sin">
                                          <tr>
                                              <td>一 单选题</td>
                                              <td>
                                                  <input type="button" value="删除" class="exe_bu exe_bus_de">
                                                  <input type="button" value="编辑" class="exe_bu exe_bus_edi">
                                                  
                                              </td>
                                          </tr>
                                   </table>
                                   <div class='exe_sin_box'>
                                        <table>
                                               <tr>
                                                    <td><input type='checkbox'></td>
                                                    <td>1. Would you mind turning down the music？</td>
                                                    <td style="text-align: right;">2分</td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-1' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-1' class='dis-no'>
                                                        <p class='exe_span_top'>Not at all</p>
                                                    </td>
                                                    <td></td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-2' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-2' class='dis-no'>
                                                        <span class='exe_span_top'>Not at all</span>
                                                    </td>
                                                    <td></td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-3' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-3' class='dis-no'>
                                                        <span class='exe_span_top'>Not at all</span>
                                                    </td>
                                                    <td></td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-4' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-4' class='dis-no'>
                                                        <span class='exe_span_top'>Not at all</span>
                                                    </td>
                                                    <td><input type="button" value="编辑" class="exe_bu exe_bus_edi exe_s_edi"></td>
                                               </tr>
                                        </table>

                                        <table>
                                               <tr>
                                                    <td><input type='checkbox'></td>
                                                    <td>1. Would you mind turning down the music？</td>
                                                    <td style="text-align: right;">2分</td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-1' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-1' class='dis-no'>
                                                        <p class='exe_span_top'>Not at all</p>
                                                    </td>
                                                    <td></td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-2' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-2' class='dis-no'>
                                                        <span class='exe_span_top'>Not at all</span>
                                                    </td>
                                                    <td></td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-3' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-3' class='dis-no'>
                                                        <span class='exe_span_top'>Not at all</span>
                                                    </td>
                                                    <td></td>
                                               </tr>
                                               <tr>
                                                    <td></td>
                                                    <td>
                                                        <label for='a-1-4' class='exe_for_check'><div>A</div></label>
                                                        <input type='checkbox' id='a-1-4' class='dis-no'>
                                                        <span class='exe_span_top'>Not at all</span>
                                                    </td>
                                                    <td><input type="button" value="编辑" class="exe_bu exe_bus_edi exe_s_edi"></td>
                                               </tr>
                                        </table>
                                   </div>
                              </div>
                        </div>
                        <div class="call">
                              <div class="call-2">
                                    <input type="button" value="添加新练习" class="call-bu call-bu1">
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