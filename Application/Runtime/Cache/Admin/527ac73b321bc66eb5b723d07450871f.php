<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<link href="/Thinkphp_meddle/b2b2c/Public/Admin/css/bootstrap.min.css" title="" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/Admin/css/font-awesome.min.css">
<link title="blue" href="/Thinkphp_meddle/b2b2c/Public/Admin/css/dermadefault.css" rel="stylesheet" type="text/css"/>
<link href="/Thinkphp_meddle/b2b2c/Public/Admin/css/templatecss.css" rel="stylesheet" title="" type="text/css" />
<link title="" href="/Thinkphp_meddle/b2b2c/Public/Admin/css/style.css" rel="stylesheet" type="text/css"  />
<link title="" href="/Thinkphp_meddle/b2b2c/Public/css/page.css" rel="stylesheet" type="text/css"  />
<link title="" href="/Thinkphp_meddle/b2b2c/Public/css/fileinput.min.css" rel="stylesheet" type="text/css"  />
<script src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/validation/dist/jquery.validate.min.js"></script>
<script src="/Thinkphp_meddle/b2b2c/Public/Admin/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Thinkphp_meddle/b2b2c/Public/Admin/js/global.js" type="text/javascript"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/layer/layer.js"></script>

<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/js/fileinput.min.js"></script>
<title>管理控制台</title>
	<!--[if lt IE 9]>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>建材列表</title>
<link rel="stylesheet" href="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body>
<div class="info-center">
	<div class="page-header">
		<div class="pull-left">
			<h4>产品管理</h4>
		</div>
	</div>
	<div class="clearfix"></div>
<div >
	<div class="page-container" style="width:100%;height:80%;margin-left: 0">
		<form action="" method="get">
		<div class="text-c">

			<input type="text" name="search"  placeholder=" 产品名称" style="width:400px" class="input-text" >
			<button name=""  class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
		</div>
		</form>

		<div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除                  </a>
                 <a href="javascript:;" onclick="selAll()" class="btn btn-primary">
                     全选
                 </a>
                 <a href="javascript:;" onclick="notAll()" class="btn btn-primary">
                     全不选
                 </a>
                 <a href="javascript:;" onclick="defAll()" class="btn btn-primary">
                    反选                       </a>
                <a class="btn btn-primary radius" onclick='product_add("添加产品")' href="javascript:;">
                    <i class="Hui-iconfont">&#xe600;</i> 添加产品                  </a>
            </span>
            <span class="r">共有数据：<strong><?php echo ($total); ?></strong> 条              </span>
        </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="60">选择</th>
						<th width="40">ID</th>
						<th width="80">缩略图</th>
						<th >店名</th>
						<th width="200">产品名称</th>
						<th width="100">售出数量</th>
						<th>描述</th>
						<th width="60">团购价</th>
						<th width="80">发布状态</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($res)): if(is_array($res)): foreach($res as $key=>$vol): ?><tr class="text-c va-m" style="text-align: center">
						<td><input name="check" type="checkbox" value="<?php echo ($vol["p_id"]); ?>"></td>
						<td><?php echo ($vol["p_id"]); ?></td>
						<td><a onClick="product_show('哥本哈根橡木地板','product-show.html','10001')" href="javascript:;"><img width="60" class="product-thumb" src="/Thinkphp_meddle/b2b2c/Public/<?php echo ($vol["p_theme"]); ?>"></a></td>
						<td class="text-l"><a style="text-decoration:none" onClick="product_show('哥本哈根橡木地板','product-show.html','10001')" href="javascript:;">  <?php echo mb_substr($vol['p_rname'],0,16,'utf-8');?></a></td>
						<td class="text-l"><a style="text-decoration:none" onClick="product_show('哥本哈根橡木地板','product-show.html','10001')" href="javascript:;">  <?php echo mb_substr($vol['p_name'],0,16,'utf-8');?></a></td>
						<td class="text-l"><?php echo ($vol["p_num"]); ?></td>
						<td><?php echo mb_substr($vol['p_introduce'],0,40,'utf-8');?></td>
						<td><span class="price"><?php echo ($vol["p_gprice"]); ?></span> 元</td>
                        <?php if($vol['p_show']==1): ?><td class="td-status"><span class="label label-success radius">已发布</span></td>
                            <?php else: ?>
                        <td><span class="label label-defaunt radius">已下架</span></td><?php endif; ?>
						<td class="td-manage">
                            <?php if($vol['p_show']==1): ?><a style="text-decoration:none" onClick="product_stop(this,'<?php echo ($vol["p_id"]); ?>')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
                                <?php else: ?>
                                <a style="text-decoration:none" onClick="product_start(this,'<?php echo ($vol["p_id"]); ?>')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a><?php endif; ?>
							<a style="text-decoration:none" class="pro_edit" value="<?php echo ($vol["p_id"]); ?>"  href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
							<a style="text-decoration:none" class="pro_delete" value="<?php echo ($vol["p_id"]); ?>" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr><?php endforeach; endif; ?>
				<?php else: ?>

				<tr>
					<td colspan="9"><div style="font-size: 20px;text-align: center">你还没有发布商品哦~</div></td>
				</tr><?php endif; ?>
				<tr>
					<td colspan="10"><?php echo ($list); ?></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
	</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*产品-添加*/
