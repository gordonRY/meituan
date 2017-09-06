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
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/Checkboxes/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/Checkboxes/css/build.css">
    <style>
        #check8{
            position: relative;
            left:-5px;
        }
    </style>
</head>
<body>
    <div class="info-center">
        <div class="page-header">
            <div class="pull-left">
                <h4>分配权限</h4>
            </div>
        </div>
        <div class="clearfix"></div>
            <br>
        <form action="<?php echo U('Admin/Rule/assign_power');?>" method="post" class="form-horizontal">
            <div style="text-align: left">
                <font color="red"><span class="glyphicon glyphicon-asterisk">&nbsp;</span></font><span style="font-size: 20px;color:#09c;font-weight: bold">用户组别：</span>
                <?php if(is_array($group)): foreach($group as $key=>$g): $gid = $g['gid']; ?>
                    <div class="radio radio-danger" style="display: inline-block;margin:0px 20px;">
                        <input
                                type="radio"
                                name="group" id="<?php echo ($g['gid']); ?>group"
                                value="<?php echo ($g['gid']); ?>"  <?php echo ($gid==$get_gid?checked:''); ?> >
                        <label for="<?php echo ($g['gid']); ?>group">
                           <span style="color:orangered;font-size: 16px;"><?php echo ($g["title"]); ?></span>
                        </label>
                    </div><?php endforeach; endif; ?>
            </div>
            <div class="clearfix"></div>
            <div class="table-margin">
                <div id="warp">
                    <?php if(is_array($father)): foreach($father as $key=>$app): ?><div class="app">
                            <p>
                                <strong><?php echo ($app["name"]); ?></strong>
                            </p>
                            <?php if(is_array($son)): foreach($son as $key=>$action): if($action['fid']==$app['id']): ?><dl>
                                    <dt><strong  style=" display:inline-block" class="son">
                                        <div class="checkbox checkbox-info checkbox-circle" style="position: relative;left: 10px">
                                            <?php if(strstr($rules,$action['rid'].',')): ?><input id="<?php echo ($action["rid"]); ?>" class="styled" style="color:red" value="<?php echo ($action["rid"]); ?>" name="<?php echo ($action["name"]); ?>" type="checkbox" checked >
                                                <?php else: ?>
                                                <input id="<?php echo ($action["rid"]); ?>" class="styled" style="color:red" value="<?php echo ($action["rid"]); ?>" name="<?php echo ($action["name"]); ?>" type="checkbox" ><?php endif; ?>


                                            <label for="<?php echo ($action["rid"]); ?>" id="check8">
                                                <span style="    color:darkcyan;
    font-size: 16px;font-weight: bold"><?php echo ($action["name"]); ?></span>
                                            </label>
                                        </div>
                                    </strong>
                                    </dt>

                                    <?php if(is_array($grandson)): foreach($grandson as $key=>$method): if($method['r_fid']==$action['id']): ?><div class="checkbox checkbox-success" style="display:inline-block;margin: 10px 10px">

                       <?php if(strstr($rules,$method['rid'])): ?><input id=<?php echo ($method["rid"]); ?> class="styled" type="checkbox" value="<?php echo ($method["rid"]); ?>" name="<?php echo ($method['title']); ?>"  checked>
                           <?php else: ?>
                           <input id=<?php echo ($method["rid"]); ?> class="styled" type="checkbox" value="<?php echo ($method["rid"]); ?>" name="<?php echo ($method['title']); ?>" ><?php endif; ?>
                    <label for=<?php echo ($method["rid"]); ?>>
                        <span style="color:brown;font-weight: bold;"><?php echo ($method['title']); ?></span>
                    </label>
                        </div><?php endif; endforeach; endif; ?>
                                </dl><?php endif; endforeach; endif; ?>
                        </div><?php endforeach; endif; ?>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div style="text-align: center">
        <button type="submit" class="btn btn-info">确认提交</button></div>
        <br>
        <br>
        <br>
        <br>
        </form>
        <br>
</body>
</html>
<script type="text/javascript">
    function changeState(el) {
        if (el.readOnly) el.checked=el.readOnly=false;
        else if (!el.checked) el.readOnly=el.indeterminate=true;
    }
 $("input[name$=son]:checked").attr("id")


    $(".son").click(function()
    {
        var obj=$(this).children().children("input");
        var res=obj.attr("checked")
        if(res==undefined)
        {
            $(this).parent().nextAll().children("input").attr("checked","checked");
        }
    })

</script>