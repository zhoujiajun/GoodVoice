<?php 
namespace Home\Model;
use Think\Model;

class TeacherModel extends Model
{
	//根据语种显示老师
	public function getTeacher($language=""){
		$where['language']=$language;
		$teachers = M('teacher')->where($where)->select();
		return $teachers;
	}

	//根据老师名字查询老师
	public function getTeacherByName($t_name=""){
		$where['t_name']=$t_name;
		$teacher = M('teacher')->where($where)->select();
		return $teacher[0];
	}

	public function getTeacherCourse($t_name){
		$data=M()->table(array('teacher'=>'t','course'=>'c'))->field(array('t.t_name,t_description,t_head'))->where(array('c.t_name=t.t_name','t.t_name="'.$t_name.'"'))->select();
		return $data[0];
	}

	public function getPageTeacher($language,$page){
		$where['t_language']=$language;
		$data = M('teacher')->where($where)->field('t_head,t_description,t_name')->select();
		$result = array();
		$result['pagenum']=ceil(count($data)*1.0/4);
		$index = ($page-1)*4;
		$lines = 0;
		while ($index<count($data) && $lines<4) {
			$result[$lines]=$data[$index];
			$index++;
			$lines++;
		}
		
		return $result;
	}
}

?> 