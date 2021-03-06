<?php
namespace app\admin\validate;
use think\Validate;
class Goods extends Validate{

    protected $rule = [
        'goods_name'    => 'require|unique:goods',
        'cat_id'        => 'require',
        'goods_price'   => 'require|gt:0',
        'goods_number'  => 'require|regex:\d+'
    ];

    protected $message = [
        'goods_name.require'    => '商品名称不能为空',
        'goods_name.unique'     => '商品名称已存在',
        'cat_id.require'        => '请选择分类',
        'goods_price.require'   => '商品价格不能为空',
        'goods_price.gt'        => '商品价格必须大于零',
        'goods_number.require'  => '商品库存不能为空',
        'goods_number.regex'    => '商品库存不能小于零'
    ];

    protected $scene = [
        'add' => ['goods_name','cat_id','goods_price','goods_number']
    ];
}