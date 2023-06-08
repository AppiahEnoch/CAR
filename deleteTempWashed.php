<?php 
include "config.php";
$sql  =  "DELETE FROM tempwashed";
$stmt = $conn->prepare($sql);
$stmt->execute();