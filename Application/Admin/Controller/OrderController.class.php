<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/16
 * Time: 9:00
 */

namespace Admin\Controller;
use Common\Controller\AdminBaseController;

class OrderController extends AdminBaseController
{
    public function index()
    {
        $uid=$_SESSION['admin']['admin_id'];
        $m=M('auth_group_access')->field("group_id")->where("uid='$uid'")->select();
      $cur=current($m);
      $gid=$cur['group_id'];
      if($gid==18)
      {
          $m=M('order');
          $res=$m->where("o_saluid='$uid'")->select();
         foreach($res as $k=>$v)
          {
             if($v['o_status']==0)
             {
                 $buildtime=$v['o_buildtime'];
                 $oid=$v['o_id'];
                 $time_expire=strtotime("$buildtime +1 minutes");                     $now_time=time();
                 if($now_time>$time_expire)
                 {
                     $m->startTrans();
                     $res=$m->where("o_id='$oid'")->delete();
                     $d=M('orderDetail');
                     $result=$d->where("detail_oid='$oid'")->delete();
                     if($res && $result)
                     {
                         $m->commit();
                     }
                     else
                     {
                         $this->error("删除过期订单失败！");
                         $m->rollback();
                     }
                 }
             }
          }
          if(IS_POST)
          {
              $time_start=I('post.star_date');
              $time_expire=I('post.star_end');
              $time_expire=date("Y-m-d ",strtotime("$time_expire +1 day"));
              $o_rand=I('post.order_num');
              if( $o_rand )
              {
                  $total=M()->query("select * from h_order where o_saluid='$uid' and o_rand like '%$o_rand%'" );
                  $total=count($total);
                  $pages=new \Think\Page($total,10);
                  $start=$pages->firstRow;
                  $res=M()->query("select * from h_order where o_saluid='$uid' and o_rand like '%$o_rand%' limit $start,10" );
                  $this->res=$res;
                  $this->total=$total;
                  $list=$pages->show();
                  $this->assign("list",$list)->assign("res",$res);
              }
              else
              {
                  if($time_start && $time_expire)
                  {
                      $total=$m->where("o_buildtime>='$time_start' && o_buildtime<='$time_expire' && o_saluid='$uid'")->count();
                      $pages=new \Think\Page($total,10);
                      $res=$m->where("o_buildtime>='$time_start' && o_buildtime<='$time_expire' && o_saluid='$uid'")->limit($pages->firstRow,10)->select();
                      $this->res=$res;
                      $this->total=$total;
                      $list=$pages->show();
                      $this->assign("list",$list)->assign("res",$res);
                  }
                  elseif(!empty($time_start))
                  {
                      $total=$m->where("o_buildtime>='$time_start' && o_saluid='$uid' ")->count();
                      $pages=new \Think\Page($total,10);
                      $res=$m->where("o_buildtime>='$time_start'&& o_saluid='$uid' ")->limit($pages->firstRow,10)->select();
                      $this->res=$res;
                      $this->total=$total;
                      $list=$pages->show();
                      $this->assign("list",$list)->assign("res",$res);
                  }
                  elseif(!empty($time_expire))
                  {
                      $total=$m->where("o_buildtime<='$time_expire'&& o_saluid='$uid' ")->count();
                      $pages=new \Think\Page($total,10);
                      $res=$m->where("o_buildtime<='$time_expire' && o_saluid='$uid'")->limit($pages->firstRow,10)->select();
                      $this->res=$res;
                      $this->total=$total;
                      $list=$pages->show();
                      $this->assign("list",$list)->assign("res",$res);
                  }
              }

          }
          else
          {
              $total=$m->where("o_saluid='$uid' ")->count();
              $pages=new \Think\Page($total,10);
              $res=$m->where("o_saluid='$uid'")->limit($pages->firstRow,10)->select();
              $this->res=$res;
              $this->total=$total;
              $list=$pages->show();
              $this->assign("list",$list)->assign("res",$res);
          }

      }
      else
      {

          $m=M('order');
          $res=$m->select();
          foreach($res as $k=>$v)
          {
              if($v['o_status']==0)
              {
                  $buildtime=$v['o_buildtime'];
                  $oid=$v['o_id'];
                  $time_expire=strtotime("$buildtime +1 minute");
                  $now_time=time();
                  if($now_time>=$time_expire)
                  {
                      $m->startTrans();
                      $res=$m->where("o_id='$oid'")->delete();
                      $d=M('orderDetail');
                      $result=$d->where("detail_oid='$oid'")->delete();
                      if($res && $result)
                      {
                          $m->commit();
                      }
                      else
                      {
                          $this->error("删除过期订单失败！");
                          $m->rollback();
                      }
                  }
              }
          }
          if(IS_POST)
          {
              $time_start=I('post.star_date');
              $time_expire=I('post.star_end');
              $time_expire=date("Y-m-d ",strtotime("$time_expire +1 day"));
              $o_rand=I('post.order_num');
              if( $o_rand )
              {
                  $total=M()->query("select * from h_order where  o_rand like '%$o_rand%'" );
                  $total=count($total);
                  $pages=new \Think\Page($total,10);
                  $start=$pages->firstRow;
                  $res=M()->query("select * from h_order where  o_rand like '%$o_rand%' limit $start,10" );
                  $this->res=$res;
                  $this->total=$total;
                  $list=$pages->show();
                  $this->assign("list",$list)->assign("res",$res);
              }
              else
              {
                  if($time_start && $time_expire)
                  {
                      $total=$m->where("o_buildtime >='$time_start' && o_buildtime<='$time_expire' ")->count();
                      $pages=new \Think\Page($total,10);
                      $res=$m->where("o_buildtime >='$time_start' && o_buildtime<='$time_expire' ")->limit($pages->firstRow,10)->select();
                     // echo $m->getLastSql();
                      $this->res=$res;
                      $this->total=$total;
                      $list=$pages->show();
                      $this->assign("list",$list)->assign("res",$res);
                  }
                  elseif(!empty($time_start))
                  {
                      $total=$m->where("o_buildtime>='$time_start'")->count();
                      $pages=new \Think\Page($total,10);
                      $res=$m->where("o_buildtime>='$time_start'")->limit($pages->firstRow,10)->select();
                      $this->res=$res;
                      $this->total=$total;
                      $list=$pages->show();
                      $this->assign("list",$list)->assign("res",$res);
                  }
                  elseif(!empty($time_expire))
                  {
                      $total=$m->where("o_buildtime<='$time_expire' ")->count();
                      $pages=new \Think\Page($total,10);
                      $res=$m->where("o_buildtime<='$time_expire'")->limit($pages->firstRow,10)->select();
                      $this->res=$res;
                      $this->total=$total;
                      $list=$pages->show();
                      $this->assign("list",$list)->assign("res",$res);
                  }
              }

          }
          else
          {
              $total=$m->count();
              $pages=new \Think\Page($total,10);
              $res=$m->limit($pages->firstRow,10)->select();
              $this->res=$res;
              $this->total=$total;
              $list=$pages->show();
              $this->assign("list",$list)->assign("res",$res);
          }
      }
        $this->display();
    }

