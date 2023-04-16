<?php
include "config.php";
// Select all unique manager from the "washed" table
$sql  =  "DELETE FROM user1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sql  =  "DELETE FROM registrationcode";
$stmt = $conn->prepare($sql);
$stmt->execute();



$sql  =  "DELETE FROM washed";
$stmt = $conn->prepare($sql);
$stmt->execute();

echo 1;
