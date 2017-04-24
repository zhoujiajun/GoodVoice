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
		            }
				})
			}
		},
		error:function(jqXHR){
		}
	})

switch(getQueryString('html')){
	case "11":usersy();break;
  case "12":teachersy();break;
  case "14":classsy();break;
  case "16":lansy();break;
}


/*--全选--*/
$("#allcheck").click(function(event) {
	if($("#allcheck").is(':checked')){
		$(".check").attr('checked','checked')}
	else{
		$(".check").attr('checked',false);
	}
});



})
/*-----------用户信息------*/
function usersy(){
  // var jsondata='[{"name":"12","qq":"322143","mail":"121@qq.com"},{"name":"321","qq":"312312","mail":"23123@qq.com"}]';
  // var jsonobj=$.parseJSON(jsondata);
	$.ajax({
		type:'post',
		url:'getData',
		data:{html:11},
		success:function(data){
      console.log(data);
      $(".condiv").html('');
           $.each(data,function(index, data) {          	   
			   $(".condiv").append(
                     "<table class='contable' id='"+data.id+"'>"+
                            "<tr>"+
                               "<td style='text-align: left;width: 40px'><input type='checkbox' class='check' name='checkname'><p hidden='hidden'>"+data.id+"</p></td>"+
                                "<td style='width: 100px'>"+data.username+"</td>"+
                                "<td style='width: 130px'>"+data.qq+"</td>"+
                                "<td style='width: 210px'>"+data.email+"</td>"+
                                "<td style='width: 200px'>"+data.register_time+"</td>"+
                                "<td style='width: 64px'><input type='button' value='删除' class='delete' name='"+data.id+"'></td>"+
                            "</tr>"+
                     "</table>"
				)
           });
      delefun();

		},
		error:function(jqXHR){
			// $(".condiv").html('');
   //         $.each(jsonobj,function(index, data) {
			//    $(".condiv").append(
   //                   "<table class='contable' id='ta"+index+"'>"+
   //                          "<tr>"+
   //                              "<td style='text-align: left;width: 40px'><input type='checkbox' class='check' name='checkname'><p hidden='hidden'>ta"+index+"</p></td>"+
   //                              "<td style='width: 100px'>"+data.name+"</td>"+
   //                              "<td style='width: 130px'>"+data.qq+"</td>"+
   //                              "<td style='width: 210px'>"+data.mail+"</td>"+
   //                              "<td style='width: 200px'>"+"data.time"+"</td>"+
   //                              "<td style='width: 64px'><input type='button' value='删除' class='delete' name='ta"+index+"'></td>"+
   //                          "</tr>"+
   //                   "</table>"
			// 	)
   //         });
		},	
	})
}
/*-----------教师管理------*/
function teachersy(){
  // var jsondata='[{"id":"a1", "name":"12","qq":"322143","mail":"121@qq.com"},{"id":"a2","name":"321","qq":"312312","mail":"23123@qq.com"}]';
  // var jsonobj=$.parseJSON(jsondata);
  $.ajax({
		type:'post',
		url:'getData',
		data:{html:12},
		success:function(data){
           $(".condiv").html('');
           $.each(data, function(index, data) {
                $(".condiv").append(
                            "<table class='contable' id='"+data.t_id+"'>"+
                                   "<tr>"+
                                       "<td style='text-align: left;width: 40px'><input type='checkbox' class='check' name='checkname'><p hidden='hidden'>"+data.t_id+"</p></td>"+
                                       "<td style='width: 120px'>"+data.t_name+"</td>"+
                                       "<td style='width: 120px'><a href='"+data.src+"'>"+data.t_language+"</a></td>"+
                                       "<td style='width: 170px'>"+data.t_qq+"</td>"+
                                       "<td style='width: 210px'>"+data.email+"</td>"+
                                       "<td style='width: 200px'>"+data.t_rtime+"</td>"+
                                       "<td style='width: 64px'><input type='button' value='编辑' class='tc-edit edit' name='"+data.t_id+"'></td>"+
                                   "</tr>"+
                            "</table>"
           	     );
           });
          delefun();
          adtcedi();
		},
		error:function(jqXHR){
			 // $(".condiv").html('');
    //        $.each(jsonobj, function(index, data) {
    //             $(".condiv").append(
    //                         "<table class='contable' id='"+data.id+"'>"+
    //                                "<tr>"+
    //                                    "<td style='text-align: left;width: 40px'><input type='checkbox' class='check'><p hidden='hidden'>"+data.id+"</p></td>"+
    //                                    "<td style='width: 120px'>"+data.name+"</td>"+
    //                                    "<td style='width: 120px'><a href='"+data.src+"'>"+data.lang+"</a></td>"+
    //                                    "<td style='width: 170px'>"+data.qq+"</td>"+
    //                                    "<td style='width: 210px'>"+data.mail+"</td>"+
    //                                    "<td style='width: 200px'>"+data.time+"</td>"+
    //                                    "<td style='width: 64px'><input type='button' value='删除' class='delete' name='"+data.id+"'></td>"+
    //                                "</tr>"+
    //                         "</table>"
    //        	     );
    //        });
		},
  })
}

