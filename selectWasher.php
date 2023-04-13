<?php
include "config.php";
// Select all unique washers from the "washed" table
$sql = "SELECT DISTINCT UPPER(TRIM(washer)) as washer FROM washed";
$result = $conn->query($sql);

// Store the result in an array
$washers = array();
while ($row = $result->fetch_assoc()) {
    $washers[] = $row['washer'];
}

// Convert the array to a JSON object and return it
echo json_encode($washers);
?>
