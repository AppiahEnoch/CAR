<?php
include "config.php";

// Assuming $conn is your connection variable

// Create an empty array to hold the result
$resultArray = array();

// Write your SQL statement
$sql = "SELECT * FROM car";

// Query the database
$result = mysqli_query($conn, $sql);

// Check if the query returned a result
if (mysqli_num_rows($result) > 0) {
    // Fetch all rows into an associative array
    while($row = mysqli_fetch_assoc($result)) {
        $resultArray[] = $row;
    }
} else {
    echo "No results found.";
}

// Convert the result array to JSON
$json = json_encode($resultArray, JSON_PRETTY_PRINT);

// Echo the JSON
echo $json;

// Close the connection
mysqli_close($conn);
?>
