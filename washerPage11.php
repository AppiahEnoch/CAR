<?php

include "config.php";

$keyword=$_POST["id"];





$sql = "SELECT * FROM washer WHERE wfullname LIKE ?";
$stmt = $conn->prepare($sql); 
$keyword = "%{$keyword}%"; // add wildcards to the keyword
$stmt->bind_param("s", $keyword);
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

































