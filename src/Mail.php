<?php
namespace niklaslu;
class Mail {
    
    protected $config = [];
    
    protected $mail ; 
    
    protected $error = '';
    
    public function __construct($config){
        
        $mail = new \PHPMailer();
        
        $mail->isSMTP();
        
        if ($config['debug']){
            $mail->SMTPDebug = 3;
        }
        
        $mail->Host = $config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = isset($config['secure']) ? $config['secure'] : 'ssl';
        $mail->Port = $config['port'];
        
        // 发信人
        $from = $config['from'];
        if (is_array($from)){
            $address = $from['address'];
            $fromName = $from['name'];
        }else{
            $address = $from;
            $fromName = '';
        }
        $mail->setFrom($address , $fromName);
        
        $this->config = $config;
        $this->mail = $mail;
        
    }
    
    public function sent($to , $subject , $body , $replyTo = NULL , $attachments = null ){
        
        if (is_array($to)){
            foreach ($to as $t){
                $this->mail->addAddress($t);
            }
        }else{
            $this->mail->addAddress($to);
        }
        
        if ($replyTo){
            $this->mail->addReplyTo($replyTo);
        }
        

        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
//         $this->mail->AltBody = $altBody;
        
        if (!$this->mail->send()){
            $this->error = $this->mail->ErrorInfo;
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * 添加附件
     */
    public function addAttachments($attachments){
        
        if ($attachments){
            foreach ($attachments as $a){
                if (is_array($a)){
                    $this->mail->addAttachment($a[0] , $a[1]);
                }else{
                    $this->mail->addAttachment($a);
                }
        
            }
        }
        
        return true;
    }
    
    public function addReplyTo($address , $name = ''){
        
        $this->mail->addReplyTo($address , $name);
        
        return true;
    }
    /**
     * 添加抄送
     */
    public function addCC($arr){
        
        foreach ($arr as $a){
            if (is_array($a)){
                $this->mail->addCC($a[0] , $a[1]);
            }else{
                $this->mail->addCC($a);
            }
        }
        return true;
    }
    
    /**
     * 添加密送
     */
    public function addBCC($arr){
        foreach ($arr as $a){
            if (is_array($a)){
                $this->mail->addBCC($a[0] , $a[1]);
            }else{
                $this->mail->addBCC($a);
            }
        }
        return true;
    }
    
    public function getConfig(){
        
        return $this->config;
    }
    
    public function getError(){
        
        return $this->error;
    }
}