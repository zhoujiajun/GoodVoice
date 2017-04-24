<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\AdminModel;

class AdministrationController extends Controller {

    //管理员登录方法
   	public function doAdLogin(){
   		$username = $_POST['acc'];
   		$password = md5($_POST['psw']);
   		$admin = new AdminModel();
   		$result = $admin->doAdminLogin($username,$password);
   		if (count($result)==0) {
   			$data=0;
   			$this->ajaxReturn($data);
   		}else{
   			$data=$result[0]['a_name'];
   			$_SESSION['a_name']=$result[0]['a_name'];
   			$_SESSION['a_id']=$result[0]['a_id'];
   			$this->ajaxReturn($data);
   		}
   	}

   	//检查管理员登录
   	public function checkLogin(){
   		if (isset($_SESSION['a_name'])) {
   			$data = $_SESSION['a_id'];
   			$this->ajaxReturn($data);
   		}else{
   			$data=0;
   			$this->ajaxReturn($data);
   		}
   	}

   	//获取管理员名字
   	public function getName(){
   		$data['acc']=$_SESSION['a_name'];
   		$this->ajaxReturn($data);
   	}

   	//查询分流方法
   	public function getData(){
   		$tag = $_POST['html'];
   		switch ($tag) {
   			case '11':
   				$this->getAllUsers();
   				break;
   			case '12':
   				$this->getAllTeacher();
   				break;
   			case '14':
   				$this->getAllClasses();
   				break;

   			default:
   				# code...
   				break;
   		}
   	}

   	//获取所有用户
   	public function getAllUsers(){
   		$admin = new AdminModel();
   		$data = $admin->getUsers();
   		$this->ajaxReturn($data,"JSON");
   	}

   	//获取所有老师
   	public function getAllTeacher(){
   		$admin = new AdminModel();
   		$data = $admin->getTeachers();
   		$this->ajaxReturn($data,"JSON");
   	}

      //获取一个老师
      public function getOneTeacher(){
         $admin = new AdminModel();
         $data = $admin->getTc(I("post.id"));
         $data['acc']=$_SESSION['a_name'];
         $this->ajaxReturn($data);
      }

   	//获取所有课程
   	public function getAllClasses(){
   		$admin = new AdminModel();
   		$data = $admin->getCourses();
   		for ($i=0; $i < count($data); $i++) { 
   			$data[$i]['sells']=$admin->countSales($data[$i]['c_id']);
   		}
   		$this->ajaxReturn($data,"JSON");
   	}

      //获取一个课程
      public function getOneClass(){
         $c_id = I("post.c_id");
         $admin = new AdminModel();
         $course = $admin->getOneCourse($c_id);
         $this->ajaxReturn($course[0]);
      }

      //获取交易数据
      public function getTakes(){
         $language = $_POST['lang'];
         $c_id = $_POST['c_id'];
         $admin = new AdminModel();
         $data = $admin->gettakes($language,$c_id);
         $this->ajaxReturn($data);
      }

      //删除单个用户方法
      public function deleteUser(){
         $admin = new AdminModel();
         if ($admin->dodeleteUser($_POST['id'])) {
            $this->ajaxReturn(1);
         }else{
            $this->ajaxReturn(0);
         }
      }

      //批量删除分流方法
      public function dodeletes(){
         // $_POST['deleteid']='["9"]';

         // print_r();
         $_POST['html']=12;
         $deleteid = "['8']";
         $admin = new AdminModel();
         switch ($_POST['html']) {
            case '11':
               $result = $admin->deleteUsers($_POST['deleteid']);
               break;
            case '12':
               $deleteid = I("post.deleteid");
               $result = $admin->deleteTeachers($deleteid);              
               foreach ($deleteid as $key => $value) {
                  $this->deleteOldPic($deleteid[$key]);
               }
               break;
            case '14':
               $result = $admin->deleteCourses($_POST['deleteid']);
               break;
         }
         if ($result) {
            $this->ajaxReturn(1);
         }else{
            $this->ajaxReturn(0);
         }
      }

      //退出登录方法
      public function logout(){
         session_destroy();
      }

