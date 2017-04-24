<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\FocusModel;
use Home\Model\QuestionModel;
use Home\Model\CominfoModel;

/**
* 个人类
*/
class PersonController extends Controller
{
	//更新电话号码
	public function updateTel($account,$newTel)
	{
		//$json = file_get_contents('php://input');
		//$sourceData=json_decode($json,true);

		$where['account']=$account;
		$update['telephone']=$newTel;
        $result=M('user')->where($where)->save($update);
        if ($result) {
        	$this->feedback("true",json_encode($this->getPerson($account)));
        }else{
        	$this->feedback("false","Update failed");
        }
	}

    //更新密码
	public function updatepsw($account,$oldpsw,$newpsw){
        $where['account']=$account;
		$where['password']=$oldpsw;
		//var_dump($where);
		$data=M('user')->where($where)->count();
        
        $result=array();
		if ($data==1) {
			$update['password']=$newpsw;
			$result=M('user')->where($where)->save($update);
			if ($result) {
				$this->feedback("true",json_encode($this->getPerson($account)));
			}else{
				$this->feedback("false","Update failed");
			}
		}else{
			$this->feedback("false","password error");
		}
	}

//更新名称
	public function updateName($account,$newName){
		$check['username']=$newName;
		$affected_rows = M('user')->where($check)->count();
		if ($affected_rows!=0) {
			$this->feedback("false","Has Name");
		}else{
			$where['account']=$account;
			$update['username']=$newName;
        	$result=M('user')->where($where)->save($update);
        	if ($result) {
        		//exit($this->getPerson($account));
        		$this->feedback("true",json_encode($this->getPerson($account)));
        	}else{
        		$this->feedback("false","Update failed");
        	}
		}
	}

	public function getPerson($account){
		$where['account']=$account;
		$result=M('user')->where($where)->select();
		unset($result[0]['id']);
		// $result[0]['userName']=$result[0]['username'];
		// unset($result[0]['username']);
		return $result[0];
	}

	public function getPersonBean($account){
		$question = new QuestionModel();
		$data = $question->getUserInfo($account);
		//var_dump($data);
		$this->feedback("true",json_encode($data));
	}

    //查看我的岗位收藏
	public function MyFavourite($account){
		// $index=file_get_contents('php://input');
		//$index=0;		
		$data=M()->table(array('favourite'=>'f','jobinfo'=>'j'))->where(array('f.job_id=j.job_id',"user='$account'"))->field(array('f.job_id','name','companyname','location','time','salary','type'))->select();
		$company = new CominfoModel();

		for ($i=0; $i < count($data); $i++) { 
		// 	$where['name']=$data[$i]['companyname'];
		// 	$temp=M('cominfo')->field('logo')->where($where)->select();
		 	$data[$i]['comlogo']=$company->getCompanyIcon($data[$i]['companyname']);
		}
		var_dump($data);
		$this->feedback("true",json_encode($data));
	}

	//查看我的文章收藏
	public function MyArticle($account){
		$user = new UserModel();
		$data = $user->seeMyArticle($account);
		//var_dump($data);
		$this->feedback("true",json_encode($data));
	}

//关注某人
	public function focus($my,$you){
		$data['follow']=$my;
		$data['fans']=$you;
		$user=new UserModel();
		$check = $user->checkFocus($data);
		if ($check) {
			$this->feedback("false","has focused");
		}else{
			$result = $user->addFocus($data);
			if ($result) {
				$this->sendMessage($my,$you);
				$this->feedback("true","");
			}else{
				$this->feedback("false","focus failed");
			}
		}
	}

