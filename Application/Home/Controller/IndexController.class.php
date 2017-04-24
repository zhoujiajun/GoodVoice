<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;

class IndexController extends Controller {

    //主页
    public function index(){
       $this->display();
       // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    //登录方法
    public function do_login(){
        $username=$_POST['acc'];
        $password=md5($_POST['psw']);

        $user=new UserModel();
        $result=$user->checkLogin($username,$password);
        if (count($result)==1) {  
            $data['acc']=$result[0]['username'];
            $data['id']=$result[0]['id'];
            $_SESSION['user_id']=$result[0]['id'];
            $_SESSION['username']=$result[0]['username'];

            //$this->ajaxReturn($data,"登录成功！",1);
            $this->ajaxReturn($data,"JSON");
        }else{
            $data['acc']=0;
            $data['id']=0;
            $this->ajaxReturn($data,"JSON");
        }
    }

    //注册方法
    public function register(){
        $data['username']=$_POST['acc'];
        $data['password']=md5($_POST['psw']);
        $data['email']=$_POST['mail'];
        $data['QQ']=$_POST['qq'];
        $data['head']="http://".C('server_address')."/EasyTalk/Public/src/userHead/default.jpg";
        $data['register_time']=date('Y-m-d G:i:s');

        $user=new UserModel();
        if($id=$user->do_register($data)){
            $_SESSION['username']=$_POST['acc'];
            $_SESSION['user_id']=$id;
            $data['acc']=$_POST['acc'];
            $data['id']=$id;
            $this->ajaxReturn($data,"JSON");
        }else{
            $data['acc']=0;
            $data['id']=0;
            $this->ajaxReturn($data,"JSON");
        }
    }

    //检查是否被注册
    public function checkUser(){
        $where['username']=$_POST['acc'];
        $check=M('user')->where($where)->select();
        if (count($check)==1) {
            $data=0;
            $this->ajaxReturn($data);
        }else{
            $data=1;
            $this->ajaxReturn($data);
        }
    }

    //检测是否已登录
    public function checkHasLogin(){
        if (isset($_SESSION['username'])) {
            $data=$_SESSION['user_id'];
            $this->ajaxReturn($data);
        }else{
            $data=0;
            $this->ajaxReturn($data);
        }
    }

    //退出登录
    public function logout(){
        if (session_destroy()) {
            $data=1;
        }else{
            $data=0;
        }
        $this->ajaxReturn($data);
    }

    //获取用户昵称
    public function getAcc(){
        $data['acc']=$_SESSION['username'];
        $this->ajaxReturn($data);
    }

    //忘记密码验证
    public function verify(){
        $data = array(
            'username'=>$_POST['acc'],
            'QQ'=>$_POST['qq'],
            'email'=>$_POST['mail'],
            );
        $user=new UserModel();
        $check = $user->checkForgetPsw($data);
        if ($check==0) {
            $this->ajaxReturn($check);
        }else{
            $result = $user->do_psw($_POST['acc'],md5($_POST['newpsw']));
            if ($result) {
                $this->ajaxReturn("1");
            }else{
                $this->ajaxReturn("00");
            }
        }
        
    }

    //输出导航栏
    public function showGuide(){
        $tags = M('tags')->select();
        $this->ajaxReturn($tags[0]);
    }

    //输出首页图片
    public function showIndexPic(){
        $pictures = M('indexpic')->select();
        $this->ajaxReturn($pictures[0]);
    }

}