<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\TeacherModel;

class TeacherController extends Controller {
	//教师登录方法
   	public function doLogin(){
   		$username = $_POST['acc'];
   		$password = md5($_POST['psw']);
   		$teacher = new TeacherModel();
   		$result = $teacher->doTeacherLogin($username,$password);
   		if (count($result)==0) {
   			$data=0;
   			$this->ajaxReturn($data);
   		}else{
   			$data=$result[0]['t_name'];
   			$_SESSION['t_name']=$result[0]['t_name'];
   			$_SESSION['t_id']=$result[0]['t_id'];
   			$this->ajaxReturn($data);
   		}
   	}

   	//检查老师登录
   	public function checkLogin(){
   		if (isset($_SESSION['t_name'])) {
   			$data = $_SESSION['t_id'];
   			$this->ajaxReturn($data);
   		}else{
   			$data = 0;
   			$this->ajaxReturn($data);
   		}
   	}

      //获取老师个人信息
      public function getTeacherInfo(){
         $teacher = new TeacherModel();
         $data = $teacher->getTeacher($_POST['id']);
         $back=array(
            'acc'=>$data['t_name'],
            'qq'=>$data['t_qq'],
            'mail'=>$data['email']
            );
         $this->ajaxReturn($back);
      }

      //已完成课程
      public function getClass(){
         $teacher = new TeacherModel();
         $data = $teacher->getClassing();
         //var_dump($data);
         $this->ajaxReturn($data);
      }

      //未完成课程
      public function getUnclass(){
         $teacher = new TeacherModel();
         $data = $teacher->getUnClass();
         //var_dump($data);
         $this->ajaxReturn($data);
      }

      //检查并修改密码
      public function updatePsw(){
         $teacher = new TeacherModel();
         if ($teacher->checkPsw(I("post.pswold"))) {
            if ($teacher->doupdatePsw(I("post.pswnew")) !== false) {
               session_destroy();
               $this->ajaxReturn(1);
            }else{
               $this->ajaxReturn(0);
            }
         }else{
            $this->ajaxReturn(0);
         }
      }

      //修改课程完成度
      public function updateFinish(){
         $where['user_id']=I("post.id");
         $where['c_id']=I("post.c_id");
         $update['finished']=I("post.fclassnum");
         // $where['user_id']=5;
         // $where['t.c_id']=1;
         // $update['finished']=8;
         $teacher = new TeacherModel();
         if ($teacher->doupdateFin($where,$update)) {
            if ($teacher->checkHasFinished($_POST['id'],$_POST['c_id'])) {
               $this->ajaxReturn(1);
            }else{
               $this->ajaxReturn(0);
            }
         }else{
            $this->ajaxReturn(0);
         }
      }

      //老师退出登录
      public function logout(){
         if (session_destroy()) {
            $this->ajaxReturn(1);
         }else{
            $this->ajaxReturn(0);
         }
      }
}