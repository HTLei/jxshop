<?php
namespace app\admin\controller;
use app\admin\model\Auth;
class AuthController extends CommonController{

    //权限添加
    public function add(){
        //1-判断是否是post请求
        if( request()->isPost() ){
            //2-接收表单数据
            $postData = input('post.');
            //3-验证器验证
            if( $postData['pid'] == 0 ){
                $result = $this->validate($postData,'Auth.exceptCA',[],true);
            }else{
                $result = $this->validate($postData,'Auth.add',[],true);
            }
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            //4-数据入库
            $authModel = new Auth;
            if( $authModel->save($postData) ){
                $this->success('添加成功',url('/admin/auth/index'));
            }else{
                $this->error('添加失败');
            }
        }

        $authModel = new Auth;
        $oldAuth = $authModel->select();
        $auths = $authModel->getSonsAuth($oldAuth);
        return $this->fetch('',[
            'auths' => $auths
        ]);
    }

    //权限添加
    public function index(){

        dump(session('auths'));
        dump(session('children'));


        $authModel = new Auth;
        $oldAuths = $authModel->alias('t1')
                    ->field('t1.*,t2.auth_name p_name')
                    ->join('sh_auth t2','t1.pid = t2.auth_id','left')
                    ->select();
        $auths = $authModel->getSonsAuth($oldAuths);
        return $this->fetch('',[
            'auths' => $auths
        ]);
    }

    //权限编辑
    public function upd(){
        //1-判断是否是post请求
        if( request()->isPost() ){
            //2-接收表单数据
            $postData = input('post.');
            //3-验证器验证
            if($postData['pid'] == 0){
                $result = $this->validate($postData,'Auth.exceptCA',[],true);
            }else{
                $result = $this->validate($postData,'Auth.upd',[],true);
            }
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            //4-数据入库
            if( Auth::update($postData) ){
                $this->success('编辑成功',url('/admin/auth/index'));
            }else{
                $this->error('编辑失败');
            }
        }
        $auth_id = input('auth_id');
        $authModel = new Auth;
        $authority = $authModel->find($auth_id);
        $oldAuths = $authModel->select();
        $auths = $authModel->getSonsAuth($oldAuths);
        return $this->fetch('',[
            'authority'     => $authority,
            'auths'     => $auths
        ]);
    }

    //权限删除
    public function del(){
        $auth_id = input('auth_id');
        $authInfo = Auth::where('pid','=',$auth_id)->find();
        if($authInfo){
            $this->error('该权限下有子权限，无法删除');
        }
        if(Auth::destroy($auth_id)){
            $this->success('删除成功',url('/admin/auth/index'));
        }else{
            $this->error('删除失败');
        }
    }

}