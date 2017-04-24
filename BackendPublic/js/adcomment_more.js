$(function(){
	$.ajax({
		type:'post',
		url:'checkLogin',
		success:function(data){
			if(data==0){
				alert("请先登录");
				window.location.href="adminlogin.html";
			}else{
				$.ajax({
					type:'post',
		            url:'getName',
		            data:{id:data},
		            success:function(data){
		            	$(".ctop span").html("管理员："+data.acc);
			   	 		$(".topbg a").css('display','block');
                        $(".topbg p").css('display','none');
                        //获取信息
                        $.ajax({
                        	type:'post',
                        	url:'getSingleOpinion',
                        	data:{id:getQueryString('id')},
                        	success:function(data){
                        		$("#commore_content").html(data.content);
                        		$("#com_more_name").html(data.username);
                        		$("#com_more_time").html(data.time);
                        	}
                        })
		            },
				})
			}
		},
		error:function(jqXHR){
		}
	});

$("#com_more_dele").click(function(data){
	if(confirm("删除后不可恢复：确定删除？")){
		$.ajax({
			type:'post',
			url:'deleteOneOpinion',
			data:{id:getQueryString('id')},
			success:function(data){
				if(data==0){
					alert("删除失败：请重试");
				}else{
					alert("删除成功");
					window.location.href='adcomment.html'
				}
			}
		})
	}
})

$("#com_more_back").click(function(data){
	window.location.href='adcomment.html'
})
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 


})