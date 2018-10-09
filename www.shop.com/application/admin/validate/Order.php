<?php
namespace app\admin\validate;
use think\Validate;
class Order extends Validate{

    protected $rule = [
        'company'   => 'require',
        'number'    => 'require'
    ];

    protected $message = [
        'company.require'   => '请选择物流公司',
        'number.require'    => '运单号不能为空'
    ];

    protected $scene = [
        'setLogistics'  => ['company','number']
    ];
}