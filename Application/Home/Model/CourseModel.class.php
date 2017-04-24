<?php 
namespace Home\Model;
use Think\Model;

class CourseModel extends Model
{
	//根据语种显示老师
	public function getCourse($language="",$level="",$page){
		$where['c_language']=$language;
		$where['level']=$level;
		$index=($page-1)*4;
		$courses = M('course')->where($where)->limit($index,4)->select();
		return $courses;
	}

	public function getCourseCount($language="",$level=""){
		$where['c_language']=$language;
		$where['level']=$level;
		$num = M('course')->where($where)->count();
		return $num;
	}
}

?> 