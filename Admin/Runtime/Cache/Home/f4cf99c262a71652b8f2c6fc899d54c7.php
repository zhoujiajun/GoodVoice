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
                        <li><a href="/jobBook/admin.php/Home/job/job_company">上传公司信息</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_company_search">公司信息修改或删除</a></li>
                        <li><a href="/jobBook/admin.php/Home/job/job_upload" > 上传岗位信息</a></li>
                        <li class="active"><a href="/jobBook/admin.php/Home/job/job_search"> 岗位信息修改或删除</a></li>
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
                            修改岗位信息
                        </header>
                        <div class="panel-body">
                            <form role="form" method="post" action="/jobBook/admin.php/Home/Job/job_update/job_id/<?php echo ($job["job_id"]); ?>">
                                <div class="form-group">
                                    <!-- <p style="display: none" id="type"><?php echo ($job["type"]); ?></p> 备用-->
                                    <label>职位类别</label>
                                    <div class="btn btn-group" data-toggle="buttons">
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="美工"> 美工
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="客服"> 客服
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="普工"> 普工
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="文员"> 文员
                                    </label>
                                    <label class="btn btn-mystyle">
                                        <input type="radio" autocomplete="off" name="type" value="其他"> 其他
                                    </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>岗位名称</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($job["name"]); ?>" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>薪资</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($job["salary"]); ?>" name="salary">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>工作地点</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($job["location"]); ?>" name="location">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>招聘时间</label>
                                    <div class="input">
                                        <input type="text" class="form-control" value="<?php echo ($job["time"]); ?>" name="time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>岗位职责</label>
                                    <div class="input">
                                        <textarea rows="5" class="form-control" name="responsibilities"><?php echo ($job["responsibilities"]); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>任职要求</label>
                                    <div class="input">
                                        <textarea rows="5" class="form-control" name="requirements"><?php echo ($job["requirements"]); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group has-error">
                                    <label class="control-label" for="inputError2">公司名称</label>
                                    <div class="input">
                                        <input class="form-control" value="<?php echo ($company["name"]); ?>" data-provide="typeahead"
                                        data-source='<?php echo ($companyLists); ?>' autocomplete="off" name="companyname">
                                    </div>
                                </div>
                                <center><input type="submit" class="btn btn-mystyle" style="width:150px;" value="修改" name="button"><input type="submit" class="btn btn-danger" style="width:150px;border-radius:30px;margin-left:15px;" value="删除" name="button"></center>
                            </form>
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
<script type="text/javascript">
    //var type = document.getElementById("type").innerHTML;
    var type = "<?php echo ($job["type"]); ?>";
    //alert(type);
    var tags=document.getElementsByName("type");    
    var classes=document.getElementsByTagName("label");

    if (type=="美工") {
        tags[0].checked="checked";
        classes[1].className="btn btn-mystyle active";
    }else if (type=="客服") {
        tags[1].checked="checked";
        classes[2].className="btn btn-mystyle active";
    }else if (type=="普工") {
        tags[2].checked="checked";
        classes[3].className="btn btn-mystyle active";
    }else if (type=="文员") {
        tags[2].checked="checked";
        classes[4].className="btn btn-mystyle active";
    }else if (type=="其他") {
        tags[2].checked="checked";
        classes[5].className="btn btn-mystyle active";
    }
</script>


</body>
</html>