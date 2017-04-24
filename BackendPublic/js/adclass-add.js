$(function(){
	$.ajax({
		type:'post',
		url:'checkLogin',
		success:function(data){
			if(data==0){
				alert("请先登录");
				// window.location.href="adminlogin.html";
			}else{
				$.ajax({
					type:'post',
		            url:'getName',
		            data:{id:data},
		            success:function(data){
		            	
		            	    $(".ctop span").html("管理员："+data.acc);
			   	 		    $(".topbg a").css('display','block');
			   	 		    $(".topbg p").css('display','none');
			   	 		    /*----------获取老师下拉框数据----------------*/
			   	 		    $.ajax({
			   	 		    	type:'post',
		                        url:'getTeachers',
			   	 		    	success:function(data){
			   	 		    		console.log(data);
                                   $("#tcname").html('');
               	                   $("#tcname").append("<option value='请选择'>请选择</option>");
               	                   $.each(data, function(index, data) {
               	 	                   $("#tcname").append("<option value='"+data.t_name+"'>"+data.t_name+"</option>");
               	                   });
			   	 		    	},
			   	 		    	error:function(){
			   	 		    	},
			   	 		    })
		            }
				})
			}
		},
		error:function(jqXHR){
			
		}
	})
});
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

	$("#classname").focus(function(event) {
		if($("#classname").val()==' 输入该课程名称'){
            $("#classname").val('');
		}
	});
	$("#classname").blur(function(event) {
		if($("#classname").val()==''){
			$("#classname").val(' 输入该课程名称');
		}
	});
    
	$("#up-classform").click(function(event) {
		if(confirm("确定添加？")){
            if($(".add-input3").val()=='' || $("#lang").val()=='请选择' ||$("#tcname").val()=='请选择' || $("#rank").val()=='请选择' || $("#classnum").val()=='请选择' || $("#classname").val()=='输入该课程名称' || $(".add-input2").val()==0){
                alert("资料未填写完整");
            }else{
            	$.ajax({
                   type:'POST',
                   url:'addClasses',
                   data:{
                   	   des:$(".add-input3").val(),
                   	   lang:$("#lang").val(),
                   	   level:$("#rank").val(),
                   	   classnum:$("#classnum").val(),
                   	   classname:$("#classname").val(),
                   	   tcname:$("#tcname").val(),
                   	   price:$(".add-input2").val(),
                   },
                   success:function(data){
                   	 if(data==0){
                       alert("添加失败请重试");
                   	}else{
                   		if(confirm("添加成功!是否继续添加")){
                   			window.location.reload();
                   		}else{
                   			window.location.href=document.referrer;
                   		}
                   	}
                   },
            	});
            }
		}
	});
})