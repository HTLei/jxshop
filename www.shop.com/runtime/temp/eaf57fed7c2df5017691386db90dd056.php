<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\item\www.shop.com\public/../application/home\view\public\register.html";i:1535598594;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/base.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/global.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/header.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/login.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/footer.css" type="text/css">
	<script src="<?php echo config('static_home'); ?>/js/jquery-1.8.3.min.js"></script>
	<script src="/plugins/layer/layer.js"></script>
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="/"><img src="<?php echo config('static_home'); ?>/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">邮箱：</label>
							<input type="text" class="txt" name="email" />
							<p>3-20位字符，可由字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password" class="txt" name="repassword" />
							<p> <span>请再次输入密码</p>
						</li>
						<li>
							<label for="">手机号码：</label>
							<input type="text" class="txt" name="phone" />
							<input type="button" id="sendSms" value="发送短信" style="height:32px;" />
							<p> <span>请输入手机号</p>
						</li>
						<li>
							<label for="">短信验证：</label>
							<input type="password" class="txt" name="phoneCaptcha" />
							<p> <span>请输入手机验证码</p>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="captcha" />
							<img src="<?php echo captcha_src('1'); ?>" alt=""  id="captcha" />
							<span>看不清？<a href="javascript:void(0);" onclick="changeCaptcha()">换一张</a></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				
			</div>
			
			<div class="mobile fl">
				<h3>手机快速注册</h3>			
				<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
				<p><strong>1069099988</strong></p>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="<?php echo config('static_home'); ?>/images/xin.png" alt="" /></a>
			<a href=""><img src="<?php echo config('static_home'); ?>/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="<?php echo config('static_home'); ?>/images/police.jpg" alt="" /></a>
			<a href=""><img src="<?php echo config('static_home'); ?>/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->

</body>
<script>
	//点击更换验证码
	function changeCaptcha(){
	    document.getElementById('captcha').setAttribute('src',"<?php echo captcha_src('1'); ?>?_=" + Math.random());
	}
	changeCaptcha();

	//点击发送信息按钮，发送ajax请求
	$('#sendSms').click(function(){
	    var phone = $("input[name='phone']").val();
	    var reg = /^1[3-8]\d{9}$/;
	    if(!reg.test(phone)){
	        layer.msg('手机号码非法');
	        return false;
		}

		var input = $(this);
	    var time = 10;//倒计时时间
        countDown(input,time);

		//发送ajax请求
	    $.get("<?php echo url('/home/public/sendSms'); ?>",{'phone':phone},function(res){
	        if(res['code'] == 200){
	            layer.msg(res['msg']);
            }else{
	            layer.msg(res['msg']);
			}
		},'json');


    });

	//短信发送成功之后的倒计时重新发送
	function countDown(input,time){
	    input.val('请' + time-- +  '秒后重试').attr('disabled',true);
	    //定时器每秒执行一次函数
		setTimeout(function(){
		    //当时间为 0 的时候，中断函数
            if(time == 0){
                input.val('发送短信').attr('disabled',false);
                return false;
            }
		    countDown(input,time);
		},1000);
	}

</script>
</html>