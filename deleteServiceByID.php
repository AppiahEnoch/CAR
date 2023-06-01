<?php
include "config.php";

include "config.php";

if (isset($_POST['id'])) {
  $serviceId = $_POST['id'];

  // Prepare your query
  $query = "DELETE FROM `service` WHERE id = ?";

  // Prepare statement
  $stmt = $conn->prepare($query);
    
  // Bind parameter
  $stmt->bind_param("i", $serviceId);

  // Try executing the statement
  if ($stmt->execute()) {
    echo 1;
  } else {
    echo 0;
  }
}

// Close connection
$conn->close();