      //添加老师方法
      public function addteacher(){
         $head = $this->uploadPic();
         if (!$head) {
            //返回上传头像失败
            $this->ajaxReturn(0);
         }else{       
            $data=array(
               't_name'=>$_POST['name'],
               't_language'=>$_POST['lang'],
               't_qq'=>$_POST['qq'],
               'email'=>$_POST['mail'],
               't_head'=>$head,
               't_description'=>$_POST['des'],
               't_rtime'=>date('Y-m-d G:i:s'),
               't_password'=>md5("88888888"),
            );
            $admin = new AdminModel();
            if ($admin->doAddTeacher($data)) {
               //添加成功
               $this->ajaxReturn(1);
            }else{
               //添加失败
               $this->ajaxReturn(0);
            }
         }
      }

      //编辑老师方法
      public function updateTeacher(){
         if (empty($_FILES)) {
            $update=array(
               't_name'=>I("post.name"),
               't_language'=>I("post.lang"),
               't_qq'=>I("post.qq"),
               'email'=>I("post.mail"),
               't_description'=>I("post.tcdes"),
            );
         }else{            
            $head = $this->uploadPic();
            if (!$head) {
               //返回上传头像失败
               $this->ajaxReturn(0);
            }else{
               $this->deleteOldPic($_POST['t_id']);
               $update=array(
                  't_name'=>I("post.name"),
                  't_language'=>I("post.lang"),
                  't_qq'=>I("post.qq"),
                  'email'=>I("post.mail"),
                  't_head'=>$head,
                  't_description'=>I("post.tcdes"),
               );               
            }
         }

         $admin = new AdminModel();
         if ($admin->doUpdateTeacher($_POST['t_id'],$update)) {
            //更新成功
            $this->ajaxReturn(1);
         }else{
            //更新失败
            $this->ajaxReturn(0);
         }
      }

      //删除老师旧图片
      public function deleteOldPic($t_id){
         $where['t_id']=$t_id;
         $data = M('teacher')->field('t_head')->where($where)->select();
         $pieces = explode("/",$data[0]['t_head']);
         $newFile = "C:/wamp/www/".$pieces[3]."/".$pieces[4]."/".$pieces[5]."/".$pieces[6]."/".$pieces[7]."/".$pieces[8];
         unlink($newFile);
      }

      //上传图片公共方法
      public function uploadPic(){
         $upload = new \Think\Upload();// 实例化上传类
         $upload->maxSize = 3145728 ;// 设置附件上传大小
         $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
         $upload->rootPath = './Public/';  // 设置附件上传根目录
         $upload->savePath = 'src/teacherHead/';
         $upload->saveName = 'time';
         $info=$upload->upload();

         if(!$info) {// 上传错误提示错误信息
            return false;
         }else{// 上传成功 获取上传文件信息
            return "http://".C("server_address")."/EasyTalk/Public/".$info['photo']['savepath'].$info['photo']['savename'];
         }
      }

      //获取所有老师备选
      public function getTeachers(){
         $admin = new AdminModel();
         $data = $admin->getTeacher();
         $this->ajaxReturn($data);
      }

      //添加课程
      public function addClasses(){
         $data=array(
            't_name'=>I("post.tcname"),
            'c_description'=>I("post.des"),
            'c_language'=>I("post.lang"),
            'level'=>I("post.level"),
            'c_credit'=>I("post.classnum"),
            'c_title'=>I("post.classname"),
            'cost'=>I("post.price"),
            );
         $admin = new AdminModel();
         if ($admin->addClass($data)) {
            $this->ajaxReturn(1);
         }else{
            $this->ajaxReturn(0);
         }
      }

      //修改课程方法
      public function updateClass(){
         $update=array(
            't_name'=>I("post.t_name"),
            'c_language'=>I("post.lang"),
            'level'=>I("post.level"),
            'c_credit'=>I("post.c_num"),
            'c_title'=>I("post.c_name"),
            'cost'=>I("post.c_pri"),
            'c_description'=>I("post.c_des"),
         ); 
         $admin = new AdminModel();
         if ($admin->doUpdateClass($update,I("post.c_id"))) {
            $this->ajaxReturn(1);
         }else{
            $this->ajaxReturn(0);
         }
      }

      //修改管理员密码
      public function updatePsw(){
         $oldpsw = I("post.opass");
         $newpsw = I("post.npass");
         $admin = new AdminModel();
         $result = $admin->checkAdminPsw($oldpsw);
         if ($result==0) {
            $this->ajaxReturn(0);
         }else{
            if ($admin->doUpdateAdminPsw($newpsw) !== false) {
               session_destroy();
               $this->ajaxReturn(1);
            }else{
               $this->ajaxReturn(0);
            }
         }
      }

