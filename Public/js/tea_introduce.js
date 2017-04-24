$(function(){
    window.pagenow=1;
//修改选择语言
    switch(getQueryString('lan')){
         case '01':$("#tea_01").addClass('nowa');break;
         case '02':$("#tea_02").addClass('nowa');break;
         case '03':$("#tea_03").addClass('nowa');break;
         case '04':$("#tea_04").addClass('nowa');break;
    }    

//获取第一页内容
	$.ajax({
       type:'post',
        url:'../teacher/showTeachers',
       data:{lan:getQueryString('lan'),
             page:1},
       success:function(data){
        // console.log(data);
       	  if(data.pagenum==0){
       	  	alert("暂时还没有老师喔，看看别的吧");
       	  	$('.tea_con').height(400);
       	  }else{
       	  	$.each(data,function(index,data){
              if(index!='pagenum'){
                 $('.tea_con_box').append(
                       "<div class='tea_box'>"+
                             "<img src='"+data.t_head+"'>"+
                             "<p class='tea_box_word'>教师&nbsp&nbsp&nbsp<span>"+data.t_name+"</span></p>"+
                             "<p class='tea_box_word'>简介</p>"+
                             "<span class='tea_box_word'>"+data.t_description+"</span>"+
                             "<table  class='table_hr'></table>"+
                       "</div>"
                 );
              }

       	  	})
            window.pagenum=data.pagenum;

       	  	if(data.pagenum>1){
       	  		$('.tea_page').css('display', 'table');
       	  		for(var n=1;n<=data.pagenum;n++){
                    $('.tea_page_ul').append(
                    	  "<li><a href='#'>"+n+"</a></li>"
                    	);
       	  		}
       	  	};
            clickpage();
       	  }
       },
       // error:function(jqXHR){
       //   window.pagenum=3;
       // }
	});
  
})

function clickpage(){
//点击页数
  $('.tea_page_ul li a').click(function(){
     var pageclick=$(this).html();
     if(pagenow==pageclick){
        alert("已经是当前页啦！");
      }else{
        pagenow=pageclick;
        getPageTeaher(pageclick);
      }
  });
//点击上一个下一个
$('.tea_page_last').click(function(){
  if(pagenow==1){
    alert("到第一页啦!");
  }else{
    pagenow=parseInt(pagenow)-1;
    getPageTeaher(pagenow)
  }
});
$('.tea_page_next').click(function() {
   if(pagenow==pagenum){
    alert("最后一页啦！");
   }else{
    pagenow=parseInt(pagenow)+1;
    getPageTeaher(pagenow);
   }
});
}
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 

function getPageTeaher(pageclick){
            $.ajax({
                type:'post',
                url:'../teacher/showTeachers',
                data:{lan:getQueryString('lan'),
                      page:pageclick},
                success:function(data){
                       pagenow=pageclick;
                       $('.tea_con_box').html('');
                       $.each(data,function(index,data){
                            if(index!='pagenum'){
                               $('.tea_con_box').append(
                                     "<div class='tea_box'>"+
                                           "<img src='"+data.t_head+"'>"+
                                           "<p class='tea_box_word'>教师&nbsp&nbsp&nbsp<span>"+data.t_name+"</span></p>"+
                                           "<p class='tea_box_word'>简介</p>"+
                                           "<span class='tea_box_word'>"+data.t_description+"</span>"+
                                           "<table  class='table_hr'></table>"+
                                     "</div>"
                               );
                            }
                       })
                       // if(data.pagenum>=1){
                       //   $('.tea_page').css('display', 'table');
                       //   $('.tea_page_ul').html('');
                       //   for(var n=1;n<=data.pagenum;n++){
                       //         $('.tea_page_ul').append(
                       //             "<li><a href='#'>"+n+"</a></li>"
                       //           );
                       //   }
                       // }
                },
              // error:function(jqXHR){
              //     pagenow=pageclick;
              //     console.log(pagenow);
              // }
            });
}