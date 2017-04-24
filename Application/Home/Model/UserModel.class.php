<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class UserModel extends Model
{
	//查询所有我关注的人
	public function getMyFocus($account){
		$where['follow']=$account;
		$focusedLists = M('focus')->where($where)->getField('fans',true);
		// for ($i=0; $i < count($focusedLists); $i++) { 
		// 	$lists[$i]=$focusedLists[$i]['fans'];
		// }
		return $focusedLists;
	}

	//查看所有关注我的人
	public function getFocusMe($account){
		$where['fans']=$account;
		$focusedLists = M('focus')->where($where)->getField('follow',true);
		// for ($i=0; $i < count($focusedLists); $i++) { 
		// 	$lists[$i]=$focusedLists[$i]['follow'];
		// }
		return $focusedLists;
	}

	//添加关注
	public function addFocus($data){
		$result = M('focus')->add($data);
		return $result;
	}

	//取消关注
	public function deleteFocus($data){
		$result = M('focus')->where($data)->delete();
		return $result;
	}

	//检查是否关注
	public function checkFocus($data){
		$result = M('focus')->where($data)->count();
		return $result;
	}

	//忘记密码验证
	public function checkForgetPsw($data){
		$check = M('user')->where($data)->count();
		return $check;
	}

	//查看我的文章收藏
	public function seeMyArticle($account){				
		$where['user']=$account;
		/*$where[0]="a.article_id=l.article_id";
		$source = M()->table(array("article"=>"a","likearticle"=>"l"))->where($where)->select();*/
		$source = M()->table(array("article"=>"a","likearticle"=>"l"))->where(array('a.article_id=l.article_id','l.user='.$account))->select();
		return $source;
	}

	//查询是否互粉
	public function ifLike($my,$his){
		if ($my==$his) {
			/*查看自己*/
			return 1;
		}else{
			$where['follow']=$my;
			$where['fans']=$his;
			$result = M('focus')->where($where)->select();
			if (count($result)==1) {
				/*已关注*/
				return 0;
			}else{
				return 1;
			}
		}
	}

	//计数：粉丝数
	public function countFans($account){
		$where['fans']=$account;
		return M('focus')->where($where)->count();
	}

	//计数：关注数
	public function countFollow($account){
		$where['follow']=$account;
		return M('focus')->where($where)->count();
	}
}

?>