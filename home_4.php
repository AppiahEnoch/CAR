<?php
include "config.php";

// Define the SQL query to select unique managers from user1 and sysadmin tables
$sql = "SELECT fullname, username, password1, email, mobile, location FROM user1
UNION
SELECT fullname,username, password1, email, mobile, location FROM sysadmin;
";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Store the result in an array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Convert the array to a JSON object and return it
echo json_encode($data);

// Close the database connection
$conn->close();
?>
