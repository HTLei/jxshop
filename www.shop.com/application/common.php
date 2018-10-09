<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//解决两种报错
//1-解决下标不存在的报错
//2-解决变量不存在的报错
error_reporting(0);

/**
 * 发送短信验证码
 * @param $to   array：手机号码的集合 或是 string：单个手机号码
 *  （【手机号码集合,用英文逗号分开】）
 * @param $datas    array('6666','5') 6666为发送的验证码，‘5’是在几分钟内有效
 *  （【内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null】）
 * @param string $tempId    短信的模板ID
 *  （【模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID】）
 */
function sendSms($to,$datas,$tempId = '1'){

    include_once("../extend/sendSMS/CCPRestSmsSDK.php");

//主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8aaf07086541761801655d29d05811fd';

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= '0fcd51c46ff0405097ecd27ed696ea77';

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8aaf07086541761801655d29d0c31204';

//请求地址
//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
//生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='app.cloopen.com';


//请求端口，生产环境和沙盒环境一致
    $serverPort='8883';

//REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';

    $rest = new REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);

    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
    return $result;

    //失败返回内容
    /*object(SimpleXMLElement)#10 (2) {
        ["statusCode"] => string(6) "172001"
        ["statusMsg"] => string(12) "网络错误"
    }*/

    //成功返回内容
    /*object(SimpleXMLElement)#10 (2) {
        ["statusCode"] => string(6) "000000"
        ["TemplateSMS"] => object(SimpleXMLElement)#3 (2) {
            ["smsMessageSid"] => string(32) "5b4446f6e63c4389882a935be3851c17"
            ["dateCreated"] => string(14) "20180825222735"
        }
    }*/
}



/**     发送邮件
 * @param $receivers    array,收件人邮箱地址
 * @param $title        string,邮件标题
 * @param $content      string,邮件中的内容
 * @return bool         邮件发送的返回结果
 */
function sendEmail($receivers,$title,$content){

    // 实例化
    include "../extend/sendEmail/class.phpmailer.php";
    $pm = new PHPMailer();
    // 服务器相关信息
    $pm->Host = 'smtp.163.com'; // SMTP服务器
    $pm->IsSMTP(); // 设置使用SMTP服务器发送邮件
    $pm->SMTPAuth = true; // 需要SMTP身份认证
    $pm->Username = '15013337551'; // 登录SMTP服务器的用户名，邮箱@前面一串字符
    $pm->Password = 'tianlei1203'; //授权码 登录SMTP服务器的密码

    // 发件人信息
    $pm->From = '15013337551@163.com'; //自己的邮箱
    $pm->FromName = '京西商城系统管理员'; // 发件人昵称，名字可以随便取

    // 收件人信息
    foreach($receivers as $receiver){
        $pm->AddAddress($receiver, ''); // 设置收件人邮箱和昵称，昵称名字随便取
    }

    $pm->CharSet = 'utf-8'; // 内容编码
    $pm->Subject = $title; // 邮件标题
    $pm->MsgHTML($content); // 邮件内容

    //发送邮件，并返回结果
    return $pm->Send();


    //var_dump($pm->Send()); //成功返回true
    // 发送邮件
//    if($pm->Send()){
//        echo 'ok';
//    }else {
//        echo $pm->ErrorInfo;
//    }
}