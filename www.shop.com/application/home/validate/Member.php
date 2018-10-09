<?php
namespace app\home\validate;
use think\Validate;
class Member extends Validate{

    protected $rule = [
        'username'      => 'require|unique:member',
        'email'         => 'require|email|unique:member',
        'password'      => 'require',
        'repassword'    => 'require|confirm:password',
        'phone'         => 'require|regex:1[3-8]\d{9}',
        'captcha'       => 'require|captcha:1',
        'login_captcha' => 'require|captcha:2'
    ];

    protected $message = [
        'username.require'          => '用户名不能为空',
        'username.unique'           => '用户名已存在',
        'email.require'             => '邮箱不能为空',
        'email.email'               => '邮箱格式不正确',
        'email.unique'              => '邮箱已注册',
        'password.require'          => '密码不能为空',
        'repassword.require'        => '确认密码不能为空',
        'repassword.confirm'        => '两次密码不一致',
        'phone.require'             => '手机号码不能为空',
        'phone.regex'               => '手机号码格式有误',
        'captcha.require'           => '验证码不能为空',
        'captcha.captcha'           => '验证码错误',
        'login_captcha.require'     => '验证码不能为空',
        'login_captcha.captcha'     => '验证码错误'
    ];

    protected $scene = [
        'register'  => ['username','email','password','repassword','phone','captcha'],
        'login'     => ['username' => 'require','password','login_captcha'],
        'change'    => ['password','repassword']
    ];
}