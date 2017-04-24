<?php 
namespace Home\Model;
use Think\Model;

class QuizModel extends Model
{
	//获取整份练习
	public function getWholeQuiz($e_id){
		$where['e_id']=$e_id;
		$wholeQuiz = M('quiz')->where($where)->select();
		return $wholeQuiz;
	}

//获取某份练习某个大题的小题
	// public function getXiaoti($e_id,$dati){
	// 	$where['e_id']=$e_id;
	// 	$where['dati']=$dati;
	// 	$xiaotis=M('quiz')->field('e_id,dati',true)->where($where)->select();
	// 	return $xiaotis;
	// }

	//查询题目的答案
	public function checkAnswer($e_id){
		$where['e_id']=$e_id;
		$answers = M('quiz')->field('point,answer')->where($where)->select();
        return $answers;
	}

	//获得某个练习的基础信息
	public function getBasicInfo($e_id){
		$where['e_id']=$e_id;
		$source = M('exercise')->where($where)->select();
		$data = $source[0];
		$data['point']=$this->countPoint($e_id);
		$data['quantity']=$this->countQuizs($e_id);
		$data['bignum']=count($this->getDati($e_id));
		return $data;
	}

	//计算分数
	public function countPoint($e_id){
		$where['e_id']=$e_id;
		$result = M('quiz')->where($where)->sum('point');
		if (empty($result)) {
			return 0;
		}else{
			return $result;
		}		
	}

	//计算题量
	public function countQuizs($e_id){
		$where['e_id']=$e_id;
		return M('quiz')->where($where)->count();
	}

	//构造大题号及大题题目
	public function getDati($e_id){
		$where['e_id']=$e_id;
		$result = M('quiz')->field('dati,da_des')->where($where)->group('dati')->select();
		//var_dump($result);
		return $result;
	}

	//获取小题
	public function getXiaoti($e_id,$t_id){
		$where['e_id']=$e_id;
		$where['dati']=$t_id;
		$result = M('quiz')->where($where)->select();
		for ($i=0; $i < count($result); $i++) { 
			$tips = $this->getTips($result[$i]['abcd']);
			$result[$i]['a_ans']=$tips[0];
			$result[$i]['b_ans']=$tips[1];
			$result[$i]['c_ans']=$tips[2];
			$result[$i]['d_ans']=$tips[3];
		}
		return $result;
	}

	//选项拆分
	public function getTips($source){
		$tips = explode(",",$source);
		return $tips;
	}

	//用户得分
	public function chAnswer($e_id,$ans){
		$where['e_id']=$e_id;
		$answers = M('quiz')->field('answer,point')->where($where)->select();
		$point = 0;
		for ($i=0; $i < count($answers); $i++) { 
			if ($answers[$i]['answer']==$ans[$i]) {
				$point+=$answers[$i]['point'];
			}
		}
		return $point;
	}

	//记录用户做题
	public function recordDone($e_id){
		$data['u_id'] = $_SESSION['user_id'];
		$data['e_id'] = $e_id;
		$check = M('do_exercise')->where($data)->select();
		if (count($check)==0) {
			return M('do_exercise')->add($data);
		}else{
			return 1;
		}		
	}
	
}

?> 