<?php

include "config.php";

$nRegCode=$_POST["nRegCode"];
$nFullname=$_POST["nFullname"];
$nEmail=$_POST["nEmail"];
$nMobile=$_POST["nMobile"];
$nUsername=$_POST["nUsername"];
$nPassword=$_POST["nPassword"];
$nLocation=$_POST["nLocation"];


$sql = "SELECT * FROM user1 WHERE username=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $nUsername);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    echo 3;
    exit;
}



$sql = "SELECT * FROM registrationcode WHERE code=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $nRegCode);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
  
}
else{

  echo 4;
    exit;
}




$stmt = $conn->prepare("INSERT INTO user1 (fullname, email,mobile, username,password1,location) VALUES (?, ?, ?,?,?,?)");
$stmt->bind_param("ssssss", $nFullname, $nEmail, $nMobile,$nUsername,$nPassword,$nLocation);
 $stmt->execute();

 echo 1;





$sql = "DELETE FROM registrationcode WHERE code=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $nRegCode);
$stmt->execute();


exit;



























