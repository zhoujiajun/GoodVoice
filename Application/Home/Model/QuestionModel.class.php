<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class QuestionModel extends Model
{
	//获取所有工作圈
	public function getQuestions($index)
	{
		$data=M('question')->limit($index,10)->order('date desc')->select();
		return $data;
	}

	//根据工作圈，获取评论
	public function gainComments($q_id,$index){
		$where['q_id']=$q_id;
		$data=M('comment')->limit($index,10)->where($where)->order('ask_time desc')->select();
		return $data;
	}

	//计算评论数
	public function countComments($q_id){
		$where['q_id']=$q_id;
		$number = M('comment')->where($where)->count();
		return $number;
	}

	//计算点赞数
	public function countLikes($q_id){
		$where['q_id']=$q_id;
		$number = M('likes')->where($where)->count();
		return $number;
	}

	//获取用户PersonBean
	public function getUserInfo($account){
		$where['account']=$account;
		$userInfo = M('user')->where($where)->select();
		unset($userInfo[0]['login_time']);
		unset($userInfo[0]['id']);
		unset($userInfo[0]['devicetoken']);
		$userInfo[0]['follow']=(int)$this->getFocuses($userInfo[0]['account']);
		$userInfo[0]['fans']=(int)$this->getFans($userInfo[0]['account']);
		$userInfo[0]['moment']=(int)$this->getMoments($userInfo[0]['account']);		
		return $userInfo[0];
	}

	//计算用户发布过的动态数
	public function getMoments($account){
		$where['author']=$account;
		return M('question')->where($where)->count();
	}

	//获取用户的关注人数
	public function getFocuses($account){
		$where['follow']=$account;
		return M('focus')->where($where)->count();
	}

	//获取用户的粉丝人数
	public function getFans($account){
		$where['fans']=$account;
		return M('focus')->where($where)->count();
	}

	public function addQuestion($data){
		$result=M('question')->add($data);
		return $result;
	}

	public function addComment($data){
		$result=M('comment')->add($data);
		return $result;
	}

//获取
	public function getFocusQuestions($index,$myFocus){
		$where['author']=array('in',$myFocus);
		$result = M('question')->where($where)->limit($index,10)->order('date desc')->select();
		return $result;
	}

	//检查某个用户是否点赞某条工作圈
	public function checkLikes($account,$q_id){
		$where['account']=$account;
		$where['q_id']=$q_id;
		$result=M('likes')->where($where)->select();
		return $result;
	}

	//点赞
	public function addLikes($data){
		$result = M('likes')->add($data);
		return $result;
	}

	//取消赞
	public function deleteLikes($account,$q_id){
		$where['account']=$account;
		$where['q_id']=$q_id;
		$result = M('likes')->where($where)->delete();
		return $result;
	}

	public function getMyLikes($account){
		$where['account']=$account;
		$source = M('likes')->where($where)->getField('q_id',true);
		return $source;
	}

	//获取某个人的工作圈
	public function getHis($his){
		$where['author']=$his;
		$source = M('question')->where($where)->select();
		return $source;
	}

	//获取某条工作圈
	public function getOneMoment($q_id){
		$where['q_id']=$q_id;
		$result = M('question')->where($where)->select();
		$result[0]['commentNum']=(int)$this->countComments($q_id);
		$result[0]['likesNum']=(int)$this->countLikes($q_id);
		return $result[0];
	}
}



?>