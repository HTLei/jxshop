<?php
namespace app\admin\controller;
//use think\Controller;//引入核心控制器
use app\admin\model\Category;
use app\admin\model\Goods;
use app\admin\model\Type;
use app\admin\model\Attribute;
class GoodsController extends CommonController{
    
    //商品添加
    public function add(){

        if( request()->isPost() ){

            $postData = input('post.');

            $result = $this->validate($postData,'Goods.add',[],true);
            if($result !== true){
                $this->error(implode(',',$result));
            }
            $goodsModel = new Goods;
            //接收上传文件
            $goods_img = $goodsModel->uploadImg();///[]
            //判断图片是否上传成功
            if($goods_img){
                $postData['goods_img'] = json_encode($goods_img);
                $thumb = $goodsModel->getThumb($goods_img);
                //存入数据对应的字段中
                $postData['goods_middle'] = json_encode( $thumb['goods_middle'] );
                $postData['goods_thumb'] = json_encode( $thumb['goods_thumb'] );
            }
            //数据入库
            if( $goodsModel->allowField(true)->save($postData) ){
                $this->success('添加成功',url('/admin/goods/index'));
            }else{
                $this->error('添加失败');
            }
        }

        $cateModel = new Category;
        $oldCates = $cateModel->select();
        $cates = $cateModel->getSonsCate($oldCates);
        $types = Type::select();
        return $this->fetch('',[
            'cates' => $cates,
            'types' => $types
        ]);
    }

    //获取对应商品类型的属性
    public function getAttrs(){
        //判断是不是ajax请求
        if(request()->isAjax()){
            $type_id = input('type_id');
            $attrs = Attribute::where('type_id','=',$type_id)->order('attr_type asc')->select();
            echo json_encode($attrs);
        }
    }

    //商品列表
    public function index(){
        $goods = Goods::alias('t1')
                ->field('t1.*,t2.cat_name')
                ->join('sh_category t2','t1.cat_id = t2.cat_id','left')
                ->select();
        return $this->fetch('',[
            'goods' => $goods
        ]);
    }
}