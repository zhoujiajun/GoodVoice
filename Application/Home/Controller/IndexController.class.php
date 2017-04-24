<?php
namespace Home\Controller;
use Think\Controller;
use Vendor\AndroidMessage;
class IndexController extends Controller {
	
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    public function test(){
    	//$this->show('尹嘉敏是女神');
    	$data=array(
    		0=>array(
    			'account'=>'里卓洋',
    			'password'=>'19960126',
    			'telephone'=>'18826101314',
    			),
    		1=>array(
    			'account'=>'Clarence',
    			'password'=>'19950622',
    			'telephone'=>'15986090742',
    	    	)
    		);
    	M('user')->addAll($data);    
    }
    public function check(){
        //echo 555;
    	Vendor('AndroidMessage.Demo');
       // import('Vendor.AndroidMessage.Demo');
        
        $demo = new \Demo("588392cbf43e481fb7001e56","azsotoh6owtb40cgzzbde1qqh2jbecjr");
        $demo->sendAndroidUnicast("AvwNyTWF8pbtEL0dzEfS3aU6Nzs0WreZ2W6kJvu39wYl","{'account':'888','num':1}");
    }
    public function loadError(){
        $error=file_get_contents('php://input');
        $data['words']=$error;
        M('temporary')->add($data);
    }

}