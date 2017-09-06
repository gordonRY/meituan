<?php
// +----------------------------------------------------------------------
// | 用户管理模型
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
class AuthGroupAccessModel extends BaseModel{

	/**
	 * 根据group_id获取全部用户id
	 * @param  int $group_id 用户组id
	 * @return array         用户数组
	 */
	public function getUidsByGroupId($group_id){
		$user_ids=$this
			->where(array('group_id'=>$group_id))
			->getField('uid',true);
		return $user_ids;
	}

	/**
	 * 获取管理员权限列表
	 */
	public function getAllData(){
		$data=$this
			->field('u.admin_id,u.status,u.admin_name,aga.group_id,ag.title')
			->alias('aga')
			->join('__ADMIN__ u ON aga.uid=u.admin_id','RIGHT')
			->join('__AUTH_GROUP__ ag ON aga.group_id=ag.id','LEFT')
            ->order('register_time ASC')
			->select();
		// 获取第一条数据
		$first=$data[0];
		$first['title']=array();
		$user_data[$first['admin_id']]=$first;
		// 组合数组
		foreach ($data as $k => $v) {
			foreach ($user_data as $m => $n) {
				$uids=array_map(function($a){return $a['admin_id'];}, $user_data);
				if (!in_array($v['admin_id'], $uids)) {
					$v['title']=array();
					$user_data[$v['admin_id']]=$v;
				}
			}
		}
		// 组合管理员title数组
		foreach ($user_data as $k => $v) {
			foreach ($data as $m => $n) {
				if ($n['admin_id']==$k) {
					$user_data[$k]['title'][]=$n['title'];
				}
			}
			$user_data[$k]['title']=implode('、', $user_data[$k]['title']);
		}
		// 管理组title数组用顿号连接
		return $user_data;

	}


}
