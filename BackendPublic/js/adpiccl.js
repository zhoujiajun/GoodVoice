$(function(){
   $("#adlc-uppic").change(function(event) {
   	   docObj = document.getElementById("adlc-uppic");
   	   imgObjPreview=document.getElementById("adlc_img")
   	   imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
   	   $("#adlc_img").css('display', 'block');
   	   $(".cl-p").css('display', 'none');
   });
})