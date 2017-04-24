$(function(){
	$("#lang").css({
		width: '400',
		height: '37',
	});
   /*-----------显示照片---------*/
   $("#edi-pic").change(function(event) {
   	   docObj = document.getElementById("edi-pic");
   	   var imgObjPreview=document.getElementById("edi-imgid");
   	   imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
   });
})