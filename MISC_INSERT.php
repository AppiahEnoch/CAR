<?php
session_start();
require_once './vendor/autoload.php';
include "config.php";

$id="";
// write a fuction to return a unique id

function generateCode() {
  $seed = md5(uniqid(mt_rand(), true));
  $characters = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < 30; $i++) {
      $charIndex = hexdec(substr($seed, $i, 1)) % $charactersLength;
      $randomString .= $characters[$charIndex];
  }
  return $randomString;
}

$id = generateCode();



// $_SESSION["mobile"] =$m;

$managerMobile = $_SESSION["mobile"];




if (isset($_POST['totalAmount']) && isset($_POST['expenseDescription']) && isset($_POST['expenseDate']) && isset($_POST['washerSelect']) && isset($_POST['washerAmount'])) {
  $totalAmount = $_POST['totalAmount'];
  $expenseDescription = $_POST['expenseDescription'];
  $expenseDate = $_POST['expenseDate'];
  $washer_id = $_POST['washerSelect'];
  $washer_amount = $_POST['washerAmount'];

  $stmt = $conn->prepare("INSERT INTO misc (id,totalAmount, Description, DateAdded, washer_id, washer_amount,manager_mobile) VALUES (?,?,?, ?, ?, ?, ?)");
  $stmt->bind_param("sdsssds",$id,  $totalAmount, $expenseDescription, $expenseDate, $washer_id, $washer_amount,$managerMobile);

  if ($stmt->execute()) {
    echo 1;
  } else {
    echo 0;
  }
}
?>

