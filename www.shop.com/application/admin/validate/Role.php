<?php
namespace app\admin\validate;
use think\Validate;
class Role extends Validate{
    //1-定义规则
    protected $rule = [
        'role_name' => 'require|unique:role'
    ];
    //2-定义提示信息
    protected $message =[
        'role_name.require' => '角色名称不能为欸空',
        'role_name.unique'  => '角色名称已存在'
    ];
    //3-定义验证场景
    protected $scene = [
        'add'   => 'role_name',
        'upd'   => 'role_name'
    ];
}