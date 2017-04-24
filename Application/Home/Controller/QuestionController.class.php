<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\QuestionModel;
use Home\Model\UserModel;
/**
* 问问
*/
class QuestionController extends Controller
{
	//发布工作圈
	public function releaseQuestion()
	{
		//$json='{"author":{"account":"888","favourite":[],"password":"0a113ef6b61820daa5611c870ed8d5ee","telephone":"","textCVs":[],"userName":"Raymond","videoCVs":[]},"commentnum":0,"content":"888","q_id":0,"title":"888"}';
		$json=file_get_contents('php://input');
		$sourceData=json_decode($json,true);

        $date=date('Y-m-d G:i:s');
		$data=array(
			'author'=>$sourceData['author']['account'],
			'content'=>$sourceData['content'],
			'date'=>$date,			
			);
		
		$question = new QuestionModel();
		if ($question->addQuestion($data)) {
			$this->feedback("true","");
		}else{
			$this->feedback("false","Release Failed");	
		}
	}

    //获得广场的工作圈
	public function allQuestions($account=""){ 
		$index=file_get_contents('php://input');
		
		//$index=4;
		$question = new QuestionModel();
		$data = $question->getQuestions($index);
		$likes = $question->getMyLikes($account);
		$data = $this->dealQuestion($account,$data,$likes);
		
        // for ($i=0; $i < count($data); $i++) { 
        // 	$data[$i]['date']=$this->countTime($data[$i]['date']);
        // 	$data[$i]['commentNum']=(int)$question->countComments($data[$i]['q_id']);
        // 	$data[$i]['likesNum']=(int)$question->countLikes($data[$i]['q_id']);
        // 	$data[$i]['author']=$question->getUserInfo($data[$i]['author']);
        // 	if (in_array($data[$i]['q_id'],$likes)) {
        // 		$data[$i]['ifLike']=1;
        // 	}else{
        // 		$data[$i]['ifLike']=0;
        // 	}
        // }
		//var_dump($data);
		$this->feedback("true",json_encode($data));
	}

	//获得关注的工作圈
	public function focusQuestion($account=""){
		$index=file_get_contents('php://input');
		//$index=0;
		if ($account=="") {
			$this->feedback("false","please login");
		}else{

			$user = new UserModel();
			$myFocus = $user->getMyFocus($account);
			if(count($myFocus)==0){
				$data = array();
				$this->feedback("true",json_encode($data));
			}else{
				$question = new QuestionModel();
				$data = $question->getFocusQuestions($index,$myFocus);
				$likes = $question->getMyLikes($account);
				$data = $this->dealQuestion($account,$data,$likes);

			// for ($i=0; $i < count($data); $i++) { 
   //      		$data[$i]['date']=$this->countTime($data[$i]['date']);
   //      		$data[$i]['commentNum']=(int)$question->countComments($data[$i]['q_id']);
   //      		$data[$i]['likesNum']=(int)$question->countLikes($data[$i]['q_id']);
   //      		$data[$i]['author']=$question->getUserInfo($data[$i]['author']);
   //      		if (in_array($data[$i]['q_id'],$likes)) {
   //      			$data[$i]['ifLike']=1;
   //      		}else{
   //      			$data[$i]['ifLike']=0;
   //      		}
   //     		}
       		//var_dump($data);
				$this->feedback("true",json_encode($data));
			}
		}
	}

	//获得某条工作圈
	public function getSingleMoment($q_id,$account){
		$question = new QuestionModel();
		$data = $question->getOneMoment($q_id);
		$data['date']=$this->countTime($data['date']);
		$temporary = $question->getMyLikes($account);
		$data['author']=$question->getUserInfo($data['author']);
		if (in_array($q_id,$temporary)) {
			$data['ifLike']=1;
		}else{
			$data['ifLike']=0;
		}
		// var_dump($temporary);
		//var_dump($data);
		$this->feedback("true",json_encode($data));
	}

	//得到某个人的工作圈
	public function getHisQuestion($his,$my=""){
		$question = new QuestionModel();
		$source = $question->getHis($his);
		$likes = $question->getMyLikes($my);
		
		// for ($i=0; $i < count($source); $i++) {
		//  	$source[$i]['date']=$this->countTime($source[$i]['date']);
		// 	$source[$i]['commentNum']=(int)$question->countComments($source[$i]['q_id']);
		// 	$source[$i]['likesNum']=(int)$question->countLikes($source[$i]['q_id']);
		// 	$source[$i]['author']=$question->getUserInfo($source[$i]['author']);
		// 	if (in_array($source[$i]['q_id'],$likes)) {
  //       		$source[$i]['ifLike']=1;
  //       	}else{
  //       		$source[$i]['ifLike']=0;
  //       	}
		// }
		$data = $this->dealQuestion($source,$likes);
		//var_dump($data);
		$this->feedback("true",json_encode($data));
	}

	//处理工作圈
	public function dealQuestion($account,$source,$likes){
		$question = new QuestionModel();
		$user = new UserModel();
		for ($i=0; $i < count($source); $i++) {
		 	$source[$i]['date']=$this->countTime($source[$i]['date']);
			$source[$i]['commentNum']=(int)$question->countComments($source[$i]['q_id']);
			$source[$i]['likesNum']=(int)$question->countLikes($source[$i]['q_id']);
			$source[$i]['author']=$question->getUserInfo($source[$i]['author']);
			$source[$i]['author']['type']=(int)$user->ifLike($account,$source[$i]['author']['account']);
			if (in_array($source[$i]['q_id'],$likes)) {
        		$source[$i]['ifLike']=1;
        	}else{
        		$source[$i]['ifLike']=0;
        	}
		}
		return $source;
	}

