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
                <h4>管理员列表</h4>      
            </div>
            <a href="<?php echo U('rule/add_admin');?>"  class="btn btn-primary pull-right margin-top">添加管理员</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                    <tr>
                        <td>管理员账号</td>
                        <td>所属用户组</td>
                        <td>状态</td>
                        <td class="w10">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($infos)): foreach($infos as $key=>$vo): ?><tr>
                            <td><?php echo ($vo['admin_name']); ?></td>
                            <td>
                                <?php echo ($vo['title']); ?>
                            </td>
                            <td>
                                <?php if($vo["status"] == 1): ?>允许登陆
                                <?php else: ?>
                                    <font color="red">禁止登陆</font><?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo U('Admin/Rule/edit_admin',array('id'=>$vo['admin_id']));?>"> <span class="glyphicon glyphicon-pencil" alt="修改信息和权限" title="修改信息和权限"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a  class="admin_delete" value="<?php echo ($vo['admin_id']); ?>"><span class="glyphicon glyphicon-trash" alt="删除" title="删除" ></span></a>
                            </td>
                        </tr><?php endforeach; endif; ?>
					<tr align="right">
                        <td colspan=4 ><?php echo ($list); ?></td>
  
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/Admin/js/common.js"></script>
</body>
</html>
<script>

    $(".admin_delete").click(function()
    {
        id=$(this).attr("value");
        data="id="+id;
        saveurl='<?php echo U("Admin/Rule/delete_admin");?>';
        layer.confirm('确认删除？', {icon: 3, title:'提示'}, function(index){
            $.post(saveurl,data,function(res){
           if(res=="1")
           {
               layer.msg("删除成功", {icon: 6},function()
               {
                   window.location.reload();
               })
           }
           else if(res=="2")
                {
                    layer.msg("删除失败", {icon: 6},function()
                    {
                        window.location.reload();
                    })
                }
           else if(res=="3")
           {
                    layer.msg("该用户不能被删除",{icon:6},function()
                    {
                        window.location.reload();
                    })
           }
           else if(res=="4")
           {
               layer.msg("权限不够",{icon:6},function()
               {
                   window.location.reload();
               })
           }
            },"json")
            layer.close(index);
        })

    })




</script>