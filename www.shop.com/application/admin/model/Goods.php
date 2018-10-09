<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Goods extends Model{

    protected $pk = 'goods_id';
    protected $autoWriteTimestamp = true;

    public static function init(){
        //数据入库前事件
        Goods::event('before_insert',function($goods){

            $goods['goods_sn'] = uniqid();
        });

        //数据库后事件
        Goods::event('after_insert',function($goods){
            //获取商品主键
            $goods_id = $goods['goods_id'];
            $postData = input('post.');
            $goodsAttrValue = $postData['goodsAttrValue'];
            $goodsAttrPrice = $postData['goodsAttrPrice'];
            foreach($goodsAttrValue as $attr_id => $attr_values){
                if( is_array($attr_values) ){
                    foreach($attr_values as $k => $attr_value){
                        $goods_attr = [
                            'goods_id'      => $goods_id,
                            'attr_id'       => $attr_id,
                            'attr_value'    => $attr_value,
                            'attr_price'    => $goodsAttrPrice[$attr_id][$k],
                            'create_time'   => time(),
                            'update_time'   => time()
                        ];
                        Db::name('goods_attr')->insert($goods_attr);
                    }
                }else{
                    $goods_attr = [
                        'goods_id'      => $goods_id,
                        'attr_id'       => $attr_id,
                        'attr_value'    => $attr_values,
                        'create_time'   => time(),
                        'update_time'   => time()
                    ];
                    Db::name('goods_attr')->insert($goods_attr);
                }
            }
        });

    }

    //图片上传
    public function uploadImg(){
        //用于存储图片的路径信息
        $goods_img = [];
        //接收上传文件数据
        $files = request()->file('goods_img');//[fileObj,fileObj,...]
        //验证上传文件
        $validate = [
            'size' => 1024*1024*3,//最大3M
            'ext' => 'jpg,jpeg,png,gif'//文件后缀类型
        ];
        //判断是否有文件上传
        if($files){
            $uploads_dir = './uploads/';//定义上传目录
            foreach($files as $file){
                $info = $file->validate($validate)->move($uploads_dir);
                //如果上传成功
                if($info){
                    $goods_img[] = str_replace('\\','/',$info->getSaveName());
                }
            }
        }
        return $goods_img;
    }

    //生成缩略图
    public function getThumb($imgesArr){
        $goods_middle = [];//保存中图路径
        $goods_thumb = [];//保存缩略图路径
        foreach($imgesArr as $img){

            $arr = explode('/',$img);
            //打开要处理的图片
            $image = \think\Image::open('./uploads/'.$img);


            $middlePath = $arr[0] . '/thumb_200_' . $arr[1];
            $thumbPath = $arr[0] . '/thumb_50_' . $arr[1];
            //进行缩放处理并保存
            $image->thumb(350,350,2)->save('./uploads/' . $middlePath);
            $image->thumb(50,50,2)->save('./uploads/' . $thumbPath);

            $goods_middle[] = $middlePath;//存入数组中
            $goods_thumb[] = $thumbPath;
        }
        return ['goods_middle' => $goods_middle,'goods_thumb' => $goods_thumb];//
    }
}