<?php
include "config.php";
require __DIR__ . '/vendor/autoload.php';


$workerName=$_POST["workerName"];
$workerDays=$_POST["workerDays"];
$managerMobile=null;
$managerEmail=null;
$managerLoc=null;


$sql = "SELECT * FROM user1 WHERE fullname=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $workerName);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $managerMobile=$row["mobile"];
    $managerEmail=$row["email"];
    $managerLoc=$row["location"];
}





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
locationUser = '$workerName' 
AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL $workerDays DAY) AND NOW() order by recdate asc
";


$result = $conn->query($sql);
// Initialize the PDF document
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'BU', 16);

$pdf->Cell(0, 10, 'Location Manager Daily Report Details', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 10, 'Manager Name:'.$workerName, 0, 1, 'C');
$pdf->Cell(0, 10, 'Mobile:'.$managerMobile, 0, 1, 'C');
$pdf->Cell(0, 10, 'Email:'.$managerEmail, 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(0, 10, 'All amounts are in Ghana Cedis (GHS)', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
// Loop through the data and create tables for each location

$current_location = null;
$workDay2 = null;
$total_cars = 0;
$total_washer_amount = 0;
$total_amount = 0;

$valid=false;

while ($row = $result->fetch_assoc()) {
    $w=$row['workDay'];
    if ($w!= $workDay2) {
        $workDay2=$w;

        // Start a new table for each location
        if ($current_location !== null) { 
            $valid=true;

            // Add a summary row for the previous location
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, 'Total', 1, 0, 'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetTextColor(255, 0, 0);
            
            $pdf->Cell(35, 10, $total_cars, 1, 0, 'C');
            $pdf->Cell(35, 10, "     ", 1, 0, 'C');
            $pdf->Cell(45, 10, $total_washer_amount, 1, 0, 'C');
            $pdf->Cell(35, 10, $total_amount, 1, 0, 'C');
            $pdf->Cell(35, 10, $total_difference, 1, 1, 'C');
            $pdf->Ln();
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 12);

        }

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "location: ". $row['location'], 0, 1, 'L');
        $pdf->Cell(0, 10, "DAY: ". $row['workDay'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(90, 10, 'worker', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Car NO#', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Action', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Worker Amount', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Amount', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Difference', 1, 1, 'C');
      
        $current_location = $row['location'];
        $current_day = $row['workDay'];
        $total_cars = 0;
        $total_washer_amount = 0;
        $total_amount = 0;
        $total_difference = 0;

    }

    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(90, 10, $row['washer'], 1, 0, 'L');
    $pdf->Cell(35, 10, $row['cars_worked'], 1, 0, 'C');
    $pdf->Cell(35, 10, $row['action'], 1, 0, 'C');
    $pdf->Cell(45, 10, $row['washer_amount'], 1, 0, 'C');
    $pdf->Cell(35, 10, $row['total_amount'], 1, 0, 'C');
    $pdf->Cell(35, 10, $row['total_amount'] - $row['washer_amount'], 1, 1, 'C');
 

    // Update the totals for each location
    $total_cars++;
    $total_washer_amount += $row['washer_amount'];
    $total_amount += $row['total_amount'];
    $total_difference += $row['total_amount'] - $row['washer_amount'];
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 12);
}


if(!$valid){
    echo 0;
   exit;
}

// Add a summary row for the last location
// Add a summary row for the last location
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Total', 1, 0, 'R');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(35, 10, $total_cars, 1, 0, 'C');
$pdf->Cell(35, 10, "      ", 1, 0, 'C');
$pdf->Cell(45,  10, $total_washer_amount, 1, 0, 'C');
$pdf->Cell(35, 10, $total_amount, 1, 0, 'C');
$pdf->Cell(35, 10, $total_difference, 1, 1, 'C');
$pdf->Ln();


$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);

// Calculate totals for all locations
$total_cars_all = 0;
$total_washer_amount_all = 0;
$total_amount_all = 0;
$total_difference_all = 0;



$result->data_seek(0); // Reset pointer to beginning of result set

while ($row = $result->fetch_assoc()) {
    $total_cars_all ++;
    $total_washer_amount_all += $row['washer_amount'];
    $total_amount_all += $row['total_amount'];
    $total_difference_all += ($row['total_amount'] - $row['washer_amount']);
}

// Add a grand summary table to the PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->AddPage();



$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, 'Grand Summary For All Worker Days ', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Item', 1, 0, 'L');
$pdf->Cell(35, 10, 'Cars', 1, 0, 'C');
$pdf->Cell(45, 10, 'Worker Amount(GHS)', 1, 0, 'C');
$pdf->Cell(35, 10, 'Amount (GHS)', 1, 0, 'C');
$pdf->Cell(35, 10, 'Difference (GHS)', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(90, 10, 'Grand Total', 1, 0, 'L');
$pdf->Cell(35, 10, $total_cars_all, 1, 0, 'C');

$pdf->Cell(45, 10, $total_washer_amount_all, 1, 0, 'C');
$pdf->Cell(35, 10, $total_amount_all, 1, 0, 'C');
$pdf->Cell(35, 10, $total_difference_all, 1, 1, 'C');

$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, "Date Printed: ". getCurrentDateFormatted(), 0, 1, 'C');
// Output the PDF
//$pdf->Output('F','report/workerDailyReport.pdf');


// Output the PDF
$pdf->Output('F','report/managerDailyReport.pdf');



if($valid){
    echo 11;
}




function deleteFile($filePath) {
    if (file_exists($filePath)) {
      unlink($filePath);
     
    }
  }
  
  function getCurrentDateFormatted() {
    // Set timezone
    date_default_timezone_set('UTC');

    // Get current day, month, and year
    $day = date('j');
    $month = date('F');
    $year = date('Y');

    // Get current day of the week
    $dayOfWeek = date('l');

    // Format day with suffix
    if ($day == 1 || $day == 21 || $day == 31) {
        $dayFormatted = $day . 'st';
    } else if ($day == 2 || $day == 22) {
        $dayFormatted = $day . 'nd';
    } else if ($day == 3 || $day == 23) {
        $dayFormatted = $day . 'rd';
    } else {
        $dayFormatted = $day . 'th';
    }

    // Format date string
    $dateString = $dayOfWeek . ', ' . $dayFormatted . ' ' . $month . ', ' . $year;

    return $dateString;
}