      // public function deleteFile(){
      //    $file = "D:/wamp/www/EasyTalk/Public/154440157.jpg";
      //    //$file = fopen("http://localhost/EasyTalk/public/154440157.jpg","wb");
      //    echo $file;
      //    if (unlink($file)) {
      //       echo "33";
      //    }else{
      //       echo "44";
      //    }
      // }

      public function adteacher_editc(){
         $id = $_GET['id'];
         $this->assign("id",$id);
         $this->display();
      }

      //查询语种
      public function getLanguage(){
         $admin = new AdminModel();
         $data = $admin->checkLanguage();
         $this->ajaxReturn($data);
      }

      //获取所有练习
      public function getAllExercises(){
         $data = M('exercise')->select();
         $this->ajaxReturn($data);
      }

      //删除某个练习
      public function deleteExe(){
         $admin = new AdminModel();
         $data = $admin->dodeleteExe(I("post.e_id"));
         $this->ajaxReturn($data);
      }

      //添加练习基本信息
      public function addExe(){
         $data = array(
            'title'=>I("post.name"),
            'language'=>I("post.lang"),
            'level'=>I("post.level"),
            'release'=>0,
            're_time'=>date("Y-m-d"),
            );
         $result = M('exercise')->add($data);
         $this->ajaxReturn($result);
      }

      //获取单个练习
      public function getOneExe(){
         $admin = new AdminModel();
         $result = $admin->getBasicInfo(I("post.e_id"));
         $result['bignum'] = count($result['bigQuiz']);
         //var_dump($result);
         $this->ajaxReturn($result);
      }

      //根据练习号和大题号获取每个小题
      public function getXiaoti(){
         $admin = new AdminModel();
         $result = $admin->getWholeExe(I("post.e_id"),I("post.t_id"));
         $this->ajaxReturn($result);
      }

      //添加大题
      public function addDati(){
         $admin = new AdminModel();
         $data = array(
            'e_id'=>I("post.e_id"),
            // 'da_title'=>I("post.title"),
            'da_des'=>I("post.title"),
            );
         $result = $admin->doAddDati($data);
         $this->ajaxReturn($result);
      }

      //删除大题
      public function deleteDati(){
         $admin = new AdminModel();
         $result = $admin->dodeleteDati(I("post.e_id"),I("post.t_id"));
         $this->ajaxReturn($result);
      }

      //查看大题情况
      public function checkDati(){
         $admin = new AdminModel();
         $result = $admin->doCheckDati(I("post.e_id"),I("post.t_id"));
         $this->ajaxReturn($result[0]);
      }

      //修改大题标题
      public function updateDati(){
         $admin = new AdminModel();
         $where['e_id']=I("post.e_id");
         $where['dati']=I("post.t_id");
         $update['da_des']=I("post.des");
         $result = $admin->doUpdateDati($where,$update);
         $this->ajaxReturn($result);
      }

      //添加小题
      public function addXiaoti(){
         $admin = new AdminModel();
         $tips = I("post.op_a").",".I("post.op_b").",".I("post.op_c").",".I("post.op_d");
         $data = array(
            'title'=>I("post.t_title"),
            'answer'=>I("post.answer"),
            'point'=>I("post.point"),
            'ABCD'=>$tips,
            );      
         $condition['e_id']=I("post.e_id");
         $condition['dati']=I("post.t_id");
         $result = $admin->doAddXiaoti($condition,$data);
         $this->ajaxReturn($result);
      }

      //查获小题信息
      public function checkXiaoti(){
         $admin = new AdminModel();
         $data = $admin->doCheckXiaoti(I("post.e_id"),I("post.t_id"),I("post.x_id"));
         $this->ajaxReturn($data,"JSON");
      }

      //编辑小题
      public function updateXiaoti(){
         $admin = new AdminModel();
         $tips = I("post.op_a").",".I("post.op_b").",".I("post.op_c").",".I("post.op_d");
         $update = array(
            'title'=>I("post.t_title"),
            'answer'=>I("post.answer"),
            'point'=>I("post.point"),
            'ABCD'=>$tips,
            );  
         $condition['e_id']=I("post.e_id");
         $condition['dati']=I("post.t_id");
         $condition['xiaoti']=I("post.x_id");
         $result = $admin->doUpdateXiaoti($condition,$update);
         $this->ajaxReturn($result);
      }

