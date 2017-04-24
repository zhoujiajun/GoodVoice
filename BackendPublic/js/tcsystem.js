$(function(){
	$.ajax({
		type:'post',
		url:'checkLogin',
		success:function(data){
			if(data==0){
				alert("请先登录");
				// window.location.href="teacherlogin.html";
			}else{
				$.ajax({
					type:'post',
		            url:'getTeacherInfo',
		            data:{id:data,},
		            success:function(data){
		            	$(".ctop span").html("教师："+data.acc)
			   	 		    $(".topbg a").css('display','block');
                  $(".topbg p").css('display','none');
			   	 		    $("#qqval").val(data.qq);
			   	 		    $("#mailval").val(data.mail);
			   	 		    $("#qqp").html(data.qq);
			   	 		    $("#mail").html(data.mail);
		            }
				})
			}
		},
		error:function(jqXHR){
			   	 		// $("#qqval").val("data.qq");
			   	 		// $("#mailval").val("data.mail");
			   	 		// $("#qqp").html("data.qq");
			   	 		// $("#mailp").html("data.mail");
		}
	})

	switch(getQueryString('lan')){
        case "21":ficlass();break;
        case "22":unclass();break;
        default:console.log('success');break;
	};
})
/*----------未完成课程----------------*/
function unclass(){
  // var jsondata='[{"c_id":"1","id":"11","mail":"121@qq.com"},{"c_id":"2","id":"12","mail":"23123@qq.com"}]';
  // var jsonobj=$.parseJSON(jsondata);
	$.ajax({
		type:'post',
		 url:'getUnclass',
    //url:'xx.php',
		data:{html:22},
		success:function(data){
      console.log(data);
            $(".condiv").html('');
            $.each(data,function(index, data) {
              var rest = data.c_credit-data.finished;
            	$(".condiv").append(
                
                // ficlassnum=已完成的课程数 classnum=总课程数 id=这个模块的id（点击保存要post的）
                                    "<table class='contable' style='margin-left: 30px;'>"+
                                           "<tr>"+
                                               "<td style='width: 110px'>"+data.c_id+"</td>"+
                                               "<td style='width: 130px'>"+data.c_title+"</td>"+
                                               "<td style='width: 100px'>"+data.c_language+"</td>"+
                                               "<td style='width: 100px'>"+data.level+"</td>"+
                                               "<td style='width: 160px'>"+data.username+"</td>"+
                                               "<td style='width: 180px'><span class='f"+index+"'>"+data.finished+"</span>/"+data.c_credit+"</td>"+
                                               "<td style='width: 180px;text-align: center;'>"+
                                                   "<img src='../../../BackendPublic/images/min.png' class='addcss imgreduce'>"+
                                                   "<p class='addcss classp' id='a"+index+"' name='"+rest+"'>"+data.finished+"</p>"+
                                                   "<img src='../../../BackendPublic/images/plus.png' class='addcss  imgup'>"+
                                               "</td>"+
                                               "<td style='width: 60px'>"+
                                                   "<p hidden='hidden'>f"+index+"</p>"+
                                                   "<p hidden='hidden'>a"+index+"</p>"+
                                                   "<input type='button' value='保存'  name='"+data.c_id+"' class='save'>"+
                                                   "<p hidden='hidden'>"+data.id+"</p>"+
                                               "</td>"+
                                           "</tr>"+
                                    "</table>"
            		);
            });
            clickup();
		},
		error:function(jqXHR){
			$(".condiv").html('');
  var jsondata='[{"c_id":"1","id":"11","c_title":"hhh","c_language":"ri","finished":"1","c_credit":"6"},{"c_id":"2","id":"12","c_title":"lll","c_language":"hang","finished":"3","c_credit":"5"}]';
  var jsonobj=$.parseJSON(jsondata);
      $.each(jsonobj,function(index, data) {
              var rest=data.c_credit-data.finished;
            	$(".condiv").append(
                                    "<table class='contable' style='margin-left: 30px;'>"+
                                           "<tr>"+
                                               "<td style='width: 110px'>"+data.c_id+"</td>"+
                                               "<td style='width: 130px'>"+data.c_title+"</td>"+
                                               "<td style='width: 100px'>"+data.c_language+"</td>"+
                                               "<td style='width: 100px'>"+"data.level"+"</td>"+
                                               "<td style='width: 160px'>"+"data.username"+"</td>"+
                                               "<td style='width: 180px'><span class='f"+index+"'>"+data.finished+"</span>/"+data.c_credit+"</td>"+
                                               "<td style='width: 180px;text-align: center;'>"+
                                                   "<img src='../../../BackendPublic/images/min.png' class='addcss imgreduce'>"+
                                                   "<p class='addcss classp' id='a"+index+"' name='"+rest+"'>"+data.finished+"</p>"+
                                                   "<img src='../../../BackendPublic/images/plus.png' class='addcss  imgup'>"+
                                               "</td>"+
                                               "<td style='width: 60px'>"+
                                                   "<p hidden='hidden'>f"+index+"</p>"+
                                                   "<p hidden='hidden'>a"+index+"</p>"+
                                                   "<input type='button' value='保存'  name='"+data.c_id+"' class='save'>"+
                                                   "<p hidden='hidden'>"+data.id+"</p>"+
                                               "</td>"+
                                           "</tr>"+
                                    "</table>"
            		);
            });

              clickup();
		}
	});
}
/*----------完成课程----------------*/
function ficlass(){
  // var jsondata='[{"name":"12","qq":"322143","mail":"121@qq.com"},{"name":"321","qq":"312312","mail":"23123@qq.com"}]';
  // var jsonobj=$.parseJSON(jsondata);
	$.ajax({
		type:'post',
		url:'getClass',
		data:{html:21},
		success:function(data){

          $(".condiv").html('');
          $.each(data,function(index, data) {
          	$(".condiv").append(
                                   "<table class='contable' style='margin-left: 30px;'>"+
                                           "<tr>"+
                                               "<td style='width: 110px'>"+data.c_id+"</td>"+
                                               "<td style='width: 130px'>"+data.c_title+"</td>"+
                                               "<td style='width: 90px'>"+data.c_language+"</td>"+
                                               "<td style='width: 90px'>"+data.level+"</td>"+
                                               "<td style='width: 150px'>"+data.username+"</td>"+
                                               "<td style='width: 210px'>"+data.buytime+"</td>"+
                                               "<td style='width: 190px'>"+data.finishtime+"</td>"+
                                           "</tr>"+
                                    "</table>"
          		);
          });
		},
		error:function(jqXHR){
          // $(".condiv").html('');
          // $.each(jsonobj,function(index, data) {
          // 	$(".condiv").append(
          //                          "<table class='contable' style='margin-left: 30px;'>"+
          //                                  "<tr>"+
          //                                      "<td style='width: 110px'>"+data.qq+"</td>"+
          //                                      "<td style='width: 130px'>"+data.name+"</td>"+
          //                                      "<td style='width: 100px'>"+data.mail+"</td>"+
          //                                      "<td style='width: 100px'>"+"data.rank"+"</td>"+
          //                                      "<td style='width: 160px'>"+"data.stname"+"</td>"+
          //                                      "<td style='width: 190px'>"+"data.time"+"</td>"+
          //                                      "<td style='width: 110px'>"+"data.timeend"+"</td>"+
          //                                  "</tr>"+
          //                           "</table>"
          // 		);
          // });    
		},
	});
}
/*----------------修改账户--------------------*/
$(function(){
  clickup();
   $("#qqval").focus(function(event) {
       if($(this).val()==$("#qqp").html()){
       	  $(this).val('');
       }
   });
   $("#qqval").blur(function(event) {
   	   if($(this).val()==''){
   	   	  $(this).val($("#qqp").html());
   	   }
   });
   $("#mailval").focus(function(event) {
       if($(this).val()==$("#mailp").html()){
         	$(this).val('');
       }
   });
   $("#mailval").blur(function(event) {
   	   if($(this).val()==''){
   	   	  $(this).val($("#mailp").html());
   	   }
   });



	var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
	$("#upbu").click(function(event) {
		if($("#qqval").val()==$("#qqp").html()&& $("#mailval").val()==$("#mailp").html()){
			alert("资料未填写完整!");
		}else if($("#mailval").val()!=$("#mailp").html() && !reg.test($("#mailval").val())){
            alert("请填写正确的邮箱!");
		}
		else{
			$.ajax({
				type:'post',
				url:'xxx.php',
				data:{
                    qq:$("#qqval").val(),
                    mail:$("#mailval").val()
				},
				success:function(data){
					if(data==0){
						alert("修改失败，请重试");
					}else{
						alert("修改成功!");
						$("#qqp").html($("#qqp").html());
						$("#mailp").html($("#mailval").val());
					}
				},
				error:function(jqXHR){
				}
			})
		}
	});


  /*-------------修改密码------------------*/
  $("#upbu-psw").click(function(event) {
    if($("#psw-1").val()==''||$("#psw-2").val()==''||$("#psw-3").val()==''){
      alert("请将资料填写完整！");
    }else if($("#psw-2").val()!=$("#psw-3").val()){
      alert("两次输入新密码不一致！");
    }else{
        $.ajax({
          type:'post',
          url:'updatePsw',
          data:{
              pswold:$("#psw-1").val(),
              pswnew:$("#psw-2").val(),
          },
          success:function(data){

              if(data==0){
                alert("原密码错误请重试！");
              }else{
                alert("修改成功！请重新登录");
                window.location.href="teacherlogin.html";
              }
          },
          error:function(){
          }
        })
    }
  });
})
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 
/*----------二级菜单------*/
$(function(){
  $(".seca,.ul2").mousemove(function(event) {
    $(".ul2").css('display', 'block');
  });
  $(".seca,.ul2").mouseout(function(event) {
    $(".ul2").css('display', 'none');
  });

})

