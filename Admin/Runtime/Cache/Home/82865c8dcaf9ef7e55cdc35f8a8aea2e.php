<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>干货板块</title>

  <!--file upload-->
  <link rel="stylesheet" type="text/css" href="/jobBook/Public/css/bootstrap-fileupload.min.css" />  
   <link rel="stylesheet" type="text/css" href="/jobBook/Public/css/wangEditor.min.css">

  <!--common-->
  <link href="/jobBook/Public/css/style.css" rel="stylesheet">
  <link href="/jobBook/Public/css/style-responsive.css" rel="stylesheet">
  
  <style>
  .btn-mystyle{
    color: #fff;
    background-color:#65CEA7;
    border-radius: 30px;  
  }
  .btn-mystyle:hover,
.btn-mystyle:focus,
.btn-mystyle:active,
.btn-mystyle.active{
    color: #fff;
    background-color: #4D997A;
}
 #editor-trigger {
            height: 400px;
            /*max-height: 500px;*/
        }
        .container {
            width: 100%;
            margin: 0 auto;
            position: relative;
        }
  </style>



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">
<script src="/jobBook/Public/js/jquery-1.10.2.min.js"></script>
<script src="/jobBook/Public/js/wangEditor.js"></script>
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="/jobBook/admin.php/Home/index/index"><img src="/jobBook/Public/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="/jobBook/admin.php/Home/index/index"><img src="/jobBook/Public/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="/jobBook/Public/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">卓洋</a></h4>
                    </div>
                </div>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="/jobBook/admin.php/Home/index/logout"><i class="fa fa-sign-out"></i> <span>注销</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li ><a href="/jobBook/admin.php/Home/index/index"><i class="fa fa-home"></i> <span>主页</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-suitcase"></i> <span>就业板块</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/jobBook/admin.php/Home/job/job_company">上传公司信息</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_company_search">公司信息修改或删除</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_upload" > 上传岗位信息</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_search"> 岗位信息修改或删除</a></li>

                    </ul>
                </li> 
                <li class="menu-list nav-active"><a href=""><i class="fa fa-book"></i> <span>干货板块</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/jobBook/admin.php/Home/article/article_upload"> 上传干货</a></li>
                        <li class="active"><a href="/jobBook/admin.php/Home/article/article_search"> 干货修改与删除</a></li>
                    </ul>
                </li>
                <li><a href="/jobBook/admin.php/Home/question/askask_search"> <i class="fa fa-question"></i> <span>问问修改与删除</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>意见反馈</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/jobBook/admin.php/Home/feedback/hasdeal">已处理</a></li>
                        <li><a href="/jobBook/admin.php/Home/feedback/undeal">待处理</a></li>
                    </ul>
                </li>
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

        <!--toggle button start-->
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->

            <!--user menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="/jobBook/Public/images/photos/user-avatar.png" alt="" />
                            <?php echo ($_SESSION['username']); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="/jobBook/admin.php/Home/index/logout"><i class="fa fa-sign-out"></i>注销</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--user menu end -->

        </div>
        <!-- header section end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <section class="panel">
                        <header class="panel-heading">
                            干货修改
                        </header>
                        <div class="panel-body">
                            <!-- form start -->
                            <form role="form" method="post" action="/jobBook/admin.php/Home/Article/do_function/a_id/<?php echo ($article["article_id"]); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>板块</label>
                                    <div class="btn btn-group" data-toggle="buttons">
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="1"> 就业技巧
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="2"> 政策解读
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="3"> 生活咨询
                                    </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>标题</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($article["title"]); ?>" name="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>正文</label>
                                    <!-- <textarea rows="6" class="form-control" name="content"><?php echo ($article["content"]); ?></textarea> -->
                                    <div id="editor-container" class="container">
                                        <!-- <div id="editor-trigger"><p>请输入内容</p></div> -->
                                        <textarea id="editor-trigger" style="display:none;" name="content">
                                            <p><?php echo ($article["content"]); ?></p>
                                        </textarea>
                                    </div>
                                </div>   
                                <div class="form-group">
                                    <label>图片</label>

                                    <div class="fileupload fileupload-exists" data-provides="fileupload"><input type="hidden" value="" name="">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="/jobBook/Public/images/noimg.jpg" alt="">
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 91px;"><img src="<?php echo ($article['image']); ?>" style="max-height: 200px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 选择图片</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> 更换</span>
                                                   <input type="file" class="default" name="photo">
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> 删除</a>
                                            </div>
                                        </div>
                                </div>

                                <center><input type="submit" class="btn btn-mystyle" style="width:150px;" value="修改" name="button"><input type="submit" class="btn btn-danger" style="width:150px;border-radius:30px;margin-left:15px;" value="删除" name="button"></center>
                            </form>
                            <!-- form end -->
                        </div>
                    </section>
                </div>     
            </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/jobBook/Public/js/jquery-1.10.2.min.js"></script>
