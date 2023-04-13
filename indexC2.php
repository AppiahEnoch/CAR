<?php

include "config.php";

$email=$_POST["email"];


$sql = "SELECT * FROM user1 WHERE email=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
  $username=$row["username"];
  $password=$row["password1"];
    echo "$username|$password";
}




exit;





























