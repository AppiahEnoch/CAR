<?php
require_once "config.php";



$code=createRandomPassword();

$stmt = $conn->prepare("INSERT INTO registrationcode (code) VALUES (?)");
$stmt->bind_param("s", $code);
 $stmt->execute();

$stmt->close();
$conn->close();

echo $code;
    
// coment

function createRandomPassword() { 
    $chars = "abcdefghijkmnpqrstuvwxyz23456789"; 
    $otp = "";
    for ($i = 0; $i < 20; $i++) {
        $otp .= $chars[mt_rand(0, strlen($chars) - 1)];
    }


    return $otp;


  } 