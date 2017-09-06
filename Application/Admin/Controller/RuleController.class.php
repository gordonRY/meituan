<?php
// +----------------------------------------------------------------------
// | 权限分配控制器
// +----------------------------------------------------------------------
// | date:2017-05-17
// +----------------------------------------------------------------------
// | Author: lzb
// +-------------------------------------------------
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台权限管理
 */
class RuleController extends AdminBaseController
{

    //******************权限***********************
    /**
     * 权限列表
     */
    public function index()
    {

        $get_gid = '';
        if (IS_GET) {
            $get_gid = $_GET['gid'];
            $rules=current(M('auth_group')->where("gid='$get_gid'")->select())['rules'].",";
            $this->rules=$rules;
        }
        $data = D('AdminNav')->getTreeData();
        $father = current($data);
        $son = end($data);
        $this->father = $father;
        $this->son = $son;

        $grandson = D("authRule")->where("r_fid>0 and r_fid !=11")->select();
        $group = M('authGroup')->where("type!=1")->select();
        $this->group = $group;
        $this->grandson = $grandson;
        $this->get_gid = $get_gid;
    /* dump($father);*/
        /*dump($son);*/
        /*dump($grandson);*/
        $this->display();
    }

    /**
     * 添加权限
     */
    public function add()
    {
        $AuthRule_db = D('AuthRule');
        if (IS_POST) {
            $pid = I('post.pid');
            $title = trim(I('post.title'));
            $name = trim(I('post.name'));
            if (empty($title) || empty($name)) $this->error('抱歉，缺少参数');
            //检测auth_rule表的name是否已经存在
            $auth_info = $AuthRule_db->getDataOne(array('name' => $name), 'id');
            if (!empty($auth_info)) {
                $this->error('权限已存在，请核对');
            }
            //插入数据
            $data = array(
                'pid' => $pid,
                'title' => $title,
                'name' => $name
            );
            $result = $AuthRule_db->addData($data);
            if ($result) {
                $this->success('添加成功', U('Admin/Rule/index'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->pid = I('id', 0);
            $this->type = $this->pid ? '添加子权限' : '添加权限';
            $this->display();
        }
    }

    /**
     * 修改权限
     */
    public function edit()
    {
        $AuthRule_db = D('AuthRule');
        if (IS_POST) {
            $id = I('post.id');
            $title = trim(I('post.title'));
            $name = trim(I('post.name'));
            if (empty($title) || empty($name)) $this->error('抱歉，缺少参数');
            //检测auth_rule表的name是否已经存在
            $auth_info = $AuthRule_db->getDataOne(array('name' => $name), 'id');
            if (!empty($auth_info)) {
                $this->error('权限已存在，请核对');
            }
            $map = array(
                'id' => $id
            );
            $data = array(
                'title' => $title,
                'name' => $name
            );
            $result = $AuthRule_db->editData($map, $data);
            if ($result) {
                $this->success('修改成功', U('Admin/Rule/index'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = I('id', 0);
            $data = $AuthRule_db->find($id);
            if (empty($data)) $this->error('找不到指定内容', U('Rule/index'));
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 删除权限
     */
    public function delete()
    {
        $id = I('get.id');
        $map = array(
            'id' => $id
        );
        $result = D('AuthRule')->deleteData($map);
        if ($result) {
            $this->success('删除成功', U('Admin/Rule/index'));
        } else {
            $this->error('请先删除子权限');
        }
    }
    //*******************用户组**********************

    /**
     * 用户组列表
     */
    public function group()
    {
        $data = D('AuthGroup')->select();
        $assign = array(
            'data' => $data
        );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加用户组
     */
    public function add_group()
    {
        $title = trim(I('post.title'));
        if (empty($title)) {
            $this->error('用户组名不能为空');
        }
        $data = array(
            'title' => $title
        );
        $result = D('AuthGroup')->addData($data);
        if ($result) {
            $this->success('添加成功', U('Admin/Rule/group'));
        } else {
            $this->error('添加失败');
        }
    }

    /**
     * 修改用户组
     */
    public function edit_group()
    {
        $title = trim(I('post.title'));
        if (empty($title)) {
            $this->error('用户组名不能为空');
        }
        $map = array(
            'gid' => I('post.id')
        );
        $data = array(
            'title' => $title
        );
        $result = D('AuthGroup')->editData($map, $data);
        if ($result) {
            $this->success('修改成功', U('Admin/Rule/group'));
        } else {
            $this->error('修改失败');
        }
    }

    /**
     * 删除用户组
     */
    public function delete_group()
    {
        $gid = I('get.gid');
        $result = D('AuthGroup')->where("gid='$gid'")->delete();
        if ($result) {
            //$this->success('删除成功', U('Admin/Rule/group'));
            echo 1;
        } else {
            echo D('AuthGroup')->getLastSql();
            //$this->error('删除失败');
            echo 2;
        }
    }

    //*****************权限-用户组*****************

    /**
     * 分配权限
     */
    public function rule_group()
    {

        U("admin/rule/index");

    }
    //******************用户-用户组*******************

    /**
     * 添加成员
     */
    public function check_user()
    {
        $username = I('get.username', '');
        $group_id = I('get.group_id');
        $group_name = M('Auth_group')->getFieldById($group_id, 'title');
        $uids = D('AuthGroupAccess')->getUidsByGroupId($group_id);
        // 判断用户名是否为空
        if (empty($username)) {
            $user_data = '';
        } else {
            $user_data = M('Users')->where(array('username' => $username))->select();
        }
        $assign = array(
            'group_name' => $group_name,
            'uids' => $uids,
            'user_data' => $user_data,
        );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加用户到用户组
     */
    public function add_user_to_group()
    {
        $data = I('get.');
        $map = array(
            'uid' => $data['uid'],
            'group_id' => $data['group_id']
        );
        $count = M('AuthGroupAccess')->where($map)->count();
        if ($count == 0) {
            D('AuthGroupAccess')->addData($data);
        }
        $this->success('操作成功', U('Admin/Rule/check_user', array('group_id' => $data['group_id'], 'username' => $data['username'])));
    }

    /**
     * 将用户移除用户组(没有实现)
     */
   /* public function delete_user_from_group()
    {
        $map = I('get.');
        $result = D('AuthGroupAccess')->deleteData($map);
        if ($result) {
            $this->success('操作成功', U('Admin/Rule/admin_user_list'));
        } else {
            $this->error('操作失败');
        }
    }*/

    /**
     * 管理员列表
     */
    public function admin_user_list()
    {
        $data = M("admin ha");
        $total=$data->Count();
        $pages=new \Think\Page($total,5);
       /* $pages->setConfig("prev","上一页");
        $pages->setConfig("next","下一页");
        $pages->setConfig("first","首页");
        $pages->setConfig("last","末页");
        $pages->setConfig("theme"," %FIRST%  %UP_PAGE%  %LINK_PAGE%     %END%    %DOWN_PAGE%");*/
        $list=$pages->show();
        $infos=$data->field("ha.admin_name ,ha.admin_id,hag.title ,ha.status")->join("inner join h_auth_group_access haga on ha.admin_id=haga.uid")->join("inner join h_auth_group hag on haga.group_id=hag.gid")->limit($pages->firstRow,5)->select();
        $this->assign("list",$list)->assign("infos",$infos);
        $this->display();
    }

    /**
     * 添加管理员
     */
    public function add_admin()
    {
        if (IS_POST) {
          $preg1="/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/";
          $phone=I('post.phone');
          $preg2="/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
          $email=I('post.email');
          $preg3="/^\w+$/";
          if(!empty($phone))
          {
              if(!preg_match($preg1,$phone))
              {
                  $this->error("请输入正确的手机号！");
              }
          }
            if(!empty($email))
            {
                if(!preg_match($preg2,$email))
                {
                    $this->error("请输入正确的邮箱！");
                }
            }

            $admin_name = trim(I('post.admin_name'));
//          if(empty($admin_name))
//          {
//              $this->error("用户名不得为空");
//
//          }
            $admin_password = trim(I('post.admin_password'));
//          if(empty($admin_password))
//          {
//              $this->error("密码不得为空");
//          }
         if(!preg_match($preg3,$admin_name))
            {
                $this->error("用户名只能由英文，数字，下划线组成");
            }
            $phone = trim(I('post.phone'));
            $email = trim(I('post.email'));
            $status = I('post.status');
            $group_ids = I('post.group_ids');
            if (empty($group_ids)) {
                $this->error('请选择用户分组');
            }
            if (empty($admin_name) || !isNames($admin_name, 6, 20)) {
                $this->error('请输入6-20位的账号');
            }
            if (empty($admin_password) || !isPWD($admin_password, 6, 20)) {
                $this->error('请输入6-20位的密码');
            }
            if (empty($group_ids)) {
                $this->error('请选择管理组');
            }
            //检查账号是否已存在
            $admin_info = D('Admin')->field('admin_id')->where(array('admin_name' => $admin_name))->find();
            if (!empty($admin_info)) {
                $this->error('账号已存在');
            }
            $data = array(
                'admin_name' => $admin_name,
                'admin_password' => md5($admin_password),
                'phone' => $phone,
                'email' => $email,
                'status' => $status,
                'register_time' => time()
            );
            $result = D('Admin')->addData($data);
            if ($result) {
                $group = array(
                    'uid' => $result,
                    'group_id' => $group_ids
                );
                $res = D('AuthGroupAccess')->addData($group);
                // 操作成功
                if ($res)
                    $this->success('添加成功', U('Admin/Rule/admin_user_list'));
            } else {
                $this->error('添加失败', U('Admin/Rule/admin_user_list'));
            }
        }
        else
       {
            $data = D('AuthGroup')->select();
            $assign = array(
                'data' => $data
            );
            $this->assign($assign);
            $this->display();
        }
    }

    /**
     * 修改管理员
     */
    public function edit_admin()
    {
        if (IS_POST) {

            $preg1="/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/";
            $phone=I('post.phone');
            $preg2="/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
            $email=I('post.email');
            $preg3="/^\w+$/";
            if(!empty($phone))
            {
                if(!preg_match($preg1,$phone))
                {
                    $this->error("请输入正确的手机号！");
                }
            }
            if(!empty($email))
            {
                if(!preg_match($preg2,$email))
                {
                    $this->error("请输入正确的邮箱！");
                }
            }


            $admin_id = I('post.admin_id');
            if ($admin_id == 1) {
                $this->error("该账号不允许被修改", U('Admin/Rule/admin_user_list'));
            }
            $admin_name = trim(I('post.admin_name'));
            $admin_password = trim(I('post.admin_password'));
            $phone = trim(I('post.phone'));
            $email = trim(I('post.email'));
            $status = I('post.status');
            $group_ids = I('post.group_ids');
            //用户ID不能空
            if (empty($admin_id)) {
                $this->error('管理员id异常');
            }
            //用户名不能空且符合正则
            if (empty($admin_name) || !isNames($admin_name, 5, 20)) {
                $this->error('请输入6-20位的账号');
            }
            //用户组ID不能空
            if (empty($group_ids)) {
                $this->error('请选择管理组');
            }
            //检查账号是否已存在
            $admin_info = D('Admin')->field('admin_id')->where("admin_name='" . $admin_name . "' and admin_id !=" . $admin_id)->find();
            if (!empty($admin_info)) {
                $this->error('账号已存在');
            }
            // 修改权限

            D('AuthGroupAccess')->deleteData(array('uid' => $admin_id));
            D('AuthGroupAccess')->add(array('uid' => $admin_id, 'group_id' => $group_ids));
            $data = array(
                'admin_name' => $admin_name,
                'phone' => $phone,
                'email' => $email
            );
            $data = array_filter($data);
            $data['status'] = $status;
            // 如果修改密码则md5
            if (!empty($admin_password)) {
                if (empty($admin_password) || !isPWD($admin_password, 6, 20)) {
                    $this->error('请输入6-20位的密码');
                }
                $data['admin_password'] = md5($admin_password);
            }
            // 组合where数组条件
            $map = array(
                'admin_id' => $admin_id
            );
            $result = D('Admin')->editData($map, $data);
            // 操作成功
            $this->success('编辑成功', U('Admin/Rule/admin_user_list'));
        } elseif (IS_GET) {
            $id = I('get.id', 0, 'intval');
            // 获取用户数据
            $user_data = M('Admin')->find($id);
            // 获取已加入用户组
            $group_data = M('AuthGroupAccess')
                ->where(array('uid' => $id))
                ->getField('group_id', true);
            $group_data = current($group_data);
            // 全部用户组
            $data = D('AuthGroup')->select();
            $assign = array(
                'data' => $data,
                'user_data' => $user_data,
                'group_data' => $group_data
            );
            $this->assign($assign);
            $this->display();
        }
    }
    /**
     * 删除管理员
     */
    public function delete_admin()
    {
        if(IS_POST)
        {
            $admin=$_SESSION['admin'];
            $admin_id=$admin['admin_id'];
            $supadmin=$admin['supadmin'];
            if($admin_id==1 && $supadmin==1)
            {
                $admin_id=I('post.id');
                if($admin_id!=1)
                {
                    $obj=M('admin');
                    $obj->startTrans();
                    $res=$obj->where("admin_id='$admin_id'")->delete();
                    $access=M('authGroupAccess');
                    $result=$access->where("uid='$admin_id'")->delete();
                    if($res && $result)
                    {
                        $obj->commit();//成功则提交
                      echo "1";
                    }
                    else{
                        echo "sfsdf";
                        $obj->rollback();//回滚

                    }
                }
                else
                {
                    /*$this->error("该用户不能被删除");*/
                    echo "3";
                }

            }
            else
            {
                /*$this->error("权限不够，无法删除");*/
                echo "4";
            }


        }
    }

    /**
     * 分配权限
     */
    public function assign_power()
    {
        if (IS_POST) {
            $post = I("POST.");
            if(empty($post['group']))
            {
                $this->error("请选择用户组别");
            }
            $gid=I('POST.group');
            $arr=array();
            foreach($post as $k => $v)
            {
                if($k!='group')
                {
                    $arr[]=$v;
                }
            }
            $arrs=array(1,5,9);
           $arr=array_merge($arr,$arrs);
             sort($arr);
            $str=implode(",",$arr);
            $data=array("rules"=>$str);
            $m=M("authGroup");
            $res=$m->where("gid='$gid'")->save($data);
            if($res>=0)
            {
                $this->success("提交成功",U('Admin/Rule/index'));
            }
            else
            {
                $this->error("提交失败");
            }
        }
    }
}
