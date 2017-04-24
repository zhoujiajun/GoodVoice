<?php
namespace Home\Controller;
use Think\Controller;

/**
* 发送邮件
*/
class MailController extends Controller
{
	
	public function sendMail($to,$title,$content,$attachment)
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

        //是否需要发附件
        if ($attachment) {
        	if (file_exists($attachment)) {
        		$mail->AddAttachment($attachment); 
        	}
        }
        //$mail->Port = C('MAIL_PORT'); 
        //$mail->SMTPSecure = C('MAIL_SECURE'); 
        return($mail->Send());
	}

	public function add($account,$com_id){  
        $where['com_id']=$com_id;
        $re=M('cominfo')->where($where)->select(); 
		$to=$re[0]['email'];
        if ($to=="") {
            $back['status']="false";
            $back['response']="No destination"; 
            //exit("");
        }else{
            $check['account']=$account;
            $person=M('user')->where($check)->select();
            $content="面试官，您好！这是".$person[0]['username']."的简历（请点击链接）：http://".C('server_address')."/jobBook/index.php/Home/mail/createCV/account/".$account;
            $title="职谱与我们";
            if($this->sendMail($to,$title,$content,$attachment)){
                $now=time();
                $data=array(
                    'account'=>$account,
                    'com_id'=>$com_id,
                    'time'=>$now,
                    );
                M('sendemail')->add($data);
                $back['status']="true";
                $back['response']="";
            }else{    
                $back['status']="false";
                $back['response']="email failed";           
                //exit("");
            }
        }
        exit(json_encode($back));
    }

    public function createCV($account){
    	$where['user']=$account;
		$basicInfo=M('personality')->where($where)->select();
		$education=M('education')->where($where)->select();
		$work=M('work')->where($where)->select();
		$result['basicInfo']=$basicInfo[0];
		$result['education']=$education;
		$result['work']=$work;
		//var_dump($result);
 
        $this->assign("source",$result);
        $this->assign("education",$result['education']);
        $this->assign("work",$result['work']);
        $this->display();
    }

    public function check($account,$com_id){
        $condition['user']=$account;
        $judge = M('personality')->where($condition)->count();
        if ($judge==0) {
            $back['status']="false";
            $back['response']="not write";
        }else{
            $where['account']=$account;
            $where['com_id']=$com_id;
            $result=M('sendemail')->where($where)->select();
            if (count($result)==0) {
                $this->add($account,$com_id);
                $back['status']="true";
                $back['response']="";
            }else{
                $between=604800;    //设置再次发送的时间
                $now=time();
                if (($now-$result[0]['time'])>$between) {
                    $r=M('sendemail')->where($where)->delete();
                    $this->add($account,$com_id);
                    $back['status']="true";
                    $back['response']="";
                }else{
                //exit("have sent");  //判定已经发送过，一周后才能发送
                    $back['status']="false";
                    $back['response']="have sent";
                }
            }
        }       
        exit(json_encode($back));
    }

}
