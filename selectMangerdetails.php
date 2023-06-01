<?php
include "config.php";

// Prepare your query
$query = "SELECT * FROM sysadmin";

// Prepare statement
$stmt = $conn->prepare($query);

// Try executing the statement
if ($stmt->execute()) {
    // Fetch result if necessary
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $mobile = $row['mobile'];
        echo $mobile;
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$conn->close();
?>


