<?php

include "config.php";

$keyword=$_POST["id"];





$sql = "SELECT * FROM car";
$stmt = $conn->prepare($sql); 
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {

  $carname=$row["carname"];

  
  $data[] = array(
    'carname' => $carname,

);


   
}


$json = json_encode($data);
echo $json;

exit;

































