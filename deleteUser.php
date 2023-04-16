<?php
include "config.php";


$worker=$_POST["worker"];
// Select all unique manager from the "washed" table
$sql  =  "DELETE FROM user1 where fullname='$worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sql  =  "DELETE FROM washed where locationUser='$worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();


echo 1;


