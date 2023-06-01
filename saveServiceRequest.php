<?php
require_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include "config.php";


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








$cusname = $_POST['username'];
$cusmobile = $_POST['user_mobile'];
$cusloc = $_POST['location'];
$cusDesc = $_POST['description'];
$cusservice = $_POST['verhicle'];

$sender = $email_sender;
$password = $email_password;

$subject = "Service Request";

$host = "smtp.gmail.com";
$port = "587";

function sendEmail($settings) {
    $mail = new PHPMailer;

    if (!file_exists($settings['htmlFile'])) {
        die($settings['htmlFile'] . " does not exist");
    } else {
        $html = file_get_contents($settings['htmlFile']);
    }

    $requestDate = date('l, jS F, Y');
    $currentYear = date('Y');
    $html = str_replace('{{manager_name}}', $settings['receiverName'], $html);
    $html = str_replace('{{username}}', $settings['cusname'], $html);
    $html = str_replace('{{user_mobile}}', $settings['cusmobile'], $html);
    $html = str_replace('{{location}}', $settings['cusloc'], $html);
    $html = str_replace('{{description}}', $settings['cusDesc'], $html);
    $html = str_replace('{{verhicle}}', $settings['cusservice'], $html);
    $html = str_replace('{{requestDate}}',   $requestDate, $html);
    $html = str_replace('{{curyear}}',$currentYear, $html);



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

function sendEmailsToUsers($conn, $settings) {
    $sql = "
        (SELECT username, email FROM sysadmin)
        UNION
        (SELECT username, email FROM user1)
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $settings['receiver'] = $row['email'];
            $settings['receiverName'] = $row['username'];

            sendEmail($settings);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
}

$settings = [
    'sender' => $sender,
    'password' => $password,
    'receiverName' => '', // will be replaced for each email sent
    'subject' => $subject,
    'host' => $host,
    'port' => $port,
    'htmlFile' => "SEM.html",
    'cusname' => $cusname,
    'cusmobile' => $cusmobile,
    'cusloc' => $cusloc,
    'cusDesc' => $cusDesc,
    'cusservice' => $cusservice
];

sendEmailsToUsers($conn, $settings);
?>
