<?php
session_start();
require_once './vendor/autoload.php';
include "config.php";


$id = $_POST['id'];
$totalAmount = $_POST['totalAmount'];
$washerAmount = $_POST['washerAmount'];
$Description = $_POST['Description'];
$DateAdded = $_POST['DateAdded'];
$washer_id = $_POST['washer_id'];

$query = "UPDATE misc SET totalAmount = ?, washer_amount = ?, Description = ?, DateAdded = ?, washer_id = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ddssss", $totalAmount, $washerAmount, $Description, $DateAdded, $washer_id, $id);
$result = $stmt->execute();

echo json_encode(["status" => $result ? "success" : "error"]);
?>
