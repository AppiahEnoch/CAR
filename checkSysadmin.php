<?php
session_start();

// check if $_SESSION["admin"] is not set
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}
?>
