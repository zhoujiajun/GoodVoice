<?php 
namespace Home\Controller;
use Think\Controller;
use Home\Model\ExerciseModel;
use Home\Model\QuizModel;
/**
* 
*/
class ExerciseController extends Controller
{
	//获取所有练习
	// public function showExercises($language){
	// 	$exercise = new ExerciseModel();		

	// 	$doneLists = $exercise->haveDone();
	// 	$allExercises=$exercise->getExercise($language);
	// 	for ($i=0; $i < count($allExercises); $i++) { 
	// 		if (in_array($allExercises[$i]['e_id'],$doneLists)) {
	// 			//用户已做这份练习
	// 			$allExercises[$i]['done']=1;
	// 		}else{
	// 			$allExercises[$i]['done']=0;
	// 		}
	// 	}
	// 	$this->assign("exercises",$allExercises);
	// 	var_dump($doneLists);
	// 	var_dump($allExercises);
	// 	//$this->display();
	// }
	
	//获取某一份练习
	public function getQuit($e_id){
		$quiz = new QuizModel();
		$wholeQuiz = $quiz->getDati($e_id);
		for ($i=1; $i <= $wholeQuiz[0]['total']; $i++) { 
			$xiaotis=$quiz->getXiaoti($e_id,$i);
			for ($j=0; $j < count($xiaotis); $j++) { 
				if ($xiaotis[$j]['abcd']!="") {
					$choose=explode(",", $xiaotis[$j]['abcd']);
					$xiaotis[$j]['abcd']=$choose;
					//var_dump($choose);
				}
			}
			$questions[$i]=$xiaotis;
		}
		return $questions;
		var_dump($questions);
	}

//记录用户做过的练习
	public function recordQuit($e_id){
		//$_SESSION['user_id']=1;
		$exercise = new ExerciseModel();
		$result = $exercise->recordQuit($e_id,$_SESSION['user_id']);
		if ($result) {
			//处理成功
		}else{
			//处理失败
		}
	}


	//计算分数
	public function getScore($e_id){
		$json = "";
		$key = json_decode($json);
		$quiz = new QuizModel();
		$answers = $quiz->checkAnswer($e_id);
		$point=0;
		for ($i=0; $i < count($answers); $i++) { 
			if ($key[$i]==$answers[$i]['answer']) {
				//回答正确
				$point+=$answers[$i]['point'];
			}
		}
		return $point;
		var_dump($answers);
	}

	//获取所有练习
	public function showExercise(){
		$page=$_POST['page'];
		$language = $this->getLanguage($_POST['lan']);

		$exercise = new ExerciseModel();
		$doneLists = $exercise->haveDone();
		$allExercises=$exercise->getExercise($language,$page);
		
		for ($i=0; $i < count($allExercises); $i++) { 
			if (in_array($allExercises[$i]['e_id'],$doneLists)) {
				//用户已做这份练习
				$allExercises[$i]['done']=1;
			}else{
				$allExercises[$i]['done']=0;
			}
		}
		$this->ajaxReturn($allExercises,"JSON");
		//var_dump($allExercises);
	}

	public function getPages(){
		$language = $this->getLanguage($_POST['lan']);
        $exercise = new ExerciseModel();
        $count = $exercise->getExNum($language);
        $data['pagenum'] = ceil($count*1.0/9);
		$data['acc']=$_SESSION['username'];
		$this->ajaxReturn($data,"JSON");
	}

	public function getLanguage($lan){
		switch ($lan) {
			case '01':
				return "越南语";
				break;
			case '02':
				return "泰语";
				break;
			case '03':
				return "印尼语";
				break;
			case '04':
				return "阿拉伯语";
				break;
			// case '05':
			// 	return "西班牙语";
			// 	break;
			// case '06':
			// 	return "葡萄牙语";
			// 	break;
			// case '07':
			// 	return "意大利语";
				break;
		}
	}

	public function getAcc(){
		$data['username']=$_SESSION['username'];
		$this->ajaxReturn($data);
	}

	//获取练习大题
	public function gainDati(){
		$quiz = new QuizModel();
		$data = $quiz->getBasicInfo(I("post.e_id"));
		$data['dati']=$quiz->getDati(I("post.e_id"));
		//var_dump($data);
		$data['score']=$_SESSION['point'];
		$this->ajaxReturn($data);
	}

	//获取练习小题
	public function gainXiaoti(){
		$quiz = new QuizModel();
		$data=$quiz->getXiaoti(I("post.e_id"),I("post.t_id"));
		$num = I("post.num");
		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['ans_user']=$_SESSION['answer'][$i+$num];
		}
		$this->ajaxReturn($data);
	}

	

	//检查答案
	public function checkAns(){
		$quiz = new QuizModel();
		$data = $quiz->chAnswer(I("post.e_id"),I("post.ans"));
		$do = $quiz->recordDone(I("post.e_id"));
		$_SESSION['point']=$data;
		$_SESSION['answer']=I("post.ans");
		$this->ajaxReturn($do);
	}
}


?>