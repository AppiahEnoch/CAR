<?php
$ext_img = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions

// change these
$fileName="washerImage";
$tempName="washerImage";
$destFolder ="washer";

$renameFileTo=$_POST["mobile"];


$newFilePath="not set";
if (isset($_FILES[$fileName]) && $_FILES[$fileName]["error"] == UPLOAD_ERR_OK) {
    $fileName = $_FILES[$fileName]['name'];
    $tmp = $_FILES[$tempName]['tmp_name'];
    $newFilePath=getFilepath_img($renameFileTo);
  
  } else {
    $newFilePath="not set";
  }





  function getFilepath_img($unique)
  {
      global $fileName, $tmp, $destFolder;
  
      $unique = str_replace(" ", "_", $unique);
  
      try {
          // get uploaded file's extension
          $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  
          // convert to jpg if not already jpg
          if ($ext !== 'jpg') {
              $image = imagecreatefromstring(file_get_contents($tmp));
              $final_image = $unique . '.jpg';
              $final_path = $destFolder . '/' . strtolower($final_image);
              imagejpeg($image, $final_path, 90);
              imagedestroy($image);
          } else {
              $final_image = $unique . '.jpg';
              $final_path = $destFolder . '/' . strtolower($final_image);
              move_uploaded_file($tmp, $final_path);
          }
  
          echo $final_path;
          return $final_path;
  
      } catch (\Throwable $th) {
          throw $th;
      }
  }
  