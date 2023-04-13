<?php
$conn ="";
    try {

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "car";
        $port = "63943";  
       $conn = mysqli_connect($hostname, $username, $password, $database,$port) or die("Database connection failed");
 
    } catch (Throwable $th) {
        //throw $th;
    }

