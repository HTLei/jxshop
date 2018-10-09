<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\item\www.shop.com\public/../application/admin\view\auth\add.html";i:1534676390;}*/ ?>
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
        </div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>权限名称</label>
                    <input name="auth_name" placeholder="请输入权限名称" type="text" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>父级权限</label>
                    <select name="pid" id="" class="dfinput">
                        <option value="">请选择父级权限</option>
                        <option value="0">顶级（1级）权限</option>
                        <?php if(is_array($auths) || $auths instanceof \think\Collection || $auths instanceof \think\Paginator): if( count($auths)==0 ) : echo "" ;else: foreach($auths as $key=>$auth): ?>
                        <option value="<?php echo $auth['auth_id']; ?>"><?php echo str_repeat('--- ',$auth['level']); ?><?php echo $auth['auth_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <label>控制器名</label>
                    <input name="auth_c" placeholder="请输入控制器名" type="text" class="dfinput" />
                </li>
                <li>
                    <label>方法名</label>
                    <input name="auth_a" placeholder="请输入方法名" type="text" class="dfinput" />
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
    //当添加权限的时候：
    //选择父权限为顶级时，控制器名和方法名的input输入框应该被禁用
    //选择父权限为非顶级时，必须要验证控制器名和方法名必填
    $("select[name='pid']").change(function(){
        if($(this).val() == 0){
            $("input[name='auth_c'],input[name='auth_a']").attr('disabled',true).val('');
        }else{
            $("input[name='auth_c'],input[name='auth_a']").attr('disabled',false);
        }
    });

</script>
</html>
