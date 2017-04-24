$(function(){
    $(".centerbg-1,regibg-1,fgpwbg-1").css('width', $(document).width());
    $(".topbg a").click(function(event) {
        console.log(1);
    	if(confirm("确定退出登录？")){
    		$.ajax({
    			type:'post',
    			url:'../index/logout',
    			success:function(data){
    				if(data==0){
                       alert("退出登录失败");
    				}else{
    					alert("成功退出登录");
    					window.location.href="../../";
    				}
    			},
    			error:function(jqXHR){
    				
    			}
    		});
    	}
    });
});