function product_add(title,url,id){
    var url="<?php echo U('Admin/Product/product_add');?>";
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-审核*/
function product_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'],
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});
}
/*产品-下架*/
function product_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index)
    {
        var url="<?php echo U('Admin/Product/product_stop');?>";
        var data="id="+id;
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		$.post(url,data,function(res)
        {
            if(res==1)
            {
                layer.msg('已下架!',{icon: 5,time:1000},function()
                {
                    window.location.reload();
                });
            }
        },"text")

	});
}

/*产品-发布*/
function product_start(obj,id){
    var url="<?php echo U('Admin/Product/product_start');?>";
    var data="id="+id;
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
        $.post(url,data,function(res)
        {
            if(res==1)
            {
                layer.msg('已发布!',{icon: 6,time:1000},function()
                {
                    window.location.reload();
                });
            }
        },"text")
	});
}

/*产品-申请上线*/
function product_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*产品-编辑*/
$(".pro_edit").click(function()
{
    var id=$(this).attr("value");
    var url="<?php echo U('Admin/Product/product_add_edit/id/"+id+"');?>";
    var index=layer.open({
		type:2,
		title:"商品编辑",
		content:url,
	});
    layer.full(index);

})
/*产品-全选和全不选*/
function selAll()
{
    var checkbox=$("input");
    var total=$("input").length;
    for(var i=0;i<total;i++)
    {
        if(checkbox[i].type=='checkbox')
        {
            checkbox[i].checked=true;
        }

    }
}
 function notAll()
{
    var checkbox=$("input");
    var total=$("input").length;
    for(var i=0;i<total;i++)
    {
        if(checkbox[i].type=='checkbox')
        {
            checkbox[i].checked=false;
        }

    }
}
function defAll()
{
    var checkbox=$("input");
    var total=$("input").length;
    for(var i=0;i<total;i++)
    {
        if(checkbox[i].type=='checkbox')
        {
            checkbox[i].checked=!(checkbox[i].checked);
        }

    }
}
/*产品-批量删除*/
function datadel()
{
    var delcheck=$("input[type=checkbox]:checked");
    var str="";
    layer.confirm("确认要删除吗？",{icon:3},function(index)
    {
        $.each(delcheck,function(k,v)
        {
            str+=v.value+","
        })
        var url="<?php echo U('Admin/Product/datadel');?>";
        var data="str="+str;
        $.post(url,data,function(res)
        {
            if(res==1)
            {
                layer.msg("删除成功！",{icon:1},function()
                {
                    window.location.reload();
                })
            }
            else if(res==0)
            {
                layer.msg("删除失败！",{icon:1},function()
                {
                    window.location.reload();
                })
            }

        },"text");
        layer.close(index);
    })


    /*str='';
    for(var i=0;i<cbox.length;i++)
    {
        if(cbox[i].type=='checkbox')
        {
            if(cbox[i].checked==true)
            {
                str+=cbox[i].value+',';
            }
        }

    }
    if(str!='')
    {
        var msg=confirm("确定删除？");
    }
    if(msg)
    {
        location.href="moredelconf2.php?ids="+str;
    }*/

}
/*产品-删除*/
$(".pro_delete").click(function()
{
    var id=$(this).attr("value");
    layer.confirm("确定要删除吗？",{icon:3},function(index)
	{
        var url="<?php echo U('Admin/Product/delProduct');?>";
        var data="id="+id;
        $.get(url,data,function(res)
        {
            if(res==1)
            {
				layer.msg("删除成功！",{icon:1},function()
				{
                    window.location.reload();
				});

            }
            else
			{
                layer.msg("删除失败！",{icon:2},function()
                {
                    window.location.reload();
                });
			}
        },"text");
	    layer_close(index);

	})

})
</script>
</body>
</html>