<?php  
require 'vendor/autoload.php';
require_once "../ENV/env.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



$receiver=$_POST['receiver'];
$code=$_POST['code'];


$sender=$email_sender;
$password=$email_password;


$subject='EMAIL VERIFICATION CODE';
$htmlFile='indexOTP.html';



$host="smtp.gmail.com";
$port="587";


sendEmail();

function sendEmail() {
  
  global $sender,$receiver,$password,$port,
  $host,$subject,$htmlFile,$code;
  $mail = new PHPMailer;
  $html = file_get_contents($htmlFile);


  $currentYear = date('Y');
  // modify file
  $html = str_replace('{{code}}', $code, $html);
  $html = str_replace('{{curyear}}',   $currentYear, $html);



  $mail->isSMTP();
  $mail->Host = $host;
  $mail->SMTPAuth="true";
  $mail->SMTPSecure="tls";
  $mail->Port = $port;

  //echo $port." |".$password." |".$sender." |".$receiver;


  $mail-> Username=$sender;
  $mail->Password = $password;
  $mail->setFrom($sender);
  $mail->addAddress($receiver);
  $mail->Subject = $subject;










  $mail->msgHTML($html);


  
  if (!$mail->send()) {
  
      echo "Error: " . $mail->ErrorInfo;
     exit;
  } else {
   echo 1;
   exit;
  }
}


?>