/*-----课程管理-------*/
function classsy(){
	$.ajax({
		type:'post',
		url:'getData',
		data:{html:14},
		success:function(data){
		   $(".condiv").html('');
          $.each(data, function(index, data) {
           $(".condiv").append(
              "<table class='contable' id='"+data.c_id+"'>"+
                     "<tr>"+
                         "<td style='width: 35px'><input type='checkbox' class='check' name='checkname'><p hidden='hidden'>"+data.c_id+"</p></td>"+
                         "<td style='width: 170px'>"+data.c_id+"</td>"+
                         "<td style='width: 110px'>"+data.c_language+"</td>"+
                         "<td style='width: 110px'>"+data.level+"</td>"+
                         "<td style='width: 110px'>"+data.t_name+"</td>"+
                         "<td style='width: 220px'>"+data.c_title+"</td>"+
                         "<td style='width: 100px'>"+data.cost+"</td>"+
                         "<td style='width: 100px'>"+data.sells+"</td>"+
                         "<td><input type='button' value='编辑' class='edit c_edit' name='"+data.c_id+"'></td>"+
                     "</tr>"+
              "</table>"
           	);
          });
       delefun();
       c_editgo();
		},
	});
}
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 
/*-----------------教师管理-编辑 跳转到编辑页面----------------*/
function adtcedi(){
    $(".tc-edit").click(function(event) {
     if(confirm("确定编辑？")){
        var id=$(this).attr('name');
        window.location.href="adteacher_editc?id="+id;
     }
  });

}

$(function(){

  $("#addclassbu").click(function(event) {
     window.location.href="adclass-add.html";
  });
  $("#molang").click(function(event) {
    window.location.href="addlang.html";
  });
  $("#langback").click(function(event) {
    window.location.href=document.referrer;
  }); 
})
/*---------------语种管理--------------*/
function lansy(){
    $.ajax({
      type:'POST',
      url:'getLanguage',
      data:{html:16,},
      success:function(data){
          $(".condiv").html('');
          $.each(data, function(index, data) {
             $(".condiv").append(
                                 "<table class='contable' id='"+data.l_id+"'>"+
                                          "<tr>"+
                                              "<td style='width: 100px'>"+data.l_name+"</td>"+
                                              "<td style='width: 80px'>"+data.l_teacher+"</td>"+
                                              "<td style='width: 130px'>"+data.primary+"</td>"+
                                              "<td style='width: 130px'>"+data.secondary+"</td>"+
                                              "<td style='width: 130px'>"+data.advanced+"</td>"+
                                              "<td><input type='button' value='删除' class='delete' name='"+data.l_id+"' style='float: right;'></td>"+
                                          "</tr>"+
                                   "</table>"
              )
          });
          delefun();
      },
      error:function(){
        
      }
    })
}