function clickup(){
  $(".imgreduce").click(function(event) {
     var i=$(this).next().html();
     if(i==0){
        alert("不能更小啦！");
     }else{
       i--;
       $(this).next().html(i);
     }
  });
  $(".imgup").click(function(event) {
     var i=$(this).prev().html();//now
     var max=$(this).prev().attr('name');//rest
     if(max==0){
      alert("不能更大啦");
     }else{
      i++;
      max--;
      $(this).prev().attr('name',max);
      console.log(max);
      $(this).prev().html(i);
     }
  });

  $(".save").click(function(event) {
     if(confirm("确定保存？")){
        var mypid=$(this).prev().html();//修改的类名称
        var c_id=$(this).attr('name');; //课程id
        var id=$(this).next().html();//用户id
        var initial=$(this).prev().prev().html();//进度的类名称
          $.ajax({
            type:'POST',
            url:'updateFinish',
            async:false,
            data:{
                c_id:c_id,//课程id
                id:id,//用户id
                fclassnum:$("#"+mypid).html(),
            },
            success:function(data){
                if(data==0){
                  alert("保存失败，请重试");
                }else{
                  alert("保存成功！");
                  var ini=$("."+initial).html($("#"+mypid).html());
                }
            },
            error:function(){

            }
          });
     }
  });
}