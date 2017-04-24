window.page=1;
$(function(){
//判断登录
	$.ajax({
		type:'post',
    async:false,
		url:'../index/checkHasLogin',
		success:function(data){
            if(data==0){
                alert("请先登录");
                window.location.href="../../";
            }else{
               $.ajax({
                 type:'post',
                 url:'getPages',
                 data:{
                   // id:data,
                   page:1,
                   lan:getQueryString('lan'),
                   rank:getQueryString('rank'),
                 },
                 success:function(data){
                     $(".topbg p").html(data.username);//用户名字
                     $(".topbg a").css('display','block');
                     $(".loinbox").css('display','none');
                     $(".allbox").html('');
                     window.pagenum=data.pagenum;
                     if(pagenum==0){
                        alert("没有符合要求的课程哦，去看看其他课程吧")
                        history.back(-1);
                        return false;
                     }else if(pagenum==1){
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
		error:function(jqXHR){
      // window.pagenum=4;
      // for(var i=1;i<=4;i++)
      // {
      //   $(".addp").append("<p>"+i+"</p>");
      //  }
      //  more(page);
      //  set();
		},
	});

})

//分页
function more(page){
   $.ajax({
     type:'post',
     url:'getCourse',
     async:false,
     data:{page:page,
           lan:getQueryString('lan'),
           rank:getQueryString('rank')},
     success:function(data){
          $(".addbox").html('');
          $.each(data,function(index,data){
                          $(".addbox").append(
                        "<div class='allbox'>"+
                              "<div class='inbox1'>"+
                                    "<div class='lanname'><p></p></div>"+
                                    "<table class='inbox1-table1' cellpadding='0' cellspacing='18'>"+
                                          "<tr>"+
                                              "<td>课程号</td>"+
                                              "<td>"+data.c_id+"</td>"+
                                          "</tr>"+
                                          "<tr>"+
                                             "<td>课程名</td>"+
                                              "<td>"+data.c_title+"</td>"+
                                          "</tr>"+
                                          "<tr>"+
                                              "<td>教&nbsp&nbsp&nbsp师</td>"+
                                              "<td>"+data.t_name+"</td>"+
                                          "</tr>"+
                                          "<tr>"+
                                              "<td>难&nbsp&nbsp&nbsp度</td>"+
                                              "<td><p class='ranktd'>"+data.level+"</p></td>"+
                                          "</tr>"+
                                    "</table>"+
                                    "<table class='inbox1-table2' cellpadding='0' cellspacing='18'>"+
                                           "<tr>"+
                                              "<td>课程量</td>"+
                                              "<td style='text-align: right;'>"+data.c_credit+"节</td>"+
                                          "</tr>"+
                                          "<tr>"+
                                              "<td>价格￥</td>"+
                                              "<td style='text-align: right;'>"+data.cost+"</td>"+
                                          "</tr>"+
                                          "<tr>"+
                                             " <td colspan='2'>"+
                                                  "<button class='buybutton' name='"+data.classid+"'>购买</button>"+
                                              "</td>"+
                                          "</tr>"+
                                    "</table>"+
                              "</div>"+
                              "<div class='inbox2 boxspan'>"+
                                    "<p>课程简介</p>"+
                                    "<div>"+data.c_description+
                                    "</div>"+
                              "</div>"+
                              "<div class='inbox3'>"+
                                    "<img src='"+data.t_head+"'>"+
                                    "<table cellpadding='0' cellspacing='18'>"+
                                          "<tr>"+
                                              "<td>教师</td>"+
                                              "<td>"+data.t_name+"</td>"+
                                         "</tr>"+
                                   "</table>"+
                                    "<div>"+
                                         "<p>简介</p>"+
                                         "<div>"+data.t_description+"</div>"+
                                    "</div>"+
                              "</div>"+
                        "</div>"+
                        "<hr>"
                            );
                      });
          $(".buybutton").click(function(){
             alert('赶紧添加我们的QQ号：1723253971联系我们吧。');
           });

     },
     error:function(jqXHR){
       
     },
     
   });
}


function set(){
//获取等级级别等
    switch(getQueryString('lan')){
      case '01':$(".lanname p").html("越南语");$(".lan01").addClass('nowa'); break;
      case '02':$(".lanname p").html("泰语");$(".lan02").addClass('nowa');break;
      case '03':$(".lanname p").html("印尼语");$(".lan03").addClass('nowa');break;
      case '04':$(".lanname p").html("阿拉伯语");$(".lan04").addClass('nowa');break;
    }
    switch(getQueryString('rank')){
      case '01':$(".ranktd").html("初级");break;
      case '02':$(".ranktd").html("中级");break;
      case '03':$(".ranktd").html("高级");break;
    }
//页面适应
  $(".centerbg-noheight").css('height', $(".bcrightbg").height()+20);
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
/*-------------获取url------------------------*/
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 