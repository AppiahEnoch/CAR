<?php

$conn ="";

        $DBhostname = "localhost";
        $DBusername = "root";
        $DBpassword = "";
        $database = "car";
        $DBport = "63943";  

$remote_addr = $_SERVER['REMOTE_ADDR'];
$remote_host = gethostbyaddr($remote_addr);

if($remote_host=="AECleanCodes"){



    try {


       $conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $database,$DBport) or die("Database connection failed");
 
    } catch (Throwable $th) {
        //throw $th;
    }


exit;
}


// remote server

    try {



        $DBhostname = "localhost";
        $DBusername = "root";
        $DBpassword = "";
        $database = "car";
    

       $conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $database) or die("Database connection failed");
 
    } catch (Throwable $th) {
        //throw $th;
    }




