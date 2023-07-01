<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION["receipt"]);

include "config.php";
$sql  =  "DELETE FROM tempwashed";
$stmt = $conn->prepare($sql);
$stmt->execute();