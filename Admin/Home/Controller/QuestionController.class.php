<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
/**
* 修改问问
*/
class QuestionController extends Controller
{
	
	public function askask_search()
	{
		$keyword=$_POST['keyword'];
		if ($keyword=="") {
			$questions=M('question')->order('date desc')->select();
		}else{
			$where['content']=array('like',array('%'.$keyword.'%'));
		    $questions=M('question')->where($where)->order('date desc')->select();
		    if (count($questions)==0) {
		    	$questions[0]['content']="无搜索结果";
		    }
		}
		$this->assign("questions",$questions);
		$this->display();
	}

	public function askask_edit($q_id=""){
		if ($q_id=="") {
			$this->error("不存在");
		}else{
			$where['q_id']=$q_id;
			$question=M('question')->where($where)->select();
			$check['account']=$question[0]['author'];
			$question[0]['userName'] = M('user')->where($check)->getField('userName');
			$this->assign("question",$question[0]);
			$comments=M('comment')->join('inner join user On comment.applier=user.account')->where($where)->field(array('userName','content','head','comment_id'))->select();
			//var_dump($comments);
			$this->assign("comments",$comments);
			$this->display();
		}
	}

	public function do_function($q_id=""){
		$where['q_id']=$q_id;
		if ($_POST['button']=="修改") {
			if ($_POST['content']=="") {
				$this->error("请填写完整");
			}else{
				$update['content']=$_POST['content'];
				$result=M('question')->where($where)->save($update);
				if ($result) {
					$this->success('修改成功','../../askask_search');
					//header('Location:../../askask_search');
				}else{
					$this->error('修改失败');
					//header('Location:../../askask_edit/q_id/'.$q_id);
				}
			}
		}else if($_POST['button']=="删除"){
			$model = new Model();
			$model->startTrans();
			$line1 = $model->table('question')->where($where)->delete();
			$line2 = $model->table('comment')->where($where)->delete();
			$line3 = $model->table('likes')->where($where)->delete();
			if ($line2 !== false && $line1 !== false && $line3 !== false) {
				$model->commit();
				$this->success('删除成功','../../askask_search');
			}else{
				$model->rollback();
				$this->error('删除失败');
			}
		}
	}

	public function delete_comment($c_id=""){
		$where['comment_id']=$c_id;
		$result=M('comment')->where($where)->delete();
		
		if ($result) {
			$this->success('删除成功','../../askask_search');
		}else{
			$this->error('删除失败');
		}
	}
}