<script src="/jobBook/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/jobBook/Public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/jobBook/Public/js/bootstrap.min.js"></script>
<script src="/jobBook/Public/js/modernizr.min.js"></script>
<script src="/jobBook/Public/js/jquery.nicescroll.js"></script>
<script src="/jobBook/Public/js/wysihtml5-0.3.0.js"></script>

<!--common scripts for all pages-->
<script src="/jobBook/Public/js/scripts.js"></script>

<!--file upload-->
<script type="text/javascript" src="/jobBook/Public/js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript">
    var type=<?php echo ($article["type"]); ?>;
    var tags=document.getElementsByName("type");
    var classes=document.getElementsByTagName("label");

    if (type==1) {
        tags[0].checked="checked";
        classes[1].className="btn btn-mystyle active";
    }else if (type==2) {
        tags[1].checked="checked";
        classes[2].className="btn btn-mystyle active";
    }else if (type==3) {
        tags[2].checked="checked";
        classes[3].className="btn btn-mystyle active";
    }
</script>
<script type="text/javascript">
        // 阻止输出log
        // wangEditor.config.printLog = false;

        var editor = new wangEditor('editor-trigger');

        // 上传图片
        editor.config.uploadImgUrl = '/upload';
        editor.config.uploadParams = {
            // token1: 'abcde',
            // token2: '12345'
        };
        editor.config.uploadHeaders = {
            // 'Accept' : 'text/x-json'
        }
        // editor.config.uploadImgFileName = 'myFileName';

        // 隐藏网络图片
        // editor.config.hideLinkImg = true;

        // 表情显示项
        editor.config.emotionsShow = 'value';
        var icons={
            icon:[],
            value:[],
        }
        editor.config.emotions = {
            'default': {
                title: '默认',
                data: "/jobBook/Public/emotions.data",
            },
            'weibo': {
                title: '微博表情',
                data: [
                    {
                        icon: 'http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/7a/shenshou_thumb.gif',
                        value: '[草泥马]'    
                    },
                    {
                        icon: 'http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/60/horse2_thumb.gif',
                        value: '[神马]'    
                    },
                    {
                        icon: 'http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/bc/fuyun_thumb.gif',
                        value: '[浮云]'    
                    },
                    {
                        icon: 'http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/c9/geili_thumb.gif',
                        value: '[给力]'    
                    },
                    {
                        icon: 'http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/f2/wg_thumb.gif',
                        value: '[围观]'    
                    },
                    {
                        icon: 'http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/70/vw_thumb.gif',
                        value: '[威武]'
                    }
                ]
            }
        };

        // 插入代码时的默认语言
        // editor.config.codeDefaultLang = 'html'

        // 只粘贴纯文本
        // editor.config.pasteText = true;

        // 跨域上传
        // editor.config.uploadImgUrl = 'http://localhost:8012/upload';

        // 第三方上传
        // editor.config.customUpload = true;

        // 普通菜单配置
        // editor.config.menus = [
        //     'img',
        //     'insertcode',
        //     'eraser',
        //     'fullscreen'
        // ];
        // 只排除某几个菜单（兼容IE低版本，不支持ES5的浏览器），支持ES5的浏览器可直接用 [].map 方法
        // editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
        //     if (item === 'insertcode') {
        //         return null;
        //     }
        //     if (item === 'fullscreen') {
        //         return null;
        //     }
        //     return item;
        // });

        // onchange 事件
        editor.onchange = function () {
            console.log(this.$txt.html());
        };

        // 取消过滤js
        // editor.config.jsFilter = false;

        // 取消粘贴过来
        // editor.config.pasteFilter = false;

        // 设置 z-index
        // editor.config.zindex = 20000;

        // 语言
        // editor.config.lang = wangEditor.langs['en'];

        // 自定义菜单UI
        // editor.UI.menus.bold = {
        //     normal: '<button style="font-size:20px; margin-top:5px;">B</button>',
        //     selected: '.selected'
        // };
        // editor.UI.menus.italic = {
        //     normal: '<button style="font-size:20px; margin-top:5px;">I</button>',
        //     selected: '<button style="font-size:20px; margin-top:5px;"><i>I</i></button>'
        // };
        editor.create();
    </script>


</body>
</html>