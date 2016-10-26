<?php

require_once 'vendor/autoload.php';

use niklaslu\Mail;

$mailConfig = [
    'debug' => false,
    'host' => 'smtp.yeah.net',
    'username' => 'smallgroup@yeah.net',
    'password' => 'lc19890512',
    'port' => 465,
    'from' =>[
            'address' => 'smallgroup@yeah.net',
            'name' => 'niklaslu'
        ],
//     'from' => 'smallgroup@yeah.net',

];

$mail = new Mail($mailConfig);

// 添加回复人
// $mail->addReplyTo('423418902@qq.com' , 'lucong');
// 添加抄送
$CC = [
    ['423418902@qq.com' , 'lucong'],
    ['1594208938@qq.com' , 'lccc']
];
// $mail->addCC($CC);
// 添加密送
// $BCC = $CC;
// $mail->addBCC($BCC);


$to = '332553882@qq.com';
$subject = '测试标题';
$body = "<p>测试内容</p>";

// 添加附件
// $attachments = [
//     ['a.txt' , 'a'],
//     ['b.txt' , 'b']
// ];
// $mail->addAttachments($attachments);

$res = $mail->sent($to, $subject, $body);


if (!$res){
    print_r($mail->getError());
}else{
    echo '成功';
}
