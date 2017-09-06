<?php if (!defined('THINK_PATH')) exit();?>
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
			<h4>订单详情</h4>
		</div>
	</div>
</div>
	<div class="clearfix"></div>
<div >
	<?php if($m['o_usestatus']==4): ?><div class="bg-success" style="height:60px;text-align: center;line-height: 60px;margin: 10px 30px"><span style="font-family:Microsoft Yahei ;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-ok" style="color:green;font-size: 20px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交易成功</span></div>

	<?php elseif($m['o_status']==0): ?>
		<div class="bg-danger" style="height:60px;text-align: center;line-height: 60px;margin: 10px 30px"><span style="font-family:Microsoft Yahei ;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-ban-circle" style="color:orangered;font-size: 20px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单未支付</span></div>
		<?php elseif($m['o_usestatus']==2 && $m['o_status']==1): ?>
		<div class="bg-info" style="height:60px;text-align: center;line-height: 60px;margin: 10px 30px"><span style="font-family:Microsoft Yahei ;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-credit-card" style="color:darkgreen;font-size: 20px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;券码待消费</span></div>
		<?php elseif($m['o_usestatus']==3 && $m['o_status']==1): ?>
		<div class="bg-danger" style="height:60px;text-align: center;line-height: 60px;margin: 10px 30px"><span style="font-family:Microsoft Yahei ;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-usd" style="color:darkblue;font-size: 20px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请求退款</span></div>

		<?php elseif($m['o_usestatus']==3 && $m['o_status']==1): ?>
		<div class="bg-danger" style="height:60px;text-align: center;line-height: 60px;margin: 10px 30px"><span style="font-family:Microsoft Yahei ;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-usd" style="color:darkblue;font-size: 20px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;等待评论</span></div><?php endif; ?>
<div style="margin:10px 30px ">
			<table class="table" border="1" style="height:50px">
				<!-- On rows -->
				<tr class="warning" >
					<td class="success"style="text-align: center"><span class="glyphicon glyphicon-user" style="font-size: 16px ;color:darkslateblue">&nbsp;用户:</span><span style="font-size: 15px ;color:darkslategrey;cursor: pointer">&nbsp;&nbsp;&nbsp;<?php echo ($m["nickname"]); ?></span></td>
					<td class="warning" style="text-align: center"><span class="glyphicon glyphicon-earphone"style="font-size: 16px ;color:darkslateblue">&nbsp;联系方式:</span>&nbsp;&nbsp;&nbsp;<span style="font-size: 15px ;color:darkslategrey;cursor: pointer"><?php echo ($m["mobile"]); ?></span></td>
				</tr>
			</table>
	</div>
</div >
	<div style="margin:10px 30px "><span style="font-size: 14px;color:orangered;font-weight: bold"><?php echo ($m["p_rname"]); ?></span><span class="glyphicon glyphicon-chevron-right"></span></div>
	<div class="mt-20" style="margin:10px 30px ">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
			<tr class="text-c">
				<th width="160">缩略图</th>
				<th width="100">商品名</th>
				<th width="80">单价</th>
				<th width="60">数量</th>
				<th width="60">总计</th>
				<th width="120">使用时间</th>
				<th width="100">评分</th>
				<th width="160">评论内容</th>
				<th width="100">操作</th>
			</tr>
			</thead>
			<tbody>
					<tr class="text-c va-m" style="text-align: center;font-size: 15px;margin: 10px;padding: 0px">
						<td style="margin: 10px;padding: 0;width:100px"><img src="/Thinkphp_meddle/b2b2c/Public/<?php echo ($m["p_theme"]); ?>" alt="" width="145px" height="75px" style="margin: 5px;padding: 0"></td>
						<td><?php echo mb_substr($m['p_name'],0,16,'utf-8');?></td>
						<td><?php echo ($m["p_gprice"]); ?>元/人</td>
						<td><span style="font-weight: bold">X</span><?php echo ($m["detail_num"]); ?></td>
						<td><span class="glyphicon glyphicon-yen"></span><span style="color:orangered"><?php echo ($m["o_totalprice"]); ?></span></td>
						<td>
							<?php if(!empty($m['o_usetime'])): ?><span style="color:blue"><?php echo ($m["o_usetime"]); ?></span>
								<?php else: ?>
								<span style="color:green">未消费</span><?php endif; ?>
						</td>
						<?php if($msg['star']==1): ?><td>
							<span class='glyphicon glyphicon-star' style="color: red"></span>
						</td>
							<?php elseif($msg['star']==2): ?>
							<td>
								<span class='glyphicon glyphicon-star' style="color: red">
								</span>
								<span class='glyphicon glyphicon-star'style="color: red">
								</span>
							</td>
							<?php elseif($msg['star']==3): ?>
							<td>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
							</td>
							<?php elseif($msg['star']==4): ?>
							<td>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
							</td>
							<?php elseif($msg['star']==5): ?>
							<td>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>
								<span class='glyphicon glyphicon-star'style="color: red"></span>

								<span class='glyphicon glyphicon-star'style="color: red"></span>
							</td>
							<?php else: ?>
							<td>
								该用户还没有评论
							</td><?php endif; ?>
						<?php if($msg==null): ?><td>该用户还没有评论</td>
							<?php else: ?>
							<td><?php echo ($msg["comment"]); ?></td><?php endif; ?>


						<?php if($m['o_status']==1 && $msg==null && $m['o_usestatus']==1): ?><td><a href="" style="color:blue">提醒用户评论</a></td>
							<?php elseif($m['o_status']==1 && $m['o_usestatus']==2): ?>
							<td><a href="" style="color:blue">提醒用户消费</a></td>
							<?php elseif($m['o_status']==1 && $msg!=null && $m['o_usestatus']==1): ?>
							<td><a href="">回复/查看评论</a></td>
							<?php elseif($m['o_status']==1 && $m['o_usestatus']==3): ?>
							<td><a href="" style="color:red">同意退款</a></td>
							<?php elseif($m['o_status']==0): ?>
							<td><a href="" style="color:red">提醒用户支付</a></td>
							<?php elseif($m['o_usestatus']==4 ): ?>
							<td><a href="" style="color:red">评论用户</a></td><?php endif; ?>
					</tr>
			</tbody>
		</table>
		<div style="text-align: right;margin-right:0px "><button type="button" class="btn btn-primary" name="back">返回</button></div>
	</div>
</div>
</div>
</div>

</body>
</html>
<script>
	$("button[name=back]").click(function()
	{
        window.history.go(-1);
    })

</script>