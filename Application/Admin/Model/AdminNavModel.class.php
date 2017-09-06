<?php
// +----------------------------------------------------------------------
// | 菜单管理模型
// +----------------------------------------------------------------------
// | date:2017-05-17
// +----------------------------------------------------------------------
// | Author: lzb
// +-------------------------------------------------
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 菜单操作model
 */
class AdminNavModel extends BaseModel{

    /*
     * 查询数据是否存在
     * @param	array	$map	where语句数组形式
     * @param   string  $filed  要查询的字段
     * @return	数组	 操作是否成功
     */
    public function getDataOne($map,$filed='*')
    {
        $data = $this->field($filed)->where($map)->find();
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
		$this->where(array($map))->delete();
		return true;
	}

	/**
	 * 获取全部菜单
	 * @return array       一级分类和二级分类组成的数组
	 */
	public function getTreeData()
    {
        $data_father=D("AdminNav")->where("pc_level=1")->select();
        $data_son=D("AdminNav")->where("pc_level=2")->select();
        $new_data=array("father"=>$data_father,"son"=>$data_son);
        return  $new_data;
    }

}


