<?php
// +----------------------------------------------------------------------
// | 权限管理模型
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
class AuthRuleModel extends BaseModel{
    /*
    * 查询单条数据
    * @param	array	$map	where语句数组形式
    * @param   string  $filed  要查询的字段
    * @return	数组	 操作是否成功
    * */
    public function getDataOne($map,$filed='*')
    {
        $data = $this->field($filed)->where($map)->find();
        if(empty($data)) return false;
        return $data;
    }

	/**
	 * 删除数据
	 * @param	array	$map	where语句数组形式
	 * @return	boolean			操作是否成功
	 */
	public function deleteData($map){
		$count=$this
			->where(array('pid'=>$map['id']))
			->count();
		if($count!=0){
			return false;
		}
		$result=$this->where($map)->delete();
		return $result;
	}
}
