<?php
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587;
$smtpPort = 465;

$socket = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, 5);

if ($socket) {
    echo 'Connection successful!';
    fclose($socket);
} else {
    echo $smtpPort."Connection failed: $errstr ($errno)";
}
?>
