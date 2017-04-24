<?php
namespace Home\Controller;
use Think\Controller;
/**
* 显示错误
*/
class ErrorController extends Controller
{
	
	public function PageNotFound()
	{
		$this->display();
	}

	public function WentWrong(){
		$this->display();
	}
}

?>