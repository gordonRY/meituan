<?php 
// +----------------------------------------------------------------------
// | 后台登陆模块
// +----------------------------------------------------------------------
// | date:2017-05-16
// +----------------------------------------------------------------------
// | Author: lzb
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{

	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function login(){
		if(IS_POST){
			$post=I('post.');
			$code=$post['captcha'];
			//var_dump(check_verify($post['captcha'])) ;
          if(!check_verify($post['captcha']))
          	$this->ajaxReturn(array('status'=>1, 'msg'=>'验证码错误'));
           $map['admin_name'] = $post['admin_name'];
		   $name= $map['admin_name'];
            $admin_db = D('Admin');
			$where="admin_name='$name'";
			$data=$admin_db->where($where)->select();
			$data=current($data);
        if (empty($data))
            {
                $this->ajaxReturn(array('status'=>1, 'msg'=>'账号不存在'));
            }
            else
            {
             	if($data['admin_password'] != md5($post['admin_password']))
                {
                    $this->ajaxReturn(array('status'=>1, 'msg'=>'账号或密码错误'));
                }
                if($data['status'] != 1)
                {
                    $this->ajaxReturn(array('status'=>1, 'msg'=>'账号已被禁用,请联系管理员'));
                }
            	$data['last_login_ip'] = get_client_ip();
                $data['last_login_time'] = date("Y-m-d H:m:s",time());
                /**
                 * 将用户的所有信息存入到session中
                 */
                session('admin', $data);
                /**
                 * 更新登陆的时间和地址
                 */
                $admin_db->where($where)->save($data);
				echo $admin_db->getLastSql;
                $this->ajaxReturn(array('status'=>1, 'msg'=>'登录成功'));
            }
		}else{
			$this->display();
		}
	}


	/**
	 * 退出
	 * @return [type] [description]
	 */
	public function logout(){
		session('admin', null);
        $this->success('退出成功',U('public/login'),1);;
	}


	/**
	 * 验证码
	 * @return [type] [description]
	 */
	public function verify(){
		$Verify = new \Think\Verify();
		$Verify->length   = 4;
		$Verify->fontSize = 40;
		$Verify->useNoise = false;
		$Verify->codeSet = '0123456789';
        $Verify->useCurve = false;
		$Verify->entry();
	}
}
?>
