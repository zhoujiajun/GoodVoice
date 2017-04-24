$(function(){
	$(".topbg a").click(function(event) {
		if(confirm("确定退出登录？")){
			$.ajax({
				type:'POST',
				url:'logout',
				success:function(data){
                   alert("成功退出登录");
                   window.location.href="teacherlogin.html";
				},
				error:function(){

				}
			})
		}
	});
})