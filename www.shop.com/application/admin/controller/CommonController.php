<?php
namespace app\admin\controller;
use think\Controller;
class CommonController extends Controller{

    public function _initialize(){
        if( !session('user_id') ){
            $this->redirect('/admin/public/login');
        }else{
            //已经登录，但有可能翻墙
            //防止翻墙的思想：获取当前用户所访问的控制器名和方法名
            $now_c = request()->controller();
            $now_a = request()->action();
            $now_ca = strtolower($now_c . '/' . $now_a);

            //取出当前用户的访问权限
            $visitor = session('visitor');

            //面包屑
            $auth_id = input('auth_id');
            $auths = session('auths');
            $break = $this->_break($auths,$auth_id);
            session('break',$break);
            //面包屑



            //超级管理员放行，index控制器也放行
            if($visitor == '*' || strtolower($now_c) == 'index'){
                return;
            }

            //非超级管理员和index控制器
            if( !in_array($now_ca,$visitor) ){
//                $this->error('您没有该操作权限');
                $this->redirect('/admin/index/index');
            }

        }
    }

    //面包屑
    private function _break($auths,$auth_id){
        static $break = [];
        foreach($auths as $k => $auth){
            if($auth['auth_id'] == $auth_id){
                $break[] = $auth;
                unset($auth[$k]);
                $this->_break($auths,$auth['pid']);
            }
        }
        return array_reverse($break);
    }
}