<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>后台管理系统</title>
    <link href="/Thinkphp_meddle/b2b2c/Public/Admin/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Thinkphp_meddle/b2b2c/Public/Admin/css/login.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery.tscookie.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery.validation.min.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery.supersized.min.js" ></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery.progressBar.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/layer/layer.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/login.js"></script>
    <script type="text/javascript">
        var loginHandleUrl = "<?php echo U('public/login');?>";
        var homeUrl = "<?php echo U('index/index');?>";
    </script>
</head>
<body>
 <!--v3-v12-->
<div class="login-layout">
    <div class="top">
        <h5><em></em></h5>
        <h2>平台管理中心</h2>
    </div>
    <form method="post" id="form_login">
        <div class="lock-holder">
            <div class="form-group pull-left input-username">
                <label>账号</label>
                <input name="admin_name" id="admin_name" autocomplete="off" type="text" class="input-text" value="" tabindex='1' required title="请输入登陆账号">
            </div>
            <i class="fa fa-ellipsis-h dot-left"></i> 
            <i class="fa fa-ellipsis-h dot-right"></i>
            <div class="form-group pull-right input-password-box">
                <label>密码</label>
                <input name="admin_password" id="admin_password" class="input-text" autocomplete="off" tabindex='2' type="password" required pattern="[\S]{6}[\S]*" title="密码不少于6个字符">
            </div>
        </div>
        <div class="avatar"><img src="/Thinkphp_meddle/b2b2c/Public/Admin/images/admin.png" alt=""></div>
        <div class="submit"> 
            <span>
                <div class="code">
                    <div class="arrow"></div>
                    <div class="code-img">
                        <img src="<?php echo U('public/verify');?>" name="codeimage" id="codeimage" onclick="verifyimage()" border="0"/>
                    </div>
                    <a href="JavaScript:void(0);" id="hide" class="close" title="关闭"><i></i></a>
                    <a href="JavaScript:void(0);" onclick="verifyimage()" class="change" title="看不清,点击更换验证码"><i></i></a> 
                </div>
                <input name="captcha" type="text" required class="input-code" tabindex='3' id="captcha" placeholder="输入验证" pattern="[A-z0-9]{4}" title="验证码为4个字符" autocomplete="off" value="" >
            </span> 
            <span>
              <input name="" class="input-button btn-submit" type="button" value="登录">
            </span> 
        </div>
        <div class="submit2"></div>
    </form>
    <div class="bottom">
    </div>
</div>
<script>
$(function(){
    $.supersized({
        // 功能
        slide_interval     : 4000,    
        transition         : 1,    
        transition_speed   : 1000,    
        performance        : 1,    

        // 大小和位置
        min_width          : 0,    
        min_height         : 0,    
        vertical_center    : 1,    
        horizontal_center  : 1,    
        fit_always         : 0,    
        fit_portrait       : 1,    
        fit_landscape      : 0,    

        // 组件
        slide_links        : 'blank',    
        slides             : [    
            {image : '/Thinkphp_meddle/b2b2c/Public/Admin/images/1.jpg'},
            {image : '/Thinkphp_meddle/b2b2c/Public/Admin/images/2.jpg'},
            {image : '/Thinkphp_meddle/b2b2c/Public/Admin/images/3.jpg'},
            {image : '/Thinkphp_meddle/b2b2c/Public/Admin/images/4.jpg'},
            {image : '/Thinkphp_meddle/b2b2c/Public/Admin/images/5.jpg'}
        ]
    });
	//显示隐藏验证码
    $("#hide").click(function(){
        $(".code").fadeOut("slow");
    });
    $("#captcha").focus(function(){
        $(".code").fadeIn("fast");
    });
    //跳出框架在主窗口登录
    if(top.location!=this.location)	top.location=this.location;
    $('#admin_name').focus();
    if ($.browser.msie && ($.browser.version=="6.0" || $.browser.version=="7.0")){
        window.location.href='http://www.shopn.com/Public/Admin/ie6update.html';
    }
    $("#captcha").nc_placeholder();
    //动画登录
});
var num=Math.random();
var verifyUrl = "<?php echo U('public/verify',array('r'=>num));?>";

function verifyimage(){
    $('#codeimage').attr('src', verifyUrl);
}

</script>
</body>
</html>