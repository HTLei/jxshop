<?php
namespace app\home\model;
use think\Model;
class Goods extends Model{

    //推荐位类型商品
    public function getTypeGoods($type,$limit){
        $where = [
            'is_sale'   => 1,
            'is_delete' => 0
        ];
        if($type == 'is_crazy'){ // 疯狂抢购
            //按商品价格升序
            return $this->where($where)->order('goods_price asc')->limit($limit)->select();
        }else{ //新品 精品 热卖
            $where[$type] = 1;
            return $this->where($where)->limit($limit)->select();
        }
    }

    //记录最近浏览过的商品id
    public function addGoodsToHistory($goods_id){
        $goodsHistory = cookie('goodsHistory') ? cookie('goodsHistory') : [];
        if($goodsHistory){
            //往数组的开头添加元素
            array_unshift($goodsHistory,$goods_id);
            //移除数组重复的元素
            $goodsHistory = array_unique($goodsHistory);
            //限制数量为5个，删除尾部的元素
            if(count($goodsHistory) > 5){
                array_pop($goodsHistory);
            }
        }else{
            //无浏览历史
            $goodsHistory[] = $goods_id;
        }
        cookie('goodsHistory',$goodsHistory,86400*7);
        return $goodsHistory;
    }



}