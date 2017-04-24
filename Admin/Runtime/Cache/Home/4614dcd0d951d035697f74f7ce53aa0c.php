<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>问问板块</title>

  <!--common-->
  <link href="/JobBook/Public/css/style.css" rel="stylesheet">
  <link href="/JobBook/Public/css/style-responsive.css" rel="stylesheet">
  <style>
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



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="/JobBook/admin.php/Home/index/index"><img src="/JobBook/Public/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="/JobBook/admin.php/Home/index/index"><img src="/JobBook/Public/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="/JobBook/Public/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="/JobBook/admin.php/Home/index/index">卓洋</a></h4>
                    </div>
                </div>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="/JobBook/admin.php/Home/index/logout"><i class="fa fa-sign-out"></i> <span>注销</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li ><a href="/JobBook/admin.php/Home/index/index"><i class="fa fa-home"></i> <span>主页</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-suitcase"></i> <span>就业板块</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/JobBook/admin.php/Home/job/job_company">上传公司信息</a></li>
                        <li><a href="/JobBook/admin.php/Home/job/job_company_search">公司信息修改或删除</a></li>
                        <li><a href="/JobBook/admin.php/Home/job/job_upload" > 上传岗位信息</a></li>
                        <li><a href="/JobBook/admin.php/Home/job/job_search"> 岗位信息修改或删除</a></li>

                    </ul>
                </li> 
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>干货板块</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/JobBook/admin.php/Home/article/article_upload"> 上传干货</a></li>
                        <li><a href="/JobBook/admin.php/Home/article/article_search"> 干货修改与删除</a></li>
                    </ul>
                </li>
                <li class="active"><a href="/JobBook/admin.php/Home/question/askask_search"> <i class="fa fa-question"></i> <span>问问修改与删除</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>意见反馈</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/JobBook/admin.php/Home/feedback/hasdeal">已处理</a></li>
                        <li><a href="/JobBook/admin.php/Home/feedback/undeal">待处理</a></li>
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
                            <img src="/JobBook/Public/images/photos/user-avatar.png" alt="" />
                            <?php echo ($_SESSION['username']); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="/JobBook/admin.php/Home/index/logout"><i class="fa fa-sign-out"></i>注销</a></li>
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
                            问问修改与删除
                        </header>
                        <div class="panel-body">
                            <!--search start-->
                            <form action="/JobBook/admin.php/Home/Question/askask_search" method="post" class="col-lg-12">
                                <input type="text" class="form-control" name="keyword" placeholder="输入问题名称..." />
                            </form>
                            <!--search end-->
                                <ul class="result col-lg-12">
                                    <?php if(is_array($questions)): foreach($questions as $key=>$questions): ?><li><a href="/JobBook/admin.php/Home/Question/askask_edit/q_id/<?php echo ($questions['q_id']); ?>"><?php echo ($questions["content"]); ?></a></li><?php endforeach; endif; ?>
                                </ul>
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
<script src="/JobBook/Public/js/jquery-1.10.2.min.js"></script>
<script src="/JobBook/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/JobBook/Public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/JobBook/Public/js/bootstrap.min.js"></script>
<script src="/JobBook/Public/js/modernizr.min.js"></script>
<script src="/JobBook/Public/js/jquery.nicescroll.js"></script>

<!--common scripts for all pages-->
<script src="/JobBook/Public/js/scripts.js"></script>

</body>
</html>