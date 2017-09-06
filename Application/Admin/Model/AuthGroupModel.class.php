<?php
// +----------------------------------------------------------------------
// | 用户组管理模型
// +----------------------------------------------------------------------
// | date:2017-05-17
// +----------------------------------------------------------------------
// | Author: lzb
// +-------------------------------------------------
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 权限规则model
 */
class AuthGroupModel extends BaseModel{

	/**
	 * 传递主键id删除数据
	 * @param  array   $map  主键id
	 * @return boolean       操作是否成功
	 */
	public function deleteData($map){
		$this->where($map)->delete();
		$group_map=array(
			'group_id'=>$map['id']
			);
		//删除关联表中的组数据
		$result=D('AuthGroupAccess')->deleteData($group_map);
		return $result;
	}

    /*
     * 更新权限
     * $map 条件
     * $data 更新数据
     * */
    public function editData($map,$data)
    {
        if($this->where($map)->save($data)) return true;
        return false;
    }

}
