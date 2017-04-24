<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>个人简历</title>
<style type="text/css">
*{
    font-family: 微软雅黑;
    margin: 0;
    padding: 0;
}
td{ 
    /* border: 1px solid red ;  */
    padding:8px;
}
table{
    border-collapse: collapse;
}
.title{
    font-size: 20px;
    width: 80px;
    text-align: right;
    color: #457ff4;
    font-weight: lighter;
}
.content{
    font-size: 20px;
    width: 100px;
    text-align: left;
}
#name{
    font-size: 30px;
    font-weight: medium;
}
.header{
    margin-top: 30px;
    margin-left: 8px;
    font-size: 20px;
    color: #457ff4;
    font-weight: lighter;
}
.words{
    font-size: 20px;
    margin-left: 5px;
    color: #000;
}
.grey{
    color: #8F8F8F;
    font-size: 15px;
    margin-left: 10px;
}
.line{
    margin-top: 10px;
}
.head-image{
    margin-left: 50px;
}
.not-head-image{
    margin-left: 25px;
}
.body{
    border: 1px solid red;
}
</style>
</head>
<body>
<div class="body">
    <table>
    	<tr>
    		<td colspan="4" id="name"><?php echo ($source["basicInfo"]["name"]); ?></td>    		
            <td rowspan="3" colspan="2">照片</td>
    	</tr>
        <tr>
            <td class="title">性别</td>
            <td class="content"><?php echo ($source["basicInfo"]["sex"]); ?></td>
            <td class="title">邮箱</td>
            <td class="content"><?php echo ($source["basicInfo"]["email"]); ?></td> 
        </tr>
    	<tr>
            <td class="title">城市</td>
            <td class="content"><?php echo ($source["basicInfo"]["city"]); ?></td>
            <td class="title">电话号码</td>
            <td class="content"><?php echo ($source["basicInfo"]["telephone"]); ?></td>
        </tr>
        <tr>
            <td class="title">残疾类型</td>
            <td class="content"><?php echo ($source["basicInfo"]["disabilitytype"]); ?></td>
            <td class="title">残疾等级</td>
            <td class="content"><?php echo ($source["basicInfo"]["disabilitylevel"]); ?></td>
            <td class="title" style="width:100px">有无残疾证</td>
            <td class="content"><?php echo ($source["basicInfo"]["havedisabilitycard"]); ?></td>
        </tr>
    </table>
    
        <!-- <tr>
            <td colspan="4">期待工作</td>
        </tr>
        <tr>
            <td colspan="2">期待职位</td>
            <td colspan="2"><?php echo ($source["basicInfo"]["expectposition"]); ?></td>
        </tr>
        <tr>
            <td>期待薪水</td>
            <td><?php echo ($source["basicInfo"]["expectsalary"]); ?></td>
            <td>期待工作地点</td>
            <td><?php echo ($source["basicInfo"]["expectlocation"]); ?></td>
        </tr> -->
        <p class="header">教育经历</p>
            <td colspan="4"></td>
        
        <?php if(is_array($education)): $i = 0; $__LIST__ = $education;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$education): $mod = ($i % 2 );++$i;?><p class="line">
                <img src="/jobBook/Public/src/cv/school.png" class="head-image">
                <span class="words"><?php echo ($education['school']); ?></span>
                <img src="/jobBook/Public/src/cv/major.png" class="not-head-image">
                <span class="words"><?php echo ($education['major']); ?></span>
                <span class="grey"><?php echo ($education['admissiondate']); ?>&nbsp;— —&nbsp;<?php echo ($education['graduationdate']); ?></span>
            </p>
            <!-- <tr>
                <td>入学时间</td>
                <td><?php echo ($education['admissiondate']); ?></td>
                <td>毕业时间</td>
                <td><?php echo ($education['graduationdate']); ?></td>
            </tr>
            <tr>
                <td>学校名称</td>
                <td><?php echo ($education['school']); ?></td>
                <td>专业</td>
                <td><?php echo ($education['major']); ?></td>
            </tr> --><?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- <tr>
            <td colspan="4"></td>
        </tr> -->
        <p class="header">工作经历</p>
        
        <?php if(is_array($work)): $i = 0; $__LIST__ = $work;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$work): $mod = ($i % 2 );++$i;?><p class="line">
                <img src="/jobBook/Public/src/cv/company.png" class="head-image">
                <span class="words"><?php echo ($work['company']); ?></span>
                <img src="/jobBook/Public/src/cv/job.png" class="not-head-image">
                <span class="words"><?php echo ($work['position']); ?></span>
                <span class="grey"><?php echo ($work['inaugurationdate']); ?>&nbsp;— —&nbsp;<?php echo ($work['dimissiondate']); ?></span>
            </p><?php endforeach; endif; else: echo "" ;endif; ?>
            <!-- <tr>
                <td>入职时间</td>
                <td><?php echo ($work['inaugurationdate']); ?></td>
                <td>离职时间</td>
                <td><?php echo ($work['dimissiondate']); ?></td>
            </tr>
            <tr>
                <td>公司名称</td>
                <td><?php echo ($work['company']); ?></td>
                <td>岗位</td>
                <td><?php echo ($work['position']); ?></td>
            </tr> -->
        <p class="header">
            <span>期待工作</span>
            <img src="/jobBook/Public/src/cv/location.png" class="head-image">
            <span class="words"><?php echo ($source["basicInfo"]["expectlocation"]); ?></span>
            <img src="/jobBook/Public/src/cv/job.png" class="head-image">
            <span class="words"><?php echo ($source["basicInfo"]["expectposition"]); ?></span>
            <img src="/jobBook/Public/src/cv/money.png" class="head-image">
            <span class="words"><?php echo ($source["basicInfo"]["expectsalary"]); ?></span>
        </p>
    </div>
</body>
</html>