<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>提示信息</title>
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
</head>
<body>
    <div class="system-message">
        <?php if(isset($message)) {?>
        <h1>:)</h1>
        <p class="success"><?php echo($message); ?></p>
        <?php }else{?>
        <h1>:(</h1>
        <p class="error"><?php echo($error); ?></p>
        <?php }?>
        <p class="detail"></p>
        <p class="jump">
        页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
        </p>
    </div>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
        })();
    </script>
</body>
</html>