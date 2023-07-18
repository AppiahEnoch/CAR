<?php
include "config.php";

// Prepare your query
$query = "SELECT * FROM sysadmin limit 1";

// Execute query
$result = $conn->query($query);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    if($row = $result->fetch_assoc()) {
        echo "Mobile: " . $row["mobile"];
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
