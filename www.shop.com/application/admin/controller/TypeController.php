<?php
namespace app\admin\controller;
use app\admin\model\Type;
use app\admin\model\Attribute;
class TypeController extends CommonController{
    //商品类型添加
    public function add(){
        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Type.add',[],true);
            if($result !== true){
                $this->error( implode(',',$result) );
            }
            $typeModel = new Type;
            if( $typeModel->save($postData) ){
                $this->success('添加成功',url('/admin/type/index'));
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }

    //商品类型列表
    public function index(){
        $types = Type::select();
        return $this->fetch('',[
            'types' => $types
        ]);
    }

    //商品类型编辑
    public function upd(){
        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Type.upd',[],true);
            if($result !== true){
                $this->error( implode(',',$result) );
            }
            if(Type::update($postData)){
                $this->success('编辑成功',url('/admin/type/index'));
            }else{

                $this->error('编辑失败');
            }
        }

        $type_id = input('type_id');
        $type = Type::find($type_id);
        return $this->fetch('',[
            'type' => $type
        ]);
    }

    //商品类型删除
    public function del(){
        $type_id = input('type_id');
        if(Type::destroy($type_id)){
            $this->success('删除成功',url('/admin/type/index'));
        }else{
            $this->error('删除失败');
        }
    }

    //查看商品类型属性
    public function getAttr(){
        $type_id = input('type_id');
        $attrs = Attribute::alias('t1')
                ->where('t1.type_id','=',$type_id)
                ->field('t1.*,t2.type_name')
                ->join('sh_type t2','t1.type_id = t2.type_id','left')
                ->select()
                ->toArray();
        return $this->fetch('',[
            'attrs' => $attrs
        ]);
    }

}