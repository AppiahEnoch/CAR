<?php
include "config.php";
// get the POST data sent by the AJAX call
$cusname = $_POST['cusname'];
$cusloc = $_POST['cusloc'];
$cusmobile = $_POST['cusmobile'];
$cusDesc = $_POST['cusDesc'];
$cusservice = $_POST['cusservice'];

// prepare the SQL statement
$sql = "INSERT INTO cusrequest (cusname, cusloc, cusmobile, cusDesc, cusservice) 
        VALUES (?, ?, ?, ?, ?)";

// prepare the statement
$stmt = $conn->prepare($sql);

// bind the parameters
$stmt->bind_param("sssss", $cusname, $cusloc, $cusmobile, $cusDesc, $cusservice);

// execute the statement
if ($stmt->execute()) {
    echo 1;
} else {
    echo "Error inserting record: " . $conn->error;
}

// close the statement and connection
$stmt->close();
$conn->close();
?>
