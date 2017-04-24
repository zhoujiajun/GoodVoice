<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="shortcut icon" href="#" type="/jobBook/Public/image/png">

  <title>就业板块</title>
  <!--file upload-->
  <link rel="stylesheet" type="text/css" href="/jobBook/Public/css/bootstrap-fileupload.min.css" />  

   <!--tags input-->
  <link rel="stylesheet" type="text/css" href="/jobBook/Public/js/jquery-tags-input/jquery.tagsinput.css" />

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
    .result{
        padding-top: 10px;
        display: block;
        list-style: none;
    }
    .result>li>a{
        color: #0a0a0a;
        padding: 12px;
        display: block;
    }
    .result>li>a:hover{
        color: #65CEA7;
        text-decoration: none;
        background: #fafafa;
    }
  </style>

</head>

<body class="sticky-header">

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
                        <h4><a href="/jobBook/admin.php/Home/index/index">卓洋</a></h4>
                    </div>
                </div>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="/jobBook/admin.php/Home/index/logout"><i class="fa fa-sign-out"></i> <span>注销</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li ><a href="/jobBook/admin.php/Home/index/index"><i class="fa fa-home"></i> <span>主页</span></a></li>
                <li class="menu-list nav-active"><a href=""><i class="fa fa-suitcase"></i> <span>就业板块</span></a>
                    <ul class="sub-menu-list">
                        <li class="active"><a href="/jobBook/admin.php/Home/job/job_company">上传公司信息</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_company_search">公司信息修改或删除</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_upload" > 上传岗位信息</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_search"> 岗位信息修改或删除</a></li>
                    </ul>
                </li> 
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>干货板块</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/jobBook/admin.php/Home/article/article_upload"> 上传干货</a></li>
                        <li><a href="/jobBook/admin.php/Home/article/article_search"> 干货修改与删除</a></li>
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
                            上传公司信息
                        </header>
                        <div class="panel-body">
                            <!-- form start -->
                            <form role="form" method="post" action="/jobBook/admin.php/Home/Job/upload_company"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>公司名称</label>
                                    <div class="input">
                                        <input class="form-control" autocomplete="off" data-provide="typeahead" data-source='<?php echo ($companyLists); ?>' name="name"> 
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label>公司介绍</label>
                                    <div class="input">
                                        <textarea rows="4" class="form-control" name="introduction"></textarea>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label>公司邮箱</label>
                                    <div class="input">
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>公司官网网址</label>
                                    <div class="input">
                                        <input type="text" class="form-control" name="website">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>公司地址</label>
                                    <div class="input">
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>公司图片</label>

                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="/jobBook/Public/images/noimg.jpg" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 选择图片</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> 更换</span>
                                                   <input type="file" class="default" name="photo" />
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> 删除</a>
                                            </div>
                                        </div>
                                </div>
                               
                                <div class="form-group">
                                    <label>公司福利</label>
                                    <input type="text"  id="tags_1" class="tags" value="五险一金,绩效奖金,加班补助,餐补" name="welfare">
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>公司规模</label>
                                    <div class="btn btn-group" data-toggle="buttons">
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="scale" value="1-100"> 1-100
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="scale" value="100-500"> 100-500
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="scale" value="500以上"> 500以上
                                    </label>
                                    </div>
                                </div>
                                <center><input type="submit" class="btn btn-mystyle" style="width:150px;"></center>
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

<!-- bootstrap typeahead -->
<script src="/jobBook/Public/js/bootstrap3-typeahead.min.js"></script>

<!--common scripts for all pages-->
<script src="/jobBook/Public/js/scripts.js"></script>

<!--tags input-->
<script src="/jobBook/Public/js/jquery-tags-input/jquery.tagsinput.js"></script>
<script src="/jobBook/Public/js/tagsinput-init.js"></script>

<!--file upload-->
<script type="text/javascript" src="/jobBook/Public/js/bootstrap-fileupload.min.js"></script>

</body>
</html>