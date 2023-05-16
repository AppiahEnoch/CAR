<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$smtpHost = 'smtp.gmail.com';
$ports = [587, 465];

foreach ($ports as $smtpPort) {
    $socket = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, 5);

    if ($socket) {
        echo "Connection successful! Port: $smtpPort";
        fclose($socket);
        break;
    } else {
        echo "Connection failed on port $smtpPort:\n";
        var_dump($errstr, $errno);
    }
}
?>
