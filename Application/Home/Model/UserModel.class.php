<?php 
namespace Home\Model;
use Think\Model;

class UserModel extends Model
{
	public function checkLogin($username,$password)
	{
		$where['username']=$username;
    	$where['password']=$password;
    	$result=M('user')->where($where)->select();
        return $result;
	}

	public function do_basic($email,$qq){
		$where['username']=$_SESSION['username'];
		$update['email']=$email;
		$update['QQ']=$qq;
		$result=M('user')->where($where)->save($update);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	public function do_safe($username,$password){
		$where['username']=$_SESSION['username'];
		$update['username']=$username;
		$update['password']=$password;
		$result=M('user')->where($where)->save($update);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	public function do_psw($username,$newpsw){
		$where['username']=$username;
		$update['password']=$newpsw;
		$result=M('user')->where($where)->save($update);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	public function do_register($data){
		return D('user')->add($data);
	}

	public function do_nickname($nickname){
		$where['username']=$_SESSION['username'];
		$update['nickname']=$nickname;
		$result=M('user')->where($where)->save($update);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	public function getPerson($user_id){
		$where['id']=$user_id;
		$data = M('user')->where($where)->select();
		return $data;
	}

	public function getMyCourses($index){
		$uid=$_SESSION['user_id'];
		$data=M()->table(array('course'=>'c','takes'=>'t','user'=>'u'))->where(array('c.c_id=t.c_id','t.user_id=u.id','t.user_id='.$uid))->limit($index,4)->select();
		return $data;
	}

	public function getCoursesNum(){
		$uid=$_SESSION['user_id'];
		$data=M()->table(array('course'=>'c','takes'=>'t','user'=>'u'))->where(array('c.c_id=t.c_id','t.user_id=u.id','t.user_id='.$uid))->count();
		return $data;
	}

	public function getPassword(){
		$where['username']=$_SESSION['username'];
		$data = M('user')->field('password')->where($where)->select();
		return $data[0]['password'];
	}

	public function checkForgetPsw($data){
		$data = M('user')->where($data)->count();
		return $data;
	}

	public function doAddAdvice($content,$username){
		$data['content']=$content;
		$data['username']=$username;
		$data['time']=date('Y-m-d G:i:s');
		$result = M('advice')->add($data);
		return $result;
	}
}

?> 