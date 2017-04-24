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
                    console.log(data);
		            	    $(".ctop span").html("管理员："+data.acc);
			   	 		        $(".topbg a").css('display','block');
                      $(".topbg p").css('display','none');
              	 	},
              	 });

              }
		},
		error:function(){

		}
	})
  switch(getQueryString('html')){
     case '15': allexe();break;
     case '111': edibig();break;
     case '112': edism();break;
     case '113': thisexe();break;
     case '114': isexe();break;
  }
  $("#exe_back").click(function(event) {
    document.location.href=document.referrer;
  });
})
/*-----------获取所有练习------------*/
function allexe(){
   $.ajax({
   	  type:'post',
   	  url:'getAllExercises',
   	  data:{html:15},
   	  success:function(data){
        // console.log(data);
         $(".exe-conbox").html('');
         $.each(data, function(index, data) {
                $(".exe-conbox").append(
                             "<div class='exe-box' id='"+data.e_id+"'>"+
                                   "<p name='"+data.release+"'>"+data.title+"</p>"+
                                   "<table>"+
                                          "<tr>"+
                                              "<td>语种</td>"+
                                              "<td>"+data.language+"</td>"+
                                          "</tr>"+
                                          "<tr>"+
                                              "<td>难度</td>"+
                                              "<td>"+data.level+"</td>"+
                                          "</tr>"+
                                   "</table>"+
                                   "<input type='button' class='exe-de' value='删除' name='"+data.e_id+"'>"+
                                   "<p hidden='hidden' class='done-p'>"+data.release+"</p>"+//是否有发布
                             "</div>"
                	);
         });
         $('.done-p').each(function() {
           if($(this).html()==0){
              $(this).after(
                 "<div class='exe_issue'>未发布</div>"
                );
           }
         });
         exede();
   	  },
   })
}
/*-----------所有练习的删除按钮和跳转------------*/
function exede(){
	$(".exe-de").click(function(event) {
		if(confirm("确定删除？")){
            var e_id=$(this).attr('name');
            $.ajax({
            	type:'post',
            	url:'deleteExe',
            	data:{e_id:e_id},
            	success:function(data){
                    if(data==0){
                    	alert("删除失败：请重试");
                    }else{
                        $("#"+e_id).remove();
                        alert("删除成功");
                    }
            	},
            	error:function(){
            	}
            })
		}
	});
  $(".exe-box > p").click(function(event) {
    var e_id=$(this).parent().attr('id');
    if($(this).attr('name')==1){
       window.location.href='adexe_is_exe.html?html=114&e_id='+e_id;
    }else{
       window.location.href='adexe_exe.html?html=113&e_id='+e_id;
    }
  });
}

/*-----------添加小题页面----start--------*/
$(function(){
  /*---点击分数-----*/
  $("#ga_up").click(function(event) {
     var i=$(".exe_ga_div").html();
     i++;
     $(".exe_ga_div").html(i);
     $("#ga_input").val(i);
     $("#exe_edi_sm_ga").val(i)
  });
  $("#ga_down").click(function(event) {
     var i=$(".exe_ga_div").html();
     if(i==0){
        alert("不能更小啦");
     }else{
        i--;
        $(".exe_ga_div").html(i);
        $("#ga_input").val(i);
        $("#exe_edi_sm_ga").val(i)
     }
  });
  /*-----------------*/

  $("#exe_sm_up").click(function(event) {
    // if(confirm("确定上传？")){
      // $("#exe_sm_form").ajaxSubmit(smoptions);
    // }
    if(confirm("确定上传？")){
      if($('.exe_ns_selcet').val() == ''||$("#ga_input").val()=='0'){
        alert("资料未填写完整");
      }else{
        $.ajax({
          type: 'post',
          url: 'addXiaoti',
          data: {
                  t_title:$("#t_title").val(),
                  op_a:$("#op_a").val(),
                  op_b:$("#op_b").val(),
                  op_c:$("#op_c").val(),
                  op_d:$("#op_d").val(),
                  answer:$("#answer").val(),
                  point:$("#ga_input").val(),
                  t_id:getQueryString('t_id'),
                  e_id:getQueryString('e_id'),
          },
          success:function(data){
            // console.log(data);
            if (data==0) {
              alert("提交失败：请重试");
            }else{
              alert("添加成功");
              window.location.href=document.referrer;
            }
          }
        })
      }
    }
  });
})

