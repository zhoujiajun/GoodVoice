<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 课程体系
*/
class CoursesysController extends Controller
{
	public function getUsername(){
		$data['username']=$_SESSION['username'];
		$this->ajaxReturn($data);
	}
}



?>