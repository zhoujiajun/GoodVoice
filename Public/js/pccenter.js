//判断登录
$(function(){
	$.ajax({
		type:'post',
		url:'../index/checkHasLogin',
		success:function(data){
            if(data==0){
            	alert("请先登录！");
            	window.location.href="../../";
            }else{
            	  window.id=data;
            	  $.ajax({
            	  	 type:'post',
            	  	 url:'personal',
            	  	 data:{id:id},
            	  	 success:function(data){
                        $(".topbg p,#useracc").html(data.acc);//用户账号名字
                        $(".topbg a").css('display','block');
                        $(".loinbox").css('display','none');
            	  	 	$("#imghead").attr('src', data.pic);
            	  	 	$("#userqq").html(data.qq);
            	  	 	$("#usermail").html(data.mail);
                        $("#basicqq").val($("#userqq").html());
                        $("#basicmail").val($("#usermail").html());
                        $("#safeacc").val($("#useracc").html());
            	  	 },
            	  });
            }
		},
		error:function(jqXHR){
            /*测试用------------最后删----start*/
            $("#safeacc").val($("#useracc").html());
            $("#basicqq").val($("#userqq").html());
            $("#basicmail").val($("#usermail").html());
            $("#safeacc").val($("#useracc").html());
            window.mypsw=12323;
            /*测试用------------最后删----end*/
		},
	});
});



//上传图片
$(function(){
   $(".centerbg").height($(document).height()-220);
   
   $("#headfile").change(function(event) {
   	   docObj = document.getElementById("headfile");
   	   var imgObjPreview=document.getElementById("imghead");
   	   imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
   	   $(".cheadb").css('display','none');
   	   $(".upheadbu").css('display','block');
   });
   
   $("#uphead").click(function(event) {
   	    $("#upheadform").ajaxSubmit(options);
   });
   var options = {  
        beforeSubmit:  showRequest,  //提交前处理 
        success:       showResponse,  //处理完成 
        resetForm: true,  
        // dataType:  'json'  
    };  
});
function showRequest(formData, jqForm, options) {
    // 
    if(!confirm("确定修改头像？")){
             $(".cheadb").css('display','block');
   	         $(".upheadbu").css('display','none');
    	     return false;
    }
     
     
    return true;  
}  
  
function showResponse(responseText, statusText)  {  
    alert("修改成功！")
}  

