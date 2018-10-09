<?php
namespace app\admin\model;
use think\Model;
class Auth extends Model{
    protected $pk = 'auth_id';
    protected $autoWriteTimestamp = true;

    //权限无限级递归
    public function getSonsAuth($datas,$pid=0,$level=0){
        static $result = array();
        foreach($datas as $key => $data){
            if( $data['pid']  == $pid){
                $data['level'] = $level;
                $result[] = $data;
                unset($data[$key]);
                $this->getSonsAuth($datas,$data['auth_id'],$level + 1);
            }
        }
        return $result;
    }

    //模型事件
    public static function init(){
        //数据更新前事件
        Auth::event('before_update',function($auth){
            //如果为顶级权限，则没有控制器名和方法名
            if($auth['pid'] == 0){
                $auth['auth_c'] = '';
                $auth['auth_a'] = '';
            }
        });
    }

}