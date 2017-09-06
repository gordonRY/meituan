<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
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
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>建材列表</title>
    <link rel="stylesheet" href="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <style>
        .modal-backdrop{
            z-index:0
        }
        #search_comment{
            width:700px;
            position: relative;
            left:397px;

        }
    </style>
    </head>

    <body>
    <!--模态框开始-->
    <div class="modal fade" id="comment_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"> 修改评论</h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-horizontal" action="<?php echo U('Admin/Comment/edit');?>" method="post" name="form">
                        <table class="table table-hover contact-template-form">
                            <tbody>
                            <tr>
                                <td width="20%" align="right">评分：</td>
                                <td>
                                    <input class="form-control" type="text" name="star" style="width:150px;" placeholder="输入1-5间的数字">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">评论：</td>
                                <td>
                                    <input class="form-control" type="text" name="comment">
                                    <input type="hidden" name="msgID">
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


    <div class="info-center">
        <div class="page-header">
            <div class="pull-left">
                <h4>评论管理</h4>
            </div>
        </div>
        <div class="clearfix"></div>
        <div >
            <form action="" method="post">
                <div id="search_comment">
                <div class="page-container" style="width:100%;height:80%;margin-left: 0">
                        <input type="text" name="search_order"  placeholder=" 输入订单号" style="width:250px" class="input-text" >
                        <button name=""  class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
                    </div>
                </div>
            </form>
            <div class="page-container" style="width:100%;height:80%;margin-left: 0">


                <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除                  </a>
                 <a href="javascript:;"  class="btn btn-primary" id="selall">
                     全选
                 </a>
                 <a href="javascript:;"  class="btn btn-primary" id="notall">
                     全不选
                 </a>
                 <a href="javascript:;"  class="btn btn-primary" id="defall">
                    反选
				 </a>
            </span>
                    <span class="r">共有数据：<strong><?php echo ($total); ?></strong> 条              </span>
                </div>
                <div class="mt-20">
                    <table class="table table-border table-bordered table-bg table-hover table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="60">选择</th>
                            <th>订单编号</th>
                            <th width="160">用户</th>
                            <th width="160">评论时间</th>
                            <th width="160">评论商品名</th>
                            <th width="120">商品评分</th>
                            <th >评论内容</th>
                            <th width="100">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($res)): if(is_array($res)): foreach($res as $key=>$vol): ?><tr class="text-c va-m" style="text-align: center">
                                    <td><input name="check" type="checkbox" value="<?php echo ($vol["msg_id"]); ?>"></td>
                                    <td><?php echo ($vol["o_rand"]); ?></td>
                                    <td><?php echo ($vol["nickname"]); ?></td>
                                    <td><?php echo ($vol["time"]); ?></td>
                                    <td class="text-l"><span style="color:blue"><?php echo mb_substr($vol['p_name'],0,16,'utf-8');?></span></td>
                                    <?php if($vol['star']==1): ?><td>
                                            <span class='glyphicon glyphicon-star' style="color: red"></span>
                                        </td>
                                        <?php elseif($vol['star']==2): ?>
                                        <td>
								<span class='glyphicon glyphicon-star' style="color: red">
								</span>
                                            <span class='glyphicon glyphicon-star'style="color: red">
								</span>
                                        </td>
                                        <?php elseif($vol['star']==3): ?>
                                        <td>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                        </td>
                                        <?php elseif($vol['star']==4): ?>
                                        <td>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                        </td>
                                        <?php elseif($vol['star']==5): ?>
                                        <td>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                            <span class='glyphicon glyphicon-star'style="color: red"></span>

                                            <span class='glyphicon glyphicon-star'style="color: red"></span>
                                        </td><?php endif; ?>
                                    <td><span class="price"><?php echo ($vol["comment"]); ?></span> </td>
                                    <td><a valueID='<?php echo ($vol["msg_id"]); ?>'valueStar="<?php echo ($vol["star"]); ?>" valueComment="<?php echo ($vol["comment"]); ?>" style="color:blue" class="msg_edit"><span class="glyphicon glyphicon-pencil " title="编辑" ></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a  style="color:blue" value="<?php echo ($vol["msg_id"]); ?>" class="delete"><span class="glyphicon glyphicon-trash" title="删除" ></span></a>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="8"><div style="font-size: 20px;font-family:' Microsoft Yahei';text-align: center">还没有评论哦~</div></td>
                            </tr><?php endif; ?>
                        <tr>
                            <td colspan="8"><?php echo ($list); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/laypage/1.2/laypage.js"></script>
    </div>
    <div>
    </div>
</body>
</html>
<script>
    $('.msg_edit').click(function()
    {
        var id=$(this).attr("valueID");
        var star=$(this).attr("valueStar");
        var comment=$(this).attr("valueComment");
        $("input[name=msgID]").val(id);
        $("input[name=star]").val(star);
        $("input[name=comment]").val(comment);
        $('#comment_edit').modal('show');
    });

    $(".delete").click(function()
    {
        var id=$(this).attr("value");
        var url="<?php echo U('Admin/Comment/delete');?>";
        var data="id="+id;
        layer.confirm("小女子这么可怜，你确定要杀了我吗？",{icon:6},function(index)
        {
            $.post(url,data,function(res)
            {
                if(res==1)
                {
                    layer.msg("你成功杀死狐狸精",{icon:1},function()
                    {
                        window.location.reload();
                    })
                }
                else if(res==0)
                {
                    layer.msg("不好意义,你被狐狸精反杀了",{icon:2},function()
                    {
                        window.location.reload();
                    })
                }
            },"text")
            layer.close(index)
        })
    })

//    不知道什么原因，模态框中不能使用validate
   /* $("form[name=form]").validate({
        rules:{
            star:{
                required:true,
                range:[1,5],
            },
            comment:{
                required:true,
            }
        },
        messages:{
            star:{
                required:"必填项",
                range:"输入1-5中的一个数字",
            },
            comment:{
                required:"必填项",
            }
        }
    })*/


    $("#selall").click(function()
    {
        var obj=$("input[type=checkbox]");
        $.each(obj,function(k,v)
        {
            v.checked=true;
        })
    })
    $("#notall").click(function()
    {
        var obj=$("input[type=checkbox]");
        $.each(obj,function(k,v)
        {
            v.checked=false;
        })
    })
    $("#defall").click(function()
    {
        var obj=$("input[type=checkbox]");
        $.each(obj,function(k,v)
        {
            v.checked=!(v.checked);
        })
    })
</script>