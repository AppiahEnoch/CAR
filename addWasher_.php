<?php

include "config.php";


$nFullname=$_POST["nFullname"];
$nEmail=$_POST["nEmail"];
$nMobile=$_POST["nMobile"];
$ghana=$_POST["ghana"];
$location1=$_POST["location1"];





$sql = "SELECT * FROM washer WHERE wmobile=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $nMobile);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    echo 3;
    exit;
}





$stmt = $conn->prepare("INSERT INTO washer (wfullname, wemail,wmobile, wlocation,wghana) VALUES (?, ?, ?,?,?)");
$stmt->bind_param("sssss", $nFullname, $nEmail, $nMobile,$location1,$ghana);
 $stmt->execute();

 echo 1;
 $conn->close();
 exit;


//code exit






















