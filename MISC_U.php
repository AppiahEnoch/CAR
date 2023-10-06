<?php
session_start();
require_once './vendor/autoload.php';
include "config.php";

if (isset($_POST['id']) && isset($_POST['column']) && isset($_POST['value'])) {
  $id = $_POST['id'];
  $column = $_POST['column'];
  $value = $_POST['value'];

  $stmt = $conn->prepare("UPDATE misc SET $column = ? WHERE id = ?");
  $stmt->bind_param("si", $value, $id);

  if ($stmt->execute()) {
    echo "success";
  } else {
    echo "fail";
  }
}
?>
