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
</head>
<body>
    
    <div class="info-center">
        <div class="content-list">
            <div class="row">
                <div class="col-md-3">
                    <div class="content">
                        <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-bell blue"></span>
                        </div>
                        <div class="w70 right-title pull-right">
                            <div class="title-content">
                                <p>待处理订单</p>
                                <h3 class="number"><?php echo ($count["handle_order"]); ?></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content">
                        <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-gift violet"></span>
                        </div>
                        <div class="w70 right-title pull-right">
                            <div class="title-content">
                                <p>商品数量</p>
                                <h3 class="number"><?php echo ($count["goods"]); ?></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content">
                        <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-file orange"></span>
                        </div>
                        <div class="w70 right-title pull-right">
                            <div class="title-content">
                                <p>文章数量</p>
                                <h3 class="number"><?php echo ($count["article"]); ?></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content">
                        <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-user green"></span>
                        </div>
                        <div class="w70 right-title pull-right">
                            <div class="title-content">
                                <p>会员总数</p>
                                <h3 class="number"><?php echo ($count["users"]); ?></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row newslist" style="margin-top:20px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            今日统计
                        </div>     
                        <div class="panel-body">
                            <div class="w25 pull-left">
                                新增订单：<?php echo ($count["new_order"]); ?>
                            </div>
                            <div class="w25 pull-left">
                                今日访问：<?php echo ($count["today_login"]); ?>
                            </div>
                            <div class="w25 pull-left">
                                新增会员：<?php echo ($count["new_users"]); ?>
                            </div>
                            <div class="w25 pull-left">
                                待审评论：<?php echo ($count["comment"]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row newslist">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            系统信息
                        </div>     
                        <div class="panel-body">
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                服务器操作系统：<?php echo ($sys_info["os"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                服务器域名/IP：<?php echo ($sys_info["domain"]); ?> [ <?php echo ($sys_info["ip"]); ?> ]
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                服务器环境：<?php echo ($sys_info["web_server"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                PHP 版本：<?php echo ($sys_info["phpv"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                Mysql 版本：<?php echo ($sys_info["mysql_version"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                GD 版本：<?php echo ($sys_info["gdinfo"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                文件上传限制：<?php echo ($sys_info["fileupload"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                最大占用内存：<?php echo ($sys_info["memory_limit"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                最大执行时间：<?php echo ($sys_info["max_ex_time"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                安全模式：<?php echo ($sys_info["safe_mode"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                Zlib支持：<?php echo ($sys_info["zlib"]); ?>
                            </div>
                            <div class="w20 pull-left" style="margin-bottom:15px">
                                Curl支持：<?php echo ($sys_info["curl"]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>          
            
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
    <script type="text/javascript">

    $(function(){

        // 动态调整iframe的高度以适应不同高度的显示器
        $('.info-center').height($(window).height()-50);

    })
    </script>
</body>
</html>