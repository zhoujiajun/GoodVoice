<?php
namespace Home\Controller;
use Think\Controller;
//use Home\Common\CommonController;
/**
* 意见反馈
*/
class SuggestionController extends Controller
{
	
	public function postSuggestion($account)
	{
		$json=file_get_contents('php://input');
		$sourceData=json_decode($json,true);

		$mail = $sourceData['email'];
		if (empty($mail) || !preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$mail)){ 
     		$back['status']="false";
        	$back['response']="the format of email is wrong";
 		}else{
     		$data=array(
				'user'=>$account,
				'u_email'=>$sourceData['email'],
				'content'=>$sourceData['content'],
				'date'=>date('Y-m-d'),
				'reply'=>"",
				);
			$result=M('suggestion')->add($data);
		
			if ($result) {
				$title="【职谱】收到您的反馈";
				$tip="我们已经收到您的建议啦，我们会尽快改正，很感谢您支持职谱。祝生活愉快~";
				$mail=new MailController();
				if($mail->sendMail($mail,$title,$tip)){
					$back['status']="true";
        	    	$back['response']="";			
				}else{
					$back['status']="false";
        	    	$back['response']="send email failed";
				}
			}else{
				$back['status']="false";
        		$back['response']="mysql failed";
			}
 		}
		exit(json_encode($back));
	}

}