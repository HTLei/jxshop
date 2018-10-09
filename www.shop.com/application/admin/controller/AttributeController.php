<?php
namespace app\admin\controller;
use app\admin\model\Type;
use app\admin\model\Attribute;
class AttributeController extends CommonController{

    //属性添加
    public function add(){
        if(request()->isPost()){
            $postData = input('post.');
            if( $postData['attr_input_type'] == 1 ){
                $result = $this->validate($postData,'Attribute.add',[],true);
            }else{
                $result = $this->validate($postData,'Attribute.exceptAttrValues',[],true);
            }
            if($result !== true){
                $this->error( implode(',',$result) );
            }
            $attrModel = new Attribute;
            if( $attrModel->save($postData) ){
                $this->success('添加成功',url('/admin/attribute/index'));
            }else{
                $this->error('添加失败');
            }
        }

        $typeModel = new Type;
        $types = $typeModel->select();
        return $this->fetch('',[
            'types' => $types
        ]);
    }

    //属性列表
    public function index(){
        $attrs = Attribute::alias('t1')
                ->field('t1.*,t2.type_name')
                ->join('sh_type t2','t1.type_id = t2.type_id','left')
                ->select();
        return $this->fetch('',[
            'attrs' => $attrs
        ]);
    }

    //属性编辑
    public function upd(){
        if(request()->isPost()){
            $postData = input('post.');

            if( $postData['attr_input_type'] == 0 ){
                $result = $this->validate($postData,'Attribute.exceptAttrValues',[],true);
            }else{
                $result = $this->validate($postData,'Attribute.upd',[],true);
            }
            if($result !== true){
                $this->error(implode(',',$result));
            }
            if( Attribute::update($postData) ){
                $this->success('编辑成功',url('/admin/attribute/index'));
            }else{
                $this->error('编辑失败');
            }
        }

        $attr_id = input('attr_id');
        $attr = Attribute::find($attr_id);
        $types = Type::select();
        return $this->fetch('',[
            'attr'      => $attr,
            'types'     => $types
        ]);
    }

    //属性删除
    public function del(){
        $attr_id = input('attr_id');
        if( Attribute::destroy($attr_id) ){
            $this->success('删除成功',url('/admin/attribute/index'));
        }else{
            $this->error('删除失败');
        }
    }
}