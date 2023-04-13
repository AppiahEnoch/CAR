<?php
include "config.php";
// Select all unique manager from the "washed" table
$sql = "SELECT DISTINCT UPPER(TRIM(fullname)) as manager FROM user1";
$result = $conn->query($sql);

// Store the result in an array
$manager = array();
while ($row = $result->fetch_assoc()) {
    $manager[] = $row['manager'];
}

// Convert the array to a JSON object and return it
echo json_encode($manager);
?>
