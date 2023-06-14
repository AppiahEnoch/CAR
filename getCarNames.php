<?php
include "config.php";

// Select all unique car names from the "car" table
$sql = "SELECT DISTINCT UPPER(TRIM(`carname`)) as carname FROM car order by carname asc";
$result = $conn->query($sql);

// Store the result in an array
$carNames = array();
while ($row = $result->fetch_assoc()) {
    $carNames[] = $row['carname'];
}

// Convert the array to a JSON object and return it
echo json_encode($carNames);
?>
