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
                <h4>产品分类列表</h4>
            </div>
            <a href="javascript:;" onclick="add()" class="btn btn-primary pull-right margin-top">添加父级分类</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                    <tr>
                        <td>分类名称</td>
                        <td>等级</td>
                        <td>展示</td>
                        <td class="w10">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($father)): foreach($father as $key=>$vo): ?><tr    <?php echo ($vo['pc_level']==1?"class='shrink'":'class="son"'); ?>>
                            <td>
                            <?php if($vo['pc_level']!=1): echo str_repeat("&nbsp;",10);?>----<?php endif; ?>
                            <?php if($vo['pc_level']==1): echo ($vo['pc_name']); echo str_repeat('&nbsp;',5);?><a title="收起" ><span class="glyphicon glyphicon-eject"></span></a>
                            <?php else: ?>
                                <?php echo ($vo['pc_name']); endif; ?></td>
                            <td>
                                <?php echo ($vo['pc_level']); ?>
                            </td>
                            <td>
                                <?php if($vo['pc_show']==1): ?><span class="glyphicon glyphicon-ok" style="color:green"></span>
                                    <?php else: ?>
                                    <span class="glyphicon glyphicon-remove" style="color:darkred"></span><?php endif; ?>
                                </td>
                            <td>
                                <?php if($vo['pc_fid'] == 0): ?><a  pid="<?php echo ($vo['pc_id']); ?>" navname="<?php echo ($vo['pc_name']); ?>" onclick="add_child(this)"><span class="glyphicon glyphicon-plus-sign" title="添加子菜单"></span></a>
                                    <span class="text-explode">|</span><?php endif; ?>
                                <a href="javascript:;" pid="<?php echo ($vo['pc_id']); ?>" navname="<?php echo ($vo['pc_name']); ?>" show="<?php echo ($vo['pc_show']); ?>" onclick="edit(this)"> <span class="glyphicon glyphicon-pencil" title="编辑"></span></a>

                                <span class="text-explode">|</span>
                                <a value="<?php echo ($vo['pc_id']); ?>" class="delete_nav"><span class="glyphicon glyphicon-trash" title="删除"></span></a>
                                <!--href="javascript:if(confirm('确定删除？'))location='<?php echo U('Admin/Nav/delete',array('id'=>$vo['id']));?>'"-->
                            </td>
                        </tr><?php endforeach; endif; ?>		
                    </foreach>
                </tbody>
            </table>
        </div>
    </div> 
    <div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"> 添加分类</h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-horizontal" action="<?php echo U('Admin/Product/add_cate');?>" method="post">
                        <input type="hidden" name="pid" value="0">
                        <table class="table table-hover contact-template-form">
                            <tbody><tr>
                                <td width="20%" align="right">菜单名：</td>
                                <td>
                                    <input class="form-control w-300" type="text" name="name">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">分类等级：</td>
                                <td>
                                    <input class="form-control w-300" type="text" name="level" placeholder="例如：1">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">是否显示：</td>
                                <td>
                                    <input class="form-control w-300" type="text" name="show" placeholder="例如：1">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
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
                    <h4 class="modal-title" id="myModalLabel"> 修改菜单</h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-horizontal" action="<?php echo U('Admin/Product/edit_cate');?>" method="post">
                        <input type="hidden" name="id">
                        <table class="table table-hover contact-template-form">
                            <tbody><tr>
                                <td width="20%" align="right">菜单名：</td>
                                <td>
                                    <input class="form-control w-300" type="text" name="name">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">是否显示：</td>
                                <td>
                                    <input class="form-control w-300" type="text" name="show">
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
    // 添加菜单
    function add(){
        $("input[name='name'],input[name='mca']").val('');
        $("input[name='pid']").val(0);
        $('#bjy-add').modal('show');
    }

    // 添加子菜单
    function add_child(obj){
        var navId=$(obj).attr('pid');
        $("input[name='pid']").val(navId);
        $('#bjy-add').modal('show');
    }

    // 修改菜单
    function edit(obj){
        var navId=$(obj).attr('pid');
        var navName=$(obj).attr('navName');
        var show=$(obj).attr('show');
        if(show==1)
        {
            show="显示";
        }
        else
        {
            show="不显示";
        }
        $("input[name='id']").val(navId);
        $("input[name='name']").val(navName);
        $("input[name='show']").val(show);
        $('#bjy-edit').modal('show');
    }
    $(".delete_nav").click(function()
    {
        id=$(this).attr("value");
        url='<?php echo U("Admin/Product/delete_cate");?>';
        data="id="+id;
        layer.confirm("确定删除吗？",{icon:3},function(index)
        {
            $.get(url,data,function(res)
            {
                if(res==1)
                {
                    layer.msg("该父级菜单栏下存在子集，不能删除",{icon:7},function()
                    {
                        window.location.reload();
                    })
                }
                else if(res==2)
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
            })
            layer.close(index);
        })
    })
    var clickcount=0;
        $(".shrink").click(function()
        {

            clickcount++;
            if(clickcount%2==0)
            {
                $(this).nextAll(" .son").attr("style","")

            }
            else if (clickcount%2!=0)
            {
                $(this).nextAll(" .son").attr("style","display:none");

            }

        })
    </script>
</body>
</html>