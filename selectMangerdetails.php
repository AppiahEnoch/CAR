<?php
include "config.php";

// Prepare your query
$query = "SELECT * FROM sysadmin";

// Prepare statement
$stmt = $conn->prepare($query);

// Try executing the statement
if ($stmt->execute()) {
    // Bind results
    $stmt->bind_result($mobile);

    // Fetch result if necessary
    if($stmt->fetch()) {
        echo $mobile;
    }
} 
// Close connection
$conn->close();
?>
