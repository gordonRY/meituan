<?php
/**产品分类*/

namespace Common\Model;
use Common\Model\BaseModel;
class ProductCateModel extends BaseModel
{
    public function getOne($where)
    {
        $data=$this->where($where)->find();
        return $data;
    }
    public function getAll($where="1=1")
    {
        $data=$this->where($where)->select();
        return $data;
    }
    public function delete($where)
    {
        $data=$this->where($where)->delete();
        return $data;
    }
    public function add($arr)
    {
        $data=$this->create($arr);
        $res=$this->add($data);
        return $res;
    }
    public function save($where,$data)
    {
        $res=$this->where($where)->save($data);
        return $res;
    }
}