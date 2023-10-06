<?php
session_start();
require_once './vendor/autoload.php';
include "config.php";



$query = "SELECT * FROM misc order by id desc";
$result = $conn->query($query);
$records = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;

    }
    echo json_encode($records);
} else {
    if(!$result) {
        $error = $conn->error;
        error_log("Database query failed: " . $error, 0);
    }
    echo json_encode([]);
}
