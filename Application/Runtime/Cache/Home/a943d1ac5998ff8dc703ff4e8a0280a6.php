<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>个人中心</title>
  <link rel="stylesheet" type="text/css" href="/EasyTalk/Public/css/pccenter.css">
	<link rel="stylesheet" type="text/css" href="/EasyTalk/Public/css/common.css">
  <script type="text/javascript" src="/EasyTalk/Public/js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="/EasyTalk/Public/js/jquery.form.js"></script>
  <script type="text/javascript" src="/EasyTalk/Public/js/nav.js"></script>
  <script type="text/javascript" src="/EasyTalk/Public/js/common.js"></script>
  <script type="text/javascript" src="/EasyTalk/Public/js/pcmyclass.js"></script>
</head>
<body>
      <div class="bgbox topbg-1">
      	   <div class="topbg">
      	   	     <img src="/EasyTalk/Public/src/images/easytalklogo.png" alt="Easytalk">
      	   	     <a href="#">退出登录</a>
      	   	     <p>您好，请先登录</p>
      	   </div>
      </div>
      <div class="bgbox navbg-1">
      	   <div class="navbg">
               <ul>
                  <a href="/EasyTalk/index.php/"><li id="nav1">首页</li></a>
                  <a href="/EasyTalk/index.php/home/coursesys/course_system_1" class="nava"><li id="nav2">课程体系</li></a>
                  <a href="/EasyTalk/index.php/home/teacher/tea_ara?lan=01" class="nava"><li id="nav3">老师介绍</li></a>
                  <a href="/EasyTalk/index.php/home/course/buyclass_vie" class="nava"><li id="nav4">课程购买</li></a>
                  <a href="/EasyTalk/index.php/home/user/pccenter" class="nava nowa"><li id="nav5">个人中心</li></a>
                  <a href="/EasyTalk/index.php/home/exercise/practiceclass?lan=01" class="nava"><li id="nav6">练习中心</li></a>
               </ul>
      	   </div>
      </div>
      <div class="bgbox centerbg-1">
            <div class="centerbg-2">
                  <div class="cleft">
                        <div class="chead">
                             <form action="/EasyTalk/index.php/home/user/updateHead" method="post" id="upheadform" enctype="multipart/form-data">
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
                        <a href="/EasyTalk/index.php/home/user/pccenter" class="pcnava">账号信息</a>
                        <a href="/EasyTalk/index.php/home/user/pcmyclass" class="pcnava nowa">我的课程</a>
                        <a href="/EasyTalk/index.php/home/user/pccomment" class="pcnava">意见反馈</a>
                  </div>
                  
                  <div class="myclassright">
                        <div class="addbox">
<!--                               <div class="allbox">
                                    <?php if(is_array($courses)): foreach($courses as $key=>$courses): ?><div class="top">
                                          <div class="classname"><?php echo ($courses["c_language"]); ?></div>
                                          <table cellpadding="0" cellspacing="18">
                                                 <tr>
                                                     <td>课程号</td>
                                                     <td><?php echo ($courses["c_id"]); ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td>课程名</td>
                                                     <td><?php echo ($courses["c_title"]); ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td>教师</td>
                                                     <td><?php echo ($courses["t_name"]); ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td>难度</td>
                                                     <td><?php echo ($courses["level"]); ?></td>
                                                 </tr>
                                          </table>
                                          <div class="schedule">
                                                <div class="rad1"></div>
                                                <div class="rad2"></div>
                                                <div class="radtip">
                                                    <p>进度</p>
                                                    <p><?php echo ($courses["finished"]); ?>/<?php echo ($courses["c_credit"]); ?></p>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="center">
                                          <p>课程简介</p>
                                          <div><?php echo ($courses["c_description"]); ?></div>
                                    </div>
                                    <div class="bottom">
                                         <img src="<?php echo ($courses["teacher"]["t_head"]); ?>" alt="">
                                         <table cellpadding="0" cellspacing="18">
                                               <tr>
                                                   <td style="width: 50px;">教师</td>
                                                   <td><?php echo ($courses["teacher"]["t_name"]); ?></td>
                                               </tr>
                                         </table>
                                         <div class="bottomdiv">
                                              <p>简介</p>
                                              <div><?php echo ($courses["teacher"]["t_description"]); ?></div>
                                         </div>
                                    </div><?php endforeach; endif; ?> -->
                                    <!-- 以下是样例模板 -->
                                    <!-- <div class="top">
                                          <div class="classname">法语</div>
                                          <table cellpadding="0" cellspacing="18">
                                                 <tr>
                                                     <td>课程号</td>
                                                     <td>001</td>
                                                 </tr>
                                                 <tr>
                                                     <td>课程名</td>
                                                     <td>听力</td>
                                                 </tr>
                                                 <tr>
                                                     <td>教师</td>
                                                     <td>乔菲</td>
                                                 </tr>
                                                 <tr>
                                                     <td>难度</td>
                                                     <td>中级</td>
                                                 </tr>
                                          </table>
                                          <div class="schedule">
                                            
                                          </div>
                                    </div>
                                    <div class="center">
                                          <p>课程简介</p>
                                          <div>学会用法语掌如何进行自我介绍，介绍家人，请别人作自我介绍，描述个人兴趣，描述活动，表述频率或强度，描述人物的外貌及衣着，描述人物的社会、文化及地理背景信息，表达愿望，礼貌提出要求，介绍计划，表述自己的梦想和所关注的问题。</div>
                                    </div>
                                    <div class="bottom">
                                         <img src="/EasyTalk/Public/src/images/teacherCJY.png" alt="">
                                         <table cellpadding="0" cellspacing="18">
                                               <tr>
                                                   <td style="width: 50px;">教师</td>
                                                   <td>程家阳</td>
                                               </tr>
                                         </table>
                                         <div class="bottomdiv">
                                              <p>简介</p>
                                              <div>程家阳，外交部长儿子，冷静干练、又带点忧郁气质、翻译天才。毕业于法国公立大学蒙彼利埃第三大学应用外语专业，翻译方向，本科就读于法国里昂第二大学，欧洲语言统一标准DALF C1法语等级证书。留学法国多年，熟知法国的文化习俗及风土人情，
                                              并熟悉法国留学考试的流程。回国后一直从事教育工作，法语精通，口语流利，发音地道。
                                              </div>
                                         </div>
                                    </div> -->
                              </div>
                              <div class="pagebg">
                                    <div class="pagediv">
                                        <img src="/EasyTalk/Public/src/images/lastpage.png" id="page-last">
                                        <div class="addp">
                                        </div>
                                        <img src="/EasyTalk/Public/src/images/nextpage.png" id="page-next">
                                    </div>
                              </div>
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