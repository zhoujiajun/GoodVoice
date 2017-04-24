<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\JobinfoModel;
use Home\Model\CominfoModel;
/**
* 就业信息
*/
class JobController extends Controller
{
	//获取推荐岗位
	public function getAll()
	{
		$index=file_get_contents('php://input');
		//$index=0;

		$job = new JobinfoModel();
		$company = new CominfoModel();
		$getSearchResult = $job->getSearch("","",$index);

		/*下面代码对接联系公司*/
		for ($k=0; $k < count($getSearchResult); $k++) { 
			$getSearchResult[$k]['comlogo']=$company->getCompanyIcon($getSearchResult[$k]['companyname']);
		 	//$getSearchResult[$k]['company']=$company->getCompany($getSearchResult[$k]['companyname']);			
		}
		//var_dump($getSearchResult);
		$this->feedback("true",json_encode($getSearchResult));
	}

	//获取某条记录的具体信息
	public function getDetail($job_id,$account=""){
		$job = new JobinfoModel();
		$result = $job->getJobInfo($job_id);

		$company = new CominfoModel();
		$result['company']=$company->getCompany($result['companyname']);
		
        $result['company']['comments']=array();
        unset($result['companyname']);

        if (empty($account)) {
        	$result['ifLike']=0;
        }else{
		    $result['ifLike']=(int)$job->checkLikeJob($account,$job_id);
        }
		//var_dump($result);
		$this->feedback("true",json_encode($result));
	}

	//查询岗位
	public function search($location="",$type=""){
		$index=file_get_contents('php://input');
		//$index=0;

		$job = new JobinfoModel();
		$company = new CominfoModel();
		$getSearchResult = $job->getSearch($location,$type,$index);		

		/*下面代码对接联系公司*/	
		 for ($k=0; $k < count($getSearchResult); $k++) { 
		 	$getSearchResult[$k]['comlogo']=$company->getCompanyIcon($getSearchResult[$k]['companyname']);
		 	//$getSearchResult[$k]['company']=$company->getCompany($getSearchResult[$k]['companyname']);			
		 }
		var_dump($getSearchResult);
		$this->feedback("true",json_encode($getSearchResult));
	}

	public function liked($job_id,$account=""){
		$data=array(
			'user'=>$account,
			'job_id'=>$job_id,
			);
		$result=M('favourite')->add($data);
		
		if ($result) {
			$this->feedback("true","");
		}else{
			$this->feedback("false","");		
		}
		//exit(json_encode($back));
	}

    public function unliked($job_id,$account=""){
    	$where['user']=$account;
    	$where['job_id']=$job_id;
        $result=M('favourite')->where($where)->delete();
        if ($result) {
        	$back['status']="true";
		    $back['response']="";
        }else{
        	$back['status']="false";
		    $back['response']="failed";	
        }
        exit(json_encode($back));
    }

    //数据反馈（公共方法）
	public function feedback($status,$response){
		$back['status']=$status;
		$back['response']=$response;
		exit(json_encode($back));
	}



}