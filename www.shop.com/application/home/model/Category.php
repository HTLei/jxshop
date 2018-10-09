<?php
namespace app\home\model;
use think\Model;
class Category extends Model{

    //获得顶级分类数据
    public function getNavCat($limit){
        $navCats = $this->where('pid','=',0)
                    ->limit($limit)
                    ->select();
        return  $navCats;
    }

    //面包屑导航
    public function getParentCat($allCats,$cat_id){
        static $result = [];
        foreach($allCats as $k => $cat){
            if($cat['cat_id'] == $cat_id){
                $result[] = $cat;
                unset($cat[$k]);
                $this->getParentCat($allCats,$cat['pid']);
            }
        }
        return array_reverse($result);
    }

    //寻找子孙分类
    public function getSonsCats($oldCats,$cat_id){
        static $result = [];
        foreach($oldCats as $k => $cat){
            if($cat['pid'] == $cat_id){
                $result[] = $cat['cat_id'];
                unset($cat[$k]);
                $this->getSonscats($oldCats,$cat['cat_id']);
            }
        }
        return $result;
    }

}