<?php 
namespace Home\Controller;
use Think\Controller;
use Home\Model\CourseModel;
use Home\Model\TeacherModel;
/**
* 
*/
class CourseController extends Controller
{
	public function getLevel($rank){
		switch ($rank) {
			case '01':
				return "初级";
				break;
			case '02':
				return "中级";
				break;
			case '03':
				return "高级";
				break;
			default:
				return false;
				break;
		}
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
			// 	break;
			default:
				return false;
				break;
		}
	}

	//获取课程信息
	public function getCourse(){
		$rank = $_POST['rank'];
		$level = $this->getLevel($rank);
		$lan = $_POST['lan'];
		$language = $this->getLanguage($lan);
		$page = $_POST['page'];

		$course = new CourseModel();
		$data=$course->getCourse($language,$level,$page);
		$teacher = new TeacherModel();
		for ($i=0; $i < count($data); $i++) { 
			$t = $teacher->getTeacherByName($data[$i]['t_name']);
			$data[$i]['t_head']=$t['t_head'];
			$data[$i]['t_description']=$t['t_description'];
		}
		//var_dump($data);
		$this->ajaxReturn($data,"JSON");
	}

	public function getPages(){
		$level = $this->getLevel($_POST['rank']);
		$language = $this->getLanguage($_POST['lan']);

		$course = new CourseModel();
		$number = $course->getCourseCount($language,$level);
		$data['pagenum']=ceil($number*1.0/4);
		$data['username']=$_SESSION['username'];
		$this->ajaxReturn($data);
	}

	public function showCourses($language,$level){
		
		$this->assign("course",$data);
		var_dump($data);
		//$this->display();
	}

	public function course(){
		//显示课程进入界面
		$this->display();
	}
	
	public function buyclass_french(){
		$this->display();
	}

	public function buyclass_german(){
		$this->display();
	}

	public function buyclass_japanese(){
		$this->display();
	}

	public function buyclass_korean(){
		$this->display();
	}

	public function buyclass_italian(){
		$this->display();
	}

	public function buyclass_portuguese(){
		$this->display();
	}

	public function buyclass_spanish(){
		$this->display();
	}

	public function getUsername(){
		$data['username']=$_SESSION['username'];
		$this->ajaxReturn($data);
	}
}


?>