<?php
namespace app\admin\model;
use think\Model;
//use app\admin\model\Role;
//use app\admin\model\Auth;
class User extends Model{
    protected $pk = 'user_id';
    protected $autoWriteTimestamp = true;

    protected static function init(){

        //入库前的事件 before_insert
        User::event('before_insert',function($user){
            //$user是即将要写入数据库的数据，在写入数据库之前可以对数据进行改动
            $user['password'] = md5($user['password'] . config('password_salt'));
        });

        //数据更新前的事件 before_update
        User::event('before_update',function($user){
            //如果密码框都为空，则默认不修改密码
            if($user['password'] == ''){
                //密码不更新
                unset($user['password']);
            }else{
                //正常更新
                $user['password'] = md5($user['password'] . config('password_salt'));
            }
        });


    }


    public function checkUser($username,$password){
        $where = [
            'username' => $username,
            'password' => md5( $password . config('password_salt') )
        ];
        $userInfo = $this->where($where)->find();
        if($userInfo){
            //保存登录成功后用户的信息
            session('user_id',$userInfo['user_id']);
            session('username',$userInfo['username']);
            $this->_initAuth($userInfo['role_id']);
            return true;
        }else{
            return false;
        }
    }

    private function _initAuth($role_id){

        $auth_ids_list = Role::where('role_id','=',$role_id)->value('auth_ids_list');
        //如果是超级管理员
        if( $auth_ids_list == '*' ){
            $allAuths = Auth::select()->toArray();
        }else{//不是超级管理员
            //取出用户拥有的权限
            $allAuths = Auth::where('auth_id','in',$auth_ids_list)->select()->toArray();
        }
        //技巧一：用每个元素的主键当作下标
        $auths = [];
        foreach($allAuths as $v){
            $auths[$v['auth_id']] = $v;
        }
        //技巧二：根据pid进行分组，保存值为对应的主键值
        $children = [];
        foreach($allAuths as $v){
            $children[$v['pid']][] = $v['auth_id'];
        }
        //把权限写到session中
        session('auths',$auths);
        session('children',$children);

        //把角色可以访问的权限写入到session中
        //如果超级管理员
        if( $auth_ids_list == '*' ){
            session('visitor','*');
        }else{//非超级管理员
            $visitor = [];
            foreach($allAuths as $v){

                $visitor[] = strtolower($v['auth_c'] . '/' . $v['auth_a']);
            }
            session('visitor',$visitor);
        }
    }

}