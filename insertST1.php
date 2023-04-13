<?php
require_once 'config.php';

if (!isset($_SESSION)) {
    session_start();
}




    
$indexnumber= $_SESSION["indexnumber"];

//$indexnumber="12345";

$v1="fname";
$v2="mname";
$v3="lname";

$v4="postaladdress";

$v5="location1";
$v6="email";
$v7="mobile";
$v8="title";
$v9="digitaladdress";



// declare all fields

$fname= cleanInput(   $_POST[$v1]);

$mname= cleanInput(   $_POST[$v2]);

$lname= cleanInput(   $_POST[$v3]);

$postaladdress= cleanInput($_POST[$v4]);
$location1= cleanInput($_POST[$v5]);
$email= cleanInput($_POST[$v6]);
$mobile= cleanInput($_POST[$v7]);
$title= cleanInput($_POST[$v8]);
$digitaladdress= cleanInput($_POST[$v9]);







// array to test post and set status of vital variables

$arrayOfAlvoters=[$v1,$v3,$v4,$v5,$v6,$v7,$v8];

// function to clean user input

function cleanInput($data){

    try {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

      } catch(Exception $e) {

      }

     return $data;

}



// functin to test issetand post variables

function inputsAreCorrect( $arrayOfAlvoters) {

    $r=sizeof($arrayOfAlvoters)-1;

    for ($i = 0; $i <= $r; $i++) {

        $fieldName=$arrayOfAlvoters[$i];

     

        try{
              

        if (isset($_POST[$fieldName])) {



            if (empty($_POST[$fieldName])) {
           
                return false;

            }

        }

        else{
       
            return false;

        } 

        } 

        catch(Exception $e){
        }
      }

    

    return true;

  }

  // check to insert data if everything is fine.

  if(!inputsAreCorrect($arrayOfAlvoters)){

    exit();

  }

  


  $sql  =  "DELETE FROM `guardian` WHERE indexnumber=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $indexnumber);
  $stmt->execute();

  $sql  =  "DELETE FROM `student` WHERE indexnumber=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $indexnumber);
  $stmt->execute();

// prepare and bind

try{

    $stmt = $conn->prepare("INSERT INTO `guardian` 
    (`indexnumber`, `firstname`, `middlename`,
     `lastname`,`location`,`email`,`mobile`,`title`,`postaladdress`,`digitaladdress`)
      VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssss", 
    $indexnumber, $fname, $mname, $lname,
$location1,$email,$mobile,$title,$postaladdress,$digitaladdress);
    $stmt->execute();
    echo 1;

} catch (Exception $e) {

    echo $e;

} finally {

    $stmt->close();

  

}



$conn->close();

