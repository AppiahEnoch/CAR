<?php
require_once "config.php";

$sql = "SELECT * FROM service";

$result = $conn->query($sql);

$services = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
} else {
    echo "0 results";
}

// Encode array to JSON and echo it
echo json_encode($services);

// Close connection
$conn->close();

?>
