<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
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
	<!--[if lt IE 9]-->
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/html5shiv.js"></script>
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/respond.min.js"></script>
	<!--[endif]-->
	<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/css/style.css" />
	<!--[if IE 6]>-->
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
	<script>DD_belatedPNG.fix('*');</script>
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/ueditor/ueditor.all.js"></script>
	<!--[endif]-->
	<title>新增图片</title>
	<link href="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
	<style>
		label.error{
			    position: absolute;
    		right: 18px;
    		top: 9px;
    		color: #ef392b;
    		font-size: 12px;
		}
		.baiduedit{
			width:74%;
			position:relative;;
			left:234px;
		}
		#product_theme-error{
			position: relative;
			top:500px;
			left:-500px;
		}

	</style>
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" action="<?php echo U('Admin/Product/addProduct?pid=$m.p_id');?>" name="form" method='post' enctype='multipart/form-data'>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>店铺名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_name"]); ?>" placeholder="" name="rname">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>商品名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_name"]); ?>" placeholder="" name="pname">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>商家地址：</label>
			<!-- 三级联动 开始 -->
			<!--省份-->
			<div class="formControls col-xs-8 col-sm-9" style="width:235px">
				<span class="select-box" id="prov" style="width: 220px;">
				<select name="province" class="select">
					<option value="">请选择省份/自治区</option>
				</select>
				</span>
			</div>
			<!--市级-->
			<div class="formControls col-xs-8 col-sm-9" style="width:200px">
				<span class="select-box" id="city" style="width: 190px;">
				<select name="city" class="select">
					<option value="">请选择城市</option>
				</select>
				</span>
			</div>
			<!--区县-->
			<div class="formControls col-xs-8 col-sm-9" style="width:200px;">
				<span class="select-box" id="county" style="width: 190px;">
				<select name="county" class="select">
					<option value="">请选择区县</option>
				</select>
				</span>
			</div>
			<!-- 三级联动 结束 -->

		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>商家详细地址：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_detailaddr"]); ?>" placeholder="" name="detail_addr">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>商家联系号码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_mobile"]); ?>" placeholder="" name="detail_mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select name="product_cate" class="select">
					<?php if(is_array($d)): foreach($d as $key=>$v): ?><option value=<?php echo ($v["pc_id"]); ?>><?php echo ($v["pc_name"]); ?></option><?php endforeach; endif; ?>
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>详细分类：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select name="detail_cate" class="select">
					<?php if(is_array($data)): foreach($data as $key=>$vol): ?><option value="<?php echo ($vol["pc_id"]); ?>"><?php echo ($vol["pc_name"]); ?></option><?php endforeach; endif; ?>
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="清输入数字，例如：1"  name="order_vol">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">允许评论：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box" style="width:800px">
					<input type="checkbox" id="checkbox-1" name='comment' checked>
					<label for="checkbox-1">&nbsp;</label>
				</div>
			</div>
		</div>


				<?php if($m['p_pubtime']==''): ?><div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>发布日期：</label>
					<div class="formControls col-xs-8 col-sm-9">
					<input type="text" name="pubtime"  value="<?php echo date('Y-m-d H:i:s',time());?>" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}' })"  class="input-text Wdate">
					</div>
		</div>
					<?php else: ?>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>发布日期：</label>
						<div class="formControls col-xs-8 col-sm-9">
					<input type="text" name="pubtime"  value="<?php echo ($m["p_pubtime"]); ?>" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}' })"  class="input-text Wdate">
						</div>
					</div><?php endif; ?>


		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>有效时间：</label>
			<div class="formControls col-xs-8 col-sm-9">

				<input type="text" name="endtime" value="<?php echo ($m["day"]); ?>" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{            $dp.$D(\'datemin\') }'  })" id="datemax" class="input-text Wdate" placeholder="单位：天； 例如：7,代表有效时间为7天;有效时间最长为60天">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>团购价：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_gprice"]); ?>"  id="" name="group_price" placeholder="团购价<=门店价">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>门店价：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_sprice"]); ?>"   name="store_price" placeholder="门店价>=1">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($m["p_keywords"]); ?>" placeholder=""  name="keyword">
			</div>
		</div>
		<div id="appendHid">
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>商品简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="p_desc" cols=""  rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"><?php echo ($m["p_introduce"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>商品详情：</label>
			<div class="baiduedit">
				<textarea id="intro_contents" name="contents" style="width: 100%; height: 300px"><?php echo ($m["p_detailintroduce"]); ?></textarea>
				<script type="text/javascript">
                    UE.getEditor('intro_contents',{
                        //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
                        toolbars:[
                            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch','autotypeset','blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom','lineheight','|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|','touppercase','tolowercase','|',
                                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright','imagecenter', '|',
                                'insertimage', 'emotion','scrawl', 'insertvideo','music','attachment', 'map', 'gmap', 'insertframe','highlightcode','webapp','pagebreak','template','background', '|',
                                'horizontal', 'date', 'time', 'spechars','snapscreen', 'wordimage', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|',
                                'print', 'preview', 'searchreplace','help']
                        ],
                        //focus时自动清空初始化时的内容
                        autoClearinitialContent:false,
                        //关闭字数统计
                        wordCount:false,
                        //关闭elementPath
                        elementPathEnabled:false
                        //更多其他参数，请参考editor_config.js中的配置项
                    })
				</script>
			</div>
		</div>
			<?php if($m['p_theme']==''): ?><div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>缩略图：</label><input  type="file" name="product_theme"></div>
			<?php else: ?>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>缩略图：</label><input  type="file"  name="product_theme">
					<div><img src="/Thinkphp_meddle/b2b2c/Public/<?php echo ($m["p_theme"]); ?>" alt="" width="200px" height="100px" style="margin-top: 10px"></div>
				</div>
				<input type="hidden" name="theme" value="<?php echo ($m["p_theme"]); ?>"><?php endif; ?>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="glyphicon glyphicon-asterisk" style="color:red"></span>图片上传：</label>

			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-list-container">
					<div class="queueList">
						<div id="dndArea" class="placeholder">
							<div id="filePicker-2"></div>
							<p>或将照片拖到这里，单次最多可选300张</p>
						</div>
					</div>
					<div class="statusBar" style="display:none;">
						<div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
						<div class="info"></div>
						<div class="btns">
							<div id="filePicker2"></div>
							<div class="uploadBtn">开始上传</div>
						</div>
					</div>
				</div>
			</div>

			<?php if($m['p_pic']!=''): ?><div class="row cl">

				<label class="form-label col-xs-4 col-sm-2">上次图片：</label>

					<?php if(is_array($arr)): foreach($arr as $key=>$v): ?><img src="/Thinkphp_meddle/b2b2c/Public/<?php echo ($v); ?>" alt=""
							 style="margin:10px 10px;width:200px;height: 100px;">
						<input type="hidden" name="pic[]" value="<?php echo ($v); ?>" ><?php endforeach; endif; ?>

			</div><?php endif; ?>
			<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
