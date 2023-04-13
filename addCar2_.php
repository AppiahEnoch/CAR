<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['carname'])){
    
if(isset($_SESSION['carPath'])){
    $carna=$_SESSION["carname"];
    $carpath=$_SESSION["carPath"];
    echo "$carna|$carpath";
    }
}
else{
  
    
}



exit;





