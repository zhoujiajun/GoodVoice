<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if (!isset($_SESSION['username'])) {
            $this->error('请先登录',"admin.php/index/login");
           // header('Location:');
        }else{
            $userNum=M('user')->count();
            $jobNum=M('jobinfo')->count();
            $articleNum=M('article')->count();
            $queNum=M('question')->count();
        
            $this->assign("usernum",$userNum);
            $this->assign("jobnum",$jobNum);
            $this->assign("articlenum",$articleNum);
            $this->assign("quenum",$queNum);

            session_start();
            $username=$_SESSION['username'];
            $this->assign("username",$username);

            $active=$this->count_active();
            $unactive=$userNum-$active;
            $format_number = number_format(($active*1.0/$userNum), 3, '.', '');
            $active_rate=($format_number*100)."%";           
            $format_number = number_format(($unactive*1.0/$userNum), 3, '.', '');
            $unactive_rate=($format_number*100)."%";
            $this->assign("active",$active);
            $this->assign("unactive",$unactive);
            $this->assign("active_rate",$active_rate);
            $this->assign("unactive_rate",$unactive_rate);

            $userlist = M('user')->select();
            $this->assign("users",$userlist);

            $this->display();
        }    	
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function delete_user($id){
        $where['id']=$id;
        $result=M('user')->where($where)->delete();
    }

    public function doLogin(){
    	$where['username']=$_POST['username'];
    	$where['password']=md5($_POST['password']);
    	$check=M('admin')->where($where)->select();
    	if (count($check)==0) {
    		$this->error('用户名或密码错误',"login");
    	}else{
    		session_start();
    		$_SESSION['username']=$check[0]['username'];
            $this->success('登录成功',"index");
    		//header('Location:index');
    	}
    }

    public function login(){
    	$this->display();
    }

    public function logout(){
    	session_destroy();
    	header('Location:login');
    }

    public function count_active(){
        $login_times=M('user')->field('login_time')->select();
        $count=0;
        for ($i=0; $i < count($login_times); $i++) { 
            if((strtotime(date('y-m-d'))-strtotime($login_times[$i]['login_time']))<604800){
                $count++;
            }
        }
        return $count;
    }

}