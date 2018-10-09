<?php
namespace app\admin\controller;
use app\admin\model\User;
use app\admin\model\Role;
class UserController extends CommonController{

    //用户列表
    public function index(){
        $users = User::alias('t1')
                ->field('t1.*,t2.role_name')
                ->join('sh_role t2','t1.role_id = t2.role_id','left')
                ->order('user_id desc')->paginate(6);
        return $this->fetch('',[
            'users' => $users
        ]);
    }

    //用户添加
    public function add(){
        // 1-判断是否是post请求
        if(request()->isPost()){
            //2-接收参数数据
            $postData = input('post.');
            //3-验证器验证
            $result = $this->validate($postData,'User.add',[],true);
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            //4-数据入库
            $userModel = new User;
            if( $userModel->allowField(true)->save($postData) ){
                $this->success('添加成功',url('/admin/user/index'));
            }else{
                echo 22;
                $this->error('添加失败');
            }
        }

        $roles = Role::select();
        return $this->fetch('',[
            'roles' => $roles
        ]);
    }

    //用户删除
    public function del(){
        $user_id = input('user_id');
        if( User::destroy($user_id) ){
            $this->success('删除成功',url('/admin/user/index'));
        }else{
            $this->error('删除失败');
        }
    }

    //用户编辑
    public function upd(){
        //1-判断是否为post请求
        if( request()->isPost() ){
            //2-接收表单数据
            $postData = input('post.');
            //3-验证器验证
            if( $postData['password'] != '' || $postData['repassword'] != ''){
                $result = $this->validate($postData,'User.upd',[],true);
                if( $result !== true ){
                    $this->error( implode(',',$result) );
                }
            }
            //4-数据入库
            $userModel = new User;
            $flag = $userModel->allowField(true)->isUpdate()->save($postData);
            if($flag){
                $this->success('修改成功',url('/admin/user/index'));
            }else{
                $this->error('修改失败');
            }
        }
        $user_id = input('user_id');
        $user = User::find($user_id);

        $roles = Role::select();

        return $this->fetch('',[
            'user'  => $user,
            'roles' => $roles
        ]);
    }



}