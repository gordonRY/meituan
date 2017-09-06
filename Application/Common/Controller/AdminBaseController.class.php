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
class AdminBaseController extends BaseController{
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		// 判断用户是否登录
        if(empty(session('admin')))
        {
        	$this->redirect('public/login');
        }else
            {
            //权限管理
            $arr=session('admin');
            $sup=$arr['supadmin'];
            if($sup!=1)
            {
                $uid=$arr['admin_id'];
                $obj=M();
                $sql="select * from h_auth_group_access aga inner join h_auth_group ag on ag.gid=aga.group_id where aga.uid='$uid'";
                $res=$obj->query($sql);
                $res=current($res);
                $res=$res['rules'];
                $rules=explode(",",$res);
                $obj=M('auth_rule');
                $str=MODULE_NAME ."/".CONTROLLER_NAME."/".ACTION_NAME  ;
                $rid=$obj->where("name='$str'")->find();
                $rid=$rid['rid'];
                if(!in_array($rid,$rules))
                {
                    $this->error("该用户权限不够，不能访问");
                }
            }
                $this->assign('admin', session('admin'));

        }
        //查询菜单权限
        $sidebar = D('AdminNav')->getTreeData();
        //p($sidebar);
        $sidebar_far=current($sidebar);
        $sidebar_son=end($sidebar);
		$this->assign('sidebar_far', $sidebar_far);
		$this->sidebar_son=$sidebar_son;
	}
}
?>