/*-----------添加小题页面----end--------*/

/*---------添加新练习页面-----start--*/
$(function(){
  $("#exe_ni_up").click(function(event) {
    if($("#exe_ni_name").val()==''||$("exe_ni_lang").val()==''||$("exe_ni_rank").val()==''){
      alert("资料未填写完整");
     }else{
       $.ajax({
          type:'post',
          url:'addExe',
          data:{
            name:$("#exe_ni_name").val(),
            lang:$("#exe_ni_lang").val(),
            level:$("#exe_ni_rank").val(),
          },
          success:function(data){
            // console.log(data);
           //成功的话就返回这个练习的id，data=id；
            if(data==0){
              alert("添加失败：请重试");
            }else{
              alert("添加成功");
              window.location.href='adexe_new_index?e_id='+data;
            }
          }
       });
     }
  });
})
/*---------添加新练习页面-----end--*/

/*-----------------*/
$(function(){
  $("#exe_ni_can").click(function(event) {
    window.location.href=document.referrer;
  });
  $("#exe_in_new").click(function(event) {
    window.location.href='adexe_new_index.html';
  });
})
/*--------新练习页面-----strat---*/
function thisexe(){
   $.ajax({
      type:'post',
      url:'getOneExe',
      data:{e_id:getQueryString('e_id')},
      success:function(data){
        $("#exe_new_level").html(data.level);
        $("#exe_new_ga").html(data.points);
        $("#exe_new_time").html(data.re_time);
        $("#exe_qu").html(data.quantity);
        $("#exe_title").html(data.title);
        if(data.bignum > 0){//一共有多少个大题题目的意思
          $.each(data.bigQuiz, function(index, data) {
             $(".exe-conbox").append(
              "<div class='exe_single' id='"+data.dati+"'>"+
                                   "<table class='exe_title_sin'>"+
                                          "<tr>"+
                                              "<td>"+(index+1)+" "+data.da_des+"</td>"+
                                              "<td width='260px' style='vertical-align:top' >"+
                                                  "<input type='button' name='"+data.dati+"' value='删除' class='exe_bu exe_bus_de exe_newb_de'>"+
                                                  "<input type='button' name='"+data.dati+"' value='编辑' class='exe_bu exe_bus_edi exe_new_edi'>"+
                                                  "<input type='button' name='"+data.dati+"' value='添加' class='exe_bu exe_bus_edi exe_new_add'>"+
                                              "</td>"+
                                          "</tr>"+
                                   "</table>"+
               "</div>"
              );
          });
          exeXiaoTi();
        }
      exeClick();
      }
   });
function exeXiaoTi(){
    $(".exe_single").each(function() {
       var a_id=$(this).attr('id');
       $.ajax({
         type:'post',
         url:'getXiaoti',
         data:{e_id:getQueryString('e_id'),
               t_id:a_id},
         success:function(data){
              $.each(data, function(index, data) {
                  $("#"+a_id).append(
                                      "<div class='exe_sin_box' id='"+data.dati+"-"+data.xiaoti+"' name='"+data.dati+"'>"+
                                        "<table>"+
                                               "<tr>"+
                                                    "<td width='25px'><input type='radio' class='checkbox' name='delete'>"+
                                                    "<p hidden='hidden'>"+data.dati+"</p>"+
                                                    "<p hidden='hidden'>"+data.xiaoti+"</p>"+
                                                    "</td>"+
                                                    "<td>"+(index+1)+". "+data.title+"</td>"+
                                                    "<td style='text-align: right;'>"+data.point+"分</td>"+//本小题分数
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-1' class='exe_for_check'><div>A</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-1' class='dis-no'>"+
                                                        "<p class='exe_span_top'>"+data.a_ans+"</p>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-2' class='exe_for_check'><div>B</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-2' class='dis-no'>"+
                                                        "<span class='exe_span_top'>"+data.b_ans+"</span>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-3' class='exe_for_check'><div>C</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-3' class='dis-no'>"+
                                                        "<span class='exe_span_top'>"+data.c_ans+"</span>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-4' class='exe_for_check'><div>D</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-4' class='dis-no'>"+
                                                        "<span class='exe_span_top'>"+data.d_ans+"</span>"+
                                                    "</td>"+
                                                    "<td><input type='button' value='编辑' class='exe_bu exe_bus_edi exe_s_edi' name='"+data.xiaoti+"'>"+
                                                         "<p hidden='hidden'>"+data.dati+"</p>"+
                                                    "</td>"+
                                               "</tr>"+
                                        "</table>"+
                                    "</div>"
                    );
                var i=0;
                switch (data.answer) {
                        case 'A':i = 1;break;
                        case 'B':i = 2;break;
                        case 'C':i = 3;break;
                        case 'D':i = 4;break;
                    };
                $("#a-"+data.dati+"-"+index+"-"+i).attr('checked','checked');
                
              });
                $('.dis-no').each(function() {
                  if ($(this).is(':checked')) {
                    $(this).prev().children().css('backgroundColor', '#17E6FF');
                  }
                });
                exeClick();
         },
       })
    });
}
function exeClick(){
/*-------大题点击添加-------*/
$(".exe_new_add").click(function(event) {
  var t_id=$(this).attr('name');
  window.location.href='adexe_new_sm.html?html=115&e_id='+getQueryString('e_id')+'&t_id='+t_id
});
/*-------大题点击编辑-------*/
$(".exe_new_edi").click(function(event) {
  var t_id=$(this).attr('name');
  window.location.href='adexe_edi_big.html?html=111&e_id='+getQueryString('e_id')+'&t_id='+t_id
});
/*--------大题点击删除--------*/
$(".exe_newb_de").unbind('click').click(function(event) {
  var t_id=$(this).attr('name');
  if(confirm("确定删除？")){
    $.ajax({
      type:'post',
      url:'deleteDati',
      data:{t_id:t_id,
            e_id:getQueryString('e_id')},
      success:function(data){
           if(data==0){
            alert("删除失败：请重试")
           }else{
            alert("删除成功");
            $("#"+t_id).remove();
           }
      },
    })
  }
});
/*--------跳转到添加大题--------*/
$("#exe_new_addbig").click(function(event) {
  console.log(1);
  window.location.href='adexe_new_big.html?e_id='+getQueryString('e_id');
});
/*-----小题点击编辑----------*/
$(".exe_s_edi").click(function(event) {
  var x_id=$(this).attr('name');
  var t_id=$(this).next().html();
  window.location.href='adexe_edi_sm.html?html=112&e_id='+getQueryString('e_id')+'&x_id='+x_id+'&t_id='+t_id;
});
}

/*----------所有点击删除--------*/
 $("#exe_newa_de").unbind('click').click(function(event) {
   var dati;
   var xiaoti;
   var i=0;
   if(confirm("确定删除？")){
     $(".checkbox").each(function() {
        if($(this).is(':checked')){
             dati=$(this).next().html();
             xiaoti=$(this).next().next().html();
             i++;
        }
     });
      if (i == 0) {
        alert("您未选中对象");
      } else {
        $.ajax({
          type: 'post',
          url: 'deleteXiaoti',
          data: {
            dati: dati,
            xiaoti: xiaoti,
            e_id: getQueryString('e_id'),
          },
          success: function(data) {
            if (data == 0) {
              alert("删除失败：请重试");
            } else {
              $(".checkbox").each(function() {
                if ($(this).is(':checked')) {
                  var id = $(this).attr('name');
                  $('#' + id).remove();
                }
              });
              alert("删除成功");
            }
          },
          error: function() {

          }
        })
      }
   }

 });

/*-----暂存------*/
$('#exe_tem').click(function(event) {
  $.ajax({
    type:'post',
    url:'xxx.php',
    data:{e_id:getQueryString('e_id')},
    success:function(data){
      if(data==0){
        alert("暂存失败：请重试");
      }else{
        alert("暂存成功");
      }
    },
  })
});
/*------发布-----*/
$("#exe_is").click(function(event) {
  if(confirm("发布后将不能修改:确定发布？")){
    $.ajax({
        type:'post',
        url:'releaseExe',
        data:{e_id:getQueryString('e_id')},
        success:function(data){
          if(data==0){
            alert("发布失败：请重试");
          }else{
            alert("发布成功");
            window.location.href='adexe_index?html=15'
          }
        },
    })
  }
});
}

