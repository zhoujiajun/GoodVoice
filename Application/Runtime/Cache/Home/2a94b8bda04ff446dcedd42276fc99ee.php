<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="/EasyTalk/Public/css/index.css">
	<link rel="stylesheet" type="text/css" href="/EasyTalk/Public/css/common.css">
    <script type="text/javascript" src="/EasyTalk/Public/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="/EasyTalk/Public/js/jquery.form.js"></script>
    <script type="text/javascript" src="/EasyTalk/Public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/EasyTalk/Public/js/index.js"></script>
    <script type="text/javascript" src="/EasyTalk/Public/js/indexnav.js"></script>
    <script type="text/javascript" src="/EasyTalk/Public/js/indexlogout.js"></script>

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
      	   	   	  <a href="/EasyTalk/index.php/"><li id="nav1"></li></a>
      	   	   	  <a href="/EasyTalk/index.php/Home/coursesys/course_system_1?lan=01" class="nava"><li id="nav2"></li></a>
      	   	   	  <a href="/EasyTalk/index.php/Home/teacher/tea_ara?lan=01" class="nava"><li id="nav3"></li></a>
      	   	   	  <a href="/EasyTalk/index.php/Home/course/buyclass_vie" class="nava"><li id="nav4"></li></a>
      	   	   	  <a href="/EasyTalk/index.php/Home/user/pccenter" class="nava"><li id="nav5"></li></a>
      	   	   	  <a href="/EasyTalk/index.php/Home/exercise/practiceclass?lan=01" class="nava"><li id="nav6"></li></a>
      	   	   </ul>
      	   </div>
      </div>
      <div class="bgbox centerbg-1">
      	   <div class="centerbg">
                <div class="scoll_banner">
                     <img src="#">
                </div>
      	   	    <div class="loinbox">
      	   	    	  <p>登录</p>
      	   	    	  <table cellpadding="0" cellspacing="22">
      	   	    	  	   <tr>
      	   	    	  	   	   <td>
      	   	    	  	   	   	   <div class="inlobox">
      	   	    	  	   	   	   	    <img src="/EasyTalk/Public/src/images/user.png" alt="账户">
      	   	    	  	   	   	   	    <input type="text" name="loacc" value="帐号/绑定邮箱" id="loacc">
      	   	    	  	   	   	   </div>
      	   	    	  	   	   </td>
      	   	    	  	   </tr>
      	   	    	  	   <tr>
      	   	    	  	   	   <td>
      	   	    	  	   	   	   <div class="inlobox">
      	   	    	  	   	   	   	    <img src="/EasyTalk/Public/src/images/password.png" alt="密码">
      	   	    	  	   	   	   	    <input type="text" name="lopassword" value="密码" id="lopass">
                                      <input type="text" name="lopassword" id="lohid" style="display: none">
      	   	    	  	   	   	   </div>
      	   	    	  	   	   </td>
      	   	    	  	   </tr>
      	   	    	  	   <tr>
      	   	    	  	   	   <td>
      	   	    	  	   	   	   <label for="lore" class="forlore"><div></div></label>
      	   	    	  	   	   	   <input type="checkbox" id="lore" style="display: none;" checked="checked">
      	   	    	  	   	   	   <span  class="lonext">下次自动登录</span>
      	   	    	  	   	   	   <a href="#" class="fgpw" id="fgpwopen">忘记密码?</a>
      	   	    	  	   	   </td>
      	   	    	  	   </tr>
      	   	    	  </table>

      	   	    	  <input type="button" value="登录" class="lobu" id="loginbu">
      	   	    	  <input type="button" value="尚未注册" class="lobu" id="gorebu">
      	   	    </div>
      	   </div>
           <div class="index_csys">
                <p class="csys_p">课程体系</p>
                <div class="csys_introduce_box">
                     <div class="inroduce_single_box">
                           <img src="/EasyTalk/Public/src/images/Arab.jpg">
                           <p>阿拉伯语课程体系</p>
                     </div>
                     <div class="inroduce_single_box">
                           <img src="/EasyTalk/Public/src/images/Indonesia.jpg">
                           <p>印尼语课程体系</p>
                     </div>
                     <div class="inroduce_single_box">
                           <img src="/EasyTalk/Public/src/images/Thailand.jpg">
                           <p>泰语课程体系</p>
                     </div>
                     <div class="inroduce_single_box">
                           <img src="/EasyTalk/Public/src/images/Vietnam.jpg">
                           <p>越南语课程体系</p>
                     </div>
                </div>
           </div>
           <div class="index_teac">
               <p class="teac_p">名师介绍</p>
               <div class="teac_introduce_box">
                   <div class="teac_single_box">
                          <img src="/EasyTalk/Public/src/images/1.jpg">
                          <p>玛拉娣</p>
                   </div>
               </div>
               <div class="teac_introduce_box">
                   <div class="teac_single_box">
                          <img src="/EasyTalk/Public/src/images/2.jpg">
                          <p>阮氏如琼</p>
                   </div>
               </div>
               <div class="teac_introduce_box">
                   <div class="teac_single_box">
                          <img src="/EasyTalk/Public/src/images/3.jpg">
                          <p>Sabina</p>
                   </div>
               </div>
               <div class="teac_introduce_box">
                   <div class="teac_single_box">
                          <img src="/EasyTalk/Public/src/images/4.png">
                          <p>陈氏梦泉</p>
                   </div>
               </div>
           </div>
           <div class="index_more">
               <div class="more_src">
                     <p>相关连接</p>
                     <hr>
                     <ul class="more_src_ul">
                         <li><a href="http://vie.tingroom.com/shehui/ynfq/1212.html" target="_blank">你了解越南春节的习俗吗？</a></li>
                         <li><a href="http://vie.tingroom.com/shehui/ynshfz/16921.html" target="_blank">越南旅游禁忌知多少</a></li>
                         <li><a href="http://th.hujiang.com/new/p183682/" target="_blank">泰国风俗节日——美丽的“水灯节”</a></li>
                         <li><a href="http://th.hujiang.com/new/p1082582/" target="_blank">凭什么泰国又双叒叕拿世界第一！看完这些我服！</a></li>
                         <li><a href="http://www.yinniyu.com/news/view.asp?id=3713" target="_blank">哪些国家讲印尼语？</a></li>
                         <li><a href="http://www.fmprc.gov.cn/ce/ceindo/chn/zgyyn/t1439529.html" target="_blank">王毅外长会见印尼外长蕾特诺</a></li>
                         <li><a href="http://xyz.hujiang.com/new/p182638/" target="_blank">阿拉伯语读音速成，如何最快学阿语？看这里！</a></li>
                         <li><a href="http://xyz.hujiang.com/new/p1071132/" target="_blank">阿拉伯国家列表</a></li>
                     </ul>
               </div>
               <div class="about_us">
                     <p>联系我们</p>
                     <hr>
                     <img src="/EasyTalk/Public/src/images/QRcode.png">
                     <div class="about_us_div">
                         <ul>
                             <li>扫描上方二维码关注我们公众号</li>
                             <li>QQ &nbsp  &nbsp 1723253971</li>
                             <li>邮箱 &nbsp  &nbsp ueasytalk@qq.com</li>
                             <li>地址 &nbsp  &nbsp 广东省广州市白云区白云大道2号</li>
                         </ul>
                     </div>
               </div>
           </div>
      </div>
      <div class="bgbox bottombg-1">
      	   <div class="bottombg">
      	   	   <p>Copyright &copy Easy talk 小语种在线一对一学习社区 | 版权所有 京ICP证008719-5</p>
      	   </div>
      </div>
      <div class="regibg-1">
      	   <div class="regibg">
      	   	     <div class="retop">
      	   	     	   <p>注册</p>
      	   	     	   <img src="/EasyTalk/Public/src/images/close.png" alt="关闭" id="closere">
      	   	     </div>
      	   	     <hr>
      	   	    <form method="post" id="reform" action="/EasyTalk/index.php/Home/Index/register">
      	   	     <table class="retable" cellspacing="22" cellpadding="0">
      	   	     	   <tr>
      	   	     	   	   <td style="text-align: right;">用户名</td>
      	   	     	   	   <td><input type="text" name="acc" id="reacc" class="resetiniput"></td>
      	   	     	   	   <td>
      	   	     	   	   	   <img src="/EasyTalk/Public/src/images/true.png" alt="true" class="reture retacc">
      	   	     	   	   	   <div class="refalse refacc">
      	   	     	   	   	   	     <img src="/EasyTalk/Public/src/images/false.png" alt="false">
      	   	     	   	   	   	     <p>用户名已被注册</p>
      	   	     	   	   	   </div>
      	   	     	   	   </td>
      	   	     	   </tr>
      	   	     	   <tr>
      	   	     	   	   <td style="text-align: right;">密码</td>
      	   	     	   	   <td><input type="password" name="psw" id="repass1" class="resetiniput"></td>
      	   	     	   	   <td>
      	   	     	   	   	   <img src="/EasyTalk/Public/src/images/true.png" alt="true" class="reture retpass1">
      	   	     	   	   	   <div class="refalse refpass1">
      	   	     	   	   	   	     <img src="/EasyTalk/Public/src/images/false.png" alt="false">
      	   	     	   	   	   	     <p>用户名已被注册</p>
      	   	     	   	   	   </div>
      	   	     	   	   </td>
      	   	     	   </tr>
      	   	     	   <tr>
      	   	     	   	   <td style="text-align: right;">确认密码</td>
      	   	     	   	   <td><input type="password" id="repass2" class="resetiniput"></td>
      	   	     	   	   <td>
      	   	     	   	   	   <img src="/EasyTalk/Public/src/images/true.png" alt="true" class="reture retpass2">
      	   	     	   	   	   <div class="refalse refpass2">
      	   	     	   	   	   	     <img src="/EasyTalk/Public/src/images/false.png" alt="false">
      	   	     	   	   	   	     <p>用户名已被注册</p>
      	   	     	   	   	   </div>
      	   	     	   	   </td>
      	   	     	   </tr>
      	   	     	   <tr>
      	   	     	   	   <td style="text-align: right;">QQ</td>
      	   	     	   	   <td><input type="text" name="qq" class="resetiniput" id="reqq"></td>
      	   	     	   	   <td></td>
      	   	     	   </tr>
      	   	     	   <tr>
      	   	     	   	   <td style="text-align: right;">电子邮箱</td>
      	   	     	   	   <td><input type="text" name="mail" id="remail" class="resetiniput"></td>
      	   	     	   	   <td>
      	   	     	   	   	   <img src="/EasyTalk/Public/src/images/true.png" alt="true" class="reture retmail">
      	   	     	   	   	   <div class="refalse refmail">
      	   	     	   	   	   	     <img src="/EasyTalk/Public/src/images/false.png" alt="false">
      	   	     	   	   	   	     <p>用户名已被注册</p>
      	   	     	   	   	   </div>
      	   	     	   	   </td>
      	   	     	   </tr>
      	   	     	   <tr>
      	   	     	   	   <td></td>
      	   	     	   	   <td><input type="button" value="注册" id="rebu"></td>
      	   	     	   	   <td></td>
      	   	     	   </tr>
      	   	     </table>
      	   	    </form>
      	   </div>
      </div>

      <div class="fgpwbg-1">
            <div class="fgpwbg">
                  <div class="retop">
                         <p>忘记密码</p>
                        <img src="/EasyTalk/Public/src/images/close.png" alt="关闭" id="fgpwimg">
                  </div>
                  <hr>
                  <table cellpadding="0" cellspacing="0">
                         <tr>
                               <td style="text-align: right;">用户名</td>
                               <td><input type="text" class="fgpwinput" id="fgpwacc"></td>
                               <td>
                               </td>
                         </tr>
                         <tr>
                               <td style="text-align: right;">电子邮箱</td>
                               <td><input type="text" class="fgpwinput" id="fgpwmail"></td>
                               <td>
                               </td>
                         </tr>
                         <tr>
                               <td style="text-align: right;">QQ</td>
                               <td><input type="text" class="fgpwinput" id="fgpwqq"></td>
                               <td>
                               </td>
                         </tr>
                         <tr>
                               <td style="text-align: right;">新密码</td>
                               <td><input type="password" class="fgpwinput" id="pass1"></td>
                               <td>
                               </td>
                         </tr>
                         <tr>
                               <td style="text-align: right;">确认密码</td>
                               <td><input type="password" class="fgpwinput" id="pass2"></td>
                               <td>
                                    <img src="/EasyTalk/Public/src/images/true.png" alt="true" class="reture fgpwture3">
                                    <div class="refalse fgpwfales3">
                                          <img src="/EasyTalk/Public/src/images/false.png" alt="false">
                                          <p>密码不一致</p>
                                    </div>
                               </td>
                         </tr>
                         <tr>
                               <td></td>
                               <td><button id="upfogetpw">确定</button></td>
                               <td></td>
                         </tr>
                  </table>
            </div>
      </div>
</body>
</html>