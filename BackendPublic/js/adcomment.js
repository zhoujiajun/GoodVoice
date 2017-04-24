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

	                     $.ajax({
		                     type:'post',
		                     url:'opinion',
		                     success:function(data){
			                     $.each(data,function(index,data){
				                     $(".condiv").append(
                                                         "<table class='contable'>"+
                                                              "<tr>"+
                                                                  " <td width='155px'>"+data.username+"</td>"+
                                                                   "<td width='170px'>"+data.time+"</td>"+
                                                                   "<td width='590px'><div class='td-over'>"+data.content+"</div></td>"+
                                                                   "<td><input type='button' value='查看'' class='com-see' name='"+data.id+"'></td>"+
                                                              "</tr>"+
                                                         "</table>"
					                     );
			                     });
	                             $(".com-see").click(function(){
		                             window.location.href='adcomment_more.html?id='+$(this).attr('name');
	                             })
		                     },
		                     error:function(jqXHR){
		                     }
	                     });

	                     
		            },
				})
			}
		},
		error:function(jqXHR){
		}
	})


    $("#common_empty").click(function(){
       if(confirm("清空后不可恢复：确定清空？")){
       	  $.ajax({
       	  	type:'post',
       	  	url:'deleteAllOpinion',
       	  	success:function(data){
       	  		if(data==0){
       	  			alert("操作失败：请重试");
       	  		}else{
       	  			alert("操作成功");
       	  			$(".condiv").html('');
       	  		}
       	  	}
       	  })
       }
    });

})