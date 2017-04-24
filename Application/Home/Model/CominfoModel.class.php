<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class CominfoModel extends Model
{
	public function getCompany($companyname){
		$where['name']=$companyname;
		$tem=M('cominfo')->where($where)->select();
		return $tem[0];
	}

	public function getCompanyIcon($companyname){
		$where['name']=$companyname;
		$comlogo = M('cominfo')->where($where)->getField('comlogo');
		return $comlogo;
	}
}


?>