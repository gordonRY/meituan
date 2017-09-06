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
        <div class="page-header">
            <div class="pull-left">
                <h4>用户组列表</h4>      
            </div>
            <a href="javascript:;" onclick="add()" class="btn btn-primary pull-right margin-top">添加用户组</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                    <tr>
                        <td>编号</td>
                        <td>用户组名</td>
                        <td>状态</td>
                        <td class="w15">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                            <td><?php echo ($vo['gid']); ?></td>
                            <td>
                                <?php echo ($vo['title']); ?>
                            </td>
                            <td>
                                <img width="20" height="20" src="/Thinkphp_meddle/b2b2c/Public/Admin/images/<?php if($vo[status] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('auth_group','id','<?php echo ($vo["id"]); ?>','status',this)"/>
                            </td>
                            <td><a href="javascript:;" ruleid="<?php echo ($vo['gid']); ?>" ruletitle="<?php echo ($vo['title']); ?>" onclick="edit(this)"><span class="glyphicon glyphicon-pencil" alt="修改" title="修改"></span></a>
                                <?php if($vo['type']!=1): ?><span class="text-explode">|</span>
                                    <!--if(confirm('确定删除？'))location='<?php echo U('Admin/Rule/delete_group',array('gid'=>$vo['gid']));?>'-->
                                    <a value="<?php echo ($vo['gid']); ?>" class="delete_group"><span class="glyphicon glyphicon-trash" title="删除" title="删除"></span></a>
                                    <span class="text-explode">|</span>

                                <a href="<?php echo U('Admin/rule/index',array('gid'=>$vo['gid']));?>">分配权限</a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div> 
    <div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"> 添加用户组</h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-horizontal" action="<?php echo U('Admin/Rule/add_group');?>" method="post">
                        <table class="table table-hover contact-template-form">
                            <tbody><tr>
                                <td width="20%" align="right">用户组名：</td>
                                <td>
                                    <input class="form-control" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="添加">
                                </td>
                            </tr>
                        </tbody></table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"> 修改用户组</h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-horizontal" action="<?php echo U('Admin/Rule/edit_group');?>" method="post">
                        <input type="hidden" name="id">
                        <table class="table table-hover contact-template-form">
                            <tbody><tr>
                                <td width="20%" align="right">用户组名：</td>
                                <td>
                                    <input class="form-control" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="修改">
                                </td>
                            </tr>
                        </tbody></table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
    <script>
    function add(){
        $("input[name='title']").val('');
        $('#bjy-add').modal('show');
    }
    function edit(obj){
        var ruleId=$(obj).attr('ruleId');
        var ruletitle=$(obj).attr('ruletitle');
        $("input[name='id']").val(ruleId);
        $("input[name='title']").val(ruletitle);
        $('#bjy-edit').modal('show');
    }
    $(".delete_group").click(function()
    {
         gid=$(this).attr("value");
        saveurl="<?php echo U('Admin/Rule/delete_group');?>";
         data="gid="+gid;
        layer.alert(saveurl)
        layer.confirm("确认删除吗？",{icon:3},function(index)
        {
            $.get(saveurl,data,function(res)
            {
                if(res==1)
                {
                    layer.msg("删除成功",{icon:1},function()
                    {
                        window.location.reload();

                    })
                }
                else
                {
                    layer.msg("删除失败",{icon:2},function()
                    {
                        window.location.reload();
                    })
                }
            },"text");
            layer.close(index);
        });
    })
    </script>
</body>
</html>