<?php
namespace app\home\controller;
use think\Controller;//引入核心控制器
use app\home\model\Category;
use app\home\model\Goods;
class CategoryController extends Controller{

    //分类首页
    public function index(){

        //面包屑导航
        $cat_id = input('cat_id');
        $catModel = new Category;
        $allCats = $catModel->select()->toArray();
        $cats = $catModel->getParentCat($allCats,$cat_id);

        //分类列表左侧分类菜单
        $categorys = [];
        foreach($allCats as $cat){
            $categorys[$cat['cat_id']] = $cat;
        }
        $children = [];
        foreach($allCats as $cat){
            $children[$cat['pid']][] = $cat['cat_id'];
        }

        //根据点击的分类取出相对应的商品
        $result = $catModel->getSonsCats($allCats,$cat_id);
        $result[] = $cat_id;
        $where = [
            'is_sale'   => 1,
            'is_delete' => 0,
            'cat_id'    => ['in',$result]
        ];
        $goods = Goods::where($where)->select()->toArray();

        return $this->fetch('',[
            'cats'      => $cats,
            'categorys' => $categorys,
            'children'  => $children,
            'goods'     => $goods
        ]);
    }
}