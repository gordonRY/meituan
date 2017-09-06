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
	<style>
		label.error
		{
			position: relative;
			top:-35px;
			left:270px;
		}
	</style>
</head>
<body>
<div class="info-center">
	<div class="page-header">
		<div class="pull-left">
			<h4>券码验证</h4>
		</div>
	</div>
</div>
	<div class="clearfix"></div>
<div style="margin: 50px auto">
	<form action="" method="post" name="code_check">
		<div class="form-group" style="width:800px;height:40px;border:0px solid blue;text-align: center;line-height: 40px">
			<label for="inputEmail3" class="col-sm-2 control-label">请输入券码：</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="inputEmail3" placeholder="由15位数字和英文字母组成" name="code">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default"> 验证</button>
			</div>
		</div>
	</form>
	<?php if($mark==1): ?><div style="text-align: center;width:600px">
	<span class="glyphicon glyphicon-ok" style="color:green;font-size: 36px"></span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;color:blue">该券可以使用！&nbsp;&nbsp;&nbsp;</span><button type="button" class="btn btn-primary" name="usecode">点击使用</button>
		<input type="hidden" name="id" value="<?php echo ($o_id); ?>">
	</div>
		<?php elseif($mark==2): ?>
		<div style="text-align: center;width:600px">
			<span class="glyphicon glyphicon-remove" style="color:red;font-size: 36px"></span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;color:blue">该券已被使用或不存在！</span>
		</div><?php endif; ?>
</div>

</body>
</html>
<script>
	$("button[name=usecode]").click(function()
	{
		var id=$("input[name=id]").val();
		var url="<?php echo U('Admin/Order/use_code');?>";
		var data="id="+id;
		$.post(url,data,function(res)
		{
			if(res==1)
			{
			    layer.msg("使用成功！",{icon:6},function()
				{
				    window.location.href="<?php echo U('Admin/Order/check_num');?>";
				})
			}
			else
			{
                layer.msg("使用失败！",{icon:2},function()
                {
                    window.parent.location.reload();
                })
			}
		},"text")
	})

$("form[name=code_check]").validate(
	{
		rules:{
            code:{
                required:true,
                minlength:15,
                maxlength:15,
			}
		},
        messages:{
            code:{
                required:"请输入券码号",
                minlength:"券码号为15位",
                maxlength:"券码号为15位",
            }
		}
	}
)


</script>