</div>
</form>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/Thinkphp_meddle/b2b2c/Public/h-ui/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script>
    $("select[name=product_cate]").change(function()
	{
	    var value=$(this).val();
	    var url="<?php echo U('Admin/Product/cate_change');?>";
	    $.ajax({
            type:"GET",
            url:url,
        	data:"id="+value,
        	cache:false,
        	async:false,
			success:function(res)
			{
				var str="";
				$.each(res,function(k,v)
				{
                    str+="<option value='"+v.pc_id+
					"'>"+v.pc_name+"</option>";

				})
				$("select[name=detail_cate]").empty();
				$("select[name=detail_cate]").append(str);
			}
		})
	})
	$("form[name=form]").validate({
		rules:{
		    rname:{
                required:true,
                minlength:1,
			},
            pname:{
                required:true,
                minlength:1,
			},
            order_vol:
				{
                    required:true,
                    digits:true,
                    range:[0,1]
				},
            pubtime:{
                required:true,
			},
            endtime:{
                required:true,
                digits:true,
                range:[1,60]
			},
            group_price:{
                required:true,
                number:true,
                min:[1,"#file"]
			},
            store_price:{
                required:true,
                number:true,
                min:1
			},
            keyword:{
                required:true,
                minlength:1,
			},
            p_desc:{
                required:true,
                minlength:2,
			},
            pic_2:{
                required:true,
			},
            county:{
                required:true,
			},
            city:{
                required:true,
            },
            province:{
                required:true,
            },
            detail_addr:{
                required:true,
			},
            product_theme:{
                required:true,
			},
            contents:{
                required:true,
			}
		}
	})
	provurl="<?php echo U('Admin/Product/addr_change');?>"
	$.ajax({
		type:"post",
		url:provurl,
		data:"id=1",
		datatype:"json",
		success:function(data)
		{
		    var str="";

		    $.each(data,function(k,v)
			{

			    str+="<option value='"+v.id+"'>"+v.name+"</option>";
			})
            $("select[name=province]").append(str);
		}
	})
	$("select[name=province]").change(function()
	{
	    id=$(this).val();
        get_ajax( $("select[name=city]"));
		id=$("select[name=city]").val();
        get_ajax( $("select[name=county]"));
	})
    $("select[name=city]").change(function()
	{
	    id=$(this).val()
		get_ajax($("select[name=county]"))
	})
	function get_ajax (obj) {
        $.ajax({
            type:"post",
            url:provurl,
            data:"id="+id,
			async:false,
            datatype:"json",
            success:function(data)
            {
                var str='';
                $.each(data,function(k,v)
                {
                    str+="<option  value='"+v.id+"'>"+v.name+"</option>";
                })
               	obj.empty();
                obj.append(str);
            }
        })
    }
