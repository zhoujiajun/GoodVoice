$(function(){
	$.ajax({
		type:'post',
		url:'../index/checkHasLogin',
		success:function(data){
            if(data==0){
                alert("请先登录");
				        window.location.href=="../../";
            }else{
                $.ajax({
                	type:'post',
                	url:'getPages',
                	data:{
                		id:data,
                	},
                	success:function(data){
                    // console.log(data);
                    /*这里用data.head可以获取头像的url地址，更新左上角的用户头像显示*/
                          $(".topbg p").html(data.username);//用户名字
                          $(".topbg a").css('display','block');
                          $("#imghead").attr('src', data.head);
                  /*-----------分页----------------*/
                          window.pagenum=data.pagenum;
                          if(pagenum==0){
                            alert("您还未购买任何课程，赶紧去购买吧。");
                            $(".centerbg-2").css('height', '1021');
                          }
                          else if(pagenum==1){
                            $(".pagebg").css('display','none');
                          }else{
                            for(var i=1;i<=pagenum;i++)
                            {
                              $(".addp").append("<p>"+i+"</p>");
                            }
                          }
                          more(1);
                          set();               	
                },
                })
            }
		},
		error:function(){

		}
	});
})
window.page=1;
//分页
function more(page){
   $.ajax({
     type:'post',
     url:'getmyclass',
     async:false,
     data:{page:page},
     success:function(data){
      $(".addbox").html('');
     $.each(data,function(index, data) {
// console.log(index);
                            // console.log(data.teacher.t_description);
                 // if(index==pagenum){
                 //   return false;
                 // }else
                 //  {
                              $(".addbox").append(
                              "<div class='allbox'>"+
                                    "<div class='top'>"+
                                          "<div class='classname'>"+data.c_language+"</div>"+
                                          "<table cellpadding='0' cellspacing='18'>"+
                                                 "<tr>"+
                                                     "<td>课程号</td>"+
                                                     "<td>"+data.c_id+"</td>"+
                                                 "</tr>"+
                                                 "<tr>"+
                                                     "<td>课程名</td>"+
                                                     "<td>"+data.c_title+"</td>"+
                                                 "</tr>"+
                                                 "<tr>"+
                                                     "<td>教师</td>"+
                                                     "<td>"+data.t_name+"</td>"+
                                                 "</tr>"+
                                                 "<tr>"+
                                                     "<td>难度</td>"+
                                                     "<td>"+data.level+"</td>"+
                                                 "</tr>"+
                                          "</table>"+
                                          "<div class='schedule'>"+
                                                "<div class='rad1'></div>"+
                                                "<div class='rad2'></div>"+
                                                "<div class='radtip' name='"+data.finished/data.c_credit+"'>"+
                                                    "<p>进度</p>"+
                                                    "<p>"+data.finished+"/"+data.c_credit+"</p>"+
                                                "</div>"+
                                          "</div>"+
                                    "</div>"+
                                    "<div class='center'>"+
                                          "<p>课程简介</p>"+
                                          "<div>"+data.c_description+"</div>"+
                                    "</div>"+
                                    "<div class='bottom'>"+
                                         "<img src='"+data.teacher.t_head+"'>"+
                                         "<table cellpadding='0' cellspacing='18'>"+
                                               "<tr>"+
                                                   "<td style='width: 50px;'>教师</td>"+
                                                   "<td>"+data.teacher.t_name+"</td>"+
                                               "</tr>"+
                                         "</table>"+
                                         "<div class='bottomdiv'>"+
                                              "<p>简介</p>"+
                                              "<div>"+data.teacher.t_description+"</div>"+
                                         "</div>"+
                                    "</div>"
                                );
                             // }
                          });
                           //进度 prev()
                          $(".radtip").each(function() {
                              console.log($(this).attr('name'));
                              if($(this).attr('name') <= 1/4){
                                 $(this).prev('.rad2').addClass('rad2-1');
                               }else if($(this).attr('name') >= 1/4 && $(this).attr('name') <= 1/2){
                                   $(this).prev('.rad2').addClass('rad2-2');
                               }else if($(this).attr('name') >= 1/2 && $(this).attr('name') <= 3/4){
                                   $(this).prev('.rad2').addClass('rad2-3');
                               }else{
                                   $(this).prev('.rad2').addClass('rad2');
                               }
                          });
                         //页面适应
                         if($(".myclassright").height()+20 <= 814){
                             $(".centerbg-2").css('height', '814');
                         }else{
                              $(".centerbg-2").css('height', $(".myclassright").height()+20)
                         }

     },
     error:function(jqXHR){
//   var jsondata='[{"c_language":"321","c_id":"听力","c_title":"程家阳"},{"c_language":"123","c_id":"读写","c_title":"文晓华"}]';
//   var jsonobj=$.parseJSON(jsondata);
//   console.log(1);
//  $.each(jsonobj,function(index, data) {
//                             // console.log(data.teacher.t_description);
// if(index==2){
//   console.log(index);
//   return false;
// }else{
//                               $(".addbox").html('');
//                               $(".addbox").append(
//                               "<div class='allbox'>"+
//                                     "<div class='top'>"+
//                                           "<div class='classname'>"+data.c_language+"</div>"+
//                                           "<table cellpadding='0' cellspacing='18'>"+
//                                                  "<tr>"+
//                                                      "<td>课程号</td>"+
//                                                      "<td>"+data.c_id+"</td>"+
//                                                  "</tr>"+
//                                                  "<tr>"+
//                                                      "<td>课程名</td>"+
//                                                      "<td>"+data.c_title+"</td>"+
//                                                  "</tr>"+
//                                                  "<tr>"+
//                                                      "<td>教师</td>"+
//                                                      "<td>"+data.t_name+"</td>"+
//                                                  "</tr>"+
//                                                  "<tr>"+
//                                                      "<td>难度</td>"+
//                                                      "<td>"+data.level+"</td>"+
//                                                  "</tr>"+
//                                           "</table>"+
//                                           "<div class='schedule'>"+
//                                                 "<div class='rad1'></div>"+
//                                                 "<div class='rad2'></div>"+
//                                                 "<div class='radtip' name='"+"data.finished/data.c_credit"+"'>"+
//                                                     "<p>进度</p>"+
//                                                     "<p>"+"data.finished"+"/"+"data.c_credit"+"</p>"+
//                                                 "</div>"+
//                                           "</div>"+
//                                     "</div>"+
//                                     "<div class='center'>"+
//                                           "<p>课程简介</p>"+
//                                           "<div>"+"data.c_description"+"</div>"+
//                                     "</div>"+
//                                     "<div class='bottom'>"+
//                                          "<img src='"+"data.teacher.t_head"+"'>"+
//                                          "<table cellpadding='0' cellspacing='18'>"+
//                                                "<tr>"+
//                                                    "<td style='width: 50px;'>教师</td>"+
//                                                    "<td>"+"data.teacher.t_name"+"</td>"+
//                                                "</tr>"+
//                                          "</table>"+
//                                          "<div class='bottomdiv'>"+
//                                               "<p>简介</p>"+
//                                               "<div>"+"data.teacher.t_description"+"</div>"+
//                                          "</div>"+
//                                     "</div>"
//                                 );
// }
//                           });
//                            //进度 prev()
//                           $(".radtip").each(function() {
//                               console.log($(this).attr('name'));
//                               if($(this).attr('name') <= 1/4){
//                                  $(this).prev('.rad2').addClass('rad2-1');
//                                }else if($(this).attr('name') >= 1/4 && $(this).attr('name') <= 1/2){
//                                    $(this).prev('.rad2').addClass('rad2-2');
//                                }else if($(this).attr('name') >= 1/2 && $(this).attr('name') <= 3/4){
//                                    $(this).prev('.rad2').addClass('rad2-3');
//                                }else{
//                                    $(this).prev('.rad2').addClass('rad2');
//                                }
//                           });
//                          //页面适应
//                          if($(".myclassright").height()+20 <= 814){
//                              $(".centerbg-2").css('height', '814');
//                          }else{
//                               $(".centerbg-2").css('height', $(".myclassright").height()+20)
//                          }
     },
     
   });
}
function set(){
//点击换页
  $(".addp p").click(function(event) {
     if(page==$(this).html()){
      alert("当前页");
     }else{
      page=$(this).html();
      more(page);
     }
  });
//左右换页
  $("#page-last").click(function(event) {
     if(page==1){
       alert("没有啦");
     }else{
        page--;
        more(page);
     }
  });

  $("#page-next").click(function(event) {
     if(page==pagenum){
         alert("没有啦");
     }else{
        page++;
        more(page);
     }

  });
}
//上传图片
$(function(){
   $("#headfile").change(function(event) {
       docObj = document.getElementById("headfile");
       var imgObjPreview=document.getElementById("imghead");
       imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
       $(".cheadb").css('display','none');
       $(".upheadbu").css('display','block');
   });
   $("#uphead").click(function(event) {
        $("#upheadform").ajaxSubmit(options);
   });
   var options = {  
        beforeSubmit:  showRequest,  //提交前处理 
        success:       showResponse,  //处理完成 
        resetForm: true,  
        // dataType:  'json'  
    };  
});
function showRequest(formData, jqForm, options) {
    // 
    if(!confirm("确定修改头像？")){
             $(".cheadb").css('display','block');
             $(".upheadbu").css('display','none');
           return false;
    }
     
     
    return true;  
}  
  
function showResponse(responseText, statusText)  {  
    alert("修改成功！")
}  
