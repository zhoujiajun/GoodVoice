$(function(){
	$("#adlogin").click(function(event) {
		$.ajax({
			type:'post',
			url:'doAdLogin',
			data:{
				acc:$("#adacc").val(),
				psw:$("#adpsw").val(),
			},
			success:function(data){
                if(data==0){
                	alert("账号或密码错误");
                }else{
                	alert("登录成功!");
                	window.location.href="aduser.html?html=11";
                }
			},
			error:function(jqXHR){

			}
		});
	});

	$("#tclogin").click(function(event) {
		$.ajax({
			type:'post',
			url:"doLogin",
			data:{
				acc:$("#tcacc").val(),
				psw:$("#tcpsw").val(),
			},
			success:function(data){
                if(data==0){
                	alert("账号或密码错误");
                }else{
                	alert("登录成功!");
                	window.location.href="tcclass.html?lan=21";
                }
            },
            error:function(jqXHR){
            	
            }
		});
	});
})