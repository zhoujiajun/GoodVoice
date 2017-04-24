
$(function(){
	$.ajax({
		type:'POST',
		url:'../index/checkHasLogin',
		success:function(data){
           if(data==0){
           	  alert("请先登录");
           	  window.location.href="../../";
           }else{
           	  $.ajax({
           	  	type:'POST',
           	  	url:'getAcc',
           	  	data:{id:data,},
           	  	success:function(data){
                    $(".topbg p").html(data.username);
                    $(".topbg a").css('display', 'block');
           	  	},
           	  })
           }
           dati();
		},
		error:function(jqXHR){

			         
		}
	});
function dati(){
  $.ajax({
    type:'post',
    url:'gainDati',
    data:{e_id:getQueryString('e_id')},
    success:function(data){
      // console.log(data);
        $("#levle").html(data.level);
        $("#ga").html(data.point);
        $("#num").html(data.quantity);
        $("#time").html(data.re_time);
        $(".title_span").html(data.title);
        $(".title_lang").html(data.language);
        if(data.bignum > 0){
          $.each(data.dati, function(index, data) {
            var d_t='十'
            switch(index){
              case 0:d_t='一';break;
              case 1:d_t='二';break;
              case 2:d_t='三';break;
              case 3:d_t='四';break;
              case 4:d_t='五';break;
              case 5:d_t='六';break;
              case 6:d_t='七';break;
              case 7:d_t='八';break;
              case 8:d_t='九';break;
              case 9:d_t='十';break;
            }
            $(".pcitem").append(
              "<div class='bigitem' id='" + data.dati + "'>" +
              "<table>" +
              "<tr>" +
              "<td style='vertical-align: top;'>" + d_t + "&nbsp</td>" +
              "<td>" + data.da_des + "</td>" +
              "</tr>" +
              "</table>" +
              "</div>"
            );  
          });
          xiaoti();
        }
        
     
    },
    error:function(){

    },
  })
}

});
window.k=0;
function xiaoti(){
  $('.bigitem').each(function() {
     var t_id=$(this).attr('id');
    // console.log(t_id);
     $.ajax({
        type:'post',
        url:'gainXiaoti',
        data:{
             e_id:getQueryString('e_id'),
             t_id:t_id,
        },
        success:function(data){         
          $.each(data, function(index, data) {
             k++;
             $("#"+t_id).append(
                        "<div class='item'>"+
                              "<div>"+
                                   "<p class='qtnum'>"+(index+1)+".</p>"+
                                   "<p class='quest'>"+data.title+"</p>"+
                                   "<p class='qtgra'>"+data.point+"分</p>"+
                              "</div>"+
                              "<table cellspacing='0' cellpadding='0'>"+
                                    "<tr>"+
                                        "<td>"+
                                             "<input type='radio' id='text"+data.dati+"-"+index+"-1' name='text"+data.dati+"-"+index+"' style='display: none;'>"+
                                             "<label for='text"+data.dati+"-"+index+"-1' class='radiocss'><div>A</div></label>"+
                                        "</td>"+
                                        "<td><p style='margin-bottom: 20px;'>"+data.a_ans+"</p></td>"+
                                    "</tr>"+
                                    "<tr>"+
                                        "<td>"+
                                             "<input type='radio' id='text"+data.dati+"-"+index+"-2' name='text"+data.dati+"-"+index+"' style='display: none;'>"+
                                             "<label for='text"+data.dati+"-"+index+"-2' class='radiocss'><div>B</div></label>"+
                                        "</td>"+
                                        "<td><p style='margin-bottom: 20px;'>"+data.b_ans+"</p></td>"+
                                    "</tr>"+
                                    "<tr>"+
                                        "<td>"+
                                             "<input type='radio' id='text"+data.dati+"-"+index+"-3' name='text"+data.dati+"-"+index+"' style='display: none;'>"+
                                             "<label for='text"+data.dati+"-"+index+"-3' class='radiocss'><div>C</div></label>"+
                                        "</td>"+
                                        "<td><p style='margin-bottom: 20px;'>"+data.c_ans+"</p></td>"+
                                    "</tr>"+
                                    "<tr>"+
                                        "<td>"+
                                             "<input type='radio' id='text"+data.dati+"-"+index+"-4' name='text"+data.dati+"-"+index+"' style='display: none;'>"+
                                             "<label for='text"+data.dati+"-"+index+"-4' class='radiocss'><div>D</div></label>"+
                                        "</td>"+
                                        "<td><p style='margin-bottom: 20px;'>"+data.d_ans+"</p></td>"+
                                    "</tr>"+
                              "</table>"+
                        "</div>"
              );
          });
          cclick();
        }
     })
  });
}
function cclick(){
  $("input:radio").click(function(event) {
    $("input:radio").next('.radiocss').find('div').css('background-color', '#00AAF7')
    $("input:radio:checked").next('.radiocss').find('div').css('background-color', '#17E6FF');
  });
}
$(function(){
  cclick();
  $("#exe_up_an").click(function(event) {
     var ans=new Array();
     var i=0;
     if(confirm("确定提交？")){
      // console.log(22);
        $("input:radio").each(function() {
           if($(this).is(':checked')){
              ans[i]=$(this).next('.radiocss').find('div').html();
              i++;
           }
        });
        // console.log(i);
        // console.log(k);
        console.log(ans);
        if(i!=k){
          alert("您还有未完成的题目喔");
        }else{
          $.ajax({
            type:'post',
            url:'checkAns',
            data:{e_id:getQueryString('e_id'),
                  ans:ans,},
            success:function(data){
                 if(data==0){
                    alert("提交失败：请重试");
                 }else{
                    window.location.href='practice_ans.html?e_id='+getQueryString('e_id');
                 }
            },
          })
        }
     }
  });
})
/*获取URL参数----*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 