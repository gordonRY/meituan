<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
    <link rel="stylesheet" href="/Thinkphp_meddle/b2b2c/Public/Admin/js/iCheck-1.0.2/skins/all.css">
	<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/Checkboxes/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/Checkboxes/css/build.css">
</head>
<body>
    <div class="info-center">
        <div class="page-header">
            <div class="pull-left">
                <h4>添加管理员</h4>     
                <a href="javascript:history.go(-1)">
                    <button class="btn btn-default"><i class="fa fa-level-up"></i>返回</button>
                </a> 
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table-margin">
            <form action="" class="form-horizontal" method="post">
                <table class="table table-hover contact-template-form">
                    <tbody>
                        <tr>
                            <td width="20%" align="right"><font color="red">*</font>管理组：</td>
                            <td>
                                <?php if(is_array($data)): foreach($data as $key=>$v): ?><div class="radio radio-info radio-inline">
		                        <input type="radio" id="<?php echo ($v["title"]); ?>" value="<?php echo ($v["gid"]); ?>" name="group_ids"  <?php echo ($v['gid']==10?checked:''); ?>>
		                        <label for="<?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?> </label>
		                    </div><?php endforeach; endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><font color="red">*</font>登陆账号：</td>
                            <td>
                                <input class="form-control w-300" type="text" name="admin_name" value="<?php echo ($user_data['admin_name']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><font color="red">*</font>登陆密码：</td>
                            <td>
                                <input class="form-control w-300 pull-left" type="password" name="admin_password">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">管理员联系方式：</td>
                            <td>
                                <input class="form-control w-300" type="text" name="phone" value="<?php echo ($user_data['phone']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">管理员邮箱：</td>
                            <td>
                                <input class="form-control w-300" type="text" name="email" value="<?php echo ($user_data['email']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">状态：</td>
                            <td>
                                <label><span class="inputword">允许登录</span> <input checked="checked" class="xb-icheck" type="radio" name="status" value="1" <?php if(($user_data['status']) == "1"): ?>checked="checked"<?php endif; ?> ></label> &emsp; <label><span class="inputword">禁止登录</span> <input class="xb-icheck" type="radio" name="status" value="0" <?php if(($user_data['status']) == "0"): ?>checked="checked"<?php endif; ?> ></label>
                            </td>
                        </tr>
                        <tr>
                            <tD></td>
                            <td>
                                <input class="btn btn-primary" type="submit" value="添加">
                            </td>
                        </tr>
                    </tbody>
                </table>    
            </form>
        </div>
    </div>  
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/iCheck-1.0.2/icheck.js"></script>
    <script type="text/javascript">

    $(document).ready(function(){
        $('.xb-icheck').iCheck({
            checkboxClass: "icheckbox_minimal-blue",
            radioClass: "iradio_minimal-blue",
            increaseArea: "20%"
        });
    });
    </script>
</body>
</html>