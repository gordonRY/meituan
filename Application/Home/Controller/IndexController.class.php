<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /**
	*首页
	*/
	public function index()
	{

        $m=M("product_cate");
        $father=$m->where("pc_level=1")->select();
        $son=$m->where("pc_level=2")->select();
        //商品的分类
        $this->son=$son;
        $this->father=$father;

        //商品的介绍
          $product=M("product")->select();
          $this->product=$product;

        $hot=$m->where("pc_level=2")->order("pc_hot desc")->select();
        $this->hot=$hot;

        $product=M("product");
        $hot_product=$product->order("p_num desc")->select();
        $total=count( $hot_product);
        if(session('home.username'))
        {
            $name=session('home.username');
            $this->name=$name;
        }
        $this->hot_product=$hot_product;
        $this->total=$total;
		$this->display();
    }
    /**
     * search
     */
    public function search()
    {
        if(IS_GET)
        {
            $search=I('get.search');
            $p=M();
            $sql="select * from h_product where p_rname like '%$search%'";
            $res=$p->query($sql);
            $total=count($res);
            $this->total=$total;
            $this->search=$search;
            $this->res=$res;
           $this->display();
        }
    }
    /**
     * 前台验证账号
     */
    public function check_name()
    {
        if(IS_POST)
        {
            $username=I('post.username');
            $m=M('oauthUser')->where("username='$username'")->select();
            if($m)
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
     * 前台验证码验证
     */
    public function verify()
    {
        if(IS_POST)
        {
             $code=I('POST.code');
             $res=check_verify($code);
            if($res)
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
     * 验证码
     */
    public function check_num()
    {
        $config =    array(
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            'useCurve'   =>false
        );
        $Verify = new \Think\Verify($config);
        // 设置验证码字符为纯数字
        $Verify->codeSet = '0123456789';
        $Verify->entry();

    }
    /**
     * logout
     */
    public function logout()
    {
        session('home',null);
        $this->success("退出成功",U('Home/Index/index'));
    }
    /**
     * login
     */
    public function login()
    {
        if(IS_POST)
        {
            $username=I('post.user');
            $password=md5(I('post.password'));
            $m=M('oauthUser')->where("username='$username' && password='$password'")->select();
            if(!empty($m) && current($m)['status']==1)
            {
                session(array('name'=>'session_id','expire'=>3600));
                session("home",current($m));
                $this->success("登录成功",U('Home/Index/index'));
            }
            elseif(!empty($m) && current($m)['status']==0)
            {
                $this->error("该用户被禁用！");
            }
            elseif(empty($m))
            {
                $this->error("密码错误！");
            }
        }
        else
        {
            $this->display();
        }

    }
    /**
     * regist
     */
    public function regist()
    {
        if(IS_POST)
        {
           $username=I('post.user');
           $password=md5(I('post.pass'));
           $email=I('email');
           $mobile=I('mobile');
           $nickname=I('nickname');
           if(!$nickname)
           {
               $nickname=GetRandCh(5);
           }
           $create_time=date("Y-m-d H:i:m",time());
           $data=array("username"=>$username,"password"=>$password,"email"=>$email,"mobile"=>$mobile,"create_time"=>$create_time,"nickname"=>$nickname);
           $m=M('oauthUser');
           $res=$m->create($data);
           $res=$m->add($res);
           if($res)
           {
               $this->success("注册成功！",U('Home/Index/login'));
           }
           else
           {
               $this->success("注册失败！");
           }
        }
        $this->display();
    }
	/**
	商品详情
	*/
    public function product_introduce()
    {
        $p_id=I('get.id');
        $m=current(M('product')->where("p_id='$p_id'")->select());
        //查询商品表
        $fid=$m['p_fpcid'];
        $sid=$m['p_spcid'];
        $cate=M('product_cate')->field("pc_name")->where("pc_id in('$fid','$sid')")->select();
        $m['fname']=current($cate)['pc_name'];
        $m['sname']=end($cate)['pc_name'];
        $pic=explode(";",$m['p_pic']);
        $this->m=$m;
        //查询评论
        $comment=M('comment com')->join("inner join h_oauth_user hou on hou.user_id=com.uid")->where("com.pid='$p_id'")->select();
        $total=count($comment);
        $pages=new \Think\Page($total,10);

        if(I('get.sorttype'))
        {
            $comment=M('comment com')->join("inner join h_oauth_user hou on hou.user_id=com.uid")->where("com.pid='$p_id'")->LIMIT($pages->firstRow,5)->order("com.time desc")->select();
        }
        else
        {
            $comment=M('comment com')->join("inner join h_oauth_user hou on hou.user_id=com.uid")->where("com.pid='$p_id'")->LIMIT($pages->firstRow,5)->select();
        }
        $list=$pages->show();
        $this->total=$total;
        $this->comment=$comment;
        $this->list=$list;


        $this->pic=$pic;
        $this->display();
    }
	/**
	订单页面
	*/
    public function order()
    {
        if(I("session.home"))
        {
            $product_num=I('get.product_num');
            $p_id=I('get.pid');
            $p_name=I('get.p_name');
            $gprice=I('get.gprice');
            $total=$product_num*$gprice;
            $data=array("num"=>$product_num,"name"=>$p_name,"price"=>$gprice,"total"=>$total,"p_id"=>$p_id);
            $this->data=$data;
            $this->display();
        }
        else
        {
            $this->error("请登陆后购买",U('Home/Index/login'));
        }

    }
	/**
	*订单支付
	*/
    public function order_pay()
    {
        if(I('get.oid'))
        {

            //从我的订单里过来
            $o_id=I('get.oid');
            $data=M('order')->where("o_id='$o_id'")->select();
            $data=current($data);
            $detail=M('order_detail ord')->join("inner join h_product hp on hp.p_id=ord.detail_pid")->where("ord.detail_oid='$o_id'")->select();
            $p_name=current($detail)['p_name'];
            $detail=current($detail);
            $o_totalprice=$detail['p_num']*$detail['p_gprice'];
            $data['o_totalprice']=$o_totalprice;
            $p_id=$detail['p_id'];
        }
        else
        {
            $o_rand=time().rand(1000,9999);
            $o_buildtime=date("Y-m-d H:i:s",time());
            $o_totalprice=I('post.total');
            $user=I('session.home');
            if(!empty($user['nickname']))
            {
                $o_username=$user['nickname'];
            }
            else
            {
                $o_username=$user['username'];
            }
            $o_userid=$user['user_id'];
            M()->startTrans();
            $p_id=I('post.p_id');
            $m=M('product')->field("p_uid")->where("p_id='$p_id'")->select();
            $o_saluid=current($m)['p_uid'];
            $data=array("o_rand"=>$o_rand,"o_buildtime"=>$o_buildtime,"o_totalprice"=>$o_totalprice,"o_username"=>$o_username,"o_userid"=>$o_userid,"o_saluid"=>$o_saluid);
            $data=M('order')->create($data);
            $res=M('order')->add($data);
            $detail_oid=$res;
            $detail_num=I('post.num');
            $detail_pid=$p_id;
            $detail=array("detail_oid"=>$detail_oid,"detail_num"=>$detail_num,"detail_pid"=>$detail_pid);
            $detail= M('order_detail')->create($detail);
            $result= M('order_detail')->add();
            if(!$res && !$result)
            {
                M()->rollback();
                $this->error("出错！");
            }
            else
            {
                M()->commit();
            }
            $p_name=I("post.p_name");
        }
        $this->p_name=$p_name;
        $this->p_id=$p_id;
        $this->data=$data;
        $this->detail=$detail;
        $this->display();

    }
    /**
     * 查看订单信息
     */
    public function pay_infos()
    {
        if(I('get.oid'))
        {
            $o_id=I('get.oid');
            $m=current(M('order')->where("o_id='$o_id'")->select());
            $this->m=$m;
            $this->display();
        }
    }
    /**
     * 支付成功
     */
    public function pay_success()
    {
        $rand=I('post.rand');
        $o_paytime=date("Y-m-d H:i:s",time());
        $o_status=1;
        $o_usestatus=2;
        $code=GetRandStr(15);
        $o_code=$code;
        $data=array("o_paytime"=>$o_paytime,"o_status"=>$o_status,"o_code"=>$o_code,"o_usestatus"=>$o_usestatus);
        $m=M('order')->where("o_rand='$rand'")->save($data);
        if(!$m)
            $this->error("支付失败");
        $this->code=$code;
        $this->rand=$rand;
        $this->display();
    }
    /**
     * 订单详情
     */
    public function all()
    {

        $home=I('session.home');
        if($home=='')
        {
            $this->error("还没有登录",U('Home/Index/login'));
        }
        $uid=$home['user_id'];

        //未付款
        $not_pay=M('order ')->where("o_userid='$uid' && o_status=0")->select();
        $num_not_pay=count($not_pay);
        $this->num_not_pay=$num_not_pay;

        if(I('get.pay'))
        {
            $pay=I('get.pay');
            if($pay=="no_pay")
            {
                //查询所有订单信息
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_status=0")->select();
                $total=count($m);
                $pages=new \Think\Page($total,5);
                $start=$pages->firstRow;
                $list=$pages->show();
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_status=0")->order("ord.o_id desc")->limit($start,5)->select();
                $this->pay=$pay;
            }
            elseif ($pay=="no_consume")
            {
                //查询所有订单信息
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=2 ")->select();
                $total=count($m);
                $pages=new \Think\Page($total,5);
                $start=$pages->firstRow;
                $list=$pages->show();
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=2 ")->order("ord.o_id desc")->limit($start,5)->select();
                $this->pay=$pay;
            }
            elseif ($pay=="success")
            {
                //查询所有订单信息
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=1")->select();
                $total=count($m);
                $pages=new \Think\Page($total,5);
                $start=$pages->firstRow;
                $list=$pages->show();
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=1 ")->order("ord.o_id desc")->limit($start,5)->select();
                $this->pay=$pay;
            }
        }
        elseif(I('get.com'))
        {
            $com=I('get.com');
            if($com=='commenting')
            {
                //查询所有订单信息
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=1")->select();
                $total=count($m);
                $pages=new \Think\Page($total,5);
                $start=$pages->firstRow;
                $list=$pages->show();
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=1 ")->order("ord.o_id desc")->limit($start,5)->select();
            }
            elseif ($com=='commented')
            {
                //查询所有订单信息
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=4")->select();
                $total=count($m);
                $pages=new \Think\Page($total,5);
                $start=$pages->firstRow;
                $list=$pages->show();
                $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' && ord.o_usestatus=4 ")->order("ord.o_id desc")->limit($start,5)->select();
            }
        }
        else
        {
            //查询所有订单信息
            $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid'")->select();
            $total=count($m);
            $pages=new \Think\Page($total,5);
            $start=$pages->firstRow;
            $list=$pages->show();
            $m=M('order ord')->field("ord.o_rand,ord.o_usestatus,ord.o_id,ord.o_totalprice,ord.o_status,hod.detail_id,hod.detail_num,hp.p_id,hp.p_name,hp.p_theme,hp.p_endtime")->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_userid='$uid' ")->order("ord.o_id desc")->limit($start,5)->select();
        }
        $this->m=$m;
        $this->list=$list;
        $this->display();
    }
    /**
     * 退款
     */
    public function refund()
    {
        $oid=I('post.oid');
        $o_userstatus=3;
        $data=array("o_usestatus"=>$o_userstatus);
        $m=M('order')->where("o_id='$oid'")->save($data);
        if($m)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }
    /**
     * 评论内容
     */
    public function comment_info()
    {
        if(IS_POST)
        {
           $comment=I('post.comment');
           $star=current(I('post.radioInline'));
            $uid=I('session.home')['user_id'];
            $pid=I('post.pid');
            $o_id=I('post.oid');
            $use=array("o_usestatus"=>4);
            $m=M('order');
            $m->startTrans();
            $ord=$m->where("o_id='$o_id'")->save($use);
            $time=date("Y-m-d H:i:m",time());
            $data=array("uid"=>$uid,"pid"=>$pid,"comment"=>$comment,"star"=>$star,"time"=>$time);
            $comment=M('comment')->create($data);
            $comment=M('comment')->add($comment);
            $datail=M('order_detail')->where("detail_oid='$o_id'")->save(array('detail_msg_id'=>$comment));

            if($comment && $ord && $datail)
            {
                $m->commit();
                $this->success("评论成功",U("Home/Index/all"));
            }
            else
            {
                $m->rollback();
                $this->error("评论失败！");
            }
        }
    }
    /**
     *
     *查看商品的评论
     */
    public  function comment_detail()
    {
        $o_id=I('get.id');
        $msg_id=current(M('order_detail')->field("detail_msg_id")->where("detail_oid='$o_id'")->select())['detail_msg_id'];
        $msg=current(M('comment')->where("msg_id='$msg_id'")->select());
        $pid=$msg['pid'];

        $p_name=current(M('product')->where("p_id='$pid'")->select())['p_name'];
        $p_theme=current(M('product')->where("p_id='$pid'")->select())['p_theme'];
        $this->p_name=$p_name;
        $this->p_theme=$p_theme;
        $this->msg=$msg;
        $this->display();
    }

    /**
     * 评价商品
     */
    public function comment()
    {
        $o_id=I('get.id');
        $m=M('order ord')->join("h_order_detail hod on hod.detail_oid=ord.o_id")->join("h_product hp on hp.p_id=hod.detail_pid")->where("ord.o_id='$o_id'")->select();
        $m=current($m);
        $this->o_id=$o_id;
        $this->m=$m;
        $this->display();
    }
    /**
     * 订单详情里查看订单信息
     */
    public function order_info()
    {
        $o_id=I("get.oid");
        $data=M('order ord ')->join("inner join h_order_detail hod on hod.detail_oid=ord.o_id")->join('inner join h_product hp on hp.p_id=hod.detail_pid')->where("ord.o_id='$o_id'")->select();
        $data=current($data);
        $this->data=$data;
        $this->display();
    }
    /**
     * 待评价
     */
    public function torate()
    {
        $this->display();
    }
    /**
     * 已评价
     */
    public function rated()
    {
        $this->display();
    }

}
function GetRandStr($len)
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $output = "";
    for ($i=0; $i<$len; $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}

function check_verify($code, $id = '')
{
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function GetRandCh($len)
{
    $chars = array(
        "面积", "惋惜", "你", "分管", "擦去", "大红", "之", "子", "熙", "也", "k",
        "l帅", "西游", "他", "o", "怎么办", "q", "r", "死鬼", "t", "u", "v",
        "w", "x", "y", "z", "九尾", "车子", "C", "酷", "E", "F", "G",
        "H", "I", "鹏", "K", "洛阳", "M", "N", "葫芦", "P", "会", "R",
        "什么", "T", "赵云", "V", "五环", "X", "红孩儿", "Z", "孙悟空", "1", "2",
        "3", "的", "5", "6", "7", "八戒", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $output = "";
    for ($i=0; $i<$len; $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}