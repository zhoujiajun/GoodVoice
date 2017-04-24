<?php 
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\TeacherModel;
/**
* 
*/
class UserController extends Controller
{
	//更新基本信息方法
	public function update_basic()
	{
		$qq=$_POST['qq'];
		$email=$_POST['mail'];

		$user=new UserModel();
		if ($user->do_basic($email,$qq)) {
			//更新成功
			$data['qq']=$qq;
			$data['email']=$email;
			// $this->ajaxReturn($data,"JSON");
		}else{
			//更新失败
			$data['qq']=0;
			$data['email']=0;
			// $this->ajaxReturn($data,"JSON");
		}
	}

	//更新安全信息
	public function update_safe(){
		$username=$_POST['acc'];
		$password=md5($_POST['psw']);
		$user=new UserModel();
		if ($user->do_safe($username,$password)) {
			//更新成功
			$_SESSION['username']=$username;
			$data['acc']=$username;
			$data['psw']=$password;
			// $this->ajaxReturn($data,"JSON");
		}else{
			//更新失败
			$data['acc']=0;
			$data['psw']=0;
			// $this->ajaxReturn($data,"JSON");
		}
	}

	//更新昵称方法
	// public function update_nickname()
	// {
	// 	$nickname=$_POST['nickname'];
	// 	$user=new UserModel();
	// 	if ($user->do_nickname($nickname)) {
	// 		//昵称更新成功
	// 	}else{
	// 		//更新失败
	// 	}
		
	// }

	//更新密码方法
	// public function update_password(){
	// 	$oldpsw=$_POST['oldpsw'];
	// 	$username=$_SESSION['username'];
	// 	$user=new UserModel();
	// 	if (($user->checkLogin($username,$oldpsw))==0) {
	// 		//旧密码错误
	// 	}else{
	// 		$newpsw=$_POST['newpsw'];
	// 		if ($user->do_psw($username,$newpsd)) {
	// 			//新密码更新成功
	// 		}else{
	// 			//更新失败
	// 		}
	// 	}
	// }

	//更新头像方法
	public function updateHead(){  
        $update['head']=$this->uploadPic();
		$this->deleteOldPic($_SESSION['user_id']);

        $model=M('user');
        $model->startTrans();
        $where['username']=$_SESSION['username'];
        $line = $model->where($where)->save($update);

        if ($update['head']=="false" || !$line) {
        	//图片上传失败或数据更新失败
        	$model->rollback();
        	//$this->ajaxReturn("false".$update['head'],"JSON");
        }else{
        	$model->commit();       	     	
        	//$this->ajaxReturn($update['head'],"JSON");
        }
	}

	//删除用户旧图片
      public function deleteOldPic($u_id){
         $where['id']=$u_id;
         $data = M('user')->field('head')->where($where)->select();
         $pieces = explode("/",$data[0]['head']);
         $newFile = "D:/wamp/www/".$pieces[3]."/".$pieces[4]."/".$pieces[5]."/".$pieces[6]."/".$pieces[7]."/".$pieces[8];
         unlink($newFile);
      }

//上传图片公共方法
	public function uploadPic(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/';	// 设置附件上传根目录
        $upload->savePath = 'src/userHead/';
        $upload->saveName = 'time';
        $info=$upload->upload();

        if(!$info) {// 上传错误提示错误信息
            return "false";
        }else{// 上传成功 获取上传文件信息
            return "http://".C("server_address")."/EasyTalk/Public/".$info['photo']['savepath'].$info['photo']['savename'];
        }
	}

//获取用户信息
	public function personal(){
		$user=new UserModel();
		// $test['data']=$_POST['id'];

		$personal=$user->getPerson($_POST['id']);
		$data=array(
			'acc'=>$personal[0]['username'],
			'pic'=>$personal[0]['head'],
			'qq'=>$personal[0]['qq'],
			'mail'=>$personal[0]['email'],
			'psw'=>$personal[0]['password'],
			);
		$this->ajaxReturn($data,"JSON");
	}

//获取我的课程
	public function getmyclass(){
		$user = new UserModel();
		$teacher = new TeacherModel();
		$index = ($_POST['page']-1)*4;
		$courses = $user->getMyCourses($index);
		
		for ($i=0; $i < count($courses); $i++) { 
			$teacher_course[$i]=$teacher->getTeacherCourse($courses[$i]['t_name']);
			$courses[$i]['teacher']=$teacher_course[$i];
		}
		//var_dump($courses);
		// $this->assign("courses",$courses);
		// $this->assign("teacher_course",$teacher_course);
		
		$this->ajaxReturn($courses,"JSON");
		//$this->display();
	}

//获取页码
	public function getPages(){
		$user = new UserModel();
		$number = $user->getCoursesNum();
		$data['username']=$_SESSION['username'];
		$data['pagenum']=ceil($number*1.0/4);
		$data['head']=$this->getUserHead();
		$this->ajaxReturn($data,"JSON");
	}

	//检查密码是否错误
    public function checkPassword(){
        $checkpsw = $_POST['mypsw'];
        $user = new UserModel();
        $truepsw = $user->getPassword();
        if (md5($checkpsw)==$truepsw) {
        	//密码正确
        	$data=1;
        	$this->ajaxReturn($data);
        }else{
        	//密码错误
        	$data=0;
        	$this->ajaxReturn($data);
        }
    }

    //获取用户头像
    public function getUserHead(){
    	$user = new UserModel();
    	$user_id = $_SESSION['user_id'];
    	$personal=$user->getPerson($user_id);
    	return $personal[0]['head'];
    }

    //提交意见反馈
    public function personAdvice(){
    	$content = I("post.content");
    	$username = $_SESSION['username'];
    	$user = new UserModel();
    	if ($user->doAddAdvice($content,$username)) {
    		$this->ajaxReturn(1);
    	}else{
    		$this->ajaxReturn(0);
    	}
    }
}


?>