/*--------练习页面----end----*/

/*--------编辑大题---strat------*/
function edibig(){
  $.ajax({
    type:'post',
    url:'checkDati',
    data:{
        e_id:getQueryString('e_id'),
        t_id:getQueryString('t_id'),
    },
    success:function(data){
      console.log(data);
       //$("#exe_edib_title").val(data.title);
       $("#exe_edib_des").val(data.da_des);
    }
  });
  $("#exe_edib_up").click(function(event) {
    if(confirm("确定修改？")){
      $.ajax({
        type:'post',
        url:'updateDati',
        data:{//title:$("#exe_edib_title").val(),
              e_id:getQueryString('e_id'),
              t_id:getQueryString('t_id'),
              des:$("#exe_edib_des").val()},
        success:function(data){
            if(data==0){
              alert("修改失败：请重试");
            }else{
              alert("修改成功");
              window.location.href=document.referrer;
            }
        }
      });
    }
  });
  $("#exe_edib_back").click(function(event) {
    document.location.href=document.referrer;
  });
}
/*--------编辑大题---end------*/

/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 

/*-----------编辑小题-----------*/
function edism(){
  $.ajax({
    type:'post',
    url:'checkXiaoti',
    data:{
        e_id:getQueryString('e_id'),
        t_id:getQueryString('t_id'),
        x_id:getQueryString('x_id'),
    },
    success:function(data){
      console.log(data);
       $("#exe_edi_sm_title").val(data.title);
       $("#exe_edi_sm_a").val(data.a_ans);
       $("#exe_edi_sm_b").val(data.b_ans);
       $("#exe_edi_sm_c").val(data.c_ans);
       $("#exe_edi_sm_d").val(data.d_ans);
       $("#exe_edi_sm_ans").val(data.answer);
       $("#exe_edi_sm_ga").val(data.point);
       $(".exe_ga_div").html(data.point);
    },
    error:function(jqXHR){
      console.log(jqXHR.status);
    }
  })
  
  $("#exe_edi_sm_up").click(function(event) {
    if($("#exe_edi_sm_title").val()==''||$("#exe_edi_title").val()==''||$("#exe_edi_sm_a").val()=='' || $("#exe_edi_sm_b").val()=='' || $("#exe_edi_sm_c").val()==''||$("#exe_edi_sm_d").val()==''||$("#exe_edi_sm_ans").val()==''||$("#exe_edi_sm_ga").val()==0){
      alert("资料未填写完整");
    }else{
      $.ajax({
        type:'post',
        url:'updateXiaoti',
        data:{
          t_title:$("#exe_edi_sm_title").val(),
          op_a:$("#exe_edi_sm_a").val(),
          op_b:$("#exe_edi_sm_b").val(),
          op_c:$("#exe_edi_sm_c").val(),
          op_d:$("#exe_edi_sm_d").val(),
          answer:$("#exe_edi_sm_ans").val(),
          point:$("#exe_edi_sm_ga").val(),
          e_id:getQueryString('e_id'),
          x_id:getQueryString('x_id'),
          t_id:getQueryString('t_id'),
        },
        success:function(data){
          if(data==0){
            alert("修改失败：请重试");
          }else{
            alert("修改成功");
            window.location.href=document.referrer;
          }
        }
      })
    }
  });
}

