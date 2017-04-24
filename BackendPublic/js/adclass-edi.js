$(function(){
	$.ajax({
		type:'post',
		url:'checkLogin',
		success:function(data){
			if(data==0){
				alert("请先登录");
				// window.location.href="adminlogin.html";
			}else{
				/*--------获取管理员名字---------*/
				$.ajax({
					type:'post',
					url:'getName',
					data:{id:data},
					success:function(data){
                          $(".ctop span").html("管理员："+data.acc);
			   	 		  $(".topbg a").css('display','block');
			   	 		  $(".topbg p").css('display','none');
					},
				});
				/*--------获取老师数据---------*/
				$.ajax({
			   	 		 type:'post',
		                 url:'getTeachers',
			   	 		 success:function(data){
                               $("#edi-tcname").html('');
               	               $("#edi-tcname").append("<option value='请选择'>请选择</option>");
               	               $.each(data, function(index, data) {
               	 	               $("#edi-tcname").append("<option value='"+data.t_name+"'>"+data.t_name+"</option>");
               	               });
			   	 		 },
			   	 		 error:function(){
			   	 		 },
				});
				/*----------获取课程数据----------*/
				$.ajax({
					type:'post',
					url:'getOneClass',
					data:{c_id:getQueryString('cid')},
					success:function(data){
						console.log(data);
						$("#edi-lang").val(data.c_language);//语种
						$("#edi-rank").val(data.level);//级别
						$("#edi-clnum").val(data.c_credit);//课程数量
						$("#edi-clname").val(data.c_title)//课程名称
						$("#edi-tcname").val(data.t_name);//老师名字
						$("#edi-pri").val(data.cost);//价格
						$("#edi-des").val(data.c_description);//课程简介
					},
					error:function(){

					},
				})
			}
		},
	})
})
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 
/*-------------*/
$(function(){
	$(".add-input2").blur(function(event) {
		var reg=/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;
		if(!reg.test($(".add-input2").val())){
			alert("只能输入正数喔");
			$(this).val(0);
		}
	});
	$("#add-reduce").click(function(event) {
		if($(".add-input2").val()=='0'){
			alert('售价不能低于0喔');
		}else{
            var i=$(".add-input2").val();
            i--;
            $(".add-input2").val(i);
		}
	});
	$("#add-up").click(function(event) {
		var i=$(".add-input2").val();
		i++;
		$(".add-input2").val(i)
	});

	$("#edi-up").click(function(event) {
		if(confirm("确定修改？")){
			if($("#edi-lang").val()=='请选择' || $("#edi-rank").val()=='请选择' ||$("#edi-clnum").val()=='请选择' || $("#edi-pri").val()=='0' || $("#edi-des").val()=='' || $("#edi-clname").val()=='' || $("#edi-tcname").val()=='请选择'){
                alert("资料未填写完整");
			}else{
				$.ajax({
               type:'post',
               url:'updateClass',
               data:{
               	  c_id:getQueryString('cid'),//课程id
               	  //c_id:9,  //测试数据，改完可删
               	  lang:$("#edi-lang").val(),//语种
				  level:$("#edi-rank").val(),//级别
				  c_num:$("#edi-clnum").val(),//课程数量
				  c_name:$("#edi-clname").val(),//课程名称
				  t_name:$("#edi-tcname").val(),//老师名字
				  c_pri:$("#edi-pri").val(),//价格
				  c_des:$("#edi-des").val(),//课程简介
               },
               success:function(data){
               	 if(data==0){
               	 	alert("修改失败：请重试");
               	 }else{
               	 	alert("修改成功！");
               	 	window.location.href=document.referrer;
               	 }
               },
			});
			}
		}else{
			return false;
		}
	});
})