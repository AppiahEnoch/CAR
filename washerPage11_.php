<?php

include "config.php";

$sql = "SELECT * FROM washer ";
$stmt = $conn->prepare($sql); 
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {

  $wfullname=$row["wfullname"];
  $wmobile=$row["wmobile"];
  $wemail=$row["wemail"];

  
  $data[] = array(
    'wfullname' => $wfullname,
    'wmobile' => $wmobile,
);


   
}


$json = json_encode($data);
echo $json;

exit;

































