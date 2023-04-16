<?php
include "config.php";


$worker=$_POST["worker"];
// Select all unique manager from the "washed" table
$sql  =  "DELETE FROM washer where wfullname='$worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sql  =  "DELETE FROM washed where washer='$worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();


echo 1;


