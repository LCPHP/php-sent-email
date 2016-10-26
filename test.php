<?php

require_once 'vendor/autoload.php';

use niklaslu\Mail;

$mailConfig = [
    'host' => '',
    'username' => '',
    'password' => '',
    'post' => '',
    //     'from' =>[
        //         'address' => '',
        //         'name' => ''
        //     ],
    'from' => '',

];

$mail = new Mail($mailConfig);

$to = '332553882@qq.com';
$subject = '测试';
$body = '<h3>测试内容</h3>';
$res = $mail->sent($to, $subject, $body);

if (!$res){
    print_r($mail->getError());
}else{
    echo '成功';
}