<?php
session_start();
require_once './vendor/autoload.php';
include "./config.php";


$query = "SELECT id, carNumber FROM washed GROUP BY carNumber ORDER BY id DESC";
$result = $conn->query($query);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);
?>
