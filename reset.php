<?php
include "config.php";
// Retrieve the input data from the AJAX request
$oldUsername = $_POST['oldUsername'];
$oldPassword = $_POST['oldPassword'];
$newUsername = $_POST['newUsername'];
$newPassword = $_POST['newPassword'];
$newEmail = $_POST['newEmail'];
$newMobile = $_POST['newMobile'];


// Perform validation if needed
// ...

// Carry out the reset operation

// Check the sysadmin table
$sql = "UPDATE sysadmin SET username = ?, password1 = ?, email = ?,mobile=? WHERE username = ? AND password1 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $newUsername, $newPassword, $newEmail,$newMobile, $oldUsername, $oldPassword);

if ($stmt->execute() && $stmt->affected_rows > 0) {
  // Reset operation successful
  echo 1;
} else {
  // Check the user1 table
  $sql = "UPDATE user1 SET username = ?, password1 = ?, email = ?,mobile=? WHERE username = ? AND password1 = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssss", $newUsername, $newPassword, $newEmail,$newMobile, $oldUsername, $oldPassword);

  if ($stmt->execute() && $stmt->affected_rows > 0) {
    // Reset operation successful
    echo 1;
  } else {
    // User details not found in any of the tables
    echo "0";
  }
}

$stmt->close();
$conn->close();
?>
