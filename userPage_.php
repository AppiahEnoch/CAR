<?php
include "config.php";


if (!isset($_SESSION)) {
    session_start();
  
  }

  $username=  $_SESSION["username"];

// Select all unique data from the "washed" table
$sql = "SELECT COUNT(*) AS total_records, SUM(amount) AS total_amount 
FROM washed 
WHERE  locationUser='$username' AND DATE(recdate) = CURDATE();
";

$result = $conn->query($sql);

// Store the result in an array
$totalServices =0;
$totalAmount = 0;
while ($row = $result->fetch_assoc()) {
    $totalServices= $row['total_records'];
    $totalAmount= $row['total_amount'];
}

// Create a new array with the fetched data
$data = array(
    'total_services' => $totalServices,
    'total_amount' => $totalAmount
);

// Convert the array to a JSON object and return it
echo json_encode($data);
?>
