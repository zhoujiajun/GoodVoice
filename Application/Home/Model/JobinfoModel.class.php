<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class JobinfoModel extends Model
{
	public function getSearch($location,$type,$index)
	{
		// $type="";
		// $location="";
		if ($location!="") {
			$where['location']=array('like',array('%'.$location.'%'));
		}else if ($type!="") {
			$where['type']=$type;
		}
				
		$data=M('jobinfo')->where($where)->field('responsibilities,requirements',true)->limit($index,10)->select();
		return $data;
	}

	public function getJobInfo($job_id){
		$where['job_id']=$job_id;
		$data=M('jobinfo')->where($where)->select();
		return $data[0];
	}

	public function checkLikeJob($account,$job_id){
		$where['user']=$account;
		$where['job_id']=$job_id;
		$r=M('favourite')->where($where)->count();
		return $r;
	}
}


?>