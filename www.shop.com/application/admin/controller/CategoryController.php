<?php
namespace app\admin\controller;
use app\admin\model\Category;
class CategoryController extends CommonController{

    //商品分类添加
    public function add(){
        $cateModel = new Category;
        if( request()->isPost() ){
            $postData = input('post.');
            $result = $this->validate($postData,'Category.add',[],true);
            if($result !== true){
                $this->error( implode(',',$result) );
            }

            if( $cateModel->save($postData) ){
                $this->success('添加成功',url('/admin/category/index'));
            }else{
                $this->error('添加失败');
            }
        }
        $oldCates = $cateModel->select();
        $cates = $cateModel->getSonsCate($oldCates);
        return $this->fetch('',[
            'cates' => $cates
        ]);
    }

    //商品分类列表
    public function index(){
        $cateModel = new Category;
        $oldCates = $cateModel->select()->toArray();
        $cates = $cateModel->getSonsCate($oldCates);
        return $this->fetch('',[
            'cates' => $cates
        ]);
    }

    //商品分类编辑
    public function upd(){
        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Category.upd',[],true);
            if($result !== true){
                $this->error( implode(',',$result) );
            }
            if(Category::update($postData)){
                $this->success('编辑成功',url('/admin/category/index'));
            }else{
                $this->error('编辑失败');
            }
        }

        $cat_id  = input('cat_id');
        $cateModel = new Category();
        $category = $cateModel->find($cat_id);
        $oldCates = $cateModel->select();
        $cates = $cateModel->getSonsCate($oldCates);
        return $this->fetch('',[
            'category'  => $category,
            'cates'     => $cates
        ]);
    }

    //商品分类删除
    public function del(){
        $cat_id = input('cat_id');
        $cate = Category::where('pid','=',$cat_id)->find();
        if($cate){
            $this->error('该分类下有子分类，无法删除');
        }
        /*
         * $goods = Goods::where('cat_id','=',$cat_id)->find();
        if($goods){
            $this->error('该分类下有商品，无法删除');
        }*/
        if(Category::destroy($cat_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}
