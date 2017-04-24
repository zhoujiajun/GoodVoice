<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class AdminModel extends Model
{
	public function doAdminLogin($username,$password)
	{
		$where['a_name']=$username;
		$where['a_password']=$password;
		$result = M('admin')->where($where)->select();
		return $result;
	}

	public function getUsers(){
		$data = M('user')->field('password,head',true)->select();
		return $data;
	}

	public function getTeachers(){
		$data = M('teacher')->field('t_password,t_description,t_head',true)->select();
		return $data;
	}

	public function getTc($t_id){
		$where['t_id']=$t_id;
		$result = M('teacher')->where($where)->select();
		return $result[0];
	}

	public function getCourses(){
		$data = M('course')->field('c_description',true)->select();
		return $data;
	}

	public function countSales($c_id){
		$where['c_id']=$c_id;
		$count = M('takes')->where($where)->count();
		return $count;
	}

	public function doAddTeacher($data){
		return M('teacher')->add($data);
	}

	public function doUpdateTeacher($t_id,$update){
		$where['t_id']=$t_id;
		$middle = M('teacher')->field('t_name')->where($where)->select();
		$check['t_name']=$middle[0]['t_name'];
		$new['t_name']=$update['t_name'];
		$model = new Model();
		$model->startTrans();
		$line1 = $model->table('teacher')->where($where)->save($update);
		$line2 = $model->table('course')->where($check)->save($new);
		if ($line1 !== false && $line2 !== false) {
			$model->commit();
			return true;
		}else{
			$model->rollback();
			return false;
		}
	}

	public function dodeleteUser($id){
		$where['id']=$id;
		$check['u_id']=$id;
		$condition['user_id']=$id;
		$model = new Model();
		$model->startTrans();
		$line1 = $model->table('user')->where($where)->delete();
		$line2 = $model->table('do_exercise')->where($check)->delete();
		$line3 = $model->table('takes')->where($condition)->delete();
		if ($line1!==false && $line2!==false && $line3!==false) {
			$model->commit();
			return true;
		}else{
			$model->rollback();
			return false;
		}
	}

	public function dodeleteTeacher($t_id){
		$where['t_id']=$t_id;
		$query = M('teacher')->field('t_name')->where($where)->select();
		$t_name = $query[0]['t_name'];
		$condition['t_name']=$t_name;
		$c_ids = M('course')->field('c_id')->where($condition)->select();

		$model = new Model();
		$model->startTrans();
		$line1 = $model->table('course')->where($condition)->delete();
		$line2 = $model->table('teacher')->where($where)->delete();
	
		if ($line1!==false && $line2!==false) {
			$model->commit();
			for ($i=0; $i < count($c_ids); $i++) { 
				$check['c_id']=$c_ids[$i]['c_id'];
				M('takes')->where($check)->delete();
			}
			return true;
		}else{
			$model->rollback();
			return false;
		}
	}

	public function dodeleteCourse($c_id){
		$where['c_id']=$c_id;

		$model = new Model();
		$model->startTrans();
		$line1 = $model->table('course')->where($where)->delete();
		$line2 = $model->table('takes')->where($where)->delete();
		if ($line1!==false && $line2!==false) {
			$model->commit();
			return true;
		}else{
			$model->rollback();
			return false;
		}
	}

	public function deleteUsers($deleteid){
		foreach ($deleteid as $key => $value) {
			if (!$this->dodeleteUser($deleteid[$key])) {
				return false;
			}
		}
		return true;
	}

	public function deleteTeachers($deleteid){
		foreach ($deleteid as $key => $value) {
			if (!$this->dodeleteTeacher($deleteid[$key])) {
				return false;
			}
		}
		return true;
	}

	public function deleteCourses($deleteid){
		foreach ($deleteid as $key => $value) {
			if (!$this->dodeleteCourse($deleteid[$key])) {
				return false;
			}
		}
		return true;
	}

	public function addClass($data){
		return M('course')->add($data);
	}

	public function getTeacher(){
		$data = M('teacher')->field('t_name')->select();
		return $data;
	}

	public function checkAdminPsw($oldpsw){
		$where['a_password']=md5($oldpsw);
		$where['a_name']=$_SESSION['a_name'];
		return M('admin')->where($where)->count();
	}

	public function doUpdateAdminPsw($newpsw){
		$where['a_name']=$_SESSION['a_name'];
		$update['a_password']=md5($newpsw);
		return M('admin')->where($where)->save($update);
	}

	public function getOneCourse($c_id){
		$where['c_id']=$c_id;
		return M('course')->where($where)->select();
	}

	public function doUpdateClass($update,$c_id){
		$where['c_id']=$c_id;
		return M('course')->where($where)->save($update);
	}

	public function gettakes($language,$c_id){
		if ($language!="") {
			$where['c.c_language']=$language;
		}
		if ($c_id!="") {
			$where['c.c_id']=$c_id;
		}
		$where[0]="t.c_id=c.c_id";
		$where[1]="u.id=t.user_id";
		$data = M()->table(array("takes"=>"t","user"=>"u","course"=>"c"))->field('username,c_language,c.c_id,cost,buytime')->where($where)->select();
		return $data;
	}

	public function checkLanguage(){
		//$langs = array("德语","法语","韩语","日语","西班牙语","葡萄牙语","意大利语");
		$langs = array("越南语","泰语","印尼语","阿拉伯语");
		for ($i=0; $i < count($langs); $i++) { 
			$data[$i]['l_name']=$langs[$i];		
			$where['t_language']=$langs[$i];	
			$data[$i]['l_teacher']=M('teacher')->where($where)->count();			
			$data[$i]['primary']=$this->countLevelClass("初级",$langs[$i]);
			$data[$i]['secondary']=$this->countLevelClass("中级",$langs[$i]);
			$data[$i]['advanced']=$this->countLevelClass("高级",$langs[$i]);
		}
		return $data;
	}

	public function countLevelClass($level,$l_name){
		$where['c_language']=$l_name;
		$where['level']=$level;
		return M('course')->where($where)->count();
	}

	public function dodeleteExe($e_id){
		$where['e_id']=$e_id;
		$model = new Model();
		$model->startTrans();
		$line1 = $model->table("quiz")->where($where)->delete();
		$line2 = $model->table("exercise")->where($where)->delete();
		$line3 = $model->table("do_exercise")->where($where)->delete();
		if ($line1!==false && $line2!==false && $line3!==false) {
			$model->commit();
			return 1;
		}else{
			$model->rollback();
			return 0;
		}
	}

	//获取所有小题
	public function getWholeExe($e_id,$dati){
		$where['e_id']=$e_id;
		$where['dati']=$dati;
		$where['xiaoti']=array("gt",0);
		$source = M('quiz')->where($where)->select();
		for ($i=0; $i < count($source); $i++) { 
			$tips = $this->getTips($source[$i]['abcd']);
			$source[$i]['a_ans']=$tips[0];
			$source[$i]['b_ans']=$tips[1];
			$source[$i]['c_ans']=$tips[2];
			$source[$i]['d_ans']=$tips[3];
		}
		return $source;
	}

	//选项拆分
	public function getTips($source){
		$tips = explode(",",$source);
		return $tips;
	}

	//获取练习基本信息
	public function getBasicInfo($e_id){
		$where['e_id']=$e_id;
		$source=m('exercise')->where($where)->select();
		$source[0]['quantity']=$this->countQuizs($e_id);
		$source[0]['points']=$this->countPoint($e_id);
		$source[0]['bigQuiz']=$this->getDati($e_id);
		return $source[0];
	}

	//计算题量
	public function countQuizs($e_id){
		$where['e_id']=$e_id;
		$where['xiaoti']=array("gt",0);
		return M('quiz')->where($where)->count();
	}

	//计算总分
	public function countPoint($e_id){
		$where['e_id']=$e_id;
		$result = M('quiz')->where($where)->sum('point');
		if (empty($result)) {
			return 0;
		}else{
			return $result;
		}		
	}

	//构造大题号及大题题目
	public function getDati($e_id){
		$where['e_id']=$e_id;
		// $tem = M('quiz')->where($where)->select();
		// //var_dump($tem);
		// $result[0]['dati_no'] = $tem[0]['dati'];
		// //echo $result[0]['dati_no'];
		// $result[0]['dati_title'] = $tem[0]['da_title'];
		// $flag = 0;
		// for ($i=1; $i < count($tem); $i++) { 
		// 	if ($tem[$i]['dati']!=$result[$flag]['dati_no']) {
		// 		$flag++;
		// 		$result[$flag]['dati_no']=$tem[$i]['dati'];
		// 		$result[$flag]['dati_title']=$tem[$i]['da_title'];			
		// 	}
		// }
		$result = M('quiz')->field('dati,da_des')->where($where)->group('dati')->select();
		//var_dump($result);
		return $result;
	}

	//发布练习
	public function doReleaseExe($e_id){	
		//把大题标志项全部删去	
		$check['xiaoti']=0;
		$check['e_id']=$e_id;
		M('quiz')->where($check)->delete();

		$where['e_id']=$e_id;
		$update['release']=1;
		$update['re_time']=date('Y-m-d');
		$result = M('exercise')->where($where)->save($update);
		return $result;
	}

	//添加大题
	public function doAddDati($data){
		//记录大题标志项
		$temp = $this->getDati($data['e_id']);
		$datiNum = count($temp);
		$index = $datiNum-1;
		$data['dati']=$temp[$index]["dati"]+1;
		return M('quiz')->add($data);
	}

	//删除大题
	public function dodeleteDati($e_id,$t_id){
		$where['dati']=$t_id;
		$where['e_id']=$e_id;
		return M("quiz")->where($where)->delete();
	}

	//查看大题
	public function doCheckDati($e_id,$t_id){
		$where['dati']=$t_id;
		$where['e_id']=$e_id;
		return M("quiz")->field('da_des')->where($where)->select();
	}

	//修改大题标号
	public function doUpdateDati($where,$update){
		return M('quiz')->where($where)->save($update);
	}

	//添加小题
	public function doAddXiaoti($condition,$data){
		$tmp = M('quiz')->field('e_id,dati,da_des')->where($condition)->select();
		$data['da_des']=$tmp[0]['da_des'];
		$data['dati']=$tmp[0]['dati'];
		$data['e_id']=$tmp[0]['e_id'];
		// $condition['xiaoti']=array("gt",0);
		$temp = M('quiz')->where($condition)->select();
		$index = count($temp)-1;
		$data['xiaoti']=(int)$temp[$index]["xiaoti"]+1;
		return M('quiz')->add($data);
	}

	//查取小题
	public function doCheckXiaoti($e_id,$t_id,$x_id){
		$where=array(
			'e_id'=>$e_id,
			'dati'=>$t_id,
			'xiaoti'=>$x_id,
			);
		$source = M('quiz')->where($where)->select();
		$tips = $this->getTips($source[0]['abcd']);
		$source[0]['a_ans']=$tips[0];
		$source[0]['b_ans']=$tips[1];
		$source[0]['c_ans']=$tips[2];
		$source[0]['d_ans']=$tips[3];
		return $source[0];
	}

	//编辑小题
	public function doUpdateXiaoti($where,$update){
		return M('quiz')->where($where)->save($update);
	}

	//删除小题
	public function dodeleteXiaoti($where){
		return M('quiz')->where($where)->delete();
	}

	//获取导航栏标签
	public function getTags(){
		$data = M('tags')->select();
		return $data[0];
	}


	//修改导航栏标签
	public function do_tags($data){
		$model = new Model;
		$where['tag']=1;
		$model->startTrans();
		$line1 = $model->table('tags')->where($where)->delete();
		$line2 = $model->table('tags')->add($data);
		if ($line2!==false && $line1!==false) {
			$model->commit();
			return true;
		}else{
			$model->rollback();
			return false;
		}
	}

	//获得首页图片
	public function getIndexpic(){
		$pic = M('indexpic')->select();
		for ($i=0; $i < count($pic); $i++) { 
			$data['p_'.($i+1)]=$pic[$i]['pic'];
		}
		return $data;
	}

	//更新图片
	public function refreshIndexPic($head,$num){
		$where['num']=$num;
		$update['pic']=$head;
		$result = M('indexpic')->where($where)->save($update);
		return $result;
	}

	//删除图片
	public function delIndexPic($number){
		$where['num']=$number;
		$update['pic']="";
		$result = M('indexpic')->where($where)->save($update);
		return $result;
	}
}
?>