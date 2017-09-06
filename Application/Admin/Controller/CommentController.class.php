<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/17
 * Time: 21:18
 */

namespace Admin\Controller;

use Common\Controller\AdminBaseController;
class CommentController extends AdminBaseController
{
    public function index()
    {
        $admin=$_SESSION['admin'];
        $p_uid=$admin['admin_id'];
        $gid=M("admin")->field("aga.group_id")->join("inner join h_auth_group_access aga on h_admin.admin_id=aga.uid ")->where("h_admin.admin_id='$p_uid'")->select();
        $gid=current($gid);
        $gid=$gid['group_id'];
        if($gid==18)
        {
            //券码使用后一段时间自动五星好评
            $order=M('order')->where("o_saluid='$p_uid'")->select();
            foreach($order as $k=>$v)
            {
                $use_time=$v['o_usetime'];
                if($v['o_usestatus']==1)
                {
                    //判断msg_id是否为0
                    $oid=$v['o_id'];
                    $m=M('order_detail')->where("detail_oid='$oid'")->select();
                    $msg_id=current($m)['detail_msg_id'];
                    if($msg_id==0)
                    {
                        $expire=strtotime("$use_time +1 minutes");
                        $now_time=time();
                        if($now_time>$expire)
                        {
                            $uid=$v['o_userid'];
                            $ord=M('order')->where("o_id='$oid'")->save(array("o_usestatus"=>4));
                            $pid=current($m)['detail_pid'];
                            $star=5;
                            $comment="系统默认好评！";
                            $time=date("Y-m-d H:i:s",time());
                            $data=array("star"=>$star,"comment"=>$comment,"time"=>$time,"uid"=>$uid,"pid"=>$pid);
                            $comment=M('comment')->add($data);
                            if($comment)
                            {
                                $detail_msg_id=$comment;
                                $data=array("detail_msg_id"=>$detail_msg_id);
                                $detail=M('order_detail')->where("detail_oid='$oid'")->save($data);
                                $order_use=M('order')->where("o_id='$oid'")->save(array('o_usestatus'=>4));
                                if(!$detail && !$order_use)
                                {
                                    $this->error("添加系统默认好评出错！");
                                }
                            }
                            else
                            {
                                $this->error("系统默认好评出错！");
                            }
                        }
                    }

                }

            }
            if(I('post.search_order'))
            {
                $search=I('post.search_order');
                $m=M('comment com');
                $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->where("pro.p_uid='$p_uid' && ho.o_rand like '%$search%'")->select();
                $total=count($res);
                $pages=new \Think\Page($total,10);
                $start=$pages->firstRow;
                $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->limit($start,10)->where("pro.p_uid='$p_uid' && ho.o_rand like '%$search%'")->select();
                $this->total=$total;
                $list=$pages->show();
                $this->assign("list",$list)->assign("res",$res);
            }
            else
             {
                 $m=M('comment com');
                 $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->where("pro.p_uid='$p_uid'")->select();
                 $total=count($res);
                 $pages=new \Think\Page($total,10);
                 $start=$pages->firstRow;
                 $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->limit($start,10)->where("pro.p_uid='$p_uid'")->select();
                 $this->total=$total;
                 $list=$pages->show();
                 $this->assign("list",$list)->assign("res",$res);
                 $result=current($res);

             }

        }
        else{

            $order=M('order')->select();
            foreach($order as $k=>$v)
            {
                $use_time=$v['o_usetime'];
                if($v['o_usestatus']==1)
                {
                    //判断msg_id是否为0
                    $oid=$v['o_id'];
                    $m=M('order_detail')->where("detail_oid='$oid'")->select();
                    $msg_id=current($m)['detail_msg_id'];
                    if($msg_id==0)
                    {
                        $expire=strtotime("$use_time +1 minutes");
                        $now_time=time();
                        if($now_time>$expire)
                        {
                            $uid=$v['o_userid'];

                            $ord=M('order')->where("o_id='$oid'")->save(array("o_usestatus"=>4));
                            $pid=current($m)['detail_pid'];
                            $star=5;
                            $comment="系统默认好评！";
                            $time=date("Y-m-d H:i:s",time());
                            $data=array("star"=>$star,"comment"=>$comment,"time"=>$time,"uid"=>$uid,"pid"=>$pid);
                            $comment=M('comment')->add($data);
                            if($comment)
                            {
                                $detail_msg_id=$comment;
                                $data=array("detail_msg_id"=>$detail_msg_id);
                                $detail=M('order_detail')->where("detail_oid='$oid'")->save($data);
                                $order_use=M('order')->where("o_id='$oid'")->save(array('o_usestatus'=>4));
                                if(!$detail && !$order_use)
                                {
                                    $this->error("添加系统默认好评出错！");
                                }
                            }
                            else
                            {
                                $this->error("系统默认好评出错！");
                            }
                        }


                    }

                }

            }
            if(I("post.search_order"))
            {
                $search=I("post.search_order");
                $m=M('comment com');
                $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->where("ho.o_rand like '%$search%'")->select();
                $total=count($res);
                $this->total=$total;
                $pages=new \Think\Page($total,10);
                $start=$pages->firstRow;
                $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->where("ho.o_rand like '%$search%'")->limit($start,10)->select();
                $this->res=$res;
                $list=$pages->show();
                $this->assign("list",$list)->assign("res",$res);
                $result=current($res);
            }
            else
            {
                $m=M('comment com');
                $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->select();
                $total=count($res);
                $this->total=$total;
                $pages=new \Think\Page($total,10);
                $start=$pages->firstRow;
                $res=$m->field("com.msg_id,hou.nickname,com.time,pro.p_name,com.star,com.comment,ho.o_rand")->join("inner join h_oauth_user hou on hou.user_id=com.uid")->join("inner join h_product pro on pro.p_id=com.pid")->join("inner join h_order_detail hod on hod.detail_msg_id=com.msg_id")->join("inner join h_order ho on ho.o_id=hod.detail_oid")->limit($start,10)->select();
                $this->res=$res;
                $list=$pages->show();
                $this->assign("list",$list)->assign("res",$res);
                $result=current($res);
            }

        }
        $this->display();
    }
    /**
     * 删除
     */
    public function delete()
    {
        if(IS_POST)
        {
            $id=I('post.id');
            M()->startTrans();//开启事务
            $m=M('comment');
            $d=M('order_detail');
            $c=M('order');
            //第一步 删除 comment表
            $res=$m->where("msg_id='$id'")->delete();
            //获取detail_order id
            $ids=current($d->where("detail_msg_id='$id'")->select());
            $detail_id=$ids['detail_id'];
            $o_id=$ids['detail_oid'];
            //第二部 删除detail_order表
           $result= $d->where("detail_id='$detail_id'")->delete();
           //第二部 删除order表
            $result_end=$c->where("o_id='$o_id'")->delete();
            if($res && $result)
            {
                if($result_end)
                {

                    M()->commit();//成功则提交
                    echo 1;
                }
                else
                {
                    M()->rollback();//回滚
                    echo 0;
                }
            }
        }
    }
    /**
     * 修改
     */
    public function edit()
    {
        if(IS_POST)
        {
          /* 'star' => string '5s' (length=2)
             'comment' => string '傻逼玩意' (length=12)
             'msgID' => string '1' (length=1)*/
          $star=I('post.star');
          $comment=I('post.comment');
          $msg_id=I('post.msgID');
          if($star=='')
          {
              $this->error("请填写评分");
          }
          else
          {
              $preg="/^[1-5]{1}$/";
             $res= preg_match($preg,$star);
             if(!$res)
             {
                 $this->error("请输入1-5之间的数字");
             }
          }
            if($comment=='')
            {
                $this->error("评论内容不能为空");
            }
            $data=array("star"=>$star,"comment"=>$comment);
            $m=M('comment');
            $res=$m->where("msg_id='$msg_id'")->save($data);
            if($res)
            {
                $this->success("修改成功！",U('Admin/Comment/index'));
            }
            else{
                $this->error("修改失败！");
            }
        }
    }
}