<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class ProductController extends AdminBaseController
{
    public function index()
    {

        $d=D("ProductCate")->getAll("");
        $father=get_cate1($d);
        $this->father=$father;
       $this->display();
    }
   /* public function  product_category()
    {
        $this->display();
    }*/
   public function uploadFile()
   {
       iF(IS_POST)
       {
           $upload = new \Think\Upload();// 实例化上传类
           $upload->maxSize   =     10485760 ;// 设置附件上传大小
           $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
           $upload->rootPath  =     './Public/'; // 设置附件上传根目录
           $upload->savePath  =     'Upload/Pic/'; // 设置附件上传（子）目录
           // 上传文件
           $info   =  current($upload->upload()) ;
           $info['url']=$info['savepath'].$info['savename'];
           if(!$info) {// 上传错误提示错误信息
               $this->ajaxReturn($upload->getError());
           }else{// 上传成功
               //$this->success('上传成功！');
               $this->ajaxReturn($info);
           }
       }
       else
       {
           $this->display();
       }

   }

    /**
     * 编辑分类
     */
   public function edit_cate()
   {
       $pc_id=I('post.id');
       $pc_name=I('post.name');
       $pc_show=I('post.show');
       if($pc_show=="显示")
       {
           $pc_show=1;
       }
       elseif($pc_show=="不显示")
       {
           $pc_show=0;
       }
       else
       {
           $this->error("是否显示的格式错误");
       }
       $m=M('product_cate');
       $data=array("pc_name"=>$pc_name,"pc_show"=>$pc_show);
       $res=$m->where("pc_id='$pc_id'")->save($data);
       if($res)
       {
           $this->success("修改成功！",U('Admin/Product/index'));
       }
       elseif($res==0)
       {
           $this->success("修改成功！",U('Admin/Product/index'));
       }
       else
       {
           $this->error("修改失败！");
       }
   }
    /**
     * 删除分类
     */
public function delete_cate()
{
    /*array (size=1)
  'id' => string '11' (length=2)*/
    $pc_id=I('get.id');
    $res=M('product_cate')->where("pc_fid='$pc_id'")->select();
    if($res)
    {
        echo 1;//存在子集，不能删除
    }
    else
    {
        $res=M('product_cate')->where("pc_id='$pc_id'")->delete();
        if($res)
        {
            echo 2;//删除OK
        }
        else
        {
            echo 3;//删除失败
        }
    }

}




    /**
     * 添加分类
     */
public function add_cate()
{
    if(IS_POST)
    {
        $pc_name=I('post.name');
        $pc_show=I('POST.show');
        if(I('post.pid')==0)
        {
            $pc_level=1;
            $data=array("pc_name"=>$pc_name,"pc_level"=>$pc_level,"pc_show"=>$pc_show);

        }
        else
        {
            $pc_level=2;
            $pc_fid=I('POST.pid');
            $data=array("pc_name"=>$pc_name,"pc_level"=>$pc_level,"pc_show"=>$pc_show,"pc_fid"=>$pc_fid);

        }
        $m=M('product_cate');
        $data=$m->create($data);
        $res=$m->add($data);
        if($res)
        {
            $this->success("添加成功！",U('Admin/Product/index'));
        }
        else
        {
            $this->error("添加失败！");
        }

    }


}
    /**
     * 进入 编辑 商品页面（吧一些数据写死）
     */
   public function product_add_edit()
   {

       $m=array("day"=>'');
       if(IS_GET)
       {
           $p_id=I('get.id');
           $m=M('product')->where("p_id='$p_id'")->select();
           $m=current($m);
           $start=strtotime($m['p_pubtime']);
           $end=strtotime($m['p_endtime']);
           $day=round(($end-$start)/86400);
           $m["day"]=$day;
           $arr=explode(";",$m['p_pic']);
           $this->arr=$arr;

       }
       $d=D("ProductCate")->getAll(" pc_level=1");
       $data=D("ProductCate")->getAll(" pc_fid=1");
       $this->data=$data;
       $this->m=$m;
       $this->d=$d;
       $this->display();
   }
    /**
     * 进入 添加 商品页面（把一些数据写死）和编辑页面的区别：缩略图的validate
     */
   public function product_add()
   {
       $m=array("day"=>'');
       $d=D("ProductCate")->getAll(" pc_level=1");
       $data=D("ProductCate")->getAll(" pc_fid=1");
       $this->data=$data;
       $this->m=$m;
       $this->d=$d;
       $this->display();
   }

    /**
     * 商品分类二级联动
     */
    public  function cate_change($id)
    {
        $data=D("ProductCate")->getAll(" pc_fid=$id");
        $this->ajaxReturn($data);
    }

    /**
     * 地区三级联动
     */
    public  function addr_change($id)
    {
        if(IS_AJAX)
        {
            $data=M('area')->where("fid='$id'")->select();
            $this->ajaxReturn($data);
        }

    }

    /**
     * 商品入库
     */
   public function addProduct()
   {

      iF(IS_POST)
       {
           
            //判断是否是从编辑页面过来的
               $upload = new \Think\Upload();// 实例化上传类
               $upload->maxSize   =     10485760 ;// 设置附件上传大小
               $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
               $upload->rootPath  =     './Public/'; // 设置附件上传根目录
               $upload->savePath  =     'Upload/them/'; // 设置附件上传（子）目录
               // 上传文件
               $info   =  current($upload->upload()) ;
               $info['url']=$info['savepath'].$info['savename'];
               if($info)
               {
                   $_POST['theme']=$info['url'];
               }
               //判断有没有重新上传图片，否则使用之前的
           if($_POST['theme']=='')
           {
               $_POST['theme']=$_POST['theme_edit'];
           }
           //判断有没有上传新的展示图片，否则使用之前的
           if($_POST['pic']=='')
           {
               if(!empty($_POST['pic_edit']))
               {
                   $_POST['pic']=$_POST['pic_edit'];
               }
               else
               {
                   $_POST['pic']=$_POST['theme'];
               }
           }
           $m=M('area');
           $admin=$_SESSION['admin'];
           $p_uid=$admin['admin_id'];
           $p_rname=I("post.rname");
         
           $p_name=I("post.pname");
          
           $p_provid=I('post.province');
           $p_cityid=I('post.city');
           $res=current($m->field("name")->where("id='$p_cityid'")->select());
           $p_cityname=$res['name'];
           $p_counid=I('post.county');
           $res=current($m->field("name")->where("id='$p_counid'")->select());
           $p_counname=$res['name'];
           $p_detailaddr=I('post.detail_addr');
           $p_mobile=I('post.detail_mobile');
           $p_fpcid=I("post.product_cate");
           $p_spcid=I("post.detail_cate");
           $p_order=I('post.order_vol');
           $p_comment=I('post.comment');
           $p_pubtime=I('post.pubtime');
           //有效天数
           $day_num=I('post.endtime');
           $p_endtime=date('Y-m-d H:i:s', strtotime("$day_num day"));
           $p_gprice=I('post.group_price');
           $p_sprice=I('post.store_price');
           $p_keywords=I('post.keyword');
           //将图片路径数组转换为字符串
           $pic=I("post.pic");
           $str="";
           $str.=implode(";",$pic);
            $p_pic=$str;
            $p_introduce=I("post.p_desc");
           $p_detailintroduce=I("post.contents");
           $p_theme=I("post.theme");
           //判断是否是编辑的还是添加的，编辑则删除数据库内容
           if(!empty($_POST['p_id']))
           {
               $p_id=$_POST['p_id'];
               $m=M('product')->where("p_id='$p_id'")->delete();
               $data=array("p_id"=>$p_id,"p_rname"=>"$p_rname","p_name"=>$p_name,"p_provid"=>$p_provid,"p_cityid"=>$p_cityid,"p_counid"=>$p_counid,"p_detailaddr"=>$p_detailaddr,"p_mobile"=>$p_mobile,"p_fpcid"=>$p_fpcid,"p_spcid"=>$p_spcid,"p_order"=>$p_order,"p_comment"=>$p_comment,"p_pubtime"=>$p_pubtime,"p_endtime"=>$p_endtime,"p_gprice"=>$p_gprice,"p_sprice"=>$p_sprice,"p_keywords"=>$p_keywords,"p_pic"=>$p_pic,"p_introduce"=>$p_introduce,"p_detailintroduce"=>$p_detailintroduce,"p_theme"=>$p_theme,"p_uid"=>$p_uid,"p_cityname"=>$p_cityname,"p_counname"=>$p_counname);
           }
           else{
               $data=array("p_name"=>$p_name,"p_rname"=>"$p_rname","p_provid"=>$p_provid,"p_cityid"=>$p_cityid,"p_counid"=>$p_counid,"p_detailaddr"=>$p_detailaddr,"p_mobile"=>$p_mobile,"p_fpcid"=>$p_fpcid,"p_spcid"=>$p_spcid,"p_order"=>$p_order,"p_comment"=>$p_comment,"p_pubtime"=>$p_pubtime,"p_endtime"=>$p_endtime,"p_gprice"=>$p_gprice,"p_sprice"=>$p_sprice,"p_keywords"=>$p_keywords,"p_pic"=>$p_pic,"p_introduce"=>$p_introduce,"p_detailintroduce"=>$p_detailintroduce,"p_theme"=>$p_theme,"p_uid"=>$p_uid,"p_cityname"=>$p_cityname,"p_counname"=>$p_counname);
           }
            $d=M('product');
            $data=$d->create($data);
            $res=$d->add($data);
            if($res)
            {
				$this->success("提交成功",U('Admin/Product/product_list'));  
            }
            else{
                $this->error("提交失败");
            }
       }
       else
       {
           $this->display("product_add");
       }

   }

    /**
     * ajax传值删除商品（ajax好处：layer.confirm）
     */
   public function delProduct()
   {
       if(IS_GET)
       {
           $p_id=$_GET['id'];
           $m=M("product")->where("p_id='$p_id'")->delete();
           if($m)
           {
               echo 1;
           }
           else
           {
               echo 0;
           }
       }

   }

    /**
     * 下架  ajax传值
     */
    public function product_stop()
    {
        $p_id=$_POST['id'];
        $data=array("p_show"=>0);
        $m=M('product')->where("p_id='$p_id'")->save($data);
        if($m)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    /**
     * 上架
     */
    public function product_start()
    {
        $p_id=$_POST['id'];
        $data=array("p_show"=>1);
        $m=M('product')->where("p_id='$p_id'")->save($data);
        if($m)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    /**
     * ajax 商品批量删除
     */
    public function datadel()
    {
        $p_id=substr($_POST['str'],0,-1);
        $m=M('product')->where("p_id in('$p_id')")->delete();
        if($m)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    /**
     * 商品首页展示+SEARCH
     */
   public function product_list()
   {

       $admin=$_SESSION['admin'];
       $p_uid=$admin['admin_id'];
       $gid=M("admin")->field("aga.group_id")->join("inner join h_auth_group_access aga on h_admin.admin_id=aga.uid ")->where("h_admin.admin_id='$p_uid'")->select();
       $gid=current($gid);
       $gid=$gid['group_id'];
       if($gid==18)
       {

           if(!empty($_GET['search']))
           {
               $search=I('get.search');
               $m=M();
               $sql="select p_id,p_rname,p_name,p_num,p_introduce,p_theme,p_gprice,p_show from h_product where p_uid='$p_uid' && p_name like '%$search%' ";
               $res=M()->query($sql);
               $total=count($res);
               $pages=new \Think\Page($total,5);
               $start=$pages->firstRow;
               $res=M()->query("select p_id,p_rname,p_name,p_num,p_introduce,p_theme,p_gprice,p_show from h_product where p_uid='$p_uid' && p_name like '%$search%' limit $start,5");
           }
           else{
               $m=M('product');
               $res=$m->field("p_id,p_rname,p_name,p_num,p_introduce,p_theme,p_gprice,p_show")->where("p_uid='$p_uid'")->select();
               $total=count($res);
               $pages=new \Think\Page($total,5);
               $res=$m->field("p_id,p_rname,p_name,p_num,p_introduce,p_theme,p_gprice,p_show")->where("p_uid='$p_uid'")->limit($pages->firstRow,5)->select();
           }
           $this->res=$res;
           $this->total=$total;
           $list=$pages->show();
           $this->assign("list",$list)->assign("res",$res);
       }
       else{

           if(!empty($_GET['search']))
           {
               $search=I('get.search');
               $m=M();
               $sql="select * from h_product where p_name like  '%$search%'";
               $res=M()->query($sql);
               $total=count($res);
               $m=M('product');
               $pages=new \Think\Page($total,5);
               $res=$m->field("p_id,p_rname,p_name,p_num,p_introduce,p_theme,p_gprice,p_show")->where("p_name like  '%$search%'")->limit($pages->firstRow,5)->select();
           }
           else{
               $m=M('product');
               $total=$m->count();
               $pages=new \Think\Page($total,5);
               $res=$m->field("p_id,p_rname,p_name,p_num,p_introduce,p_theme,p_gprice,p_show")->limit($pages->firstRow,5)->select();
           }
           $this->total=$total;
           $this->res=$res;
           $list=$pages->show();
           $this->assign("list",$list)->assign("res",$res);
       }
       $this->display();
   }
}