<?php

include "config.php";


$keyword= $_POST["keyword"];

$sql = "SELECT * FROM car where carname= '$keyword'";


$stmt = $conn->prepare($sql); 
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $action=$row["action"];
  $amount=$row["amount"];
  $washerAmount=$row["washeramount"];
  $data[] = array(
    'action' => $action,
    'amount' => $amount,
    'washerAmount' => $washerAmount,
    
);


   
}


$json = json_encode($data);
echo $json;

exit;

































