<?php
namespace app\admin\validate;
use think\Validate;
class User extends Validate{
    //定义规则
    protected $rule = [
        'username'      => 'require|unique:user|min:4',
        'password'      => 'require',
        'repassword'    => 'require|confirm:password', // confirm规则：判断两个元素的值是否相等
        'captcha'       => 'require|captcha'
    ];

    //定义对应的提示信息
    protected $message = [
        'username.require'      => '用户名不能为空',
        'username.unique'       => '用户名已存在',
        'username.min'          => '用户名最少4位',
        'password.require'      => '密码不能为空',
        'repassword.require'    => '确认密码不能为空',
        'repassword.confirm'    => '两次密码不一致',
        'captcha.require'       => '验证码不能为空',
        'captcha.captcha'       => '验证码错误'
    ];

    //定义验证场景
    protected $scene = [
        'add'   => ['username','password','repassword'],
        'upd'   => ['username','password','repassword'],
        'login'   => ['username'=>'require','password','captcha']
    ];

}