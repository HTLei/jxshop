<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\item\www.shop.com\public/../application/home\view\cart\cartList.html";i:1535790011;s:63:"D:\item\www.shop.com\application\home\view\public\head_nav.html";i:1535853400;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/base.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/global.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/header.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/cart.css" type="text/css">
	<link rel="stylesheet" href="<?php echo config('static_home'); ?>/style/footer.css" type="text/css">

	<script type="text/javascript" src="<?php echo config('static_home'); ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php echo config('static_home'); ?>/js/cart1.js"></script>
	<script type="text/javascript" src="/plugins/layer/layer.js"></script>

</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
    <li>您好，<b><?php echo session('member_username'); ?></b> 欢迎来到京西！
        <?php if(session('member_id')): ?>
        [<a href="<?php echo url('/home/public/logout'); ?>" onclick="return confirm('客官，确定要离开吗？')">退出</a>]
        <?php else: ?>
        [<a href="<?php echo url('/home/public/login'); ?>">登录</a>]
        [<a href="<?php echo url('/home/public/register'); ?>">免费注册</a>]
        <?php endif; ?>
    </li>
    <li class="line">|</li>
    <li><a href="<?php echo url('/home/order/selfOrder'); ?>">我的订单</a></li>
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
			<div class="flow fr">
				<ul>
					<li class="cur">1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<table>
			<thead>
				<tr>
					<th class="col1">商品名称</th>
					<th class="col2">商品信息</th>
					<th class="col3">单价</th>
					<th class="col4">数量</th>	
					<th class="col5">小计</th>
					<th class="col6">操作</th>
				</tr>
			</thead>
			<tbody>

				<?php $total = 0;foreach($cartData as $v):
					$unitPrice = (float)$v['goodsInfo']['goods_price'] + (float)$v['attr']['attrTotalPrice'];//单价
					$subTotal = (float)($unitPrice * $v['goods_number']);//小计
					$total += $subTotal;
				?>
				<tr>
					<td class="col1"><a href=""><img src="/uploads/<?php echo json_decode($v['goodsInfo']['goods_middle'])[0]; ?>" alt="" /></a>  <strong><a href="<?php echo url('home/goods/detail',['goods_id'=>$v['goods_id']]); ?>"><?php echo $v['goodsInfo']['goods_name']; ?></a></strong></td>
					<td class="col2"> <?php echo $v['attr']['attrInfo']; ?> </td>
					<td class="col3">￥<span><?php echo $unitPrice; ?></span></td>
					<td class="col4"  goods_id="<?php echo $v['goods_id']; ?>" goods_attr_ids="<?php echo $v['goods_attr_ids']; ?>">
						<a href="javascript:;" class="reduce_num"></a>
						<input type="text" name="amount" value="<?php echo $v['goods_number']; ?>" class="amount"/>
						<a href="javascript:;" class="add_num"></a>
					</td>
					<td class="col5">￥<span><?php echo $subTotal; ?></span></td>
					<td class="col6"><a href="javascript:void(0);" goods_id="<?php echo $v['goods_id']; ?>" goods_attr_ids="<?php echo $v['goods_attr_ids']; ?>" subTotal="<?php echo $subTotal; ?>" class="delCartGoods" >删除</a></td>
				</tr>

				<?php endforeach; ?>

			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo $total; ?></span></strong></td>
				</tr>
			</tfoot>
		</table>
		<div class="cart_btn w990 bc mt10">
			<a href="" class="continue">继续购物</a>&nbsp;&nbsp;
			<a href="javascript:void(0);" class="continue" style="margin-left:10px;" id="clearCartGoods">清空购物车</a>
			<a href="<?php echo url('/home/order/orderInfo'); ?>" class="checkout">结 算</a>
		</div>
	</div>
	<!-- 主体部分 end -->

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

	<script>

        var html = "<tr style='height: 100px;'><td colspan='6'><span style='font-size: 30px;'>你的购物车空空如也</span></td></tr>";
        if($('tbody').children('tr').length == 0){
            $('tbody').html(html);//清除购物车内容
        }

		//删除单项购物车内的商品
		$('.delCartGoods').click(function(){
		    if(!confirm('确定要移除该商品吗？')){
		        return false;
			}
            var _self = $(this);
		    var goods_id = _self.attr('goods_id');
		    var goods_attr_ids = _self.attr('goods_attr_ids');
			$.get("<?php echo url('/home/cart/delCartGoods'); ?>",{'goods_id':goods_id,'goods_attr_ids':goods_attr_ids},function(res){
			    if(res.code == 200){
                    _self.parents('tr').remove();
					//总价
					var total = parseFloat($('#total').html());
					//本次商品的小计
					var subTotal =  parseFloat(_self.attr('subTotal'));
					$('#total').html(total - subTotal);
					console.log(total);
					console.log(subTotal);

                    if($('tbody').children('tr').length == 0){
                        $('tbody').html(html);//清除购物车内容
                    }


                    layer.msg(res.msg,{'icon':1});
				}else{
			        layer.msg(res.msg,{'icon':2});
				}
			},'json');
		});

        //清空购物车
		$('#clearCartGoods').click(function(){
		    if(!confirm('确认要清空购物车？')){
		        return false;
			}
			var _self = $(this);
			$.get("<?php echo url('/home/cart/clearCartGoods'); ?>",{},function(res){
				if(res.code == 200){
				    $('#total').html('');//价格归零
                    $('tbody').html(html);//清除购物车内容
					layer.msg(res.msg,{'icon':1});

				}else{
				    if($('tbody').text() == '你的购物车空空如也'){
                        layer.msg('你的购物车空空如也，赶紧选购吧',{'icon':6});
					}else{
                        layer.msg(res.msg,{'icon':2});
					}

				}
			},'json');
		});

	</script>

</body>
</html>
