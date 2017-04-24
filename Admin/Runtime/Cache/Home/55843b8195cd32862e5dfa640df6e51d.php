<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Jobook</title>

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="/jobBook/Public/js/morris-chart/morris.css">

  <!--common-->
  <link href="/jobBook/Public/css/style.css" rel="stylesheet">
  <link href="/jobBook/Public/css/style-responsive.css" rel="stylesheet">




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
                <li class="active"><a href="/jobBook/admin.php/Home/index/index"><i class="fa fa-home"></i> <span>主页</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-suitcase"></i> <span>就业板块</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/jobBook/admin.php/Home/job/job_company">上传公司信息</a></li>
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
                            <?php echo ($username); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="/jobBook/admin.php/Home/Index/logout"><i class="fa fa-sign-out"></i>注销</a></li>
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
                <div class="col-md-6">
                <div class="row state-overview">
                    <div class="col-md-6 col-xs-12">
                                 <div class="panel red">
                                        <div class="symbol">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="state-value">
                                           <div class="value"><?php echo ($usernum); ?></div>
                                           <div class="title">注册用户数</div>
                                        </div>
                                 </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                                 <div class="panel blue">
                                        <div class="symbol">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="state-value">
                                           <div class="value"><?php echo ($jobnum); ?></div>
                                           <div class="title">岗位数</div>
                                        </div>
                                 </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                                 <div class="panel purple">
                                        <div class="symbol">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <div class="state-value">
                                           <div class="value"><?php echo ($articlenum); ?></div>
                                           <div class="title">干货数</div>
                                        </div>
                                 </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                                 <div class="panel green">
                                        <div class="symbol">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="state-value">
                                           <div class="value"><?php echo ($quenum); ?></div>
                                           <div class="title">问问数</div>
                                        </div>
                                 </div>
                    </div> 
                </div>
            </div>
            
                <div class="col-md-6">
                    <!--more statistics box start-->
                    <div class="panel deep-purple-box">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <div id="graph-donut" class="revenue-graph"></div>

                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <ul class="bar-legend">
                                        <li><span class="blue"></span> 活跃用户</li>
                                        <li><span class="green"></span> 不活跃用户</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--more statistics box end-->
                </div>
                <div class = "col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">
                                注册用户信息表
                            </header>
                            <div class="panel-body">
                                <div class="adv-table editable-table">
                                    <div class ="clearfix">
                                        <!-- <div class="btn-group">
                                            <button id="editable-sample_new" class="btn btn-primary">
                                                新建用户<i class="fa fa-plus"></i>
                                            </button>
                                        </div> -->
                                    </div>
                                    <table class="table table-striped table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>头像</th>
                                                <th>账号</th>
                                                <th>昵称</th>
                                                <th>登录时间</th>
                                                <th>电话号码</th>
                                                <th>删除</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($users)): foreach($users as $key=>$users): ?><tr class="">                                             
                                                <td><img src="<?php echo ($users["head"]); ?>" style="width:50px;height:50px"></td>
                                                <td><?php echo ($users["account"]); ?></td>
                                                <td><?php echo ($users["username"]); ?></td>
                                                <td><?php echo ($users["login_time"]); ?></td>
                                                <td class="center"><?php echo ($users["telephone"]); ?></td>
                                                <td><a class="delete" href="javascript:;" id="<?php echo ($users["id"]); ?>">删除</a></td>
                                            </tr><?php endforeach; endif; ?>
                                            <!-- <tr class="">
                                                <td><img src="images/bg.png" style="width:50px;height:50px"></td>
                                                <td>18592001235</td>
                                                <td>旗手</td>
                                                <td>2016年9月12日</td>
                                                <td class="center">18592001235</td>
                                                <td><a class="delete" href="javascript:;">删除</a></td>
                                            </tr>
                                            <tr class="">
                                                <td><img src="images/bg.png" style="width:50px;height:50px"></td>
                                                <td>18592001235</td>
                                                <td>fdaskjl</td>
                                                <td>2016年9月12日</td>
                                                <td class="center">18592001235</td>
                                                <td><a class="delete" href="javascript:;">删除</a></td>
                                            </tr>                                            
                                             -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
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


<!--Morris Chart-->
<script src="/jobBook/Public/js/morris-chart/morris.js"></script>
<script src="/jobBook/Public/js/morris-chart/raphael-min.js"></script>

<!--data table-->
<script type="text/javascript" src="/jobBook/Public/js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="/jobBook/Public/js/data-tables/DT_bootstrap.js"></script>

<!--common scripts for all pages-->
<script src="/jobBook/Public/js/scripts.js"></script>

<!--data-->
<!-- <script src="/jobBook/Public/js/home-data.js"></script> -->
<!--script for editable table-->
<script src="/jobBook/Public/js/editable-table.js"></script>
<script>
// Use Morris.Area instead of Morris.Line
Morris.Donut({
    element: 'graph-donut',
    data: [
        {value: <?php echo ($unactive); ?>, label: '不活跃用户', formatted:'<?php echo ($unactive_rate); ?>' },
        {value: <?php echo ($active); ?>, label: '活跃用户', formatted:'<?php echo ($active_rate); ?>'}
    ],
    backgroundColor: false,
    labelColor: '#fff',
    colors: [
        '#4acacb','#6a8bc0'
    ],
    formatter: function (x, data) { return data.formatted; }
});
</script>
<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
</body>
</html>