<?php
namespace app\admin\validate;
use think\Validate;
class Auth extends Validate{
    //1-定义规则
    protected $rule = [
        'auth_name' => 'require|unique:auth',
        'pid'       => 'require',
        'auth_c'    => 'require',
        'auth_a'    => 'require'
    ];
    //2-定义提示信息
    protected $message = [
        'auth_name.require' => '权限名称不能为空',
        'auth_name.unique'  => '权限名称已存在',
        'pid.require'       => '请选择父级权限',
        'auth_c.require'    => '控制器名不能为空',
        'auth_a.require'    => '方法名不能为空'
    ];
    //3-定义验证器场景
    protected $scene = [
        'add'       => ['auth_name','pid','auth_c','auth_a'],
        'upd'       => ['auth_name','pid','auth_c','auth_a'],
        'exceptCA'  => ['auth_name','pid']
    ];
}