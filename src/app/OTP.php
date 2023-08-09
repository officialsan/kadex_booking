<?php
namespace Kadex\app;
class OTP
{
   
    public string $phone_number;
    public string  $otp ;
    private $validityTime = 300; // Validity time in seconds (5 minutes)
    private  $createTime;
    
    public function __construct(){
        if(isset( $_SESSION['otp'] ) && ( time() - $_SESSION['otp']['createTime']) > $this->validityTime ){
            unset($_SESSION['otp']);
        }
        $otp = $_SESSION['otp'] ?? $this->generateOTP();
        $this->otp = $otp['otp'];
        $this->createTime = $otp['createTime'];
        $_SESSION['otp'] = $otp;
    }
    private function generateOTP()
    {
    //    return  ['otp' => base64_encode(mt_rand(100000, 999999)) , 'createTime' => time()];
       return  ['otp' => base64_encode('123456') , 'createTime' => time()];
    }

    public function sendOTP()
    {
        return $this->otp;
    } 
    public function checkOTP($otp)
    {    
        $check =  (time() - $this->createTime <= $this->validityTime && base64_encode($otp) == $this->otp);
        if($check == true || time() - $this->createTime > $this->validityTime ) unset($_SESSION['otp']);
        return $check;
    }

}