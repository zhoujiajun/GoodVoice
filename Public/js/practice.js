$(function(){
	$(".moreright").click(function(event) {
		console.log(1);
		$(".list").css('left', '-200px');
		$(".moreright").css('display','none');
		$(".moreleft").css('display','block');
	});
	$(".moreleft").click(function(event) {
		$(".list").css('left', '0');
		$(".moreleft").css('display','none');
		$(".moreright").css('display','block');
	});
//判断登录
window.lan=getQueryString('lan');
window.page=1;
  $.ajax({
     type:'post',
     async:false,
     url:'../index/checkHasLogin',
     success:function(data){
         if(data==0){
         	alert("请先登录！");
         	window.location.href="../../";
         }else{
            window.id=data;
                  $.ajax({
                     type:'post',
                     async:false,
                     url:'getPages',
                     data:{lan:lan},
                     success:function(data){
                        $(".topbg p,#useracc").html(data.acc);//用户账号名字
                        $(".topbg a").css('display','block');
                        $(".loinbox").css('display','none');
/*-----------------------------------生产页数---------------------------------------*/
                          window.pagenum=data.pagenum;
                                if(pagenum==0){
                                  alert("没有符合要求的练习哦，去看看别的吧");
                                  return false;
                                }
                                else if(pagenum==1){
                                  $(".pagebg").css('display','none');
                                }else{
                                  for(var i=1;i<=pagenum;i++)
                                    {           
                                    $(".addp").append("<p>"+i+"</p>");
                                  }
                                }
/*------------------生产页面-----------------------*/
                         more(1);
                         set();
                     },

                  });

			  
         }
     },
     error:function(jqXHR){
/*测试--------------------------start*/
//          $(".addtest").html('');
//         for(var i=0;i<9;i++){
// 			  	 		$(".addtest").append(
//                              "<div class='testbox'>"+
//                                    "<p>"+"data.testname"+"</p>"+
//                                    "<hr>"+
//                                    "<table cellspacing='20' cellpadding='0'>"+
//                                          "<tr>"+
//                                              "<td>难度</td>"+
//                                              "<td style='text-align: right;'>"+"data.testrank"+"</td>"+
//                                          "</tr>"+
//                                          "<tr>"+
//                                              "<td>题量</td>"+
//                                              "<td style='text-align: right;'>"+"data.textnum"+"</td>"+
//                                          "</tr>"+
//                                          "<tr>"+
//                                              "<td colspan='2'><input type='button' class='starttest' value='开始做题' name='startdo'><p hidden='hidden'>"+1+"</p></td>"+
//                                          "</tr>"+
//                                    "</table>"+
//                              "</div>"
// 			  	 			);
// 			  	 	}

//  $(".starttest").click(function(event) {
//     window.location.href="__MODULE__/exercise/practice";
//  });
// window.pagenum=5;
//  for(var i=1;i<=pagenum;i++)
//  {           
//    $(".addp").append("<p>"+i+"</p>");
// }
/*测试--------------------------end*/
     },
  });

//当前页
 switch(getQueryString('lan')){
    	case '01':$(".pra-1").addClass('pranow');break;
    	case '02':$(".pra-2").addClass('pranow');break;
    	case '03':$(".pra-3").addClass('pranow');break;
    	case '04':$(".pra-4").addClass('pranow');break;
    	case '05':$(".pra-5").addClass('pranow');break;
    	case '06':$(".pra-6").addClass('pranow');break;
    	case '07':$(".pra-7").addClass('pranow');break;
   }

});

/*------------生产页面-----------------*/
function more(page){
                        
                        $.ajax({
                            type:'post',
                            async:false,
                            url:'showExercise',
                            data:{
                                lan:lan,
                                page:page,
                            },
                            success:function(data){
                              console.log(data);
                                $(".addtest").html('');
                                $.each(data,function(index,data){
                                  // console.log(index);
                                  // if(index==pagenum){
                                  //   return false;
                                  // }else{
                                    $(".addtest").append(
                                        "<div class='testbox'>"+
                                        "<p>"+data.testname+"</p>"+
                                    "<hr>"+
                                    "<table cellspacing='20' cellpadding='0'>"+
                                         "<tr>"+
                                             "<td>难度</td>"+
                                             "<td style='text-align: right;'>"+data.testrank+"</td>"+
                                         "</tr>"+
                                         "<tr>"+
                                             "<td>题量</td>"+
                                             "<td style='text-align: right;'>"+data.textnum+"</td>"+
                                         "</tr>"+
                                         "<tr>"+
                                             "<td colspan='2'><input type='button' class='starttest' value='开始做题' name='startdo'>"+
                                             "<p hidden='hidden' class='p-1'>"+data.done+"</p><span hidden='hidden' class='p-2'>"+data.e_id+"</span></td>"+
                                         "</tr>"+
                                   "</table>"+
                             "</div>"
                            );
                          // }
                       })
/*-----------------------------------显示是否已做---------------------------------------*/
                        $("input[name=startdo]").each(function() {
                           if($(this).next().html()==1){
                                   $(this).val("已做");
                              }
                          }); 

/*-----------------------------------开始做题---------------------------------------*/
                        $(".starttest").click(function(event) {
                           var id=$(this).next().next().html()
                          window.location.href="practice?e_id="+id;
                        });
                 },
                 error:function(){
                    console.log(page);
                 }
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
        page-- ;
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
/*获取URL参数----*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 