</script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $("#input-4").fileinput({showCaption: false});
    });

    function article_save(){
        alert("刷新父级的时候会自动关闭弹层。")
        window.parent.location.reload();
    }

    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $list = $("#fileList"),
            $btn = $("#btn-star"),
            state = "pending",
            uploader;
         phpfileUrl="<?php echo U('Admin/Product/uploadFile');?>";
        var uploader = WebUploader.create({
            auto: true,
            swf: '/Thinkphp_meddle/b2b2c/Public/lib/webuploader/0.1.5/Uploader.swf',

            // 文件接收服务端。

            server: phpfileUrl,

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id: '#filePicker',
                label: '点击选择图片'
            },

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        uploader.on( 'fileQueued', function( file ) {
            var $li = $(
                    '<div id="' + file.id + '" class="item">' +
                    '<div class="pic-box"><img></div>'+
                    '<div class="info">' + file.name + '</div>' +
                    '<p class="state">等待上传...</p>'+
                    '</div>'
                ),
                $img = $li.find('img');
            $list.append( $li );

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress-box .sr-only');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
            }
            $li.find(".state").text("上传中");
            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file ) {
            $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress-box').fadeOut();
        });
        uploader.on('all', function (type) {
            if (type === 'startUpload') {
                state = 'uploading';
            } else if (type === 'stopUpload') {
                state = 'paused';
            } else if (type === 'uploadFinished') {
                state = 'done';
            }

            if (state === 'uploading') {
                $btn.text('暂停上传');
            } else {
                $btn.text('开始上传');
            }
        });

        $btn.on('click', function () {
            if (state === 'uploading') {
                uploader.stop();
            } else {
                uploader.upload();
            }
        });

    });

    (function( $ ){
        // 当domReady的时候开始初始化
        $(function() {
            var $wrap = $('.uploader-list-container'),

                // 图片容器
                $queue = $( '<ul class="filelist"></ul>' )
                    .appendTo( $wrap.find( '.queueList' ) ),

                // 状态栏，包括进度和控制按钮
                $statusBar = $wrap.find( '.statusBar' ),

                // 文件总体选择信息。
                $info = $statusBar.find( '.info' ),

                // 上传按钮
                $upload = $wrap.find( '.uploadBtn' ),

                // 没选择文件之前的内容。
                $placeHolder = $wrap.find( '.placeholder' ),

                $progress = $statusBar.find( '.progress' ).hide(),

                // 添加的文件数量
                fileCount = 0,

                // 添加的文件总大小
                fileSize = 0,

                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 110 * ratio,
                thumbnailHeight = 110 * ratio,

                // 可能有pedding, ready, uploading, confirm, done.
                state = 'pedding',

                // 所有文件的进度信息，key为file id
                percentages = {},
                // 判断浏览器是否支持图片的base64
                isSupportBase64 = ( function() {
                    var data = new Image();
                    var support = true;
                    data.onload = data.onerror = function() {
                        if( this.width != 1 || this.height != 1 ) {
                            support = false;
                        }
                    }
                    data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                    return support;
                } )(),

                // 检测是否已经安装flash，检测flash的版本
                flashVersion = ( function() {
                    var version;

                    try {
                        version = navigator.plugins[ 'Shockwave Flash' ];
                        version = version.description;
                    } catch ( ex ) {
                        try {
                            version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                                .GetVariable('$version');
                        } catch ( ex2 ) {
                            version = '0.0';
                        }
                    }
                    version = version.match( /\d+/g );
                    return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
                } )(),

                supportTransition = (function(){
                    var s = document.createElement('p').style,
                        r = 'transition' in s ||
                            'WebkitTransition' in s ||
                            'MozTransition' in s ||
                            'msTransition' in s ||
                            'OTransition' in s;
                    s = null;
                    return r;
                })(),

                // WebUploader实例
                uploader;

            if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {

                // flash 安装了但是版本过低。
                if (flashVersion) {
                    (function(container) {
                        window['expressinstallcallback'] = function( state ) {
                            switch(state) {
                                case 'Download.Cancelled':
                                    alert('您取消了更新！')
                                    break;

                                case 'Download.Failed':
                                    alert('安装失败')
                                    break;

                                default:
                                    alert('安装已成功，请刷新！');
                                    break;
                            }
                            delete window['expressinstallcallback'];
                        };

                        var swf = 'expressInstall.swf';
                        // insert flash object
                        var html = '<object type="application/' +
                            'x-shockwave-flash" data="' +  swf + '" ';

                        if (WebUploader.browser.ie) {
                            html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
                        }

                        html += 'width="100%" height="100%" style="outline:0">'  +
                            '<param name="movie" value="' + swf + '" />' +
                            '<param name="wmode" value="transparent" />' +
                            '<param name="allowscriptaccess" value="always" />' +
                            '</object>';

                        container.html(html);

                    })($wrap);

                    // 压根就没有安转。
                } else {
                    $wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
                }

                return;
            } else if (!WebUploader.Uploader.support()) {
                alert( 'Web Uploader 不支持您的浏览器！');
                return;
            }

            // 实例化
            uploader = WebUploader.create({
                pick: {
                    id: '#filePicker-2',
                    label: '点击选择图片'
                },
                formData: {
                    uid: 123
                },
                dnd: '#dndArea',
                paste: '#uploader',
                swf: '/Thinkphp_meddle/b2b2c/Public/lib/webuploader/0.1.5/Uploader.swf',
                chunked: false,
                chunkSize: 512 * 1024,
                server: phpfileUrl,
                // runtimeOrder: 'flash',

                // accept: {
                //     title: 'Images',
                //     extensions: 'gif,jpg,jpeg,bmp,png',
                //     mimeTypes: 'image/*'
                // },

                // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
                disableGlobalDnd: true,
                fileNumLimit: 300,
                fileSizeLimit: 200 * 1024 * 1024,    // 200 M
                fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
            });
            // 拖拽时不接受 js, txt 文件。
            uploader.on( 'dndAccept', function( items ) {
                var denied = false,
                    len = items.length,
                    i = 0,
                    // 修改js类型
                    unAllowed = 'text/plain;application/javascript ';

                for ( ; i < len; i++ ) {
                    // 如果在列表里面
                    if ( ~unAllowed.indexOf( items[ i ].type ) ) {
                        denied = true;
                        break;
                    }
                }

                return !denied;
            });

            uploader.on('dialogOpen', function() {
                console.log('here');
            });

            // uploader.on('filesQueued', function() {
            //     uploader.sort(function( a, b ) {
            //         if ( a.name < b.name )
            //           return -1;
            //         if ( a.name > b.name )
            //           return 1;
            //         return 0;
            //     });
            // });

            // 添加“添加文件”的按钮，
            uploader.addButton({
                id: '#filePicker2',
                label: '继续添加'
            });

            uploader.on('ready', function() {
                window.uploader = uploader;
            });

            // 当有文件添加进来时执行，负责view的创建
            function addFile( file ) {
                var $li = $( '<li id="' + file.id + '">' +
                        '<p class="title">' + file.name + '</p>' +
                        '<p class="imgWrap"></p>'+
                        '<p class="progress"><span></span></p>' +
                        '</li>' ),

                    $btns = $('<div class="file-panel">' +
                        '<span class="cancel">删除</span>' +
                        '<span class="rotateRight">向右旋转</span>' +
                        '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
                    $prgress = $li.find('p.progress span'),
                    $wrap = $li.find( 'p.imgWrap' ),
                    $info = $('<p class="error"></p>'),

                    showError = function( code ) {
                        switch( code ) {
                            case 'exceed_size':
                                text = '文件大小超出';
                                break;

                            case 'interrupt':
                                text = '上传暂停';
                                break;

                            default:
                                text = '上传失败，请重试';
                                break;
                        }

                        $info.text( text ).appendTo( $li );
                    };

                if ( file.getStatus() === 'invalid' ) {
                    showError( file.statusText );
                } else {
                    // @todo lazyload
                    $wrap.text( '预览中' );
                    uploader.makeThumb( file, function( error, src ) {
                        var img;

                        if ( error ) {
                            $wrap.text( '不能预览' );
                            return;
                        }

                        if( isSupportBase64 ) {
                            img = $('<img src="'+src+'">');
                            $wrap.empty().append( img );
                        } else {
                            $.ajax('/Thinkphp_meddle/b2b2c/Public/lib/webuploader/0.1.5/server/preview.php', {
                                method: 'POST',
                                data: src,
                                dataType:'json',
                            }).done(function( response ) {

                                if (response.result) {
                                    img = $('<img src="'+response.result+'">');
                                    $wrap.empty().append( img );
                                } else {
                                    $wrap.text("预览出错");
                                }
                            });
                        }
                    }, thumbnailWidth, thumbnailHeight );

                    percentages[ file.id ] = [ file.size, 0 ];
                    file.rotation = 0;
                }

                file.on('statuschange', function( cur, prev ) {
                    if ( prev === 'progress' ) {
                        $prgress.hide().width(0);
                    } else if ( prev === 'queued' ) {
                        $li.off( 'mouseenter mouseleave' );
                        $btns.remove();
                    }

                    // 成功
                    if ( cur === 'error' || cur === 'invalid' ) {
                        console.log( file.statusText );
                        showError( file.statusText );
                        percentages[ file.id ][ 1 ] = 1;
                    } else if ( cur === 'interrupt' ) {
                        showError( 'interrupt' );
                    } else if ( cur === 'queued' ) {
                        percentages[ file.id ][ 1 ] = 0;
                    } else if ( cur === 'progress' ) {
                        $info.remove();
                        $prgress.css('display', 'block');
                    } else if ( cur === 'complete' ) {
                        $li.append( '<span class="success"></span>' );
                    }

                    $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
                });

                $li.on( 'mouseenter', function() {
                    $btns.stop().animate({height: 30});
                });

                $li.on( 'mouseleave', function() {
                    $btns.stop().animate({height: 0});
                });

                $btns.on( 'click', 'span', function() {
                    var index = $(this).index(),
                        deg;

                    switch ( index ) {
                        case 0:
                            uploader.removeFile( file );
                            return;

                        case 1:
                            file.rotation += 90;
                            break;

                        case 2:
                            file.rotation -= 90;
                            break;
                    }

                    if ( supportTransition ) {
                        deg = 'rotate(' + file.rotation + 'deg)';
                        $wrap.css({
                            '-webkit-transform': deg,
                            '-mos-transform': deg,
                            '-o-transform': deg,
                            'transform': deg
                        });
                    } else {
                        $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');

                    }


                });

                $li.appendTo( $queue );
            }

            // 负责view的销毁
            function removeFile( file ) {
                var $li = $('#'+file.id);

                delete percentages[ file.id ];
                updateTotalProgress();
                $li.off().find('.file-panel').off().end().remove();
            }

            function updateTotalProgress() {
                var loaded = 0,
                    total = 0,
                    spans = $progress.children(),
                    percent;

                $.each( percentages, function( k, v ) {
                    total += v[ 0 ];
                    loaded += v[ 0 ] * v[ 1 ];
                } );

                percent = total ? loaded / total : 0;


                spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
                spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
                updateStatus();
            }

            function updateStatus() {
                var text = '', stats;

                if ( state === 'ready' ) {
                    text = '选中' + fileCount + '张图片，共' +
                        WebUploader.formatSize( fileSize ) + '。';
                } else if ( state === 'confirm' ) {
                    stats = uploader.getStats();
                    if ( stats.uploadFailNum ) {
                        text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                            stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
                    }

                } else {
                    stats = uploader.getStats();
                    text = '共' + fileCount + '张（' +
                        WebUploader.formatSize( fileSize )  +
                        '），已上传' + stats.successNum + '张';

                    if ( stats.uploadFailNum ) {
                        text += '，失败' + stats.uploadFailNum + '张';
                    }
                }

                $info.html( text );
            }

            function setState( val ) {
                var file, stats;

                if ( val === state ) {
                    return;
                }

                $upload.removeClass( 'state-' + state );
                $upload.addClass( 'state-' + val );
                state = val;
                switch ( state ) {
                    case 'pedding':
                        $placeHolder.removeClass( 'element-invisible' );
                        $queue.hide();
                        $statusBar.addClass( 'element-invisible' );
                        uploader.refresh();
                        break;

                    case 'ready':
                        $placeHolder.addClass( 'element-invisible' );
                        $( '#filePicker2' ).removeClass( 'element-invisible');
                        $queue.show();
                        $statusBar.removeClass('element-invisible');
                        uploader.refresh();
                        break;

                    case 'uploading':
                        $( '#filePicker2' ).addClass( 'element-invisible' );
                        $progress.show();
                        $upload.text( '暂停上传' );
                        break;

                    case 'paused':
                        $progress.show();
                        $upload.text( '继续上传' );
                        break;

                    case 'confirm':
                        $progress.hide();
                        $( '#filePicker2' ).removeClass( 'element-invisible' );
                        $upload.text( '开始上传' );

                        stats = uploader.getStats();
                        if ( stats.successNum && !stats.uploadFailNum ) {
                            setState( 'finish' );
                            return;
                        }
                        break;
                    case 'finish':
                        stats = uploader.getStats();
                        if ( stats.successNum )
                        {

                        } else {
                            // 没有成功的图片，重设
                            state = 'done';
                            location.reload();
                        }
                        break;
                }

                updateStatus();
            }
            //成功返回值存储在hidden中
            uploader.on('uploadSuccess', function(file,response)
            {
                 imgurl=response.url;
                 if(imgurl!='')
				 {
				     layer.msg("上传成功",{icon:1})
				 }
				 else {
                     layer.msg("上传失败",{icon:2})
				 }
                 str="<input type='hidden' name='pic[]' value='"+imgurl+"'>";
                 $("#appendHid").append(str);
            });
            uploader.onUploadProgress = function( file, percentage ) {
                var $li = $('#'+file.id),
                    $percent = $li.find('.progress span');

                $percent.css( 'width', percentage * 100 + '%' );
                percentages[ file.id ][ 1 ] = percentage;
                updateTotalProgress();
            };

            uploader.onFileQueued = function( file ) {
                fileCount++;
                fileSize += file.size;

                if ( fileCount === 1 ) {
                    $placeHolder.addClass( 'element-invisible' );
                    $statusBar.show();
                }

                addFile( file );
                setState( 'ready' );
                updateTotalProgress();
            };

            uploader.onFileDequeued = function( file ) {
                fileCount--;
                fileSize -= file.size;

                if ( !fileCount ) {
                    setState( 'pedding' );
                }

                removeFile( file );
                updateTotalProgress();

            };

            uploader.on( 'all', function( type ) {
                var stats;
                switch( type ) {
                    case 'uploadFinished':
                        setState( 'confirm' );
                        break;

                    case 'startUpload':
                        setState( 'uploading' );
                        break;

                    case 'stopUpload':
                        setState( 'paused' );
                        break;

                }
            });

            uploader.onError = function( code ) {
                alert( 'Eroor: ' + code );
            };

            $upload.on('click', function() {
                if ( $(this).hasClass( 'disabled' ) ) {
                    return false;
                }

                if ( state === 'ready' ) {
                    uploader.upload();
                } else if ( state === 'paused' ) {
                    uploader.upload();
                } else if ( state === 'uploading' ) {
                    uploader.stop();
                }
            });

            $info.on( 'click', '.retry', function() {
                uploader.retry();
            } );

            $info.on( 'click', '.ignore', function() {
                alert( 'todo' );
            } );

            $upload.addClass( 'state-' + state );
            updateTotalProgress();
        });

    })( jQuery );
</script>
</body>
</html>