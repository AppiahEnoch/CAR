<?php
session_start();
require_once './vendor/autoload.php';
include "config.php";

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $stmt = $conn->prepare("DELETE FROM misc WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo "success";
  } else {
    echo "fail";
  }
}
?>
