<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <title>后台管理系统</title>
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/common.css">
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/adsystem.css">
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/quitlogin.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/adclass-edi.js"></script>
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
                                   <a href="/EasyTalk/admin.php/Home/Administration/adclass?html=14" class="now-a"><li>课程管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adexe_index?html=15" class="labg"><li>练习管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adlangindex?html=16" class="labg"><li>语种管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adpicindex" class="labg" id="moreul"><li>图片上传</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adnav" class="labg"><li>导航栏</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adcomment" class="labg"><li>意见反馈</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/ad-cpsw" class="labg"><li>密码修改</li></a>
                              </ul>
                        </div>
                        <div class="searchbox">
                              <div class="searchdiv"></div>
                              <p>编辑课程</p>
                        </div>
                        <div class="conbox" style="position: relative;">
                              <ul class="ulmore">
                                  <a href="/EasyTalk/admin.php/Home/Administration/adpicindex"><li>首页图片</li></a>
                                  <a href="/EasyTalk/admin.php/Home/Administration/adpiccl"><li>课程体系</li></a>
                              </ul>
                              <table class="add-table" cellpadding="0" cellspacing="30">
                                    <tr>
                                         <td style="width: 60px;">语种</td>
                                         <td><select name="lang" class="add-input1" id="edi-lang">
                                                  <option value="请选择">请选择</option>  
                                                  <option value="越南语">越南语</option>
                                                  <option value="泰语">泰语</option>
                                                  <option value="印尼语">印尼语</option>
                                                  <option value="阿拉伯语">阿拉伯语</option>
                                              </select>
                                         </td>
                                         <td  style="width:   90px;"><p style="margin-left: 30px;">难度</p></td>
                                         <td><select name="rank" class="add-input1" id="edi-rank">
                                                  <option value="请选择">请选择</option>  
                                                  <option value="初级">初级</option>
                                                  <option value="中级">中级</option>
                                                  <option value="高级">高级</option>
                                              </select>
                                         </td>
                                         <td  style="width: 90px;"><p style="margin-left: 30px;">课量</p></td>
                                         <td><select name="classnum" class="add-input1" id="edi-clnum">
                                                  <option value="请选择">请选择</option>  
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8">8</option>
                                                  <option value="9">9</option>
                                                  <option value="10">10</option>
                                                  <option value="11">11</option>
                                                  <option value="12">12</option>
                                                  <option value="13">13</option>
                                                  <option value="14">14</option>
                                                  <option value="15">15</option>
                                              </select>
                                         </td>
                                    </tr>
                                    <tr>
                                         <td style="width: 60px;">教师</td>
                                         <td><select name="tcname" class="add-input1" id="edi-tcname">
                                                  <option value="请选择">请选择</option>
                                              </select>
                                         </td>
                                         <td><p style="margin-left: 30px;">课名</p></td>
                                         <td><input type="text" value=" 输入该课程名称" class="add-input1" id="edi-clname"></td>
                                         <td><p style="margin-left: 30px;">售价</p></td>
                                         <td>
                                          <div class="add-imgbox">
                                             <img src="/EasyTalk/BackendPublic/images/min.png" class="add-img" id="add-reduce">
                                             <input type="text" value="0" class="add-input2" id="edi-pri">
                                             <img src="/EasyTalk/BackendPublic/images/plus.png" class="add-img" id="add-up">
                                          </div>
                                         </td>
                                    </tr>
                              </table>
                              <p class="add-p1">课程简介</p>
                              <textarea name="classde" class="add-input3" id="edi-des"></textarea>
                        </div>
                        <div class="call">
                              <div class="call-2">
                                    <input type="button" value="确认修改" class="call-bu call-bu1" id="edi-up">
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