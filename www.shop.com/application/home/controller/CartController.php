<?php
namespace app\home\controller;
use think\Controller;//引入核心控制器
class CartController extends Controller{

    //ajax添加商品到购物车
    public function addGoodsToCart(){


        if(request()->isAjax()){
            //判断是否登录
            if(!session('member_id')){
                $response = ['code'=>-1,'msg'=>'请先登录'];
                echo json_encode($response);die;
            }

            //接收参数
            $goods_id = input('goods_id');
            $goods_number = input('goods_number');
            $goods_attr_ids = input('goods_attr_ids');

            //调用购物车类中的addCart方法，加入购物车
            $cartModel = new \cart\Cart();
            $result = $cartModel->addCart($goods_id,$goods_attr_ids,$goods_number);

            if($result){ //数据入库成功，添加商品信息到购物车类中
                $response = ['code'=>200,'msg'=>'加入购物车成功'];
                echo json_encode($response);die;
            }else{  //数据入库失败，则不添加到购物车类中
                $response = ['code'=>-2,'msg'=>'加入购物车失败，请重试'];
                echo json_encode($response);die;
            }
        }
    }
    
    //购物车列表
    public function cartList(){
        //判断是否登录
        if(!session('member_id')){
            $this->error('请先登录');
        }
        $cartModel = new \cart\Cart;
        $cartData = $cartModel->getCart();
        return $this->fetch('',[
            'cartData'  => $cartData
        ]);
    }

    //删除购物车的某种商品
    public function delCartGoods(){
        if(request()->isAjax()){
            //判断是否登录
            if(!session('member_id')){
                $response = ['code'=>-1,'msg'=>'请先登录'];
                echo json_encode($response);die;
            }
            $goods_id = input('goods_id');
            $goods_attr_ids = input('goods_attr_ids');

            $cartModel = new \cart\Cart;
            $result = $cartModel->delCart($goods_id,$goods_attr_ids);
            if($result){
                $response = ['code'=>200,'msg'=>'移除成功'];
            }else{
                $response = ['code'=>-2,'msg'=>'移除失败，请重试'];
            }
            echo json_encode($response);die;

        }
    }

    //清空购物车
    public function clearCartGoods(){
        //判断是否登录（安全起见）
        if(!session('member_id')){
            $response = ['code'=>-1,'msg'=>'请先登录'];
            echo json_encode($response);die;
        }

        $cartModel = new \cart\Cart;
        $result = $cartModel->clearCart();
        if($result){
            $response = ['code'=>200,'msg'=>'清空购物车成功'];
        }else{
            $response = ['code'=>-2,'msg'=>'清空购物车失败，请重试'];
        }
        echo json_encode($response);die;
    }

    //+-更改购物车商品数量
    public function changeCartGoodsNum(){
        if(request()->isAjax()){

            if(!session('member_id')){
                $response = ['code'=>-1,'msg'=>'请先登录'];
                echo json_encode($response);die;
            }

            $goods_id       = input('goods_id');
            $goods_attr_ids = input('goods_attr_ids');
            $goods_number   = input('goods_number');
            $cartModel = new \cart\Cart;
            $result = $cartModel->changeCartNum($goods_id,$goods_attr_ids,$goods_number);
            if($result){
                $response = ['code'=>200,'msg'=>'修改成功'];
            }else{
                $response = ['code'=>-2,'msg'=>'修改失败'];
            }
            echo json_encode($response);die;
        }
    }
}