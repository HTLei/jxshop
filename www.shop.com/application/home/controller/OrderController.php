<?php
namespace app\home\controller;
use think\Controller;//引入核心控制器
use think\Db;
use app\home\model\Order;
class OrderController extends Controller{
    //去结算
    public function orderInfo(){
        if(!session('member_id')) {
            $this->error('请先登录');
        }

        $cartModel = new \cart\Cart;
        $cartData = $cartModel->getCart();

        if(!$cartData){
            $this->error('你的购物车空空如也，请先添加商品到购物车中');
        }
        return $this->fetch('',[
            'cartData'  => $cartData
        ]);
    }

    //提交订单
    public function writeOrderInfo(){
        if(!session('member_id')) {
            $this->error('请先登录');
        }

        $postData = input('post.');

        $result = $this->validate($postData,'Order.writeOrderInfo',[],true);
        if($result !== true){
            $this->error( implode(',',$result));
        }

        $order_id = date('ymdHis') . time() . uniqid();
        $member_id = session('member_id');

        $cartModel = new \cart\Cart;
        $cartData = $cartModel->getCart();
        if(!$cartData){
            $this->error('购物车中没有任何商品，请先添加商品到购物车');
        }
        $total_price = 0;
        foreach($cartData as $v){
            $total_price += ($v['goodsInfo']['goods_price'] + $v['attr']['attrTotalPrice']) * $v['goods_number'];
        }

        //开始开启事务，进行入库
        Db::startTrans();
        try{
            //1-入库订单表
            $postData['order_id'] = $order_id;
            $postData['total_price'] = $total_price;
            $postData['member_id'] = $member_id;
            $order_result = Order::create($postData);
            if(!$order_result){
                throw new \Exception('订单表入库失败');
            }
            //2-订单表入库成功，才入库订单商品表，同时要减去商品对应的库存数量
            foreach($cartData as $v){
                $goods_price = ($v['goodsInfo']['goods_price'] + $v['attr']['attrTotalPrice']) * $v['goods_number'];
                $orderGoodsData = [
                    'order_id'          => $order_id,
                    'goods_id'          => $v['goods_id'],
                    'goods_attr_ids'    => $v['goods_attr_ids'],
                    'goods_number'      => $v['goods_number'],
                    'goods_price'       => $goods_price
                ];

                $order_goods_result = Db::name('order_goods')->insert($orderGoodsData);

                //同时要减去商品的对应的库存数量，防止超卖
                $where = [
                    'goods_id'      => $v['goods_id'],
                    'goods_number'  => ['>=',$v['goods_number']]//商品的数量要大于购买的数量
                ];

                //执行商品表的更新操作
                $goods_result = Db::name('goods')->where($where)->setDec('goods_number',$v['goods_number']);
                if( !$order_goods_result || !$goods_result ){
                    throw new Exception('订单商品表入库失败或库存不够');
                }
            }

            //3-清空购物车
            $cartModel->clearCart();
            //提交事务
            Db::commit();

        }catch(\Exception $e){
            //上面的执行过程中，如有错误，则操作回滚
            Db::rollback();
            //获取异常信息
            $this->error($e->getMessage());
        }

        //上面都没有问题,唤起支付宝
//        echo '支付宝支付中……';
        $this->_payMoney($order_id,$total_price);


    }

    //唤起支付宝付款
    private function _payMoney($out_trade_no,$total_amount,$subject='支付标题/名称',$body='支付商品描述'){
        $url = url('/home/order/payMoney');
        echo <<<eof
            <form action="$url" method='post' id='payForm'>
            <input type='hidden' name='WIDout_trade_no' value="$out_trade_no">
            <input type='hidden' name='WIDtotal_amount' value="$total_amount">
            <input type='hidden' name='WIDsubject' value="$subject">
            <input type='hidden' name='WIDbody' value="$body">
            </form>
            <script>
                document.getElementById('payForm').submit();
            </script>
eof;
    }

    public function payMoney(){
        //直接包含支付宝支付的文件pagepay/pagepay.php
        include "../extend/alipay/pagepay/pagepay.php";
    }

    //支付成功之后跳转回来的页面   同步
    public function return_url(){
        require_once("../extend/alipay/config.php");
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';

        $arr=input('get.');
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = htmlspecialchars($arr['out_trade_no']);
            //支付宝交易号
            $trade_no = htmlspecialchars($arr['trade_no']);
            $data = [
                'pay_status'    => 1,
                'ali_order_id'  => $trade_no
            ];

            //更新付款状态
            $orderModel = new Order;
            $orderModel->where('order_id','=',$out_trade_no)->update($data);
            return $this->fetch('');


//            echo "验证成功<br />支付宝交易号：".$trade_no;
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }

    //支付成功之后跳转回来的页面   异步
    public function notify_url(){
        echo '这里是异步notify_url';
    }

    //个人订单列表
    public function selfOrder(){
        if(!session('member_id')) {
            $this->error('请先登录');
        }

        $orderModel = new Order;
        $member_id = session('member_id');
        $orderData = $orderModel->where('member_id','=',$member_id)->select();

        return $this->fetch('',[
            'orderData' => $orderData
        ]);
    }

    //支付未付款订单
    public function selfPay(){
        if(!session('member_id')) {
            $this->error('请先登录');
        }

        $id = input('id');
        $order = Order::find($id);
        $this->_payMoney($order['order_id'],$order['total_price']);
    }
}