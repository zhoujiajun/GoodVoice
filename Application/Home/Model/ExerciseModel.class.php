<?php 
namespace Home\Model;
use Think\Model;

class ExerciseModel extends Model
{
	//根据语种显示练习
	public function getExercise($language="",$page){
		$where['release']=1;
		$where['language']=$language;
		$exercises = M('exercise')->where($where)->field(array('e_id','language','title'=>'testname','level'=>'testrank'))->limit(($page-1)*9,9)->select();
		for ($i=0; $i < count($exercises); $i++) { 
			$exercises[$i]['textnum']=$this->quizNumber($exercises[$i]['e_id']);
		}
		return $exercises;
	}

	//计算题量
	public function quizNumber($e_id){
		$where['e_id']=$e_id;
		$result = M('quiz')->where($where)->count();
		return $result;
	}

	//计算对应语种的练习数量
	public function getExNum($language){
		$where['release']=1;
		$where['language']=$language;
		$ex_num = M('exercise')->where($where)->count();
		return $ex_num;
	}

    //记录用户的做题信息
	public function recordQuit($e_id,$user_id){
		$where['e_id']=$e_id;
		$where['u_id']=$user_id;
		$check = M('do_exercise')->where($where)->select();
		if (count($check)==1) {
			//用户重复做练习，不需操作
			return true;
		}else{
			//用户第一次做练习
			$data['u_id']=$user_id;
			$data['e_id']=$e_id;
			$result = M('do_exercise')->add($data);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}
	}

//查询用户做过的练习
	public function haveDone(){
		$where['u_id']=$_SESSION['user_id'];
		$dones = M('do_exercise')->field('e_id')->where($where)->select();
		for ($i=0; $i < count($dones); $i++) { 
			$list[$i]=$dones[$i]['e_id'];
		}
		return $list;
	}


}

?> 