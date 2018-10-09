<?php
namespace app\home\validate;
use think\Validate;
class Order extends Validate{

    protected $rule = [
        'receiver'  => 'require',
        'address'  => 'require',
        'phone'     => 'require|regex:1\d{10}',
        'zcode'     => 'require'
    ];

    protected $message = [
        'receiver.require'  => '收货人不能为空',
        'address.require'  => '收货地址不能为空',
        'phone.require'     => '手机号码不能为空',
        'phone.regex'       => '手机号码格式不正确',
        'zcode.require'     => '邮编不能为空',
    ];

    protected $scene = [
        'writeOrderInfo'    => ['receiver','address','phone','zcode']
    ];
}