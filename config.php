<?php
require_once('../ENV/env.php');

$conn ="";


$remote_addr = $_SERVER['REMOTE_ADDR'];
$remote_host = gethostbyaddr($remote_addr);



if($remote_host=="AECleanCodes1"){
  
    try {
       $conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $database,$DBport) or die("Database connection failed");
 
    } catch (Throwable $th) {
        //throw $th;
    }

}
else{

    
    try {
        $DBhostname = "";
        $DBusername = "";
        $DBpassword = "";
        $database = "";
       $conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $database) or die("Database connection failed");
 
    } catch (Throwable $th) {
        //throw $th;
    }

}




// remote server





