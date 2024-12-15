<?php
/*  CAR CRYSTAL CLEAR WASHING BAY */
$email_sender="crytalcleargh@gmail.com";
$email_password="lnepqtxcafyidpce";

$DBhostname = "localhost";
$DBusername = "root";
$DBpassword = "";
$database = "car";
$DBport = "63943"; 





$conn ="";

    try {
       $conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $database, $DBport) or die("Database connection failed");
 
    } catch (Throwable $th) {
        //throw $th;
    }