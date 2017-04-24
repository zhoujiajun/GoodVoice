$(function(){
	$.ajax({
		type:'post',
		// dataType:'json',
		url:'Home/index/checkHasLogin',
		success:function(data){
			   if(data!=0){
			   	 window.id=data;
			   	 $.ajax({
			   	 	type:'post',
			   	 	dataType:'json',
			   	 	url:'Home/index/getAcc',
			   	 	data:{id:id},
			   	 	success:function(data){
			   	 		$(".topbg p").html(data.acc);//用户名字
			   	 		$(".topbg a").css('display','block');
			   	 		$(".loinbox").css('display','none');
			   	 	},
			   	 });
			   }
			   else{
               $(".nava").click(function(){
                       	   alert("请先登录");
                           return false;
                });
			   }
		},
		error:function(jqXHR){

	    }
	});
});
function loginajax(){
    $.ajax({
      type:'post',
      url:'Home/index/do_login',
      data:{
        acc:$("#loacc").val(),
        psw:$("#lohid").val(),

      },
      success:function(data){
        if(data.id==0){
          $("#loacc").val('账户不存在或密码错误').css('color','red');
          $("#lopass").val('账户不存在或密码错误').attr('type','text').css('color','red');
        }
        else{
          alert("登录成功！");
          Save();
          $(".topbg p").html($("#loacc").val());//用户名字
          $(".topbg a").css('display','block');
          $(".loinbox").css('display','none');
          $(".nava").unbind();
        }
      },
      error:function(jqXHR){
        console.log(jqXHR);
      }
    })
}

//登录
$(function(){
	$("#loacc").focus(function(event) {
    $("#loacc").css('color','#999999');
		if($("#loacc").val()=='帐号/绑定邮箱'||$("#loacc").val()=='账户不存在或密码错误'||$("#loacc").val()=='帐号不能为空'){
			$("#loacc").val('').css('color','#999999');
		}
	});
	$("#loacc").blur(function(){
		if($("#loacc").val()==''){
			$("#loacc").val('帐号/绑定邮箱').css('color','#999999');
		}
	});

	$("#lopass").focus(function(event) {
    $("#lopass").attr('type','password').css('color','#999999');
		if($("#lopass").val()=='密码'||$("#lopass").val()=='账户不存在或密码错误'||$("#lopass").val()=='密码不能为空'){
			$("#lopass").val('').attr('type','password').css('color','#999999');
		}
	});
	$("#lopass").blur(function(){
		if($("#lopass").val()==''){
			$("#lopass").val('密码').attr('type','text').css('color','#999999');
		}
	});

	$("#loginbu").click(function(event) {
       if($("#loacc").val()=='帐号/绑定邮箱'||$("#loacc").val()=='帐号不能为空'){
       	 $("#loacc").val('帐号不能为空').css('color','red');
       	 return false;
       }else if($("#lopass").val()=='密码'||$("#lopass").val()=='密码不能为空'){
       	 $("#lopass").val('密码不能为空').attr('type','text').css('color','red');
       	 return false;
       }else if($("#lopass").val()=='123456'){
          loginajax();
       }else{
          $("#lohid").val($("#lopass").val());
          loginajax();
       }
	});
});
//下次自动登录
    $(document).ready(function () {
      if($("#lore").is(':checked')){
          $(".forlore div").css('background-color','black');
                if ($.cookie("rmbUser") == "true") {
                    $("#lore").attr("checked", true);
                    $("#loacc").val($.cookie("username"));
                    $("#lopass").val('123456');
                    $("#lohid").val($.cookie("password"));
                    $("#lopass").attr({
                      type: 'password',
                      color: '#999999'
                    });;
                    $("#loacc").attr('color', '#999999');
                }
      }
    	$(".forlore").click(function(event) {
    		if (!$("#lore").is(':checked')){
    			$(".forlore div").css('background-color','black');
                if ($.cookie("rmbUser") == "true") {
                    $("#lore").attr("checked", true);
                    $("#loacc").val($.cookie("username"));
                    $("#lopass").val('123456');
                    $("#lohid").val($.cookie("password"));
                    $("#lopass").attr({
                      type: 'password',
                      color: '#999999'
                    });;
                    $("#loacc").attr('color', '#999999');
                }
                
    		}else{
    			$(".forlore div").css('background-color','#ffffff');
    		}
    	});

    });

    //记住用户名密码
    function Save() {
        if ($("#lore").is(':checked')) {
            var str_username = $("#loacc").val();
            var str_password = $("#lopass").val();
            $.cookie("rmbUser", "true", { expires: 7 }); //存储一个带7天期限的cookie
            $.cookie("username", str_username, { expires: 7 });
            $.cookie("password", str_password, { expires: 7 });
        }
        else {
            $.cookie("rmbUser", "false", { expire: -1 });
            $.cookie("username", "", { expires: -1 });
            $.cookie("password", "", { expires: -1 });
        }
    };

