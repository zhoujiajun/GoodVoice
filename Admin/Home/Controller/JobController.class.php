<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
/**
* 工作发布
*/

class JobController extends Controller
{

//岗位修改界面
	public function job_edit($job_id="")
	{
		$where['job_id']=$job_id;
		$job=M('jobinfo')->where($where)->select();
		$check['name']=$job[0]['companyname'];
		$company=M('cominfo')->where($check)->select();

		$this->assign("job",$job[0]);
		//var_dump($job[0]['type']);
		$this->assign("company",$company[0]);
		$this->assign("companyLists",$this->get_company_lists());
		$this->display();
	}

//岗位搜索
	public function job_search(){
		$keyword=$_POST['keyword'];
		if ($keyword=="") {
			$jobs=M('jobinfo')->field(array('job_id','companyName','name'))->select();
		}else{
			$where['_logic']='or';
			$where['name']=array('like',array('%'.$keyword.'%')); 
			$where['companyName']=array('like',array('%'.$keyword.'%'));
			$jobs=M('jobinfo')->where($where)->field(array('job_id','companyName','name'))->select();
		}

		$this->assign("jobs",$jobs);
		$this->display();
	}

//上传岗位(填写公司名)
	public function job_upload(){
		/*$companyLists=$this->get_company_lists();
		
		$this->assign("companyLists",$companyLists);
		$this->display();*/
		$this->job_company();
	}

//上传公司
	public function job_company(){
		$companyLists=$this->get_company_lists();
		$this->assign("companyLists",$companyLists);
		$this->display();
	}

//上传岗位
	public function job_upload_detail(){
		$check['name']=$_POST['name'];
		$result=M('cominfo')->where($check)->select();
		if (count($result)==1) {
			$this->assign("companyname",$_POST['name']);
			$this->display();
		}else{
			header('Location:job_company');
		}
	}

//操作岗位上传
	public function do_job_upload($companyname){
		if (($_POST['name']!="") && ($_POST['salary']!="") && ($_POST['requirements']!="") && ($_POST['responsibilities']!="") 
			&& ($_POST['location']!="") && ($_POST['time']!="") && ($_POST['type']!="") ) {
			$data=array(
				'name'=>$_POST['name'],
				'salary'=>$_POST['salary'],
				'companyName'=>$companyname,
				'location'=>$_POST['location'],
				'time'=>$_POST['time'],
				'responsibilities'=>$_POST['responsibilities'],
				'requirements'=>$_POST['requirements'],
				'type'=>$_POST['type'],
			);
		    M('jobinfo')->add($data);
		    $this->success('上传成功','../../job_upload');
		    //header('Location:../../job_upload');
		}else{
			$this->error('请填写完整');
			//header('Location:../../../error/WentWrong');
		}
			
	}

//操作岗位修改和删除
	public function job_update($job_id=""){
		$where['job_id']=$job_id;
		if ($_POST['button']=="删除") {
			$model=new Model();
			$model->startTrans();
			$line1 = $model->table('jobinfo')->where($where)->delete();
			$line2 = $model->table('favourite')->where($where)->delete();

			if ($line1 !== false && $line2 !== false) {
				$model->commit();
				$this->success('删除成功','../../job_search');
				//header('Location:../../job_search');
			}else{
				$model->rollback();
				$this->error('删除失败',"../../job_edit?job_id=".$job_id);
				//header('Location:../../job_edit?job_id='.$job_id);
			}
		}else if ($_POST['button']=="修改") {
			if (($_POST['name']!="") && ($_POST['salary']!="") && ($_POST['requirements']!="") && 
				($_POST['responsibilities']!="") && ($_POST['location']!="") && ($_POST['companyname']!="") && 
				($_POST['time']!="") && ($_POST['type']!="")) {
        		$check['name']=$_POST['companyname'];
        	    $see=M('cominfo')->where($check)->select();
        	    if (count($see)==1) {
        	    	$update=array(
        	    		'name'=>$_POST['name'],
        	    		'salary'=>$_POST['salary'],
        	    		'companyName'=>$_POST['companyname'],
        	    		'location'=>$_POST['location'],
        	    		'responsibilities'=>$_POST['responsibilities'],
        	    		'requirements'=>$_POST['requirements'],
        	    		'time'=>$_POST['time'],
        	    		'type'=>$_POST['type'],
        	    	);
        	    	M('jobinfo')->where($where)->save($update);
        	    	$this->success("修改成功","../../job_search");
        	    	//header('Location:../../job_search');
        	    }else{
        	    	$this->error("公司不存在，请先上传","../../job_company");
        	    	//header('Location:../../job_company');
        	    }
			}else{
				$this->error("请填写完整");
				//header('Location:../../../error/WentWrong');
			}
		}
	}

//获取公司列表（公共方法）
	public function get_company_lists(){
		$allCompany=M('cominfo')->field('name')->select();

		$companyLists="[";
		for ($i=0; $i < count($allCompany); $i++) {
			if ($i==(count($allCompany)-1)) {
				$companyLists.="\"".$allCompany[$i]['name']."\"";
			}else{
				$companyLists.="\"".$allCompany[$i]['name']."\",";
			}
		}
        $companyLists.="]";
		return $companyLists;
	}

//公司发布方法
	public function upload_company(){
        if (($_POST['name']!="") && ($_POST['welfare']!="") && ($_POST['scale']!="") && ($_POST['address']!="") && 
        	($_POST['email']!="") && ($_POST['website']!="")) {
        	$where['name']=$_POST['name'];
        	$check=M('cominfo')->where($where)->select();
        	if (count($check)==1) {
        		$this->error('该公司已存在');
        		//header('Location:job_company_search');
        	}else{
        		//公司图片一定要传
			    $pic=$this->uploadPic();
			    $filename="http://".C('server_address')."/jobBook/Public/src/".$pic;

			    if ($pic=="false") {
			     	$this->error('图片上传失败');
			    // 	header('Location:job_company');
			    }else{
			    	$data=array(
        			    'name'=>$_POST['name'],
        				'email'=>$_POST['email'],
        				'location'=>$_POST['address'],
        				'welfare'=>$_POST['welfare'],
        				'scale'=>$_POST['scale'],
        				'comlogo'=>$filename,
        				'website'=>$_POST['email'],
        			);
        		    M('cominfo')->add($data);
        		    $this->success('公司上传成功');
        		    //header('Location:job_company_search');
			    }
        	}
        }else{
        	$this->error('请填写完整');
        	//header('Location:../error/WentWrong');
        }
	}

//图片上传方法(公共方法)
	public function uploadPic(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/src/'; // 设置附件上传根目录
        $upload->saveName = 'time';
        $info=$upload->upload();

        if(!$info) {// 上传错误提示错误信息
            return "false";
        }else{// 上传成功 获取上传文件信息
            return $info['photo']['savepath'].$info['photo']['savename'];
        }
	}

//删除图片公共方法
	public function deletePic($compic){
		$pieces = explode("/", $compic);
		$newfile = "D:/wamp/www/jobBook/Public/src/".$pieces[6]."/".$pieces[7];	
		unlink($newfile);
	}

//公司搜索方法
	public function job_company_search(){
		$keyword=$_POST['keyword'];
		if ($keyword=="") {
			$companys=M('cominfo')->field(array('name','com_id'))->select();
		}else{
			$check['name']=array('like',array('%'.$keyword.'%'));
			$companys=M('cominfo')->field(array('name','com_id'))->where($check)->select();
		}
		$this->assign("companys",$companys);
		$this->display();
	}

//修改公司信息方法
	public function job_company_edit(){
		$where['com_id']=$_GET['com_id'];
		$company=M('cominfo')->where($where)->select();
		//var_dump($company);
		$this->assign("company",$company[0]);
		$this->display();
	}

//修改或删除公司
	public function do_company($com_id,$companyname){
		$where['com_id']=$com_id;
		$check['companyName']=$companyname;
		$compic = M('cominfo')->where($where)->getField('comlogo');
		if ($_POST['button']=="删除") {
			$model = new Model();
			$model->startTrans();
			
			$back=$model->table('cominfo')->where($where)->delete();
			$back2=$model->table('jobinfo')->where($check)->delete();
			$back3=$model->table('sendemail')->where($where)->delete();

			if ($back !== false && ($back2 !== false) && ($back3 !== false)) {
				$this->deletePic($compic);
				$model->commit();
				$this->success('删除成功','../../../../job_company_search');
			}else{
				$model->rollback();
				$this->error('删除失败','../../../../job_company_edit?com_id='.$com_id);
				//header('Location:../../../../job_company_edit?com_id='.$com_id);
			}
		}else if ($_POST['button']=="修改") {
			if ($_POST['name']!="" && $_POST['welfare']!="" && $_POST['scale']!="" && $_POST['address']!="" && 
				$_POST['email']!="" && $_POST['website']!="") {
        		$pic=$this->uploadPic();
        		$compic = "";
         		if ($pic!="false") {
         			$where['com_id']=$com_id;
         			$compic = M('cominfo')->where($where)->getField('comlogo');
         			$filename="http://".C('server_address')."/jobBook/Public/src/".$pic;
			     	$update1['comlogo']=$filename;
			    }
        		$model = new Model();
				$model->startTrans();

        		$where['companyName']=$companyname;
        		$update['companyName']=$_POST['name'];
        		$line1 = $model->table('jobinfo')->where($where)->save($update);

        	    $update1['name']=$_POST['name'];
        	    $update1['website']=$_POST['website'];
        	    $update1['welfare']=$_POST['welfare'];
        	    $update1['scale']=$_POST['scale'];
        	    $update1['location']=$_POST['address'];
        	    $update1['email']=$_POST['email'];
                $line2 = $model->table('cominfo')->where($where)->save($update1);

                if ($line2 !== false && $line1 !== false) {               	
                	$model->commit();
                	$this->deletePic($compic);
                	$this->success('更新成功','../../../../job_company_search');
                }else{
                	$model->rollback();
                	$this->error('更新失败');                	
                }
        	    //header('Location:../../../../job_company_search');			           		
			}else{
				$this->error('请填写完整');
        	    //header('Location:../../../../../error/WentWrong');
            }
		}
	}

}