      //删除小题
      public function deleteXiaoti(){
         $admin = new AdminModel();
         $where = array(
            'e_id'=>I("post.e_id"),
            'xiaoti'=>I("post.xiaoti"),
            'dati'=>I("post.dati"),
            );
         $result = $admin->dodeleteXiaoti($where);
         $this->ajaxReturn($result);
      }

      //确定发布
      public function releaseExe(){
         $admin = new AdminModel();
         $result = $admin->doReleaseExe(I("post.e_id"));
         $this->ajaxReturn($result);
      }

      //显示导航栏标签
      public function adnav(){
         $admin = new AdminModel();
         $data = $admin->getTags();
         $this->assign("header",$data['header']);
         $this->assign("course",$data['course']);
         $this->assign("teacher",$data['teacher']);
         $this->assign("buyclass",$data['buyclass']);
         $this->assign("personal",$data['personal']);
         $this->assign("exercise",$data['exercise']);
         $this->display();
      }

      //修改导航栏标签
      public function do_updateTags(){       
         $data=array(
            'tag'=>1,
            'header'=>I("post.index"),
            'course'=>I("post.classsty"),
            'teacher'=>I("post.tcintro"),
            'buyclass'=>I("post.buyclass"),
            'personal'=>I("post.pccenter"),
            'exercise'=>I("post.exe"),
            );
         $admin = new AdminModel();
         if ($admin->do_tags($data)) {
            $this->ajaxReturn(1);
         }else{
            $this->ajaxReturn(0);
         }
      }

      //显示首页图片
      public function showIndexPic(){
         $admin = new AdminModel();
         $pics = $admin->getIndexpic();
         $this->ajaxReturn($pics);
      }

      //上传首页图片
      public function uploadIndexPic(){
         $head = $this->uploadPicture();
         if ($head) {
            $num = $_POST['pnum'];
            $this->deleteIndexPic($num);
            $admin = new AdminModel();
            $result = $admin->refreshIndexPic($head,$num); 
            $this->ajaxReturn($result);
         }else{
            $this->ajaxReturn(0);
         }         
      }

      //删除首页图片
      public function deleteIndexPicture(){
         $num = $_POST['pnum'];
         $admin = new AdminModel();
         $this->deleteIndexPic($num);
         $result = $admin->delIndexPic($num);
         if ($result) {            
            $this->ajaxReturn($result);
         }else{
            $this->ajaxReturn(0);
         }
      }

      //操作首页图片上传
      public function uploadPicture(){
         $upload = new \Think\Upload();// 实例化上传类
         $upload->maxSize = 3145728 ;// 设置附件上传大小
         $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
         $upload->rootPath = './Public/';  // 设置附件上传根目录
         $upload->savePath = 'src/images/';
         $upload->saveName = 'time';
         $info=$upload->upload();

         if(!$info) {// 上传错误提示错误信息
            return false;
         }else{// 上传成功 获取上传文件信息
            return "http://".C("server_address")."/EasyTalk/Public/".$info['photo']['savepath'].$info['photo']['savename'];
         }
      }

      //删除首页旧图片
      public function deleteIndexPic($num){
         $where['num']=$num;
         $data = M('indexpic')->field('pic')->where($where)->select();
         $pieces = explode("/",$data[0]['pic']);
         $newFile = "C:/wamp/www/".$pieces[3]."/".$pieces[4]."/".$pieces[5]."/".$pieces[6]."/".$pieces[7]."/".$pieces[8];
         unlink($newFile);
      }

/*对意见反馈模块的处理，不使用model*/
      public function opinion(){
         $data = M('advice')->select();
         $this->ajaxReturn($data);
      }

      public function getSingleOpinion(){
         $id = I("post.id");
         $where['id']=$id;
         $data = M('advice')->where($where)->select();
         $this->ajaxReturn($data[0]);
      }

      public function deleteOneOpinion(){
         $id = I("post.id");
         $where['id']=$id;
         $result = M('advice')->where($where)->delete();
         $this->ajaxReturn($result);
      }

      public function deleteAllOpinion(){
         $result = M('advice')->where('1=1')->delete();
         $this->ajaxReturn($result);
      }
}