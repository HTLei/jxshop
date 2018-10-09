<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{

    //1-定义规则
    protected $rule = [
        'cat_name'  => 'require|unique:category',
        'pid'       => 'require'
    ];
    //2-定义提示信息
    protected $message = [
        'cat_name.require'  => '分类名称不能为空',
        'cat_name.unique'   => '分类名称已存在',
        'pid.require'       => '请选择父分类'
    ];
    //3-定义验证场景
    protected $scene = [
        'add'   => ['cat_name','pid'],
        'upd'   => ['cat_name','pid']
    ];
}