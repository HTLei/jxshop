<?php
namespace app\admin\controller;
//use think\Controller;//引入核心控制器
use think\Db;
use think\Validate;
class OrderController extends CommonController{

    public function index(){
        $orderData = Db::name('order')->select();
        return $this->fetch('',[
            'orderData' => $orderData
        ]);
    }
    //分配物流
    public function setLogistics(){

        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Order.setLogistics',[],true);
            if($result !== true){
                $this->error(implode(',',$result));
            }
            //更改物流状态
            $postData['send_status'] = 1;

            if( Db::name('order')->update($postData) ){
                $this->success('分配物流成功',url('/admin/order/index'));
            }else{
                $this->error('分配物流失败');
            }
        }

        $id = input('id');
        $order = Db::name('order')->find($id);
        return $this->fetch('',[
            'order'  => $order
        ]);
    }

    //查看物流
    public function getLogistics(){
        if(request()->isAjax()){
            //http://www.kuaidi100.com/applyurl?key={$key}&com={$com}&nu={$nu}&show=0
            $key = config('kuaidi100_key');
            $company = input('company');
            $number = input('number');
            $url = "http:://www.kuaidi100.com/applyurl?key={$key}&com={$company}&nu={$number}&show=0";

            echo file_get_contents("http://www.kuaidi100.com/applyurl?key=9d37bc6b0a41e6fe&com=yunda&nu=3900321280110&show=0");die;
        }
    }
}