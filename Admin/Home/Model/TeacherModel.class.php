<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class TeacherModel extends Model
{
	public function doTeacherLogin($username,$password)
	{
		$where['t_name']=$username;
		$where['t_password']=$password;
		$result = M('teacher')->where($where)->select();
		return $result;
	}

	public function getTeacher($t_id){
		$where['t_id']=$t_id;
		$result = M('teacher')->where($where)->select();
		return $result[0];
	}

	public function getClassing(){
		$where[0]="c.c_id=t.c_id";
		$where[1]="t.user_id=u.id";
		$where['t_name']=$_SESSION['t_name'];
		$where[2]="finished=c_credit";
		$data = M()->table(array('course'=>'c','takes'=>'t','user'=>'u'))->field('c.c_id,c_title,c_language,level,username,buytime,finishtime')->where($where)->select();
		return $data;
	}

	public function getUnClass(){
		$where[0]="c.c_id=t.c_id";
		$where[1]="t.user_id=u.id";
		$where['t_name']=$_SESSION['t_name'];
		$where[2]="finished<c_credit";
		$data = M()->table(array('course'=>'c','takes'=>'t','user'=>'u'))->field('id,c.c_id,c_title,c_language,level,username,c_credit,finished')->where($where)->select();
		return $data;
	}

	public function checkPsw($oldpsw){
		$where['t_name']=$_SESSION['t_name'];
		$where['t_password']=md5($oldpsw);
		return M('teacher')->where($where)->count();
	}

	public function doupdatePsw($newpsw){
		$where['t_name']=$_SESSION['t_name'];
		$update['t_password']=md5($newpsw);
		return M('teacher')->where($where)->save($update);
	}

	public function doupdateFin($where,$update){
		return M()->table(array('takes'=>'t'))->where($where)->save($update);
	}

	public function checkHasFinished($u_id,$c_id){
		$where['user_id']=$u_id;
		$where['t.c_id']=$c_id;
		$where[0]="c.c_id=t.c_id";
		$data = M()->table(array('takes'=>'t','course'=>'c'))->field('finished,c_credit')->where($where)->select();
		if ($data[0]['finished']==$data[0]['c_credit']) {
			$update['finishtime']=date('Y-m-d G:i:s');
			unset($where[0]);
			return M()->table(array('takes'=>'t'))->where($where)->save($update);
		}else{
			return true;
		}
	}
}
?>