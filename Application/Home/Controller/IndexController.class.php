<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
        header('Content-Type:text/html;charset=utf-8');
    }
    public function index(){
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this -> display();
    }
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify -> entry();
    }
    public function verify1(){
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            );

        $Verify = new \Think\Verify($config);
        $Verify -> entry(1);
    }
    public function verify2(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length   = 3;
        $Verify->useNoise = false;
        $Verify -> entry(2);
    }
    public function check_verify($id=''){//id为验证码标识 譬如同个页面有多个验证码 那么 entry(1) 然后传id 为1就对的上
        $code = $_GET['core'];
        $Verify = new \Think\Verify();
        $result = $Verify -> check($code,$id);
        if($result)
            echo '对';
        else
            echo '错';
    }
    public function insert(){
        $fy = M('fy');
        for($i=0;$i<100;$i++){
            $arr['message']='分页用的数据信息'.$i;
            $re = $fy->add($arr);
        }
        if($re){
            echo 'y';
        }else{
            echo 'n';
        }
    }
    public function fy(){
        $fy = M('activity'); // 实例化Data数据对象
        $count = $fy -> count();// 查询满足要求的总记录数 $map表示查询条件
        $num = 15;//定义每一页条数
        $Page = new  \Think\Page($count, $num);// 实例化分页类 传入总记录数
        $Page -> lastSuffix=false;//最后一页是否显示总记录条数
        $Page -> setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录  每页<b>'.$num.'</b>条  第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page -> setConfig('prev','上一页');
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('last','末页');
        $Page -> setConfig('first','首页');
        $Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page -> show();// 分页显示输出
        // 进行分页数据查询
        $orderby['act_id']='asc';//正序
        $list = $fy->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
    function ajaxtest(){
        //定义User属性的内容
        $user['name']='quanta';
        $user['age']=21;
        //定义Article属性的内容
        $content['title']='如何成为优秀的程序员';
        $content['content']='少吃，多打代码';
        $article[0]=$content;
        $article[1]=$content;
        $article[2]=$content;
        //把User 和 Article 翻入data
        $data['User']  = $user;
        $data['Article'] = $article;

        $info='success';
        $status=1;
        //定义最外层的 data 、 info 、status属性的内容
        $return['data']=$data;
        $return['info']=$info;
        $return['status']=$status;

        $this->ajaxReturn($return);
    }
    function ajaxShow(){
        $this->display();
    }
}