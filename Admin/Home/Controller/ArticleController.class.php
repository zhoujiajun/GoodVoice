<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
/**
* 干货
*/
class ArticleController extends Controller
{
	
	public function do_upload()
	{		
		if ($_POST['type']=="" || $_POST['title']=="" || $_POST['content']=="") {
			$this->error('请填写完整');
			//header('Location:article_upload');
		}else{
			$date=date('Y-m-d');
			$pic=$this->uploadPic();
			$filename="http://".C('server_address')."/jobBook/Public/src/".$pic;
			
			if ($pic=="false") {
				$this->error('图片上传失败');				
				//header('Location:article_upload');
			}else{
				$data=array(
				    'type'=>$_POST['type'],
				    'title'=>$_POST['title'],
				    'content'=>$_POST['content'],
				    'image'=>$filename,
				    'date'=>$date,
				);
			    $result=M('article')->add($data);
			    if ($result) {
			    	$this->success('文章发布成功','article_search');			    	
			    }else{
			    	$this->error('文章发布失败');
			    }
			}					
		}
	}

	public function article_edit($a_id=""){
		if ($a_id=="") {
			header('Location:../../../error/PageNotFound');
		}else{
			$where['article_id']=$a_id;
		    $article=M('article')->where($where)->select();
		
		    //var_dump($article[0]);
		    $this->assign("article",$article[0]);
		    $this->display();
		}
		
	}

	public function article_search(){
		$keyword=$_POST['keyword'];
		if ($keyword=="") {
			$articles=M('article')->order('date desc')->select();
		}else{
			$where['title']=array('like',array('%'.$keyword.'%'));
		    $articles=M('article')->where($where)->order('date desc')->select();
		    if (count($articles)==0) {
		    	$articles[0]['title']="无搜索结果";
		    }
		}
		
		$this->assign("articles",$articles);
		//var_dump($articles);
		$this->display();
	}

	public function article_upload(){
		$this->display();
	}

	public function do_function($a_id=""){
		$where['article_id']=$a_id;
		$picture = M('article')->where($where)->getField('image');

		if ($_POST['button']=="删除") {	
			$model = new Model();
			$model->startTrans();

		    $line1=$model->table('article')->where($where)->delete();
		    $line2=$model->table('likearticle')->where($where)->delete();
		    if ($line1!==false&&$line2!==false) {
		    	$model->commit();
		    	/*数据库成功后再删图片*/
				$this->deletePic($picture);
		    	$this->success('删除成功','../../article_search');
		    }else{
		    	$model->rollback();
		    	$this->error('删除失败','Location:../../article_edit/a_id/'.$a_id);
		    }
		}else{			
			if ($_POST['title']=="" || $_POST['content']=="") {
				header('Location:../../article_edit/a_id/'.$a_id);
			}else{
				$pic=$this->uploadPic();
				if ($pic=="false") {
					//图片上传不成功
					header('Location:../../article_edit/a_id/'.$a_id);
				}else{
					$update['type']=$_POST['type'];
			        $update['title']=$_POST['title'];
			        $update['content']=$_POST['content'];
			        $update['image']="http://".C('server_address')."/jobBook/Public/src/".$pic;
			        $result=M('article')->where($where)->save($update);
			        if ($result) {
			    	    header('Location:../../article_search');
			        }else{
			    	    header('Location:../../article_edit/a_id/$a_id');
			        }
				}
				
			}
		}		
	}

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

	public function deletePic($picture){
		$pieces = explode("/",$picture);
		$newFile = "D:/wamp/www/jobBook/Public/".$pieces[5]."/".$pieces[6]."/".$pieces[7];
		unlink($newFile);
	}
}
?>