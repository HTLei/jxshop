<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\item\www.shop.com\public/../application/admin\view\goods\add.html";i:1535100362;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('static_admin'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="<?php echo config('static_admin'); ?>/js/jquery.js"></script>
    <!--富文本编辑器-->
    <script type="text/javascript" charset="utf-8" src="/plugins/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/plugins/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
    <!--富文本编辑器-->
    <style>
        .active{
            border-bottom: solid 3px #66c9f3;
        }
    </style>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">表单</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span class="active">基本信息</span>
            <span>商品属性信息</span>
            <span>商品相册</span>
            <span>商品描述</span>

        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <ul class="forminfo">
                <li>
                    <label>商品名称</label>
                    <input name="goods_name" placeholder="请输入商品名称" type="text" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>商品分类</label>
                    <select name="cat_id" class="dfinput">
                        <option value="">请选择分类</option>
                        <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): if( count($cates)==0 ) : echo "" ;else: foreach($cates as $key=>$cate): ?>
                        <option value="<?php echo $cate['cat_id']; ?>"><?php echo str_repeat('--- ',$cate['level']); ?><?php echo $cate['cat_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select><i></i>
                </li>
                <li>
                    <label>商品价格</label>
                    <input name="goods_price" placeholder="请输入商品价格" type="text" class="dfinput" />
                </li>
                <li>
                    <label>商品库存</label>
                    <input name="goods_number" placeholder="请输入商品库存" type="text" class="dfinput" />
                </li>
                <li>
                    <label>回收站</label>
                    <span class="dfinput" style="border: 0 none;">
                        <input type="radio" name="is_delete" value="0" checked="checked" /> 否 <input type="radio" name="is_delete" value="1" /> 是
                    </span>
                </li>
                <li>
                    <label>是否上架</label>
                    <span class="dfinput" style="border: 0 none;">
                        <input type="radio" name="is_sale" value="0" /> 否 <input type="radio" name="is_sale" value="1" checked="checked" /> 是
                    </span>
                </li>
                <li>
                    <label>新品</label>
                    <span class="dfinput" style="border: 0 none;">
                        <input type="radio" name="is_new" value="0"  /> 否 <input type="radio" name="is_new" value="1" checked="checked" /> 是
                    </span>
                </li>
                <li>
                    <label>精品</label>
                    <span class="dfinput" style="border: 0 none;">
                        <input type="radio" name="is_best" value="0" /> 否 <input type="radio" name="is_best" value="1" checked="checked" /> 是
                    </span>
                </li>
                <li>
                    <label>热卖</label>
                    <span class="dfinput" style="border: 0 none;">
                        <input type="radio" name="is_hot" value="0" /> 否 <input type="radio" name="is_hot" value="1" checked="checked" /> 是
                    </span>
                </li>
                <!--
                <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
                -->
            </ul>
            <ul class="forminfo">
                <li>
                    <label>商品类型</label>
                    <select name="type_id" class="dfinput">
                        <option value="">请选择商品类型</option>
                        <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): if( count($types)==0 ) : echo "" ;else: foreach($types as $key=>$type): ?>
                        <option value="<?php echo $type['type_id']; ?>"><?php echo $type['type_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <ul id="type_container">

                </ul>
            </ul>
            <ul class="forminfo">
                <li>
                    <a href="javascript:void(0);" onclick="cloneImg(this)">[+]</a>
                    <input type="file" name='goods_img[]'/>
                </li>
            </ul>
            <ul class="forminfo">
                <li>
                    <label>商品描述</label>
                    <textarea name="goods_desc" id="goods_desc"></textarea>
                </li>

                <!--
                <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
                -->
            </ul>
			<li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
             </li>
        </form>
    </div>
</body>
<script>
    //动态生成商品属性
    $("select[name='type_id']").change(function(){
        var type_id = $(this).val();
        $.get("<?php echo url('/admin/goods/getAttrs'); ?>",{'type_id':type_id},function(res){

            var html = [];
            for(var i=0;i<res.length;i++){

                html += "<li>";
                //如果是唯一属性
                if(res[i]['attr_type'] == 0){
                    html += "<label>" + res[i]['attr_name'] + "</label>";
                }else{ //单选属性
                    html += "<label><a href='javascript:void(0);' onclick='cloneAttr(this);'>[+] </a>" + res[i]['attr_name'] + "</label>";
                }

                //判断是否是单选属性，如果单选属性，name后面需要加[]，唯一属性则不需要
                var hasManyValue = res[i].attr_type == 1 ? '[]' : '';
                //手工输入
                if(res[i]['attr_input_type'] == 0){
                    html +="<input type='text' name='goodsAttrValue[" + res[i]['attr_id'] + "]" + hasManyValue + "' class='dfinput clearValue'>";
                }else{ //列表选择
                    var valuesArr = res[i]['attr_values'].split('|');
                    html += "<select name='goodsAttrValue[" + res[i]['attr_id'] + "]" + hasManyValue + "' class='dfinput'>";
                    html += "<option value=''>请选择</option>";
                    for(var j=0;j<valuesArr.length;j++){
                    html += "<option>" + valuesArr[j] + "</option>";
                    }
                    html += "</select>";
                }
                //如果是单选属性时，需要拼接上一个价格框
                if(res[i]['attr_type'] == 1){
                    html += " 属性价格 ";
                    html += "<input type='text' name='goodsAttrPrice[" + res[i]['attr_id'] + "][]' class='dfinput clearValue' style='width:100px;'>";
                }

                html += "</li>";
            }
           $("#type_container").html(html);

        },'json');
    });

    //属性添加
    function cloneAttr(ele){
        var newLi = $(ele).parent().parent().clone();
        newLi.find('a').html('[-]');
        //添加时，清空输入框内容
        newLi.children("input").val('');
        if( $(ele).html() == '[-]' ){
            $(ele).parent().parent().remove();
        }else{
            $(ele).parent().parent().after(newLi);
        }
    }


    //多图添加上传
    function cloneImg(ele){
        var newLi = $(ele).parent().clone();
        newLi.children('a').html('[-]');
        newLi.children("input[name='goods_img[]']").val('');
        if( $(ele).html() == '[-]' ){
            $(ele).parent().remove();
        }else{
            $(ele).parent().after(newLi);
        }
    }

    //富文本编辑器
    var ue = UE.getEditor('goods_desc');
    //富文本编辑器
    $(".formtitle span").click(function(event){
        $(this).addClass('active').siblings("span").removeClass('active') ;
        var index = $(this).index();
        $("ul.forminfo").eq(index).show().siblings(".forminfo").hide();
    });
     $(".formtitle span").eq(0).click();
</script>

</html>
