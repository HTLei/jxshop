<?php
namespace app\home\controller;
use think\Controller;//引入核心控制器
use app\home\model\Category;
use app\home\model\Goods;
class IndexController extends Controller{

    public function index(){

//        sendEmail(['785826799@qq.com'],'京西商城系统','想找回密码吗？你的密码被我丢在那条伟大航路上了！去吧！');die;


        $catModel = new Category;
        /******************* 导航栏 ************************/
        $navCats = $catModel->getNavCat(5);

        $allCats = $catModel->select();

        /******************* 分类筛选（全部分类） ************************/
        //奇淫技巧一：以每个元素的下标作为主键
        $cats = [];
        foreach($allCats as $cat){
            $cats[$cat['cat_id']] = $cat;
        }
        //齐淫技巧二：以元素的父分类进行分组，保存主键
        $children = [];
        foreach($allCats as $cat){
            $children[$cat['pid']][] = $cat['cat_id'];
        }

        /******************* 推荐位商品 ************************/
        $goodsModel = new Goods;
        $crazyGoods = $goodsModel->getTypeGoods('is_crazy',5);
        $hotGoods = $goodsModel->getTypeGoods('is_hot',5);
        $bestGoods = $goodsModel->getTypeGoods('is_best',5);
        $newGoods = $goodsModel->getTypeGoods('is_new',5);


        return $this->fetch('',[
            'navCats'       => $navCats,
            'cats'          => $cats,
            'children'      => $children,
            'crazyGoods'    => $crazyGoods,
            'hotGoods'    => $hotGoods,
            'bestGoods'    => $bestGoods,
            'newGoods'    => $newGoods,
        ]);
    }
}