function delefun(){
/*--删除单个-*/
$(".delete").click(function(event) {
  if(confirm("确定删除？")){
    var did=$(this).attr('name');
       $.ajax({
      type:'post',
      url:'deleteUser',
      data:{id:$(this).attr('name'),
            html:getQueryString('html'),},
      success:function(data){
             if(data==0){
              alert("删除失败请重试");
             }else{
              alert("删除成功！");
                $("#"+did).remove();
             }
      },
       });
  }
});
/*--删除多个--*/
$("#deleteall").click(function(event) {
  if(confirm("确定删除？")){
    var deleteid=new Array()
    var i=0;
       $("input[name=checkname]").each(function() {
             if ($(this).is(':checked')) {
                   deleteid[i]=$(this).next().html();
                   i++;
            }
            });
       if(i==0){
            alert("未选中删除对象!");
       }else{
          $.ajax({
         type:'post',
         url:'dodeletes',
         data:{
          deleteid:deleteid,
          html:getQueryString('html'),
         },
         success:function(data){
                  if(data==0){
                   alert("删除失败请重试");
                  }else{
                   alert("删除成功！");
                     $("input[name=checkname]").each(function() {
                       if($(this).is(':checked')){
                        var id=$(this).next().html();
                           $("#"+id).remove();
                       }
                     });
                  }
         },
         error:function(jqXHR){
         }
          })
       }

  }
});
}
/*-----------添加语种----------------*/
$(function(){
  $("#uplangbu").click(function(event) {
      if(confirm("确定添加？")){
         if($("#addlang-text").val()==''){
             alert("不能为空喔");
         }else{
          $.ajax({
               url: 'xxx.php',
               type: 'POST',
               data: {lang: $("#addlang-text").val(),},
               success:function(data){
                    if(data==0){
                      alert("添加失败:请重试");
                    }else{
                      if(confirm("添加成功！是否继续添加?")){
                         window.location.reload();
                      }else{
                         window.location.href=document.referrer;
                      }
                    }
               },
               error:function(){

               },
             });
         }
      }
  });
})

/*---------------管理员密码修改---------------*/
$(function(){
  /*---------重置---------*/
  $("#cpsw-reset").click(function(event) {
    $(".cpsw-input").val('');
  });
  /*------------确认--------------*/
  $("#cpsw-up").click(function(event) {
     if(confirm("确定修改密码？")){
       if($("#cpsw-pass1").val()==''||$("#cpsw-pass2").val()==''||$("#cpsw-pass3").val()==''){
        alert("请输入完整信息");
       }else if($("#cpsw-pass2").val()!=$("#cpsw-pass3").val()){
        alert("新密码不一致");
       }else{
           $.ajax({
            type:'POST',
            url:'updatePsw',
            data:{opass:$("#cpsw-pass1").val(),
                  npass:$("#cpsw-pass2").val(),
                },
            success:function(data){
                  if(data==0){
                    alert("修改失败：密码错误");
                  }else{
                    alert("修改成功请重新登录");
                    window.location.href="adminlogin.html";
                  }
            },
            error:function(){

            }
           })
       }
     }
  });
})
/*-----------------教师添加页面------------------*/
$(function(){

   /*---------跳转到添加教师--------------*/
   $("#addtc").click(function(event) {
    window.location.href="adteacher-addtc.html";
   });
   /*----------------添加教师返回----------------*/
   $("#addtc-back").click(function(event) {
     window.location.href=document.referrer;
   });
   /*---------上传----------*/
   $("#addtc-up").click(function(event) {
        $("#addtc-form").ajaxSubmit(options);
   });
   /*-----------显示照片---------*/
   $("#addtc-pic").change(function(event) {
       docObj = document.getElementById("addtc-pic");
       $(".addtc-p").hide();
       $("#addtic-img").show();
       var imgObjPreview=document.getElementById("addtic-img");
       imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
   });
   var options = {  
        beforeSubmit:  showRequest,  //提交前处理 
        success:       showResponse,  //处理完成 
        resetForm: true,
        // dataType:  'json'  
    };
});

function showRequest(formData, jqForm, options) {
    if(!confirm("确定添加教师？")){
           return false;
    }else if($("#addtc-name").val()==''||$("#addtc-qq").val()==''||$("#addtc-mail").val()==''||$("#addtc-lang").val()=='请选择语种'||$("#addtc-desta").val()==''){
         alert("资料未填写完整");
         return false;
    }else if($("#addtc-pic").val()==''){
         alert("请上传照片");
         return false;

    }
     
    return true;  

} 
function showResponse(responseText, statusText)  {  
    alert("添加成功！")
    if(confirm("是否继续添加？")){
       window.location.reload();
    }else{
      window.location.href=document.referrer;
    }
}  
function c_editgo(){
    $(".c_edit").click(function(event) {
       window.location.href='adclass-edi?cid='+$(this).attr('name');
    });
}