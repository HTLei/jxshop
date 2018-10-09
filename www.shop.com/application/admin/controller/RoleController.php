<?php
namespace app\admin\controller;
use app\admin\model\Auth;
use app\admin\model\Role;
use think\Db;
class RoleController extends CommonController{

    //角色添加
    public function add(){

        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Role.add',[],true);
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            $roleModel = new Role;
            if( $roleModel->allowField(true)->save($postData) ){
                $this->success('添加成功',url('/admin/role/index'));
            }else{
                $this->error('添加失败');
            }
        }

        $oldAuths = Auth::select()->toArray();
        //技巧1：以二维数组中的每个元素的主键字段值作为其相应下标。
        $auths = [];
        foreach($oldAuths as $v){
            $auths[$v['auth_id']] = $v;
        }
        //技巧2：以指向父字段值（如pid字段）进行分组，即把具有相同的pid值分为同一组。
        $children = [];
        foreach($oldAuths as $v){
            $children[$v['pid']][] = $v['auth_id'];
        }

        return $this->fetch('',[
            'auths'     => $auths,
            'children'  => $children
        ]);
    }

    //角色列表
    public function index(){
        $sql = 'select t1.*,group_concat(t2.auth_name) as allAuth from sh_role as t1 left join sh_auth as t2 on find_in_set(t2.auth_id,t1.auth_ids_list) GROUP BY t1.role_id';
        $roles = Db::query($sql);
        return $this->fetch('',[
            'roles' => $roles
        ]);
    }

    //角色编辑
    public function upd(){
        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Role.upd',[],true);
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            if( Role::update($postData) ){
                $this->success('编辑成功',url('/admin/role/index'));
            }else{
                $this->error('编辑失败');
            }
        }
        $role_id = input('role_id');
        $role = Role::find($role_id);

        $oldAuth = Auth::select();
        //1-用每个元素的主键id当作每个元素的下标
        $auths = [];
        foreach($oldAuth as $val){
            $auths[$val['auth_id']] = $val;
        }
        //2-用pid进行分组，保存元素的主键id值
        $children = [];
        foreach($oldAuth as $val){
            $children[$val['pid']][] = $val['auth_id'];
        }
        return $this->fetch('',[
            'role'      => $role,
            'auths'     => $auths,
            'children'  => $children
        ]);
    }

    //角色删除
    public function del(){
        $role_id = input('role_id');
        if( Role::destroy($role_id) ){
            $this->success('删除成功',url('/admin/role/index'));
        }else{
            $this->error('删除失败');
        }
    }
}