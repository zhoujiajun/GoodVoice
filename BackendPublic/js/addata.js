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
				async:false,
				data:{id:data},
				success:function(data){
                         $(".ctop span").html("管理员："+data.acc);
			   	 		 $(".topbg a").css('display','block');
               $(".topbg p").css('display','none');

				},
			});
            alldata();
		    /*--------获取课程编号--------*/
		    $.ajax({
				type:'post',
				url:'getAllClasses',
				async:false,
				success:function(data){
          $.each(data, function(index, data) {
					   $("#data-cid").append("<option value='"+data.c_id+"'>"+data.c_id+"</option>");
          });
				},
		    })
      }
  	},
  });

});
$(function(){
	$("#data-up").click(function(event) {
		if($("#data-cid").val()=='请选择'&&$("#data-lang").val()=='请选择'){
			alldata();
			alert("已显示所有数据");
      
		}else if($("#data-cid").val()=='请选择'&&$("#data-lang").val()!='请选择'){
            langdata();
		}else if($("#data-cid").val()!='请选择'&&$("#data-lang").val()=='请选择'){
			ciddata();
		}else{
			bothdata();
		}
	});
})

/*-------获取交易所有数据-------*/
function alldata(){
    $.ajax({
				type:'post',
				url:'getTakes',
				data:{html:13},
				async:false,
				success:function(data){
          console.log(data);
                    addbox(data);
				},
				error:function(){

				}
			});
}
/*-------只选择了语种--------*/
function langdata(){
  
	$.ajax({
		type:'post',
        url:'getTakes',
        data:{
        	lang:$("#data-lang").val(),
        },
        success:function(data){
        	if(data==0){
              alert("该语种暂时还没有人购买喔");
        	}else{
        		addbox(data);
        	}
        },
	})
}
/*----------只选择了课程编号-----*/
function ciddata(){
	$.ajax({
		type:'post',
        url:'getTakes',
        data:{
        	c_id:$("#data-cid").val(),
        },
        success:function(data){
        	addbox(data);
        },
	})
}
/*--------两个都搜索成功--------*/
function bothdata(){
	$.ajax({
		type:'post',
        url:'getTakes',
        data:{
        	c_id:$("#data-cid").val(),
        	lang:$("#data-lang").val(),
        },
        success:function(data){
        	addbox(data);
        },
	})
}
/*--------------*/
function addbox(data){
             $(".data-div").html('');
             $.each(data, function(index, data) {
               $(".data-div").append(
                           " <table class='contable'>"+
                                   "<tr>"+
                                       "<td width='170'>"+data.username+"</td>"+
                                       "<td width='170'>"+data.c_language+"</td>"+
                                       "<td width='170'>"+data.c_id+"</td>"+
                                       "<td width='230'>"+data.cost+"</td>"+
                                       "<td>"+data.buytime+"</td>"+
                                   "</tr>"+
                            "</table>"
                );
             });
}