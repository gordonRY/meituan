<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
  <head>
    <title>new document</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="zh-CN" />
    <meta name="author" content="rex" />
    <meta name="copyright" content="thinkSite" />
    <meta name="description" content="thinkSite" />
    <meta name="keywords" content="thinkSite" />
    <link rel="shortcut icon" type="image/x-icon" href="">

	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Home/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Home/validation/dist/jquery.validate.min.js"></script><script src="/Thinkphp_meddle/b2b2c/Public/Home/validation/dist/additional-methods.js"></script>
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Home/validation/lib/jquery.form.js"></script>
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Home/layer/layer.js"></script>
	<style type="text/css">
	
  .boss{
		width:700px;
		border:0px solid red;
		margin:50px auto;
  }
  .second div span{
		display:inline-block;
		width:80px;
		margin-left:15px;
  }
  .but{
		height:40px;
		width:100px;
		margin:10px 100px;
  }
  </style>
  </head>
  <body>
  <div class="boss">
	    <form action="<?php echo U('Home/Index/regist');?>" class="second" method="post">
			  <div>	
					<span>用户名：</span>
					<input type="text" name="user">
		  </div>
			  <div>
					<span>密码：</span>
					<input type="password" name="pass">
			  </div>
			  <div>
					<span>确认密码：</span>
					<input type="password" name="repass">
			  </div>
			  <div>
					<span>邮箱：</span>
					<input type="text" name="email">
			  </div>
			  <div>
					<span>手机：</span>
					<input type="text" name="mobile">
			  </div>
			<div>
				<span>昵称：</span>
				<input type="text" name="nickname">
			</div>
			  <div>
					<input type="submit" value="提交" class="but">
			  </div>
	    </form> 
   </div>
  </body>
</html>
<script type="text/javascript">
$(".second").validate(
{	
	//配置验证规则
	rules:
	{
		user:
		{
			required:true,
			maxlength:20,
			minlength:8,
		},
		pass:
		{
			required:true,
			maxlength:20,
			minlength:8,
		},
		repass:
		{
			equalTo:"input[name=pass]"
		},
		email:
		{
			required:true,
			email:true
		},
		mobile:
		{
			required:true,
			chinaphone:true,
		}
	},
	messages:{
				user:
				{
					required:"填写账户",
					maxlength:"最多20个字节",
					minlength:"至少8个字节",
					remote:'用户名已被注册',
				}, 
				pass:{
					required:"填写密码",
					minlength:"至少8个字节",
					maxlength:"最多20个字节"
				},
				repass:
				{
					equalTo:"两次密码输入必须一致"
				},
				email:
				{
					required:"填写邮箱",
					email:"邮箱格式不正确",
				},
				mobile:
				{
					required:"手机号必填",
				}
			},
			onkeyup:false,
			//设置表单提交....
})


</script>