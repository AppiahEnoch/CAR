<?php  
require 'vendor/autoload.php';
require_once "../ENV/env.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




$receiver=$_POST['receiver'];
$cusname = $_POST['cusname'];
$cusloc = $_POST['cusloc'];
$cusmobile = $_POST['cusmobile'];
$cusDesc = $_POST['cusDesc'];
$cusservice = $_POST['cusservice'];

$sender=$email_sender;
$password=$email_password;

$subject='SERVICE REQUEST';
$htmlFile='homeEmail.html';

$host="smtp.gmail.com";
$port="587";


sendEmail();
function sendEmail() {
  $currentYear = date('Y');
  global $sender,$receiver,$password,$port,
  $host,$subject,$htmlFile,$cusname,$cusloc,$cusmobile,$cusDesc,$cusservice;
  $mail = new PHPMailer;
  $html = file_get_contents($htmlFile);

  // modify file
  $html = str_replace('{{cusname}}', $cusname, $html);
  $html = str_replace('{{cusloc}}', $cusloc, $html);
  $html = str_replace('{{cusmobile}}', $cusmobile, $html);
  $html = str_replace('{{cusDesc}}', $cusDesc, $html);
  $html = str_replace('{{cusservice}}', $cusservice, $html);
  $html = str_replace('{{curyear}}',$currentYear , $html);
  
  // extract current year




  $mail->isSMTP();
  $mail->Host = $host;
  $mail->SMTPAuth="true";
  $mail->SMTPSecure="tls";
  $mail->Port = $port;

  echo $port." |".$password." |".$sender." |".$receiver;


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



