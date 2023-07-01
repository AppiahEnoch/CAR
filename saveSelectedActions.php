<?php
include "config.php";
require __DIR__ . '/vendor/autoload.php';
$receiptid=null;
if (!isset($_SESSION)) {
    session_start();
// check if not isset  $_SESSION["receipt"]

  }


  if(!isset($_SESSION["receipt"])){

    $_SESSION["receipt"]=generateUniqueID();
    $receiptid=$_SESSION["receipt"];
  
  }


  $receiptid=$_SESSION["receipt"];

$washer = mysqli_real_escape_string($conn, $_POST['washer']);
$carname = mysqli_real_escape_string($conn, $_POST['carname']);
$carNumber = mysqli_real_escape_string($conn, $_POST['carNumber']);
$action = mysqli_real_escape_string($conn, $_POST['action']);
$amount = floatval($_POST['amount']);
$washeramount = floatval($_POST['washeramount']);









$location = $_SESSION["LOC"];
$locationUser=  $_SESSION["username"];
$userMobile= $_SESSION["mobile"];

$sql = "INSERT INTO washed (washer, carname, carNumber, action, amount, washeramount, locationUser, location, receiptid) 
VALUES ('$washer', '$carname', '$carNumber', '$action', $amount, $washeramount, '$locationUser', '$location', '$receiptid')";

if ($conn->query($sql) === TRUE) {

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}




$sql = "INSERT INTO tempwashed (washer, carname, carNumber, action, amount, washeramount, locationUser, location, receiptid) 
VALUES ('$washer', '$carname', '$carNumber', '$action', $amount, $washeramount, '$locationUser', '$location', '$receiptid')";

if ($conn->query($sql) === TRUE) {
echo 1;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}








function generateUniqueID() {
    $seed = md5(uniqid(mt_rand(), true));
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}[]<>?';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 11; $i++) {
        $charIndex = hexdec(substr($seed, $i, 1)) % $charactersLength;
        $randomString .= $characters[$charIndex];
    }
    return $randomString;
  }
  