//注册表单验证
$(function(){
   // 用户名验证
   $("#reacc").blur(function(){
   	  if($("#reacc").val()==''){
   	  	 $(".retacc").css('display','none');
   	  	 $(".refacc").css('display','block');
   	  	 $(".refacc p").html("用户名不能为空");
   	  	 return false;
   	  }else{
   	  	$.ajax({
   	  		type:'post',
   	  		url:'Home/index/checkUser',
   	  		data:{acc: $("#reacc").val(),},
   	  		success:function(data){
   	  			if(data==0){//用户名已被注册
   	  				$(".retacc").css('display','none');
   	  	            $(".refacc").css('display','block');
   	  	            $(".refacc p").html("用户名已被注册");
   	  	            return false;
   	  			}else{
   	  				$(".refacc").css('display','none');
   	  				$(".retacc").css('display','block');
   	  			}
   	  		},
   	  	});
   	  }
   });
   //密码验证
   $("#repass1").blur(function(){
   	  if($("#repass1").val()==''){
   	  	 $(".retpass1").css('display','none');
   	  	 $(".refpass1").css('display','block');
   	  	 $(".refpass1 p").html("密码不能为空");
   	  	 return false;
   	  }else{
   	  	 $(".retpass1").css('display','block');
   	  	 $(".refpass1").css('display','none');
   	  }
   });
   $("#repass2").blur(function(){
   	  if($("#repass2").val()!=$("#repass1").val()){
   	  	 $(".retpass2").css('display','none');
   	  	 $(".refpass2").css('display','block');
   	  	 $(".refpass2 p").html("密码不一致");
   	  	 return false;
   	  }else{
   	  	 $(".retpass2").css('display','block');
   	  	 $(".refpass2").css('display','none');
   	  }
   });
   //邮箱验证
   var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
   $("#remail").blur(function(){
   	  if(!reg.test($("#remail").val())){
   	  	 $(".retmail").css('display','none');
   	  	 $(".refmail").css('display','block');
   	  	 $(".refmail p").html("邮箱格式错误");
   	  	 return false;
   	  }else{
   	  	 $(".retmail").css('display','block');
   	  	 $(".refmail").css('display','none');
   	  }
   });
});




$(function(){
	$('.regibg-1,.fgpwbg-1').width($(document).width()).height($(document).height());
	
	//注册
    var options = {  
        beforeSubmit:  showRequest,  //提交前处理 
        success:       showResponse,  //处理完成 
        resetForm: true,  
    };  
  
    $('#rebu').click(function(){  
            window.showacc=$("#reacc").val();
           $("#reform").ajaxSubmit(options);  
    });  
});
function showRequest(formData, jqForm, options) {
    // 
    if($(".refalse").is(':visible') || $("#reqq").val()==''||$("#reac").val()==''|| $("#repass1").val()==''|| $("#repass2").val()==''||$("#remail").val()==''){
    	alert("资料未填写完整！");
    	return false;
    }else{
      return true;
    }
     

}  
  
function showResponse(responseText, statusText)  {  
    if(responseText==0){
      alert("注册失败：请重新注册!");
      $(".reture,.refalse").css('display','none');
    }else{
          alert("注册成功！");
          $(".topbg p").html(showacc);//用户名字
          $(".topbg a").css('display','block');
          $(".loinbox").css('display','none');
          $(".regibg-1,.reture,.refalse").css('display','none');
          $(".resetiniput").val('');
          $(".nava").unbind();
    }

}  

//打开关闭注册页面
$(function(){
	$("#closere").click(function(event) {
		$(".regibg-1,.reture,.refalse").css('display','none');
		$(".resetiniput").val('');
	});
	$("#gorebu").click(function(event) {
		$(".regibg-1").css('display','block');
	});
});

//忘记密码
$(function(){
  $("#pass1,#pass2").blur(function(event) {
     if($("#pass1").val()!=$("#pass2").val()){
            $(".fgpwture").css('display', 'none');
            $(".fgpwfales,.fgpwfales1,.fgpwfales2,.fgpwture3").css('display','none');
            $(".fgpwfales3").css('display', 'block');
     }else{
            $(".fgpwture").css('display', 'none');
            $(".fgpwfales,.fgpwfales1,.fgpwfales2,.fgpwfales3").css('display','none');
            $(".fgpwture3").css('display', 'block');
     }
     
  });



  $("#upfogetpw").click(function(event) {
    if($("#fgpwacc").val()==''||$("#fgpwmail").val()==''||$("#fgpwqq").val()==''||$("#pass1").val()==''||$("#pass2").val()==''||$(".refalse").is(':visible')){
      alert("资料未填写完整！");
    }else{
     $.ajax({
        type:'POST',
        url:'Home/index/verify',
        data:{acc:$("#fgpwacc").val(),
              mail:$("#fgpwmail").val(),
                qq:$("#fgpwqq").val(),
                newpsw:$("#pass1").val(),
              },
        success:function(data){
              if(data=='0'){
                  alert("验证错误，请重新验证");
              }else if(data=='00' || data==1){
                  alert("密码修改成功");
                  window.location.href="";
              }
                  
              
        },
        error:function(jqXHR){
        }
     });
   }
  });

  $("#fgpwimg").click(function(event) {
    $(".fgpwbg-1").css('display', 'none');
    $("#pass1,#pass2,#fgpwacc,#fgpwmail,#fgpwqq").val('');
    $(".reture,.refalse").css('display', 'none');
  });
  $("#fgpwopen").click(function(event) {
   $(".fgpwbg-1").css('display', 'block');
  });
})

/*----------首页图片-----------*/
$(function(){
  $.ajax({
    type:'post',
    url:'Home/index/showIndexPic',
    success:function(data){
      $(".scoll_banner").html("<img src='"+data.pic+"'>");
    }
  })
})
