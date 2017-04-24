$(function(){
	$(".addnav-navbox ul li").click(function(event) {
		if($(this).find('input').is(":hidden")){
			$(this).find('input').show();
			$(this).find('p').hide();
			$(this).css('background-color','#008AC9')
		}
	});
	$("#adnav-up").click(function(event) {
		if(confirm("确定修改？")){
			if($("#exe").val()==$("#exe").prev().html()&&$("#pccenter").val()==$("#pccenter").prev().html()&&$("#index").val()==$("#index").prev().html()&&$("#classsty").val()==$("#classsty").prev().html()&&$("#tcintro").val()==$("#tcintro").prev().html()&&$("#buyclass").val()==$("#buyclass").prev().html()){
				alert("先修改吧");
			}else if($("#exe").val()==''||$("#pccenter").val()==''||$("#index").val()==''||$("#classsty").val()==''||$("#tcintro").val()==''||$("#buyclass")==''){
				
				alert("不能为空喔");
			}else{
				$.ajax({
					type:'POST',
					url:'do_updateTags',
					data:{
						index:$("#index").val(),//首页
						classsty:$("#classsty").val(),//课程体系
						tcintro:$("#tcintro").val(),//老师介绍
						buyclass:$("#buyclass").val(),//课程购买
						pccenter:$("#pccenter").val(),//个人中心
						exe:$("#exe").val(),//练习中心
					},
					success:function(data){
                        if(data==0){
                           alert("修改失败：请重试");
                        }else{
                        	alert("修改成功！");
                        	window.location.reload();
                        }

					},
					error:function(){

					}
				})
			}
		}
	});
})