/*------添加大题------*/
$(function(){
  $("#exe_new_big_up").click(function(event) {
    if(confirm("确定添加？")){
      if($("#exe_new_big_title").val()==''){
        alert("资料未填写完整");
      }else{
        //console.log(getQueryString('e_id'));
        $.ajax({
          type:'post',
          url:'addDati',
          data:{
            title:$("#exe_new_big_title").val(),
            e_id:getQueryString('e_id'),
          },
          success:function(data){
            if(data==0){
                alert("添加失败：请重试");
             }else{
                if(confirm("添加成功,是否继续添加")){
                   window.location.reload();
                }else{
                  window.location.href=document.referrer;
                }
             }
          },
        })
      }
    }
  });
})
/*---------已发布的练习页面----------------*/
function isexe(){
  $.ajax({
     type:'post',
     url:'getOneExe',
     data:{e_id:getQueryString('e_id')},
     success:function(data){
      console.log(data);
          $("#exe_new_level").html(data.level);
          $("#exe_new_ga").html(data.points);
          $("#exe_new_time").html(data.re_time);
          $("#exe_qu").html(data.quantity);
          $("#exe_title").html(data.title);
          if(data.bignum > 0){
             $.each(data.bigQuiz, function(index, data) {
                $(".exe-conbox").append(
                             "<div class='exe_single' id='"+data.dati+"'>"+
                                   "<table class='exe_title_sin'>"+
                                          "<tr>"+
                                              "<td>"+(index+1)+" "+data.da_des+"</td>"+
                                              "<td>"+
                                              "</td>"+
                                          "</tr>"+
                                   "</table>"+
                              "</div>"
                  );
             });
             $('.exe_single').each(function() {
                var t_id=$(this).attr('id');
                $.ajax({
                  type:'post',
                  url:'getXiaoti',
                  data:{e_id:getQueryString('e_id'),
                        t_id:t_id,},
                  success:function(data){
                        $.each(data, function(index, data) {
                           $("#"+t_id).append(
                                   "<div class='exe_sin_box'>"+
                                        "<table>"+
                                              " <tr>"+
                                                    "<td></td>"+
                                                    "<td>"+(index+1)+". "+data.title+"</td>"+
                                                    "<td style='text-align: right;'>"+data.point+"分</td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-1' class='exe_for_check'><div>A</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-1' class='dis-no'>"+
                                                        "<p class='exe_span_top'>"+data.a_ans+"</p>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-2' class='exe_for_check'><div>B</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-2' class='dis-no'>"+
                                                        "<span class='exe_span_top'>"+data.b_ans+"</span>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-3' class='exe_for_check'><div>C</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-3' class='dis-no'>"+
                                                        "<span class='exe_span_top'>"+data.c_ans+"</span>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                               "<tr>"+
                                                    "<td></td>"+
                                                    "<td>"+
                                                        "<label for='a-"+data.dati+"-"+index+"-4' class='exe_for_check'><div>D</div></label>"+
                                                        "<input type='checkbox' id='a-"+data.dati+"-"+index+"-4' class='dis-no'>"+
                                                        "<span class='exe_span_top'>"+data.d_ans+"</span>"+
                                                    "</td>"+
                                                    "<td></td>"+
                                               "</tr>"+
                                        "</table>"+
                                   "</div>"
                            );
                            var i=0;//答案
                            switch (data.answer) {
                                 case 'A':i = 1;break;
                                 case 'B':i = 2;break;
                                 case 'C':i = 3;break;
                                 case 'D':i = 4;break;
                              }
                            $("#a-"+data.dati+"-"+index+"-"+i).attr('checked','checked');
                        });
                      $('.dis-no').each(function(){
                        if($(this).is(':checked')){
                          $(this).prev().children().css('backgroundColor', '#17E6FF');
                        }
                      });
                  },
                })
             });
          };
     },
  });
}