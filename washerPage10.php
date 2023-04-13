<?php

include "config.php";

$keyword=$_POST["id"];





$sql = "SELECT * FROM car WHERE carname LIKE ?";
$stmt = $conn->prepare($sql); 
$keyword = "%{$keyword}%"; // add wildcards to the keyword
$stmt->bind_param("s", $keyword);
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

