    /**
     * 订单详情
     */
    public function order_detail()
    {
        if(IS_GET)
        {
           $o_id=I('get.id');
           $m=current(M('order ord')->field("ouser.nickname,ouser.mobile,pro.p_rname,pro.p_name,pro.p_theme,pro.p_gprice,detail.detail_num,ord.o_totalprice,ord.o_usestatus,ord.o_usetime,ord.o_status,detail.detail_msg_id")->join("inner join h_order_detail detail on detail.detail_oid=ord.o_id ")->join("inner join h_product pro on detail.detail_pid=pro.p_id")->join("inner join h_oauth_user ouser on ouser.user_id=ord.o_userid")->where("ord.o_id='$o_id'")->select());
           $msg=$m['detail_msg_id'];
           if($msg)
           {
               $msg=current(M('comment')->where("msg_id='$msg'")->select());
           }
           else{
               $msg=null;
           }
        }
        //order表
        $this->m=$m;
        $this->msg=$msg;
        $this->display();
    }

    /**
     * 券码验证
     */
    public function check_num()
    {
        $mark=0;
        if(IS_POST)
        {
          $o_code=I('post.code');
          $m=M('order')->where("o_code='$o_code' and o_usestatus=2")->select();
         if($m)
         {
            $mark=1;
           $o_id=current($m)['o_id'];
           $this->o_id=$o_id;
         }
         else
         {
             $mark=2;
         }
        }
        $this->mark=$mark;
        $this->display();
    }

