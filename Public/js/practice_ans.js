$(function(){
	$.ajax({
		type:'post',
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
		}
	})
   $("#exe_back").click(function(event) {
   	  if(confirm("确定返回？")){
         window.location.href='practiceclass?lan=01'
   	  }
   });
})

function dati(){
	$.ajax({
		type:'post',
		url:'gainDati',
		data:{e_id:getQueryString('e_id')},
		success:function(data){
			$("#levle").html(data.level);
			$("#ga").html(data.point);
			$("#num").html(data.quantity);
			$("#time").html(data.re_time);
      $(".title_span").html(data.title);
      $(".title_lang").html(data.language);
      $(".pccontro > p").html(data.title);
			$("#score").html(data.score);
			if (data.bignum > 0) {
				$.each(data.dati, function(index, data) {
          var i=0;
					$(".pcitem").append(
            "<div class='bigitem' id='" + data.dati + "'>" +
            "<table>" +
            "<tr>" +
            "<td>" + (index + 1) + " </td>" +
            "<td>" + data.da_des + "</td>" +
            "</tr>" +
            "</table>" +
            "</div>"
					)
				}
        );
        xiaoti();
			}
		},
	   error:function(){

	   }
	})
}

function xiaoti(){
   var pn=0;
   $('.bigitem').each(function() {
   	  var t_id=$(this).attr('id');
   	  $.ajax({
   	  	type:'post',
   	  	url:'gainXiaoti',
        async:false,
   	  	data:{e_id:getQueryString('e_id'),
   	          t_id:t_id,
              num:pn},
   	    success:function(data){
           // console.log(pn);
            j=0;
            $.each(data, function(index, data) {
             j++;
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
	          var ans_t=0;
          
	          switch(data.answer){
		          case 'A':ans_t=1;break;
		          case 'B':ans_t=2;break;
		          case 'C':ans_t=3;break;
		          case 'D':ans_t=4;break;
	          }
	          var ans_u=0;
            //console.log(data.ans_user);
	          switch(data.ans_user){
		          case 'A':ans_u=1;break;
		          case 'B':ans_u=2;break;
		          case 'C':ans_u=3;break;
		          case 'D':ans_u=4;break;
	          }
	          if(ans_u==ans_t){
	               $("#text"+data.dati+"-"+index+"-"+ans_t).next('.radiocss').html("<img src='../../../Public/src/images/true.png'>");
	          }else{
		          $("#text"+data.dati+"-"+index+"-"+ans_t).next('.radiocss').html("<img src='../../../Public/src/images/true.png'>");
		          $("#text"+data.dati+"-"+index+"-"+ans_u).next('.radiocss').html("<img src='../../../Public/src/images/false.png'>");
	          }
            });
            pn=pn+j;
   	    },
   	  })
   });
}
/*获取URL参数----*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
}