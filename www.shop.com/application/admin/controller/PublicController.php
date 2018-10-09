<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
class PublicController extends Controller{

    //用户登录
    public function login(){
        //1-判断是否为post请求
        if( request()->isPost() ){
            //2-接收表单数据
            $postData = input('post.');
            //3-验证器验证
            $result = $this->validate($postData,'User.login',[],true);
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            //4-判断数据是否正确
            $userModel = new User;
            $status = $userModel->checkUser($postData['username'],$postData['password']);
            if($status){
                $this->redirect('/admin/index/index');
            }else{
                $this->error('用户名或密码错误');
            }
        }

        return $this->fetch();
    }

    //用户退出
    public function logout(){
        session('user_id',null);
        session('username',null);
        $this->redirect('/admin/public/login');
    }
}