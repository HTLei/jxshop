<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\item\www.shop.com\public/../application/admin\view\user\add.html";i:1534937112;}*/ ?>
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
                    <label>用户名</label>
                    <input name="username" placeholder="请输入用户名" type="text" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>选择角色</label>
                    <select name="role_id" class="dfinput">
                        <?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): if( count($roles)==0 ) : echo "" ;else: foreach($roles as $key=>$role): ?>
                        <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <label>密码</label>
                    <input name="password" placeholder="请输入密码" type="password" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>确认密码</label>
                    <input name="repassword" placeholder="请再次输入密码" type="password" class="dfinput" />
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

</script>

</html>
