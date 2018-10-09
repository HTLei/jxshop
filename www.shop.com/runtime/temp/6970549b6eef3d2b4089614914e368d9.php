<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\item\www.shop.com\public/../application/admin\view\attribute\add.html";i:1535884627;s:61:"D:\item\www.shop.com\application\admin\view\public\place.html";i:1535884627;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('static_admin'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="<?php echo config('static_admin'); ?>/js/jquery.js"></script>
    <style>
        .active{
            border-bottom: solid 3px #66c9f3;
        }
    </style>
</head>

<body>
    <!--<div class="place">-->
        <!--<span>位置：</span>-->
        <!--<ul class="placeul">-->
            <!--<li><a href="#">首页</a></li>-->
            <!--<li><a href="#">表单</a></li>-->
        <!--</ul>-->
    <!--</div>-->
    <div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="javascript:void(0);">首页</a></li>
        <?php $break = session('break');foreach($break as $v):if($v['pid'] == 0):?>
        <li><a href="javascript:void(0);"><?php echo $v['auth_name'];?></a></li>
        <?php else:?>
        <li><a href="<?php echo url('/admin/' . $v['auth_c'] . '/' . $v['auth_a'],['auth_id'=>$v['auth_id']]); ?>"><?php echo $v['auth_name'];?></a></li>
        <?php endif;endforeach;?>
    </ul>
</div>
    <div class="formbody">
        <div class="formtitle">
            <span class="active">基本信息</span>
        </div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>属性名称</label>
                    <input name="attr_name" placeholder="请输入属性名称" type="text" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>商品类型</label>
                    <select name="type_id" id="" class="dfinput">
                        <option value="">请选择商品类型</option>
                        <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): if( count($types)==0 ) : echo "" ;else: foreach($types as $key=>$type): ?>
                        <option value="<?php echo $type['type_id']; ?>"><?php echo $type['type_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <label>属性类型</label>
                    <input name="attr_type" type="radio" value="0" checked="checked" />唯一属性
                    <input name="attr_type" type="radio" value="1" /> 单选属性<i></i>
                </li>
                <li>
                    <label>录入方式</label>
                    <input name="attr_input_type" type="radio" value="0" checked="checked" /> 手工输入
                    <input name="attr_input_type" type="radio" value="1" /> 列表选择<i>(多个属性用 | 隔开)</i>
                </li>
                <li>
                    <label>属性值</label>
                    <textarea name="attr_values" class="textinput" ></textarea>
                </li>
            </ul>
			<li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
             </li>
        </form>
    </div>
</body>
<script>

    $("textarea[name='attr_values']").attr('disabled',true);
    $("input[name='attr_input_type']").click(function(){
       if($(this).val() == 0){
            $("textarea[name='attr_values']").attr('disabled',true).val('');
        }else{
            $("textarea[name='attr_values']").attr('disabled',false);
        }
    });

</script>
</html>
