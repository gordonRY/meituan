<?php 
// +----------------------------------------------------------------------
// | Admin 基类控制器
// +----------------------------------------------------------------------
// | date:2017-05-16
// +----------------------------------------------------------------------
// | Author: lzb
// +----------------------------------------------------------------------
namespace Common\Controller;
use Common\Controller\BaseController;
class HomeBaseController extends BaseController
	{
	
	public function _initialize()
		{
		// 判断用户是否登录
       /* if(empty(session('home')))
		{
        	$this->redirect("Index/index");
			
        }*/
	}
}