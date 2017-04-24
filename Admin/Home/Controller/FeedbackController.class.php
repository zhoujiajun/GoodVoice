<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class FeedbackController extends Controller
{
	// public function feedback($page=0){
	// 	$suggestions=M('suggestion');
 //        /*$this->assign("suggestions",$suggestions);
 //        $this->assign("page",$page/10+1);
 //        $this->assign("number",count($suggestions)/10+1);*/
 //        $count=$suggestions->count();
 //        $num=10;
 //        $Page=new \Think\Page($count,$num);
 //        $Page->setConfig('prev',"上一页");
 //        $Page->setConfig('next',"下一页");
 //        $show=$Page->show();

 //        $orderby['date']="desc";
 //        $list=$suggestions->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
 //        $this->assign("list",$list);        
 //        $this->assign("nowtime",strtotime(date('Y-m-d')));
 //        $show=str_replace("div", "ul class='pagination blog-pagination'", $show);
 //        $show=str_replace('<a class="num"', "<li><a", $show);
 //        $show=str_replace('<a class="next"', "<li><a", $show);
 //        $show=str_replace('<a class="prev"', "<li><a", $show);
 //        $show=str_replace('<span class="current"', "<li><a href='#'", $show);
 //        $show=str_replace('/span', "/li", $show);

 //        $this->assign("page",$show);
	// 	$this->display();
	// }

	public function feedback_detail($id){
		$where['id']=$id;
		$suggestion=M('suggestion')->where($where)->select();
		$this->assign("suggestion",$suggestion[0]);
		if ($suggestion[0]['reply']=="") {
			$this->assign("flag",0);
		}else{
			$this->assign("flag",1);
		}
		$this->display();
	}

	public function do_reply($to,$id){
		if ($_POST['reply_content']=="") {
			header('Location:../../../../../error/WentWrong');
		}else{
			$title="职谱员工回复您的建议啦";
			$content="职谱员工：<br>&nbsp;&nbsp;&nbsp;&nbsp;".$_POST['reply_content']."<br>感谢你对职谱的支持";
			if ($this->sendMail($to,$title,$content)) {
				$where['id']=$id;
				$update['reply']=$_POST['reply_content'];
				$result=M('suggestion')->where($where)->save($update);
				if ($result) {
					header('Location:../../../../undeal');
				}else{
					header('Location:../../../../../error/WentWrong');
				}
			}else{
				header('Location:../../../../../error/WentWrong');
			}
		}
	}

	public function do_delete($id){
		$where['id']=$id;
		$result=M('suggestion')->where($where)->delete();
		header('Location:../../hasdeal');
	}

	public function sendMail($to,$title,$content)
	{
		Vendor('PHPMailer.PHPMailerAutoload'); 
		//收信人、题目和正文不能为空
		if(empty($to) || empty($title) || empty($content)){ 
            return false; 
        }
		$mail=new \PHPMailer();
		$mail->IsSMTP();
		$mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"面试官，您好");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示

        //$mail->Port = C('MAIL_PORT'); 
        //$mail->SMTPSecure = C('MAIL_SECURE'); 
        return($mail->Send());
	}

	public function hasdeal($page=0){
		$suggestion=M('suggestion');
		$where['reply']=array('neq',""); //字段pic不为空
		$count=$suggestion->where($where)->count();
		$num=10;
        $Page=new \Think\Page($count,$num);
        $Page->setConfig('prev',"上一页");
        $Page->setConfig('next',"下一页");
        $show=$Page->show();

		$orderby['date']="desc";		
        $list=D('suggestion')->where($where)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign("list",$list);        
        $this->assign("nowtime",strtotime(date('Y-m-d')));
        $show=str_replace("div", "ul class='pagination blog-pagination'", $show);
        $show=str_replace('<a class="num"', "<li><a", $show);
        $show=str_replace('<a class="next"', "<li><a", $show);
        $show=str_replace('<a class="prev"', "<li><a", $show);
        $show=str_replace('<span class="current"', "<li><a href='#'", $show);
        $show=str_replace('/span', "/li", $show);

        $this->assign("page",$show);
		$this->display();
	}

	public function undeal($page=0){
		$suggestion=M('suggestion');
		$where['reply'] = "";
		$count=$suggestion->where($where)->count();

		$num=10;
        $Page=new \Think\Page($count,$num);
        $Page->setConfig('prev',"上一页");
        $Page->setConfig('next',"下一页");
        $show=$Page->show();

		$orderby['date']="desc";        
        $list=$suggestion->where($where)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        

        $this->assign("list",$list);        
        $this->assign("nowtime",strtotime(date('Y-m-d')));
        $show=str_replace("div", "ul class='pagination blog-pagination'", $show);
        $show=str_replace('<a class="num"', "<li><a", $show);
        $show=str_replace('<a class="next"', "<li><a", $show);
        $show=str_replace('<a class="prev"', "<li><a", $show);
        $show=str_replace('<span class="current"', "<li><a href='#'", $show);
        $show=str_replace('/span', "/li", $show);

        $this->assign("page",$show);
		$this->display();
	}
}

?>