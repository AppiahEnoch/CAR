<?php
session_start();
require_once './vendor/autoload.php';
include "config.php";

$sql = "SELECT wfullname, wmobile FROM washer";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  echo json_encode($data);
} else {
  echo json_encode([]);
}
?>
