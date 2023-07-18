<?php
include "config.php";

// Prepare your query
$query = "SELECT * FROM sysadmin";

// Prepare statement
$stmt = $conn->prepare($query);

// Try executing the statement
if ($stmt->execute()) {
    // Bind results to each column
    $stmt->bind_result($fullname, $username, $password1, $email, $mobile, $location);

    // Fetch each result row
    while($stmt->fetch()) {
        echo $mobile;
        
    }
} 
// Close connection
$conn->close();
?>
