<?php
require_once 'config.php';



$v1="username";
$v2="password";
$pageNumber=0;
// declare all fields

if (!isset($_SESSION)) {
  session_start();

}



$username= cleanInput($_POST[$v1]);
$password= cleanInput( $_POST[$v2]);

// array to test post and set status of vital variables
$arrayOfAllNames=[$v1,$v2];

// function to clean user input
function cleanInput($data){
    try {
        $data = aeTrim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      } catch(Exception $e) {

      
        
      }
     return $data;
}


$stmt = $conn->prepare("SELECT * FROM sysadmin
");
$stmt->execute();

$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  $ad= $row['username'];
  $adm= $row['mobile'];

  $_SESSION["ceo"]=$ad;
  $_SESSION["ceoM"]=$adm;

}





  $stmt = $conn->prepare("SELECT * FROM sysadmin WHERE 
  username = ? AND `password1` = ?");
  $stmt->bind_param("ss", $username,$password);
  $stmt->execute();

  //fetching result would go here, but will be covered later
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
       $n= $row['username'];
       $p= $row['password1'];
       $m= $row['mobile'];
       $e= $row['email'];
       $loc= $row['location'];

       $_SESSION["admin"]=$n;
       $_SESSION["password"] = $p;
       $_SESSION["mobile"] =$m;
       $_SESSION["email"] =$e;
       $_SESSION["LOC"] =$loc;
       $_SESSION["username"]=$n;

       echo 900;
    
       exit(); 
  }

  $stmt = $conn->prepare("SELECT * FROM user1 WHERE 
  username = ? AND `password1` = ?");
  $stmt->bind_param("ss", $username,$password);
  $stmt->execute();

  //fetching result would go here, but will be covered later
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
       $n= $row['username'];
       $p= $row['password1'];
       $m= $row['mobile'];
       $e= $row['email'];
       $loc= $row['location'];


       $_SESSION["username"]=$n;
       $_SESSION["password"] = $p;
       $_SESSION["mobile"] =$m;
       $_SESSION["email"] =$e;
       $_SESSION["LOC"] =$loc;
       echo 1;
       exit(); 
  }
  




function aeTrim($var) {
  try {
      // Trim the variable
      if($var !== null && $var !== ''){
        $var = trim($var);
    }
    
      
      // Check if the variable is null or empty
      if(is_null($var) || $var === "") {
          return "";
      }
      
      return $var;
  } catch (Exception $e) {
    return "";
  }
}



