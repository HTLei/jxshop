<?php
namespace app\home\model;
use think\Model;
class Member extends Model{

    protected $pk = 'member_id';
    protected $autoWriteTimestamp = true;

    public static function init(){

        //用户注册数据入库前事件
        Member::event('before_insert',function($member){
            //密码加密
            $member['password'] = md5( $member['password'] . config('password_salt'));
        });

        //修改密码数据更新前事件
        Member::event('before_update',function($member){
            $member['password'] = md5( $member['password'] . config('password_salt'));
        });
    }

    public function checkUser($username,$password){
        $where = [
            'username'  => $username,
            'password'  => md5($password . config('password_salt'))
        ];
        $userInfo = $this->where($where)->find();
        //用户存在
        if($userInfo){
            session('member_id',$userInfo['member_id']);
            session('member_username',$userInfo['username']);
            return true;
        }else{
            //用户不存在
            return false;
        }
    }

}