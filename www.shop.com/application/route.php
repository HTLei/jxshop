<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//网站默认首页
Route::get('/','home/index/index');


Route::any('index/index/index','index/index/index');

//后台相关路由
Route::group('admin',function(){

    Route::any('/index/index','admin/index/index');
    Route::any('/index/top','admin/index/top');
    Route::any('/index/left','admin/index/left');
    Route::any('/index/main','admin/index/main');

    Route::any('/user/index','admin/user/index');
    Route::any('/user/add','admin/user/add');
    Route::any('/user/del','admin/user/del');
    Route::any('/user/upd','admin/user/upd');

    Route::any('/public/login','admin/public/login');
    Route::any('/public/logout','admin/public/logout');

    Route::any('/auth/add','admin/auth/add');
    Route::any('/auth/index','admin/auth/index');
    Route::any('/auth/upd','admin/auth/upd');
    Route::any('/auth/del','admin/auth/del');

    Route::any('/role/add','admin/role/add');
    Route::any('/role/index','admin/role/index');
    Route::any('/role/upd','admin/role/upd');
    Route::any('/role/del','admin/role/del');

    Route::any('/type/add','admin/type/add');
    Route::any('/type/index','admin/type/index');
    Route::any('/type/upd','admin/type/upd');
    Route::any('/type/del','admin/type/del');
    Route::any('/type/getAttr','admin/type/getAttr');

    Route::any('/attribute/add','admin/attribute/add');
    Route::any('/attribute/index','admin/attribute/index');
    Route::any('/attribute/upd','admin/attribute/upd');
    Route::any('/attribute/del','admin/attribute/del');

    Route::any('/category/add','admin/category/add');
    Route::any('/category/index','admin/category/index');
    Route::any('/category/upd','admin/category/upd');
    Route::any('/category/del','admin/category/del');

    Route::any('/goods/add','admin/goods/add');
    Route::any('/goods/getAttrs','admin/goods/getAttrs');
    Route::any('/goods/index','admin/goods/index');

    Route::any('/order/index','admin/order/index');
    Route::any('/order/setLogistics','admin/order/setLogistics');
    Route::any('/order/getLogistics','admin/order/getLogistics');

});

//前台相关路由
Route::group('home',function(){

    //前台首页
    Route::any('/index/index','home/index/index');

    //注册
    Route::any('/public/register','home/public/register');
    //登录
    Route::any('/public/login','home/public/login');
    //退出
    Route::any('/public/logout','home/public/logout');
    //注册时发送短信
    Route::any('/public/sendSms','home/public/sendSms');
    //忘记密码
    Route::any('/public/forgetPassword','home/public/forgetPassword');
    //发送邮件
    Route::any('/public/sendEmail','home/public/sendEmail');
    //修改密码
    Route::any('/public/change/:member_id/:hash/:time','home/public/change');

    //
    Route::any('/category/index','home/category/index');

    Route::any('/goods/detail','home/goods/detail');

    Route::any('cart/addGoodsToCart','home/cart/addGoodsToCart');
    Route::any('cart/cartList','home/cart/cartList');
    Route::any('cart/delCartGoods','home/cart/delCartGoods');
    Route::any('cart/clearCartGoods','home/cart/clearCartGoods');
    Route::any('cart/changeCartGoodsNum','home/cart/changeCartGoodsNum');

    Route::any('order/orderInfo','home/order/orderInfo');
    Route::any('order/writeOrderInfo','home/order/writeOrderInfo');

    Route::any('order/payMoney','home/order/payMoney');

    Route::any('order/return_url','home/order/return_url');//同步
    Route::any('order/notify_url','home/order/notify_url');//异步

    Route::any('order/selfOrder','home/order/selfOrder');
    Route::any('order/selfPay','home/order/selfPay');

});
