$(function(){
window.name=0;
window.lang;
window.qq;
window.mail;
window.src;
window.des;
	$.ajax({
		type:'POST',
		url:'checkLogin',
		success:function(data){
            if(data==0){
            	alert("请先登录");
            	// window.location.href="adminlogin.html";
            }else{
            	$.ajax({
            		type:"POST",
            		url:'getOneTeacher',
            		data:{id:getQueryString('id')},
            		success:function(data){
                  console.log(data);
                          $(".ctop span").html("管理员："+data.acc);
                          $(".topbg a").css('display','block');
                          $(".topbg p").css('display','none');
                          $("#edi-name").val(data.t_name);
                          $("#lang").val(data.t_language);
                          $("#edi-qq").val(data.t_qq);
                          $("#edi-mail").val(data.email);
                          $("#edi-imgid").attr('src', data.t_head);
                          $("#eid-des").val(data.t_description);
                          $("#tcedi-id").val(getQueryString('id'));
                          name=data.t_name;
                          lang=data.t_language;
                          qq=data.t_qq;
                          mail=data.email;
                          src=data.t_head;
                          des=data.t_description;//
            		},
            		error:function(){

            		}
            	});
            }
		},
		error:function(){ 
		// 	                    window.name="data.name";
  //                         window.lang="法语";
  //                         window.qq="data.qq";
  //                         window.mail="data.mail";
  //                         $("#edi-name").val(name);
  //                         $("#lang").val(lang);
  //                         $("#edi-qq").val(qq);
  //                         $("#edi-mail").val(mail);
		}
	})
/*-------------------点击设置--------------------------*/
$("#edi-name").focus(function(event) {
	if($("#edi-name").val()==name){
       $("#edi-name").val('');
	}
  });
$("#edi-name").blur(function(event) {
	if($("#edi-name").val()==''){
	    $("#edi-name").val(name);
	 }
  });

$("#edi-qq").focus(function(event) {
	if($("#edi-qq").val()==qq){
       $("#edi-qq").val('');qq
	}
  });
$("#edi-qq").blur(function(event) {
	if($("#edi-qq").val()==''){
	    $("#edi-qq").val(qq);
	 }
  });

$("#edi-mail").focus(function(event) {
	if($("#edi-mail").val()==mail){
       $("#edi-mail").val('');
	}
  });
$("#edi-mail").blur(function(event) {
	if($("#edi-mail").val()==''){
	    $("#edi-mail").val(mail);
	 }
  });
/*--------------------------*/
$("#upeditc").click(function(event) {
   	    $("#upeditcform").ajaxSubmit(options);
   });
   var options = {  
        beforeSubmit:  showRequest,  //提交前处理 
        success:       showResponse,  //处理完成 
        resetForm: true,  
        // dataType:  'json'  
    }; 
 /*--------------*/
$("#editcback").click(function(event) {
window.location.href=document.referrer;
   }); 
})
/*--------------------*/
function showRequest(formData, jqForm, options) {
    var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/
    if(!confirm("确定修改老师信息？")){
    	
    	     return false;
    }else if($("#edi-name").val()==name && $("#edi-qq").val()==qq && $("#edi-mail").val()==mail && $("#lang").val()==lang && $("#edi-imgid").attr('src')==src && $("#eid-des").val()==des){
         alert("请修改资料");
         return false;
    }else if(!reg.test($("#edi-mail").val())){
    	alert("邮箱格式错误");
    	return false;
    }else if($("#lang").val()==''){
      alert("语种不能为空");
      return false;
    }
     
     
    return true;  
}  
  
function showResponse(responseText, statusText)  {  
  alert("修改成功！")
	window.location.reload();
} 
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
}
