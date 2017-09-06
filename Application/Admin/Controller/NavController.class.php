<?php
// +----------------------------------------------------------------------
// | 菜单管理控制器
// +----------------------------------------------------------------------
// | date:2017-05-17
// +----------------------------------------------------------------------
// | Author: lzb
// +-------------------------------------------------
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台菜单管理
 */
class NavController extends AdminBaseController{
	/**
	 * 菜单列表
	 */
	public function index(){
	
		$data=D('AdminNav')->getTreeData();
        $father=current($data);
        $son=end($data);
        $arr=array_merge($father,$son);
        $arr=get_cate($arr);
        $this->arr=$arr;
		$this->display();
	}

	/**
	 * 添加菜单
	 */
	public function add(){
		if(IS_POST){
            $id = I('post.pid');
            $name = trim(I('post.name'));
            $mca = trim(I('post.mca'));
			if(empty($name) || empty($mca)) $this->error('抱歉！参数不全');
            //查看mca是否已存在
            $AdminNav_db = D('AdminNav');
            $AuthRule_db = D('AuthRule');
            $bool = $AdminNav_db->getDataOne(array('mca'=>$mca),'id');
            if(!empty($bool))
            {
                $this->error('链接已存在，请核对');
            }
            //插入数据
            //判断是一级菜单还是二级菜单
            $count=substr_count("$mca","/");
            if($count==1)
            {
                $data=array(
                    'fid'=>0,
                    "name"=>$name,
                    "mca"=>$mca,
                    "pc_level"=>1 );
                    $result = $AdminNav_db->addData($data);
            }
            elseif($count==2 && $id!=0)
            {

                $data = array(
                    'fid' => $id,
                    'name' => $name,
                    'mca' => $mca,
                    'pc_level'=>2
                );
                $result = $AdminNav_db->addData($data);
            }
            else
            {
                $this->error('链接格式不对，请核对');
            }


			if ($result) {
                //添加相应的权限
                $rule_data = array();
                if($data['fid'] != 0)
                {
                    $rule_data['name']=$data['mca'];
                    $rule_data['title']=$data['name'];
                    $rule_data['nid']=$result;
                    $rule_result = $AuthRule_db->addData($rule_data);
                    if($rule_result)
                    {
                        $this->success('添加成功',U('Admin/Nav/index'));
                    }
                    else
                    {
                        $this->success('添加菜单成功，权限失败',U('Admin/Nav/index'));
                    }
                }
                elseif ($data['fid'] == 0)
                {
                    $this->success('添加成功',U('Admin/Nav/index'));
                }

			}else{
				$this->error('添加失败');
			}
		}
		else
		    {
			$this->display('index/index');
		}
	}

    /*
     * 修改超级管理员的auth_group权限
     * $auth_rule_id 新增的auth_rule表id
     * */
    public function edit_auth_group($auth_rule_id)
    {
        if(empty($auth_rule_id) || $auth_rule_id < 1)
        {
            return false;
        }
        $AuthGroup_db = D('AuthGroup');
        $group_info = $AuthGroup_db->field('id,rules')->where('id=1 and status=1')->find();
        if(empty($group_info))
        {
            return false;
        }
        if(empty($group_info['rules']))
        {
            $str = $auth_rule_id;
        }
        else
        {
            $str = $group_info['rules'].','.$auth_rule_id;
        }
        return $AuthGroup_db->editData(array('id'=>$group_info['id']),array('rules'=>$str));
    }

	/**
	 * 修改菜单
	 */
	public function edit(){
		$AdminNav = D('AdminNav');
		if(IS_POST){
			$data=I('post.');
			if(empty($data['name']) || empty($data['mca'])) $this->error('抱歉！参数不全');
            //查询信息是否存在
            $nav_info = $AdminNav->getDataOne(array('id'=>$data['id']),'mca');
            $nav_level=$AdminNav->getDataOne(array('id'=>$data['id']),'pc_level');
            $pc_level=current($nav_level);
            if(empty($nav_info))
            {
                $this->error('信息异常');
            }
			$map=array(
				'id'=>$data['id']
				);
			$result=$AdminNav->editData($map,$data);
			if($pc_level==1)
            {
                $this->success('修改成功',U('Admin/Nav/index'));
            }
            else{
                if ($result) {
                    //相关权限也修改
                    $AuthRule=D('AuthRule');
                    $rule_result = $AuthRule->editData(array('nid'=>$data['id']),array('name'=>$data['mca'],'title'=>$data['name']));
                    if($rule_result)
                    {
                        $this->success('修改成功',U('Admin/Nav/index'));
                    }
                    else
                    {
                        $this->success('修改成功,修改权限失败',U('Admin/Nav/index'));
                    }
                }else{
                    $this->error('修改失败');
                }
            }

		}else{
			$id = I('id', 0);
			$data = $AdminNav->find($id);
			if(empty($data)) $this->error('找不到指定菜单', U('Nav/index'));
			$this->assign('data', $data);
			$this->display();
		}
	}

	/**
	 * 删除菜单
	 */
	public function delete(){
		$id=I('get.id');
		$map=array(
			'id'=>$id
			);
        $AdminNav = D('AdminNav');
        $AuthRule_db = D('AuthRule');
        $res= $AdminNav ->getDataOne($map);
        if($res['pc_level']==1)
        {
            $fid=$res['id'];
            $map=array("fid"=>$fid);
            if(count($AdminNav ->getDataOne($map))>0)
            {
                //$this->error("该父级菜单栏下存在子集，不能删除");
                echo 1;
            }
            else
            {
                $rows= $AdminNav ->where("id='$fid'")->delete();
                if($rows)
                {
                   // $this->success("删除成功");
                    echo 2;
                }
                else
                {
                    //echo $AdminNav ->getLastSql();
                   //$this->error("删除失败");
                    echo 3;
                }
            }
        }
        else
            {
                $AdminNav->startTrans();
                $row=$AdminNav->where($map)->delete();
                $rows= $AuthRule_db ->where("nid='$id'")->delete();
                if($row && $rows)
                {
                    $AdminNav->commit();
                    $this->success("菜单，权限删除成功");
                }
                else{
                    $AdminNav->rollback();
                    $this->error("删除失败");
                }
            }
    }

}