//修改数据
$(function(){
	$("#basicimg").click(function(event) {
		$("#basicimg,.tablep1").css('display','none');
		$(".tableinput1,#upbasci").css('display','block');
	});

	$("#safesetimg").click(function(event) {
		$("#safesetimg,.tablep2").css('display','none');
		$(".tableinput2,#upsafeset,.tabletdpass").css('display','block');
	});

	$("#safepass2,#safepass1").blur(function(event) {
		if($("#safepass2").val()!=$("#safepass1").val() && $("#safepass1").val()!=''){
			$(".refpass2").css('display','block');
			$(".retpass2").css('display','none');
		}else if($("#safepass2").val()!='' && $("#safepass2").val()!=$("#safepass1").val()){
            $(".refpass2").css('display','block');
            $(".retpass2").css('display','none');
		}else if($("#safepass2").val()!=''&& $("#safepass1").val()!=''&& $("#safepass2").val()==$("#safepass1").val()){
            $(".refpass2").css('display','none');
            $(".retpass2").css('display','block');
        }
        else{
            $(".refpass2").css('display','none');
            $(".retpass2").css('display','none');
        }
	});
    //判断账户
    $("#safeacc").blur(function(event) {
      if($("#safeacc").val()!=$("#useracc").html()){
        $.ajax({
            type:'post',
            url:'../index/checkUser',
            data:{
                acc:$("#safeacc").val(),
            },
            success:function(data){               
                if(data==0){
                    $(".retacc").css('display', 'none');
                    $(".refacc").css('display', 'block');
                }else{
                    $(".retacc").css('display', 'block');
                    $(".refacc").css('display', 'none');
                }
            },
            error:function(){
            }
        });
      }
    });
    //判断原密码
    
    $("#safepass3").blur(function(event) {
        if($("#safepass3").val()!=''){
             $.ajax({
                 type:'post',
                 url:'checkPassword',
                 data:{mypsw:$("#safepass3").val()},
                 success:function(data){
                     if(data==0){
                          $(".refpass3").css('display', 'block');
                          $(".retpass3").css('display', 'none');
                     }else{
                          $(".retpass3").css('display', 'block');
                          $(".refpass3").css('display', 'none');         
                     }
                 },
                 error:function(){
                 }
             });
        }
    }); 
   

    var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
	$("#upbasci").click(function(event) {
		if(!confirm("确定修改？")){
		     $("#basicimg,.tablep1").css('display','block');
		     $(".tableinput1,#upbasci").css('display','none');
             $("#basicqq").val($("#userqq").html());
             $("#basicmail").val($("#usermail").html());
		}else if($("#basicqq").val()==$("#userqq").html()&&$("#basicmail").val()==$("#usermail").html()){
             $("#basicimg,.tablep1").css('display','block');
             $(".tableinput1,#upbasci").css('display','none');
        }else if($("#basicqq").val()=='' || $("#basicmail").val()==''){
            alert("请将资料填写完整！");
            $("#basicqq").val($("#userqq").html());
            $("#basicmail").val($("#usermail").html());
        }else if(!reg.test($("#basicmail").val())){
             alert("邮箱格式错误");
        }else{
             $.ajax({
             	type:'post',
             	url:'update_basic',
             	data:{
             		  qq:$("#basicqq").val(),
             		  mail:$("#basicmail").val(),
             	},
             	success:function(data){
                    console.log(data);
                    alert("修改成功！");
                    $("#userqq").html($("#basicqq").val());
                    $("#usermail").html($("#basicmail").val());
                    
                    $("#basicimg,.tablep1").css('display','block');
                    $(".tableinput1,#upbasci").css('display','none');
             	},
             	error:function(jqXHR){

             	}
             });
		}
	});

    $("#upsafeset").click(function(event) {
        if(!confirm("确定修改？")){
           $("#safesetimg,.tablep2").css('display','block');
           $(".tableinput2,#upsafeset,.tabletdpass,.refalse,.reture").css('display','none');
           $("#safeacc").val($("#useracc").html());
        }else if($("#safeacc").val()==$("#useracc").html() && $("#safepass1").val()=='' && $("#safepass2").val()=='' &&$("#safepass3").val()==''){
		    $("#safesetimg,.tablep2").css('display','block');
		    $(".tableinput2,#upsafeset,.tabletdpass,.refalse,.reture").css('display','none');
            $("#safeacc").val($("#useracc").html());
    	}else if($(".refalse").is(':visible')){
            alert("请将资料填写完整！");
    	}else if($("#safeacc").val()!=$("#useracc").html() && $("#safepass2").val()!=$("#safepass1").val() && $("#safepass3").val()!=''){
            alert("请将资料填写完整！");
        }
        else if($("#safepass3").val()!='' && $("#safepass1").val()==''){
           alert("请设置新密码");
        }else if($("#safepass1").val()!=''&& $("#safepass3").val()==''){
            alert("请输入原密码");
        }
        else{
    		$.ajax({
    			type:'post',
    			url:'update_safe',
    			data:{
                    acc:$("#safeacc").val(),
    				psw:$("#safepass1").val(),
    			},
    			success:function(data){
                    alert("修改成功！");
                    $("#useracc").html($("#safeacc").val());
                    $("#safepass3,#safepass2,#safepass1").val('');
		            $("#safesetimg,.tablep2").css('display','block');
		            $(".tableinput2,#upsafeset,.tabletdpass").css('display','none');
		            $(".reture").css('display', 'none');
    			},
    			error:function(jqXHR){
    			}
    		});
    	}
    });

});