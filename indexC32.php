<?php



$otp=createRandomPassword();

$_SESSION["emailverificationCode"]=$otp;



echo $otp;










function createRandomPassword() { 
    $chars = "23456789"; 
    $otp = "";
    for ($i = 0; $i < 4; $i++) {
        $otp .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $otp;
  
  } 