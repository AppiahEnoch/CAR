<?php
require_once "config.php";

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get the values from POST
    $serviceName = $_POST['service_name'];
    $serviceDescription = $_POST['service_description'];

    // Prepare a SQL statement
    $sql = "INSERT INTO service (`service_name`, service_description) VALUES (?, ?)";

    // Prepare the SQL statement
    if($stmt = $conn->prepare($sql)){
        
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $serviceName, $serviceDescription);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            echo 1;
        } else{
            echo "ERROR: Could not execute query: $sql. " . $conn->error;
        }
    } else{
        echo "ERROR: Could not prepare query: $sql. " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

?>
