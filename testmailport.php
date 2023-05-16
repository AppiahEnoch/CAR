<?php
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587;

$socket = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, 5);

if ($socket) {
    echo 'Connection successful!';
    fclose($socket);
} else {
    echo "Connection failed: $errstr ($errno)";
}
?>
