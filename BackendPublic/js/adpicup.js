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
                data:{},
                success:function(data){
                      $(".ctop span").html("管理员："+data.acc);
                      $(".topbg a").css('display','block');
                      $(".topbg p").css('display','none');
                },
              });

              $.ajax({
                type:'post',
                url:'showIndexPic',
                success:function(data){
                    $("#pic-1").attr('src', data.p_1);
                    // $("#pic-2").attr('src', data.p_2);
                    // $("#pic-3").attr('src', data.p_3);
                    // $("#pic-4").attr('src', data.p_4);
                    // $("#pic-5").attr('src', data.p_5);
                    window.pnull=data.pnull;//默认图片 就是没有任何图片时的默认图片 __ROOT__/BackendPublic/images/banner-ini.jpg
                    window.p1=data.p_1;
                    // window.p2=data.p_2;
                    // window.p3=data.p_3;
                    // window.p4=data.p_4;
                    // window.p5=data.p_5;
                },
                error:function(){

                }
              });
        }
     },
  });

	window.page=1;
	// $("#lr-l").click(function(event) {
	// 	if(page==1){
	// 		page=5;
	// 		$(".list").css('left', -4*900);
 //      $(".adpic-buttonfor").css('display','none');
 //      $(".button-"+page).css('display','block');
	// 	}else{
 //            page--;
	// 		var ini=$(".list").css('left');
	// 		var now=parseInt(ini)+900;
	// 		$(".list").css('left', now);
 //      $(".adpic-buttonfor").css('display','none');
 //      $(".button-"+page).css('display','block');
	// 	}
	// });
	// $("#lr-r").click(function(event) {
	// 	if(page==5){
	// 		page=1;
	// 		$(".list").css('left', 0);
 //      $(".adpic-buttonfor").css('display','none');
 //      $(".button-"+page).css('display','block');
	// 	}else{
	// 		page++;
	// 		var ini=$(".list").css('left');
	// 		var now=parseInt(ini)-900;
	// 		$(".list").css('left', now);
 //      $(".adpic-buttonfor").css('display','none');
 //      $(".button-"+page).css('display','block');
	// 	}
	// });
  


   /*--------显示图片--------*/
   $(".buttonid").change(function(event) {
       var imgid=$(this).attr('id');
   	   docObj = document.getElementById(imgid);
       imgObjPreview=document.getElementById("pic-1")
   	   // switch(page){
       //       case 1:var ;break;
       //       case 2:var imgObjPreview=document.getElementById("pic-2");break;
       //       case 3:var imgObjPreview=document.getElementById("pic-3");break;
       //       case 4:var imgObjPreview=document.getElementById("pic-4");break;
       //       case 5:var imgObjPreview=document.getElementById("pic-5");break;
       // }
   	   imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
   });
  /*--------------删除图片-------------*/
  $("#upindexpic-de").click(function(event) {
  	 if(confirm("确定删除图片？")){
       imgOb=$("#pic-1")
   	   // switch(page){
       //       case 1:var ;break;
       //       case 2:var imgOb=$("#pic-2");break;
       //       case 3:var imgOb=$("#pic-3");break;
       //       case 4:var imgOb=$("#pic-4");break;
       //       case 5:var imgOb=$("#pic-5");break;
       // }
       imgOb.attr('src', '__ROOT__/BackendPublic/images/banner-ini.jpg');
  	 }
  });
  /*----------上传图片----------------*/
	function showRequest(formData, jqForm, options) {
       switch(page){
             case 1:var pint=p1;break;
             case 2:var pint=p2;break;
             case 3:var pint=p3;break;
             case 4:var pint=p4;break;
             case 5:var pint=p5;break;
       }
		if($("#pic-"+page).attr('src')==pint){
      alert("请先修改");
      return false;
    }
		return true;

	}
	function showResponse(responseText, statusText) {
		alert("上传成功！")
	}
   $("#upindexpic-su").click(function(event) {
        // $("#upindexpic-"+page).ajaxSubmit(options);
     if (confirm("当前图片位置为图片"+page+":确定修改此图片?")) {
          if($("#pic-"+page).attr('src')=='__ROOT__/BackendPublic/images/banner-ini.jpg'||$("#pic-"+page).attr('src')==pnull){
               $("#pnum").val(page);
               $.ajax({
                 type:'post',
                 url:'deleteIndexPicture',
                 data:{pnum:page},
                 success:function(data){
                  console.log(data);
                    alert("删除成功");
                 }
               })
         }else{
               $("#upindexpic-"+page).ajaxSubmit(options);
         }
     }
   });
   var options = {  
        beforeSubmit:  showRequest,  //提交前处理 
        success:       showResponse,  //处理完成 
        url:'uploadIndexPic',
        resetForm: false,
        // dataType:  'json'  
    };
})