	//计算当前时间与发表时间的差（公共方法）
	public function countTime($date){
		$date=strtotime($date);
		$now=strtotime(date('Y-m-d G:i:s'));
		if (($now-$date)>86400) {
			return date('Y-m-d',$date);
		}else{
			if (($now-$date)>3600) {
				return floor(($now-$date)/3600)."小时前";
			}else{
				if (($now-$date)>60) {
					return ceil(($now-$date)/60)."分钟前";
				}else{
					return "刚刚";
				}				
			}
		}
	}

    //得到某个工作圈的评论
	public function getComments($q_id){	
		$index=file_get_contents('php://input');
		//$index=0;
		$question = new QuestionModel();
		$comments = $question->gainComments($q_id,$index);
        
        for ($i=0; $i < count($comments); $i++) { 
        	$comments[$i]['ask_time']=$this->countTime($comments[$i]['ask_time']);
        	$comments[$i]['applier']=$question->getUserInfo($comments[$i]['applier']);
        }   
       // var_dump($comments);
        $this->feedback("true",json_encode($comments));
	}

    //添加评论
	public function comment(){
		$json=file_get_contents('php://input');
		//$json='{"applier":{"account":"888","favourite":[],"password":"0a113ef6b61820daa5611c870ed8d5ee","telephone":"","textCVs":[],"userName":"Raymond","videoCVs":[]},"bad":0,"comment_id":0,"content":"qishou111","good":0,"q_id":2}';
		$data['words']=$json;
		M('temporary')->add($data);
		$sourceData=json_decode($json,true);

		$ask_time=date('Y-m-d G:i:s');
		$data=array(
			'q_id'=>$sourceData['q_id'],
			'content'=>$sourceData['content'],
			'ask_time'=>$ask_time,
			'applier'=>$sourceData['applier']['account'],
			);
		
		$question = new QuestionModel();
		if ($question->addComment($data)) {
		    $this->feedback("true",json_encode($this->getSingleMoment($data['q_id'],$data['applier'])));
		}else{
		    $this->feedback("false","fail to comment");
		}
	}

	//点赞工作圈
	public function likesQuestion($account,$q_id){
		$question = new QuestionModel();
		$check = $question->checkLikes($account,$q_id);
		if (count($check)==0) {
			$data=array(
				'account'=>$account,
				'q_id'=>$q_id,
			);
			if ($question->addLikes($data)) {
				$this->sendMessage($account,$q_id);
				$this->feedback("true",json_encode($this->getSingleMoment($q_id,$account)));
			}else{
				$this->feedback("false","fail to likes");
			}
		}else{
			$this->feedback("false","has liked");
		}
	}

	public function sendMessage($my,$q_id){
		$check['q_id']=$q_id;
		$you = M('question')->where($check)->getField('author');
		$where['account']=$you;
		$devicetoken = M('user')->where($where)->getField('devicetoken');
		//echo $devicetoken;
		$data = array(
			"type"=>2,
			"accountFrom"=>$my,
			"accountTo"=>$you,
			"event"=>$q_id,
			"time"=>date('Y-m-d'),
			);
		Vendor('AndroidMessage.Demo');
		$demo = new \Demo("588392cbf43e481fb7001e56","azsotoh6owtb40cgzzbde1qqh2jbecjr");
		$d = $demo->sendAndroidUnicast($devicetoken,$data);
		//print($d); 返回数据备用
	}

	//取消赞工作圈
	public function unlikeQuestion($account,$q_id){
		$question = new QuestionModel();
		$check = $question->deleteLikes($account,$q_id);
		if ($check) {
			$this->feedback("true",json_encode($this->getSingleMoment($q_id,$account)));
		}else{
			$this->feedback("false","unlike failed");
		}
	}

    //数据反馈（公共方法）
	public function feedback($status,$response){
		$back['status']=$status;
		$back['response']=$response;
		exit(json_encode($back));
	}

	// public function deal($comment_id,$account){
	// 	$check['account']=$account;
	// 	$cr=M('good')->where($check)->count();
	// 	if ($cr==0) {
	// 		$data=array(
	// 			'account'=>$account,
	// 			'comment_id'=>$comment_id,
	// 			);
	// 		$result=M('good')->add($data);
	// 		if ($result) {
	// 			$back['status']="true";
	// 	    	$back['response']="";
	// 		}else{
	// 			$back['status']="false";
	// 	    	$back['response']="fail to update";
	// 		}
	// 	}else{
	// 		$hasgood=M('good')->field('comment_id')->where($check)->select();
	// 		$hasarray=explode(",", $hasgood[0]['comment_id']);
	// 		if (in_array($comment_id,$hasarray)) {
	// 			$back['status']="false";
	// 	    	$back['response']="has opinions";
	// 		}else{
	// 			$newOpinions=$hasgood[0]['comment_id'].",$comment_id";
	// 			$update_comment['comment_id']=$newOpinions;
	// 			$where['comment_id']=$comment_id;
	// 			$goodNum = M('ask_answer')->field('good')->where($where)->select();
	// 			$update_num['good']=$goodNum[0]['good']+1;

	// 			$model = new Model();
	// 			$model->startTrans();
	// 			$line1 = $model->table('good')->where($check)->save($update_comment);
	// 			$line2 = $model->table('ask_answer')->where($where)->save($update_num);
	// 			if ($line1 && $line2) {
	// 				$model->commit();
	// 				$back['status']="true";
	// 	    		$back['response']="";
	// 			}else{
	// 				$model->rollback();
	// 				$back['status']="false";
	// 	    		$back['response']="fail to update";
	// 			}
	// 		}
	// 	}
	// 	exit(json_encode($back));
	// }

}