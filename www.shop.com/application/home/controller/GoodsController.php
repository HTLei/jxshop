<?php
namespace app\home\controller;
use think\Controller;//引入核心控制器
use app\home\model\Goods;
use app\home\model\Category;
use think\Db;
class GoodsController extends Controller{

    //商品详情
    public function detail(){

        $goods_id = input('goods_id');

        $goods = Goods::find($goods_id)->toArray();
        $goods['goods_img'] = json_decode($goods['goods_img']);
        $goods['goods_middle'] = json_decode($goods['goods_middle']);
        $goods['goods_thumb'] = json_decode($goods['goods_thumb']);

        //面包屑
        $cat_id = Goods::where('goods_id','=',$goods_id)->value('cat_id');
        $catModel = new Category;
        $allCats = $catModel->select()->toArray();
        $cats = $catModel->getParentCat($allCats,$cat_id);

        //取出该商品拥有的单选属性
        $goods_attrs = Db::name('goods_attr')
                       ->alias('t1')
                       ->field('t1.*,t2.attr_name')
                       ->join('sh_attribute t2','t1.attr_id = t2.attr_id','left')
                       ->where([
                          'goods_id'  => $goods_id,
                          'attr_type' => 1
                       ])
                       ->select();
        $single_attrs = [];
        foreach($goods_attrs as $v){
            $single_attrs[$v['attr_id']][] = $v;
        }

        //取出该商品拥有的唯一属性
        $unique_attrs = Db::name('goods_attr')
                        ->alias('t1')
                        ->field('t1.*,t2.attr_name')
                        ->join('sh_attribute t2','t1.attr_id = t2.attr_id','left')
                        ->where([
                            'goods_id'  => $goods_id,
                            'attr_type' => 0
                        ])
                        ->select();

        //最近浏览过的商品
        $goodsModel = new Goods;
        $goodsHistory = $goodsModel->addGoodsToHistory($goods_id);
        $strHistory = implode(',',$goodsHistory);
        $where = [
            'is_delete' => 0,
            'is_sale'   => 1,
            'goods_id'  => ['in',$goodsHistory]
        ];
        $historyGoods = $goodsModel->where($where)
                        ->order('field(goods_id,' . $strHistory . ')')
                        ->select()
                        ->toArray();

        return $this->fetch('',[
            'goods'             => $goods,
            'cats'              => $cats,
            'single_attrs'      => $single_attrs,
            'unique_attrs'      => $unique_attrs,
            'historyGoods'      => $historyGoods
        ]);
    }

}