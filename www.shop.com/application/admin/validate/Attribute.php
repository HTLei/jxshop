<?php
namespace app\admin\validate;
use think\Validate;
class Attribute extends Validate{

    //定义规则
    protected $rule = [
        'attr_name'     => 'require|unique:attribute',
        'type_id'       => 'require',
        'attr_values'   => 'require'
    ];
    //定义提示信息
    protected $message = [
        'attr_name.require'     => '属性名称不能为空',
        'attr_name.unique'      => '属性名称已存在',
        'type_id.require'       => '请选择商品类型',
        'attr_values.require'   => '列表选择时属性值不能为空'
    ];
    //定义验证场景
    protected $scene = [
        'add'               => ['attr_name','type_id','attr_values'],
        'exceptAttrValues'  => ['attr_name','type_id']
    ];
}