	public function sendMessage($my,$you){
		$where['account']=$you;
		$devicetoken = M('user')->where($where)->getField('devicetoken');
		//echo $devicetoken;
		$data = array(
			"type"=>1,
			"accountFrom"=>$my,
			"accountTo"=>$you,
			"event"=>"",
			"time"=>date('Y-m-d'),
			);
		Vendor('AndroidMessage.Demo');
		$demo = new \Demo("588392cbf43e481fb7001e56","azsotoh6owtb40cgzzbde1qqh2jbecjr");
		$d = $demo->sendAndroidUnicast($devicetoken,$data);
		//print($d); 返回数据备用
	}

//取关某人
	public function unfocus($my,$you){
		$user=new UserModel();
		$data['follow']=$my;
		$data['fans']=$you;
		$result = $user->deleteFocus($data);
		if ($result) {
			$this->feedback("true","");
		}else{
			$this->feedback("false","unfocus failed");
		}
	}

//查看我关注的人，my是当前用户
	public function myFocus($account,$my=""){
		$user=new UserModel();
		$source = $user->getMyFocus($account);

		$result = array();
		for ($i=0; $i < count($source); $i++) { 
			$data=$this->getPerson($source[$i]);
			$result[$i]=$data;
			if ($my=="") {
				$result[$i]['type']=1;
			}else{
				$result[$i]['type']=(int)$user->ifLike($my,$source[$i]);
			}
			$result[$i]['fans']=(int)$user->countFans($source[$i]);
			$result[$i]['follow']=(int)$user->countFollow($source[$i]);
		}
		//var_dump($result);
		$this->feedback("true",json_encode($result));
	}

//查看关注我（account）的人，my是当前用户
	public function focusMe($account,$my=""){
		$user=new UserModel();
		$source = $user->getFocusMe($account);

		$result = array();
		for ($i=0; $i < count($source); $i++) { 
			$data=$this->getPerson($source[$i]);
			$result[$i]=$data;
			if ($my=="") {
				$result[$i]['type']=1;
			}else{
				$result[$i]['type']=(int)$user->ifLike($my,$source[$i]);
			}
			$result[$i]['fans']=(int)$user->countFans($source[$i]);
			$result[$i]['follow']=(int)$user->countFollow($source[$i]);
		}
		//var_dump($result);
		$this->feedback("true",json_encode($result));	
	}

/*查看我的消息列表*/
	public function myMessage($account){
		$focus = new FocusModel();
		$focuses = $focus->getFocused($account);
		$likes = $focus->getLikes($account);
		$comments = $focus->getComments($account);
		$alls = array_merge($focuses,$likes,$comments);
		//var_dump($alls);
		rsort($alls);
		for ($i=0; $i < count($alls); $i++) { 
			$alls[$i]['time']=$this->countTime($alls[$i]['time']);
		}
		var_dump($alls);
		$this->feedback("true",json_encode($alls));
	}

	public function test($account){
		$focus = new FocusModel();
		$likes = $focus->getLikes($account);
		var_dump($likes);
	}

/*处理时间的公共方法*/
	public function countTime($date){
		$date=strtotime($date);
		$now=strtotime(date('Y-m-d G:i:s'));
		if (($now-$date)>86400) {
			return date('Y-m-d',$date);
		}else{
			if (($now-$date)>3600) {
				return floor(($now-$date)/3600)."小时前";
			}else{
				if (($now-$date)>60) {
					return ceil(($now-$date)/60)."分钟前";
				}else{
					return "刚刚";
				}				
			}
		}
	}

	//查看我发布的问问
	// public function MyQuestion(){
	// 	/*
	// 	$json=file_get_contents('php://input');
	// 	$sourceData=json_decode($json,true);*/

	// 	$account="李卓洋"; //获取用户的id		
	// 	$where['author']=$account;
	// 	//$data=M('question')->field('q_id')->union(array('field'=>'q_id','table'=>'ask_answer'),true)->select();
	// 	$data=M()->table(array('question'=>'q','ask_answer'=>'a'))->where(array('q.q_id=a.q_id',"author='$account'"))->select();
	// 	var_dump($data);
 //        exit(json_encode($data));
	// }