    /**
     * 券码使用
     */
    public function use_code()
    {
        if(IS_POST)
        {
            $o_id=I('post.id');
            $use_time=date("Y-m-d H:i:s",time());
            $data=array("o_usestatus"=>1,"o_usetime"=>$use_time);

            $m=M('order')->where("o_id='$o_id'")->save($data);
            $product=M('order_detail ord')->field("hp.p_num,hp.p_id")->join("inner join h_product hp on hp.p_id=ord.detail_pid")->where("detail_oid='$o_id'")->select();
            $num=current($product)['p_num']+1;
            $p_id=current($product)['p_id'];
            $data=array("p_num"=>$num);

            $res=M("product")->where("p_id='$p_id'")->save($data);
            if($m && $res)
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
    }
    /**
     * ajax删除(单点删除)
     */
    public function order_del()
    {
        if(IS_POST)
        {
            $id=I('post.id');
            $m=M('order ord');
            $require=current($m->field("ord.o_usestatus,hod.detail_msg_id")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->where("ord.o_id='$id'")->select());
            $userstatus=$require['o_usestatus'];
            $msg_id=$require['detail_msg_id'];
            if($msg_id!=0 && $userstatus==4)
            {
                $m=M('order');
                $m->startTrans();
                $res=$m->where("o_id='$id'")->delete();
                $d=M('order_detail');
                $arr=current($d->where("detail_oid='$id'")->select());
                $detail_id=$arr['detail_id'];
                $detail_msg_id=$arr['detail_msg_id'];

                $result=$d->where("detail_id='$detail_id'")->delete();
                if($detail_msg_id!=0)
                {
                    $msg=M('comment');
                    $result_end=$msg->where("msg_id='$detail_msg_id'")->delete();
                    if($res && $result && $result_end)
                    {
                        echo 1;
                         $m->commit();
                    }
                    else
                    {
                        echo 0;
                        $m->rollback();
                    }
                }
                else
                {
                    if($res && $result)
                    {
                        echo 1;
                        $m->commit();
                    }
                    else
                    {
                        echo 0;
                        $m->rollback();
                    }
                }
            }
            else
            {
                //只有使用了代金券（usestatus==1）并且评论了(msg_id!=0)，才能删除订单
                echo 4;
            }



        }
    }
    /**
     * ajax批量删除
     */
    public function delete_all()
    {
        if(IS_POST)
        {
            $ids=substr(I('POST.id'),0,-1);
            $m=M();
            $m->startTrans();
            $sql="delete from h_order where o_id in  ($ids) ";
            $res=$m->execute($sql);
            $str_detail="";
            $str_msg="";
            $ids=explode(",",$ids);
            foreach($ids as $v)
            {
                $sql="select * from h_order_detail where detail_oid='$v'";
                $arr=current($m->query($sql));
                $str_detail.=$arr['detail_id'].",";
                if($arr['detail_msg_id']!=0)
                {
                    $str_msg.=$arr['detail_msg_id'].",";
                }
            }
            $detail_ids=substr($str_detail,0,-1) ;
           $msg_ids =substr($str_msg,0,-1) ;
            $sql="delete from h_order_detail where detail_id in ($detail_ids) ";
            $result=$m->execute($sql);
            if($msg_ids!="")
            {
                $sql="delete from h_comment where msg_id in ($msg_ids) ";
                $result_end=$m->execute($sql);
                if($res && $result && $result_end)
                {
                    echo 1;
                    $m->commit();
                }
                else
                {
                    echo 0;
                    $m->rollback();
                }
            }
            else
            {
                if($res && $result)
                {
                    echo 1;
                    $m->commit();
                }
                else
                {
                    echo 0;
                    $m->rollback();
                }
            }
        }

    }
}