$(function(){
	$.ajax({
		type:'post',
		url:'../index/checkHasLogin',
		success:function(data){
			if(data==0){
				alert("请先登录");
				window.location.href="../../";
			}else{
                $.ajax({
                	type:'post',
                	url:'getUsername',
                	data:{id:data},
                	success:function(data){
                         $(".topbg p").html(data.username);//用户名字
                         $(".topbg a").css('display','block');
                	},
                	error:function(){
                		
                	}
                })
			}
		},
		error:function(){
		},
	});
});