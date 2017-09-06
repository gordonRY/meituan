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
			<h4>订单管理</h4>
		</div>
	</div>
	<div class="clearfix"></div>
<div >
	<form action="" method="post">
	<div class="page-container" style="width:100%;height:80%;margin-left: 0">
		<div class="text-c"> 日期范围：
			<input type="text" onfocus="WdatePicker({ maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;" name="star_date">
			-
			<input type="text" onfocus="WdatePicker({ minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;" name="star_end">
			<input type="text" name="order_num"  placeholder=" 输入订单号" style="width:250px" class="input-text">
			<button name=""  class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
		</div>
	</form>

		<div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" id="delall" class="btn btn-danger radius">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除                  </a>
                 <a href="javascript:;" class="btn btn-primary" id="selall">
                     全选
                 </a>
                 <a href="javascript:;"  class="btn btn-primary" id="notall">
                     全不选
                 </a>
                 <a href="javascript:;"  class="btn btn-primary" id="defall">
                    反选
				 </a>
            </span>
            <span class="r">共有数据：<strong><?php echo ($total); ?></strong> 条              </span>
        </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="60">选择</th>
						<th width="160">付款编号</th>
						<th width="160">下单时间</th>
						<th width="160">付款时间</th>
						<th width="120">状态</th>
						<th width="120">金额</th>
						<th>用户名</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($res)): if(is_array($res)): foreach($res as $key=>$vol): ?><tr class="text-c va-m" style="text-align: center">
						<td>
							<input name="check" type="checkbox" value="<?php echo ($vol["o_id"]); ?>"><input type="hidden" value="<?php echo ($vol["o_usestatus"]); ?>">
						</td>
						<td><?php echo ($vol["o_rand"]); ?></td>
						<td><?php echo ($vol["o_buildtime"]); ?></td>
						<td class="text-l"><?php echo ($vol["o_paytime"]); ?></td>
						<?php if($vol['o_usestatus']==4): ?><td><span class="label label-success">交易成功</span></td>
						<?php elseif($vol['o_usestatus']==2): ?>
							<td><span class="label label-primary">待消费</span></td>
							<?php elseif($vol['o_usestatus']==3): ?>
							<td><span class="label label-danger">请求退款</span></td>
							<?php elseif($vol['o_usestatus']==0): ?>
							<td><span class="label label-warning">未付款</span></td>

							<?php elseif($vol['o_usestatus']==1): ?>
							<td><span class="label label-warning">未评论</span></td><?php endif; ?>
						<td><span class="price"><?php echo ($vol["o_totalprice"]); ?></span> 元</td>
						<td><span><?php echo ($vol["o_username"]); ?></span></td>
                       <td><a href="<?php echo U('Admin/Order/order_detail',array('id'=>$vol['o_id']));?>" style="color:blue"><span class="glyphicon glyphicon-eye-open" title="查看详情"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
						   <a  style="color:black" class="order_del" value="<?php echo ($vol['o_id']); ?>"><span class="glyphicon glyphicon-trash" title="删除"></span></a>
					   </td>
					</tr><?php endforeach; endif; ?>
					<?php elseif(empty($res)): ?>
					<tr>
						<td colspan="8"><div style="font-size: 20px;font-family:' Microsoft Yahei';text-align: center">还没有订单哦~</div></td>
					</tr><?php endif; ?>
				<tr>
					<td colspan="8"><?php echo ($list); ?></td>
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
</body>
</html>
<script>
	$(".order_del").click(function()
	{
	    var id=$(this).attr("value");
	    var url="<?php echo U('Admin/Order/order_del');?>";
	    var data="id="+id;
	    layer.confirm("确定要删除吗？",{icon:3},function(index)
		{
			$.post(url,data,function(res)
			{
			    if(res==1)
				{
				    layer.msg("删除成功!",{icon:6},function()
					{
					    window.location.reload();
					})
				}
				else if(res==0)
				{
                    layer.msg("删除失败!",{icon:2},function()
                    {
                        window.location.reload();
                    })
				}
				else if(res==4)
				{
                    layer.msg("只有消费过且评论过的订单才能删除",{icon:7},function()
                    {
                        window.location.reload();
                    })
				}
			})
			layer.close(index)
		})
	})

//删除
	$("#delall").click(function ()
	{
        var obj=$("input[type=checkbox]:checked");
        if(obj.length==0)
		{
		    layer.alert("清勾选要删除的选项",{icon:9})
		}
		else
		{
		    var ensure='';
            $.each(obj,function(k,v)
			{
			    var status=v.nextSibling.value;
			    if(status!=4)
				{
                    ensure+=1;
				   layer.msg("不能删除没有交易成功的订单！",{icon:7});
				}
			})
			if(ensure=='')
			{
				layer.confirm("MMP，你要删我？",{icon:7},function(index)
				 {
				 var str='';
				 $.each(obj,function(k,v)
				 {
				 str+=v.value+',';
				 })
				 var url="<?php echo U('Admin/Order/delete_all');?>";
				 var data="id="+str;
				 $.post(url,data,function(res)
				 {
				 if(res==1)
				 {
				 layer.msg("删除成功!",{icon:6},function()
				 {
				 window.location.reload();
				 })
				 }
				 else if(res==0)
				 {
				 layer.msg("删除失败!",{icon:5},function()
				 {
				 window.location.reload();
				 })
				 }

				 },"text")
				 layer.close(index)
				 })
			}


		}

    })






//全选
	$("#selall").click(function()
	{
	    var obj=$("input[type=checkbox]");
	    $.each(obj,function(k,v)
		{
		    v.checked=true;
		})
	})

	//全不选
	$("#notall").click(function()
	{
	    var obj=$("input[type=checkbox]");
	    $.each(obj,function(k,v)
		{
            v.checked=false;
		})
	})

    //反选
$("#defall").click(function()
{
    var obj=$("input[type=checkbox]");
    $.each(obj,function(k,v)
    {
        v.checked=!(v.checked);
    })
})

</script>