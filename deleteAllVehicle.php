<?php
include "config.php";
// Select all unique manager from the "washed" table
$sql  =  "DELETE FROM car";
$stmt = $conn->prepare($sql);
$stmt->execute();

$sql  =  "DELETE FROM washed";
$stmt = $conn->prepare($sql);
$stmt->execute();

deleteAllFilesInFolder("car");

echo 1;



function deleteAllFilesInFolder($folderPath) {
    // Check if the directory exists
    if (is_dir($folderPath)) {
      // Open the directory
      $dh = opendir($folderPath);
  
      // Loop through each file in the directory
      while (($file = readdir($dh)) !== false) {
        // Skip the "." and ".." directories
        if ($file == '.' || $file == '..') {
          continue;
        }
  
        // Delete the file
        if (unlink("$folderPath/$file")) {
          echo "Deleted file: $folderPath/$file<br>";
        } else {
          echo "Error deleting file: $folderPath/$file<br>";
        }
      }
  
      // Close the directory
      closedir($dh);
    } else {
      echo "Directory not found";
    }
  }
  