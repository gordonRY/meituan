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
<script src="/Thinkphp_meddle/b2b2c/Public/Admin/js/jquery-1.10.2.js"></script>
<script src="/Thinkphp_meddle/b2b2c/Public/Admin/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Thinkphp_meddle/b2b2c/Public/Admin/js/global.js" type="text/javascript"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/layer/layer.js"></script>
<title>管理控制台</title>
</head>
<body>
    <div class="info-center">
        <div class="page-header">
            <div class="pull-left">
                <h4>分配权限</h4>      
                <a href="javascript:history.go(-1)">
                    <button class="btn btn-default"><i class="fa fa-level-up"></i>返回</button>
                </a> 
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table-margin">
            <h3 class="text-center">为<?php echo ($group_data['title']); ?>分配权限</h3>
            <div id="warp">
                <form action="" method="post">    
                    <?php if(is_array($rule_data)): foreach($rule_data as $key=>$app): ?><input type="hidden" value="<?php echo ($id); ?>" name="id"/>
                        <div class="app b-group">
                            <p>
                                <strong><?php echo ($app["title"]); ?></strong>
                                <input type="checkbox" name="rule_ids[]" value="<?php echo ($app['id']); ?>" <?php if(in_array($app['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> onclick="checkAll(this)">
                            </p>
                            <?php if(is_array($app["_data"])): foreach($app["_data"] as $key=>$action): ?><dl class="b-group">
                                    <dt>
                                        <strong><?php echo ($action["title"]); ?></strong>
                                        <input type="checkbox" name="rule_ids[]" value="<?php echo ($action['id']); ?>" <?php if(in_array($action['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> onclick="checkAll(this)">
                                    </dt>
                                    <?php if(is_array($action["_data"])): foreach($action["_data"] as $key=>$method): ?><dd>
                                            <span><?php echo ($method["title"]); ?></span>
                                            <input type="checkbox" name="rule_ids[]" value="<?php echo ($method['id']); ?>" <?php if(in_array($method['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?>
                                        </dd><?php endforeach; endif; ?>
                                </dl><?php endforeach; endif; ?>
                        </div><?php endforeach; endif; ?>
                    <button class="btn btn-primary" style="margin:20px auto;">提交</button>
                </form>
            </div>
        </div>
    </div> 
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
    <script>
    function checkAll(obj){
        $(obj).parents('.b-group').eq(0).find("input[type='checkbox']").prop('checked', $(obj).prop('checked'));
    }
    </script>
</body>
</html>