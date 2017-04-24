<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/common.css">
  <link rel="stylesheet" type="text/css" href="/EasyTalk/BackendPublic/css/adsystem.css">
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="/EasyTalk/Public/js/jquery.form.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/css.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/adteacher-editc.js"></script>
  <script type="text/javascript" src="/EasyTalk/BackendPublic/js/quitlogin.js"></script>
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
                                   <a href="/EasyTalk/admin.php/Home/Administration/aduser?html=11"><li>用户管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adteacher?html=12" class="now-a"><li>教师管理</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adtradata?html=13" class="labg"><li>交易数据</li></a>
                                   <a href="/EasyTalk/admin.php/Home/Administration/adclass?html=14"><li>课程管理</li></a>
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
                              <p>编辑老师</p>
                        </div>
                        <form action="updateTeacher" enctype="multipart/form-data" method="post" id="upeditcform">
                        <div class="conbox" style="position: relative;">
                              <ul class="ulmore">
                                  <a href="/EasyTalk/admin.php/Home/Administration/adpicindex"><li>首页图片</li></a>
                                  <a href="/EasyTalk/admin.php/Home/Administration/adpiccl"><li>课程体系</li></a>
                              </ul>
                             <table class="addtc-table" cellspacing="30" cellpadding="0">
                                   <tr>
                                       <td style="text-align: right;">姓名</td>
                                       <td><input type="text" name="name" class="addtc-text" id="edi-name"></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: right;">语种</td>
                                       <td ><select name="lang" id="lang" class="tcedi-lang">
                                                <option value=""></option>
                                                <option value="越南语">越南语</option>
                                                <option value="泰语">泰语</option>
                                                <option value="印尼语">印尼语</option>
                                                <option value="阿拉伯语">阿拉伯语</option>
                                           </select>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: right;">QQ</td>
                                       <td><input type="text" name="qq" class="addtc-text" id="edi-qq"></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: right;">邮箱</td>
                                       <td><input type="text" name="mail" class="addtc-text" id="edi-mail">
                                          <input type="text" name="t_id" value="<?php echo ($id); ?>" style="display: none;" id="tcedi-id">
                                       </td>
                                   </tr>
                             </table>
                             
                             <div class="edi-imgbox">
                                  <img src="/EasyTalk/BackendPublic/images/teacherQF.png" alt="修改图片" class="edi-img" id="edi-imgid">
                                  <label for="edi-pic" class="edi-pic">
                                          <div>
                                              <div class="edi-uppicbu">修改头像</div>
                                          </div>
                                  </label>
                                  <input type="file" name="photo" id="edi-pic" accept="image/jpeg image/jpg image/png" style="display: none;">
                             </div>
                             <div class="edi-tcde">
                                  <p>教师简介</p>
                                  <textarea name="tcdes" id="eid-des"></textarea>
                             </div>
                        </div>
                        <div class="call">
                              <input type="button" value="确认" class="addtc-button" id="upeditc">
                              <input type="button" value="返回" class="addtc-button" id="editcback">
                        </div>
                        </form>
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