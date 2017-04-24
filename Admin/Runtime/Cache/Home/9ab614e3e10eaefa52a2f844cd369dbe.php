<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>就业板块</title>
  <!--file upload-->
  <link rel="stylesheet" type="text/css" href="/JobBook/Public/css/bootstrap-fileupload.min.css" />  

   <!--tags input-->
  <link rel="stylesheet" type="text/css" href="/JobBook/Public/js/jquery-tags-input/jquery.tagsinput.css" />

  <!--common-->
  <link href="/JobBook/Public/css/style.css" rel="stylesheet">
  <link href="/JobBook/Public/css/style-responsive.css" rel="stylesheet">
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
.btn-delete{
    color: #d9534f;
    background-color: #fafafa;
    border-radius: 20px;
}
  .btn-delete:hover,
.btn-delete:focus,
.btn-delete:active,
.btn-delete.active{
    color: #fff;
    background-color: #d9534f;

}

.user{
    padding: 10px;
}
.user:hover{
    background: #fafafa;
}
.user>img{
    width: 40px;
    height: 40px;
    border-radius: 20px;
}
.user>label{
    font-weight: bold;
    margin: 4px;
}
.user>p{
    margin:10px; 
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
                            修改问题
                        </header>
                        <div class="panel-body">
                            <!-- form start -->
                            <form role="form" method="post" action="/JobBook/admin.php/Home/Question/do_function/q_id/<?php echo ($question["q_id"]); ?>">
                                <div class="form-group">
                                    <label>发布时间</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($question["date"]); ?>" name="title" readonly>
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <label>发布者</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($question["userName"]); ?>" name="author" readonly>
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <label>问题详述</label>
                                    <div class="input">
                                        <textarea rows="6" class="form-control" name="content"><?php echo ($question["content"]); ?></textarea>
                                    </div>
                                </div>
                                <h3>删除回答</h3>
                                <?php if(is_array($comments)): foreach($comments as $key=>$comments): ?><div class="form-group">
                                    <div class="user">
                                        <img src="<?php echo ($comments["head"]); ?>">
                                        <label><?php echo ($comments["username"]); ?></label><a href="/JobBook/admin.php/Home/Question/delete_comment/c_id/<?php echo ($comments["comment_id"]); ?>" type="submit" class="btn btn-delete pull-right"><span class="fa fa-trash-o"></span></a>

                                        <p><?php echo ($comments["content"]); ?></p>
                                    </div>
                                </div><?php endforeach; endif; ?>
                                <!-- <div class="form-group">
                                    <div class="user">
                                        <img src="images/photos/user-avatar.png">
                                        <label>朝旭</label><button type="submit" class="btn btn-delete pull-right"><span class="fa fa-trash-o"></span></button>

                                        <p>我也想知道啊我也想知道啊我也想知道啊我也想知道啊我也想知道啊我也想知道啊我也想知道啊我也想知道啊</p>
                                    </div>
                                </div> -->
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
<script src="/JobBook/Public/js/jquery-1.10.2.min.js"></script>
<script src="/JobBook/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/JobBook/Public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/JobBook/Public/js/bootstrap.min.js"></script>
<script src="/JobBook/Public/js/modernizr.min.js"></script>
<script src="/JobBook/Public/js/jquery.nicescroll.js"></script>

<!--common scripts for all pages-->
<script src="/JobBook/Public/js/scripts.js"></script>

<!--tags input-->
<script src="/JobBook/Public/js/jquery-tags-input/jquery.tagsinput.js"></script>
<script src="/JobBook/Public/js/tagsinput-init.js"></script>

<!--file upload-->
<script type="text/javascript" src="/JobBook/Public/js/bootstrap-fileupload.min.js"></script>



</body>
</html>