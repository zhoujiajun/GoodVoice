<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script language="JavaScript" src="/test/Public/js/jquery-2.1.3.min.js"></script>
    <script language="JavaScript">
        function fyAsk(current){
            $.ajax({
                "url":"/test/index.php/Home/Ajax/fyAsk",
                "data":{
                    "num":10,
                    "current":current
                },
                "success":function(data){
                    var list=data.data.list;
                    var len=list.length;

                    var pages=document.getElementById("pages");
                    pages.innerHTML='';
                    var bu=document.getElementById("bu");
                    bu.innerHTML='';
                    var i=0;
                    for(i=0; i<len;i++){
                        var div= document.createElement('div');
                        div.innerHTML=list[i].id+"："+list[i].message;
                        pages.appendChild(div);
                    }

                    var Blen=Math.ceil(data.data.count/data.data.num);
                    var buttonfirst=document.createElement('button');
                    buttonfirst.innerHTML='首页';
                    buttonfirst.setAttribute("onclick","fyAsk("+1+")");
                    bu.appendChild(buttonfirst);
                    for(i=1;i<=Blen;i++){
                        var button=document.createElement('button');
                        button.innerHTML=i;
                        if(i==data.data.current){
                            button.setAttribute('class','current');
                        }
                        button.setAttribute("onclick","fyAsk("+i+")");
                        bu.appendChild(button);
                    }
                    var buttonlast=document.createElement('button');
                    buttonlast.innerHTML='末页';
                    buttonlast.setAttribute("onclick","fyAsk("+Blen+")");
                    bu.appendChild(buttonlast);
                }
            });
        }

        window.onload=function() {
            fyAsk(1);
        }
    </script>
    <style>
        .current{
            background-color: #50A8E6;
        }
    </style>
</head>
<body>
<div id="pages">
    <!--填写列表内容-->
</div>
<div id="bu">
    <!--填写按钮-->
</div>
</body>
</html>