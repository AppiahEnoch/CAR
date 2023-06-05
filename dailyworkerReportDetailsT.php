<?php
include "config.php";
require __DIR__ . '/vendor/autoload.php';


$workerName="APPIAH ENOCH";
$workerDays=1;

$current_location = null;
$workDay2 = null;
$total_cars = 0;
$total_washer_amount = 0;
$total_amount = 0;
// Retrieve data from the 'washed' table
$sql = "SELECT 
location, 
washer, 
DATE_FORMAT(recdate, '%W, %D %M, %Y') AS workDay, 
carNumber AS cars_worked, 
washeramount AS washer_amount, 
amount AS total_amount,
`action`
FROM washed 
WHERE 
washer = '$workerName' 
AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL $workerDays DAY) AND NOW() order by recdate asc
";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $w=$row['workDay'];

    if ($w!= $workDay2) {
        $workDay2=$w;
        echo $w;

    }
}


