<?php 
namespace Home\Controller;
use Think\Controller;
use Home\Model\TeacherModel;
/**
* 
*/
class TeacherController extends Controller
{
	public function showTeachers(){
		$lan = $_POST['lan'];
		//$lan = "04";
		$page = $_POST['page'];
		//$page = 1;
		$language = $this->getLanguage($lan);
		$teacher=new TeacherModel();
		$data=$teacher->getPageTeacher($language,$page);
		//var_dump($data);
		$this->ajaxReturn($data);
		//$this->display();
	}
	
	public function getUsername(){
		$data['username']=$_SESSION['username'];
		$this->ajaxReturn($data);
	}

	public function getLanguage($lan){
		switch ($lan) {
			case '01':
				return "阿拉伯语";
				break;
			case '02':
				return "印尼语";
				break;
			case '03':
				return "泰语";
				break;
			case '04':
				return "越南语";
				break;
		}
	}
}


?>