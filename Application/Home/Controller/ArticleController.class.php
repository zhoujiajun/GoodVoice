<?php
namespace Home\Controller;
use Think\Controller;
/**
* 干货类
*/
class ArticleController extends Controller
{
	
	public function getArticle($a_id="",$account="")
	{
		//$json='{"article_id":"2"}';
		//$json=file_get_contents('php://input');
		//$sourceData=json_decode($json,true);

		$where['article_id']=$a_id;
		$data=M('article')->where($where)->find();	
		$data['comments']=array();		

        //修改阅读量
        $update['readingquantity']=$data['readingquantity']+1;        
        $newData=M('article')->where($where)->save($update);
        
        //内容...字符串封装
        $data['content']=htmlspecialchars($data['content']);

        //检查是否收藏
        $check['user']=$account;
		$myLike = M('likearticle')->where($check)->getField('article_id',true);
		if (in_array($data['article_id'],$myLike)) {
			$data['ifLike']=1;
		}else{
			$data['ifLike']=0;
		}
        //var_dump($data);
        $back['response']=json_encode($data);
        $back['status']="true";
        exit(json_encode($back));
	}

	public function allArticle($type=0,$account=""){
		$index=file_get_contents('php://input');
		//$index=4;

		if ($type==0) {
			$articles=M('article')->limit($index,10)->order('date desc')->select();		    
		}else{
			$where['type']=$type;
			$articles=M('article')->limit($index,10)->where($where)->order('date desc')->select();
		}

		for ($i=0; $i < count($articles); $i++) {
			$articles[$i]['content']=htmlspecialchars($articles[$i]['content']);
			$articles[$i]['comments']=array();
		}

		$check['user']=$account;
		$myLike = M('likearticle')->where($check)->getField('article_id',true);
		
		$articles = $this->ifLike($articles,$myLike);
		//var_dump($articles);
		$back['response']=json_encode($articles);
		$back['status']="true";
		//echo json_encode(htmlspecialchars($articles[0]['content']));
		exit(json_encode($back));
	}

	/*检查每一个文章是否有收藏*/
	public function ifLike($allArticle,$myLike){
		for ($i=0; $i < count($allArticle); $i++) { 
			if (in_array($allArticle[$i]['article_id'],$myLike)) {
				$allArticle[$i]['ifLike']=1;
			}else{
				$allArticle[$i]['ifLike']=0;
			}
		}
		return $allArticle;
	}
	
	public function likesArticle($account,$a_id){
		// $json=file_get_contents('php://input');
		// $sourceData=json_decode($json,true);

		// $article_id=$sourceData['article_id'];
		// $user=$sourceData['account'];
		$data=array(
			'user'=>$account,
			'article_id'=>$a_id,
			);
		$result=M('likearticle')->add($data);
		if ($result!=0) {
			$back['response']="";
			$back['status']="true";
		}else{
			$back['response']="like failed";
			$back['status']="false";
		}
        exit(json_encode($back));
	}

	public function unlikesArticle($account,$a_id){
		$data=array(
			'user'=>$account,
			'article_id'=>$a_id,
		);
		$result=M('likearticle')->where($data)->delete();
		if ($result!=0) {
			$this->feedback("true","");
		}else{
			$this->feedback("false","unlike failed");
		}
	}

	/*添加文章评论*/
	public function addArticleComment(){
		$json=file_get_contents('php://input');
		$sourceData=json_decode($json,true);

		$ask_time=date('Y-m-d G:i:s');
		$data=array(
			'a_id'=>$sourceData['a_id'],
			'content'=>$sourceData['content'],
			'ask_time'=>$ask_time,
			'commenter'=>$sourceData['commenter']['account'],
		);
		$result = M('commentArticle')->add($data);
		if ($result) {
			$this->feedback("false","unlike failed");
		}else{
			$this->feedback("true","");
		}
	}

	//数据反馈（公共方法）
	public function feedback($status,$response){
		$back['status']=$status;
		$back['response']=$response;
		exit(json_encode($back));
	}
}