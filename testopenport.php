<?php
function isPortOpen($host, $port) {
    $timeout = 5; // Timeout value for the connection attempt

    $socket = @fsockopen($host, $port, $errno, $errstr, $timeout);

    if ($socket) {
        fclose($socket);
        return true; // Port is open
    } else {
        return false; // Port is closed or unreachable
    }
}

// Usage example
$host = 'smtp.gmail.com';
$port = 587;

if (isPortOpen($host, $port)) {
    echo "Port $port is open";
} else {
    echo "Port $port is closed or unreachable";
}
?>
