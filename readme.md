### php-sent-email  

php利用smtp发送邮件

Composer安装  

`composer require niklaslu/php-sent-email`

发邮件类使用 [PHPMailer](https://github.com/PHPMailer/PHPMailer) ,自己只是简单封装了下

#### 示例代码

```php
<?php

require_once 'vendor/autoload.php';

use niklaslu\Mail;

$mailConfig = [
    'debug' => false, // 是否开启debug,调试模式下可开启
    'host' => 'smtp.??????.???', // 邮件发送smtp服务器host
    'username' => 'xxxxxxxx@xxx.com', // 用户名
    'password' => '**********', // 密码
    'port' => 465, // 端口号
    // 发送人
    'from' =>[
            'address' => 'from@email.com',
            'name' => 'from_name'
        ],
//     'from' => 'from@email.com',

];

$mail = new Mail($mailConfig);

// 添加回复人
// $mail->addReplyTo('replyTo@email.com' , 'reply_name');
// 添加抄送,多人
$CC = [
    ['cc1@email.com' , 'cc1'],
    ['cc2@email.com' , 'cc2']
];
// $mail->addCC($CC);
// 添加密送
// $BCC = $CC;
// $mail->addBCC($BCC);


$to = '332553882@qq.com'; // 发送人
$subject = '测试标题'; // 邮件标题
$body = "<p>测试内容</p>"; // 邮件内容支持html

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
```
