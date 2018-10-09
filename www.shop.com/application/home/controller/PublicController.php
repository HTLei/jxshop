<?php
namespace app\home\controller;
use think\Controller;//引入核心控制器
use app\home\model\Member;
class PublicController extends Controller{

    //注册功能
    public function register(){
        if(request()->isPost()){
            $postData = input('post.');
            //验证短信验证码是否匹配
            $smsCode = md5($postData['phoneCaptcha'] . config('sms_salt'));
            //表单接收的短信验证码加密结果和cookie中保存的短信验证码不一致
            if(cookie('smsCode') !== $smsCode){
                $this->error('手机短信验证码错误');
            }
            $result = $this->validate($postData,'Member.register',[],true);
            if($result !== true) {
                $this->error(implode(',', $result));
            }
            $memModel = new Member;
            if($memModel->allowField(true)->save($postData)){
                //注册成功以后，为防止短信验证码被他人利用，应当清楚掉
                cookie('smsCode',null);
                $this->success('恭喜,注册成功,正在跳转登录页',url('/home/public/login'));
            }else{
                $this->error('注册失败，请稍后重试');
            }
        }
        return $this->fetch('');
    }

    //登录功能
    public function login(){

        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Member.login',[],true);
            if( $result !== true ){
                $this->error( implode(',',$result) );
            }
            $memModel = new Member;

            $status = $memModel->checkUser($postData['username'],$postData['password']);

            if($status){
                $goods_id = input('goods_id');
                if($goods_id){
                    $this->redirect('/home/goods/detail',['goods_id'=>$goods_id]);
                }

                $this->redirect('/home/index/index');
            }else{
                $this->error('用户名或密码错误');
            }

        }

        return $this->fetch('');
    }
    
    //退出功能
    public function logout(){
        session('member_id',null);
        session('member_username',null);
        $this->redirect('/home/public/login');
    }

    //发送手机短信验证码
    public function sendSms(){
        if(request()->isAjax()){
            $phone = input('phone');
            $member = Member::where('phone','=',$phone)->find();
            //说明手机已经被注册过了
            if($member){
                $response = ['code'=>-1,'msg'=>'该手机号已注册'];
                echo json_encode($response);die;
            }
            //没有注册过，则给此号码发送短信
            //生成四位数验证码
            $rand = mt_rand(1000,9999);
            $datas = [$rand,5];
            //发送短信给手机号
            $result = sendSms($phone,$datas);
            if($result->statusCode == '000000'){
                //把验证码和盐加密的结果写入cookie中，有限期5分钟
                cookie('smsCode',md5($rand . config('sms_salt')),300);
                $response = ['code'=>200,'msg'=>'发送成功，请及时查收'];
            }else{
                $response = ['code'=>-2,'msg'=>$result->statusMsg . ',请稍后重试'];
            }
            echo json_encode($response);die;
        }
    }

    //忘记密码
    public function forgetPassword(){
        return $this->fetch('');
    }

    //发送邮件
    public function sendEmail(){
        //判断是否为ajax请求
        if(request()->isAjax()){
            $email = input('email');
            //判断邮箱是否注册过

            $member = Member::where('email','=',$email)->find();

            //邮箱没有注册过，返回提示信息
            if(!$member){
                $response = ['code'=>-1,'msg'=>'该邮箱不存在'];
                echo json_encode($response);die;
            }
            //邮箱存在，发邮件
            $time = time();//用于判断有效期
            $member_id = $member['member_id'];
            $hash = md5( $member_id . config('email_salt') . $time );//用于判断用户是否篡改了地址栏
            $receivers = [$email];

            $title = '京西商城系统-找回密码';
            $href = request()->domain() . "/index.php/home/public/change/{$member_id}/{$hash}/{$time}";
            $content = "<a href='{$href}'>点击重新设置密码</a>";

            //发送邮件
            if(sendEmail($receivers,$title,$content)){
                $response = ['code'=>200,'msg'=>'发送成功，请及时查收'];
                echo json_encode($response);die;
            }else{
                $response = ['code'=>-2,'msg'=>'发送失败，请稍后重试'];
                echo json_encode($response);die;
            }
        }
    }

    //修改密码
    public function change($member_id,$hash,$time){
        //展示修改页面之前先判断地址是否被篡改或者在有效期内
        $nowHash = md5( $member_id . config('email_salt') . $time);
        //二者不等，说明地址被篡改
        if($nowHash != $hash){
            exit('兄dei，地址栏不要乱碰哦');
        }
        //有效期为5分钟
        if( time() > $time + 300 ){
            exit('兄dei，来晚了，它已经不行了');
        }

        //判断是否为post提交
        if(request()->isPost()){
            $postData = input('post.');
            $result = $this->validate($postData,'Member.change',[],true);
            if($result !== true){
                $this->error( implode(',',$result) );
            }

            //update(array1,array2,array3|true):array1是更新的数据，array2是更新条件，主键id，array3是要更新的字段，true是表示只更新数据表字段
            $flag = Member::update($postData,['member_id'=>$member_id],true);
            if(Member::update($postData,['member_id'=>$member_id],true)){
                $this->success('密码重置成功',url('/home/public/login'));
            }else{
                $this->error('密码重置失败,请稍后重试');
            }

        }



        return $this->fetch('');
    }
}