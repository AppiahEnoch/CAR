<?php
require_once "config.php";
$ext_img = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions


$carname=cleanInput($_POST["carname"]);
$action=cleanInput($_POST["action"]);
$amount=cleanInput($_POST["amount"]);
$washeramount=cleanInput($_POST["washeramount"]);


if(!isset($_SESSION)){
    session_start();
}

$_SESSION["carname"]=$carname;

$_path ="car";
$newFilePath="not set";
if (isset($_FILES["carImage"]) && $_FILES["carImage"]["error"] == UPLOAD_ERR_OK) {
    $fileName = $_FILES["carImage"]['name'];
    $tmp = $_FILES["carImage"]['tmp_name'];
    $newFilePath=getFilepath_img($carname);
  
  } else {
    $newFilePath="not set";
  }
  



 



$stmt = $conn->prepare("INSERT INTO car 
(carname,`action`,amount,washeramount,img) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $carname,$action,$amount,$washeramount,$newFilePath);
 $stmt->execute();

$stmt->close();
$conn->close();





if($newFilePath!="not set"){
 $_SESSION["carPath"]=$newFilePath;
}


$carna=$_SESSION["carname"];
$carpath=$_SESSION["carPath"];


    





  function cleanInput($data){
    try {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      } catch(Exception $e) {

      
        
      }
     return $data;
}



function getFilepath_img($unique)
{
    global $fileName, $tmp, $ext_img, $_path;

    $unique=str_replace(" ", "_", $unique);

    try {
        // get uploaded file's extension
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $final_image = $unique.".".$ext;

        if (!(in_array($ext, $ext_img))) {
            exit;
        }
        $final_path = 'car/' . strtolower($final_image);
        move_uploaded_file($tmp, $final_path);

        return $final_path;
    } catch (\Throwable $th) {
        throw $th;
    }
}