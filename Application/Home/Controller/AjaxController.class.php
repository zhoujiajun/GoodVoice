<?php
/**
 * Created by PhpStorm.
 * User: 肺肺
 * Date: 2016/3/12
 * Time: 22:48
 */

namespace Home\Controller;
use Think\Controller;

class AjaxController extends Controller{
    public function _initialize(){
        header('Content-Type:text/html;charset=utf-8');
    }
    public function verify(){
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    function check_verify($id=''){
        $code=$_GET['core'];
        $verify = new \Think\Verify();
        $result=$verify->check($code, $id);

        $re['data']=$result;
        $re['info']='success';
        $re['status']=1;
        $this->ajaxReturn($re);
    }

    function fyAsk(){//接口
        $fy = M('fy');
        $count = $fy -> count();// 查询满足要求的总记录数 $map表示查询条件
        $num = $_GET['num'];
        $current = $_GET['current'];

        $list = $fy -> page($current,$num)->select();

        if($list){
            $data['list'] = $list;
            $data['count'] = $count;
            $data['current'] = $current;
            $data['num'] = $num;

            $re['data'] = $data;
            $re['info'] = 'success';
            $re['status'] = 1;
        }
        else{
            $re['data'] = 'error';
            $re['info'] = '查询出错';
            $re['status'] = 0;
        }

        $this->ajaxReturn($re);
    }

    function fy(){
        $this->display();
    }
}