	public function upload($account){
		//$account="Xu";
		$img=file_get_contents('php://input');    //获取经过编码的密流

        $destination="Public/src/head/".date("Y-m-d")."/";  //根据日期，构建路径名称 
        mkdir($destination);  //创建路径
		$fileName=$destination.time().'_'.mt_rand().".jpg";  //根据时间，构建文件名
		$file=fopen($fileName,"w");   //打开文件，赋予写入权利
		$data=base64_decode($img);   //转码，变回图片
		fwrite($file, $data);   //把图片写入文件
		fclose($file);   //关闭文件
        $fileNewName="http://192.168.8.28/jobBook/".$fileName;  //构建完整文件名
      
        $where['account']=$account;
        $check=M('user')->field(array('head'))->where($where)->select();
        $string=split('/', $check[0]['head']);
        $oldname='Public/src/head/'.$string[7].'/'.$string[8];
        $oldfile=fopen($oldname, "r");
        fclose($oldfile);

        if(unlink($oldfile)){
        	echo "success";
        }else{
        	echo "failed";
        }   //删除旧头像    

        $update['head']=$fileNewName;
        $result=M('user')->where($where)->save($update);
        if ($result) {
        	$back['status']="true";
            $back['response']="";
        }else{
            $back['status']="false";
            $back['response']="Upload failed";
        }
        exit(json_encode($back));
	}

//上传头像
	public function upload2($account){
		$img=file_get_contents('php://input');
		//$img='/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAEAAMADASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+C0RggheQAN2Bj5hv25BGeTz9SCTnqo28kkbiAFBDABsc9ASchcjOMlgByTVjYQGxxkoBywB+/kDB56g5H+0CBuFKIyRkDnOORjnhTjJAP3eob5QMl85FY2bTs207b25tE73urau17Nacyu1Ypena3XXmcdr/AIa7rR2K+0c87WyRjaMNtDg88YLrt5PB4yTgmhdpEgU54Rg20E5DsMkljngH5uu3PJJYGYIwBI25LAA5Xr827ktgcjBPRiwIzkmpFByQGQKGXAwSSSSuRgZ4K4I4wWKnGASNW1TckrNO605ZNPWz32UWnb37O/MJJddNO1++u6tpZ31';
		$data=base64_decode($img);   //转码，变回图片

		$where['account']=$account;
		$check=M('user')->field(array('head'))->where($where)->select();
		if ($check[0]['head']=="http://".C('server_address')."/jobBook/Public/src/head/default.jpg") {
			//用户还没发布过头像
			$destination="Public/src/head/".date("Y-m-d")."/";  //根据日期，构建路径名称 
            mkdir($destination);  //创建路径
		    $fileName=$destination.time().'_'.mt_rand().".jpg";  //根据时间，构建文件名
		    $file=fopen($fileName,"w");   //打开文件，赋予写入权利
		
		    fwrite($file, $data);   //把图片写入文件
		    fclose($file);   //关闭文件

		    $fileNewName="http://".C('server_address')."/jobBook/".$fileName;
            $update['head']=$fileNewName;
            $result=M('user')->where($where)->save($update);
            if ($result) {
                $back['status']="true";
                $back['response']="";
            }else{
                $back['status']="false";
                $back['response']="Upload failed";
            }
		}else{
			//用户已经上传过头像
			$r=split('/', $check[0]['head']);
			$destination='Public/src/head/'.$r[7].'/'.$r[8];
			$file=fopen($destination,"w") or die("Unable to open file!");
			fwrite($file, $data);   //把图片写入文件
		    fclose($file);   //关闭文件
		    $back['status']="true";
            $back['response']="";
		}
		exit(json_encode($back));
	}

//数据反馈（公共方法）
	public function feedback($status,$response){
		$back['status']=$status;
		$back['response']=$response;
		exit(json_encode($back));
	}
/*
	//引进黑名单
	public function addBlack($my,$you){
		$data['blacker']=$my;
		$data['blacked']=$you;
		$result = M('black')->add($data);
		if ($result) {
			exit($this->back("true",""));
		}else{
			exit($this->back("false","添加黑名单失败"));
		}
	}

	//查询黑名单列表
	public function checkBlack($account){
		$where['blacker']=$account;
		$source = M('black')->where($where)->select();
		for ($i=0; $i < count($source); $i++) { 
			$data[$i]=$this->getPerson($source[$i]['blacked']);
		}
		exit($this->back("true",$data));
		//var_dump($data);
	}

	public function deleteBlack($account){
		$data['blacker']=$my;
		$data['blacked']=$you;
		$result = M('black')->where($data)->delete();
		if ($result) {
			exit($this->back("true",""));
		}else{
			exit($this->back("false","取消黑名单失败"));
		}
	}
*/
}

?>