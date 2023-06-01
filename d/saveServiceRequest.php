<?php
require_once '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include "../../config/config.php";


/*
      username: username,
      user_mobile: user_mobile,
      location: location_code,
      description: description,
*/


if (!isset($_POST['username'])) {
    exit();
}
else {
    $cusname = $_POST['username'];
    $cusmobile = $_POST['user_mobile'];
    $cusloc = $_POST['location'];
    $cusDesc = $_POST['description'];
    $cusservice = $_POST['verhicle'];

}

try {
    $stmt = $conn->prepare("INSERT INTO cusrequest (cusname, cusmobile, cusloc, cusDesc, cusservice) VALUES (?, ?, ?, ?, ?)"); 
    $stmt->bind_param("sssss", $cusname, $cusmobile, $cusloc, $cusDesc, $cusservice);
    $stmt->execute();
    $stmt->close();    
}
catch(Exception $e){
    // Handle the exception
}


 echo 1;
exit;






$cusname = $_POST['username'];
$cusmobile = $_POST['user_mobile'];
$cusloc = $_POST['location'];
$cusDesc = $_POST['description'];
$cusservice = $_POST['verhicle'];

$sender = $email_sender;
$password = $email_password;
$receiverName = $email1;

$subject = "Email Verification Code";
$receiver = $email1;

$host = "smtp.gmail.com";
$port = "587";

function sendCode($settings, $code) {
    $mail = new PHPMailer;

    if (!file_exists($settings['htmlFile'])) {
        die($settings['htmlFile'] . " does not exist");
    } else {
        $html = file_get_contents($settings['htmlFile']);
    }

    $html = str_replace('{{name}}', $settings['receiverName'], $html);
    $html = str_replace('{{code}}', $code, $html);
    $html = str_replace('{{username}}', $settings['cusname'], $html);
    $html = str_replace('{{user_mobile}}', $settings['cusmobile'], $html);
    $html = str_replace('{{location}}', $settings['cusloc'], $html);
    $html = str_replace('{{description}}', $settings['cusDesc'], $html);
    $html = str_replace('{{verhicle}}', $settings['cusservice'], $html);

    $mail->isSMTP();
    $mail->Host = $settings['host'];
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = $settings['port'];

    $mail->Username = $settings['sender'];
    $mail->Password = $settings['password'];
    $mail->addAddress($settings['receiver']);
    $mail->Subject = $settings['subject'];
    $mail->msgHTML($html);

    if (!$mail->send()) {
        echo "Error: " . $mail->ErrorInfo;
        exit();
    } else {
        echo 1;
        exit;
    }
}

$settings = [
    'sender' => $sender,
    'password' => $password,
    'receiverName' => $receiverName,
    'subject' => $subject,
    'receiver' => $receiver,
    'host' => $host,
    'port' => $port,
    'htmlFile' => "OTP2.html",
    'cusname' => $cusname,
    'cusmobile' => $cusmobile,
    'cusloc' => $cusloc,
    'cusDesc' => $cusDesc,
    'cusservice' => $cusservice
];

// generate or get your code here

sendCode($settings, $code);
