<?php
namespace app\admin\model;
use think\Model;
class Category extends Model{

    protected $pk = 'cat_id';
    protected $autoWriteTimestamp =true;

    //获取无限极分类数据
    public function getSonsCate($cates,$pid=0,$level=0){
        static $result = [];
        foreach($cates as $k => $cate){
            if( $cate['pid'] == $pid ){
                $cate['level'] = $level;
                $result[$cate['cat_id']] = $cate;
                unset($cate[$k]);
                $this->getSonsCate($cates,$cate['cat_id'],$level + 1);
            }
        }
        return $result;
    }
}