<?php

include "config.php";

$keyword = $_POST["keyword"]; // Assumes 'keyword' is sent from client side

// This will search for the keyword in the 'carname' column at the start
$sql = "SELECT * FROM car WHERE carname LIKE ? order by carname asc";
$stmt = $conn->prepare($sql);

// Adding % after keyword will match any carname starting with the keyword
$keyword = $keyword . "%";
$stmt->bind_param("s", $keyword); 

$stmt->execute();
$result = $stmt->get_result();

$data = array(); // Initialising the array to prevent error in case there are no results

while ($row = $result->fetch_assoc()) {
    $carname = $row["carname"];

    $data[] = array(
        'carname' => $carname
    );
}

$json = json_encode($data);
echo $json;

exit;

?>
