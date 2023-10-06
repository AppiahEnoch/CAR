<?php
session_start();
include "config.php";
require __DIR__ . '/vendor/autoload.php';
require('mc_table.php');

deleteFile('report/workerDailyReport.pdf');


$workerName=$_POST["workerName"];
$workerDays=$_POST["workerDays"];

// Fetch worker details
$sqlWorker = "SELECT * FROM washer WHERE wfullname = ?";
$stmtWorker = $conn->prepare($sqlWorker);
$stmtWorker->bind_param("s", $workerName);
$stmtWorker->execute();
$workerDetails = $stmtWorker->get_result()->fetch_assoc();

$sql = "SELECT 
location, 
carNumber,
action AS service,
DATE_FORMAT(recdate, '%W, %D %M, %Y') AS workDay, 
COUNT(DISTINCT carNumber) AS cars_worked, 
SUM(washeramount) AS washer_amount, 
SUM(amount) AS total_amount,
(amount - washeramount) AS difference
FROM washed 
WHERE 
washer = ? 
AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL ? DAY) AND NOW()
GROUP BY location, DATE(recdate), carNumber, action;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $workerName, $workerDays);
$stmt->execute();
$result = $stmt->get_result();

$pdf = new PDF_MC_Table();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, "Date: " . date("l, jS F, Y"), 0, 1, 'R');
$pdf->Image('5.jpg', 10, 10, -150);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Worker Daily Report', 0, 1, 'C');

// Worker details display
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(-5);
$pdf->Cell(0, 10, "Name: " . $workerDetails['wfullname'], 0, 1, 'C');
$pdf->Ln(-5);
$pdf->Cell(0, 10, "Mobile: " . $workerDetails['wmobile'], 0, 1, 'C');
$pdf->Ln(-5);
$pdf->Cell(0, 10, "Email: " . $workerDetails['wemail'], 0, 1, 'C');
$pdf->Ln(-5);
$pdf->Cell(0, 10, "Town: " . $workerDetails['wlocation'], 0, 1, 'C');
$pdf->Ln(-5);
$pdf->Cell(0, 10, "Ghana: " . $workerDetails['wghana'], 0, 1, 'C');
$pdf->Ln();

$current_location = null;
$total_cars = 0;
$total_washer_amount = 0;
$total_amount = 0;
$total_difference = 0;

$valid = false;
while ($row = $result->fetch_assoc()) {
    if ($current_location !== $row['location']) {
        if ($current_location !== null) {
            $valid = true;
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Row(['Total', '', $total_cars, $total_washer_amount, $total_amount, $total_difference]);
            $pdf->Ln();
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 12);
        }
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "DAY: " . $row['workDay'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetWidths(array(50, 40, 20, 20, 20, 30));
        $pdf->Row(['Car No#', 'Service', 'Cars', 'Worker Amount', 'Amount', 'Difference']);
        $current_location = $row['location'];
        $total_cars = 0;
        $total_washer_amount = 0;
        $total_amount = 0;
        $total_difference = 0;
    }
    $pdf->SetFont('Arial', '', 12);
    $pdf->Row([
        $row['carNumber'],
        $row['service'],
        $row['cars_worked'],
        $row['washer_amount'],
        $row['total_amount'],
        $row['difference']
    ]);
    $total_cars += $row['cars_worked'];
    $total_washer_amount += $row['washer_amount'];
    $total_amount += $row['total_amount'];
    $total_difference += $row['difference'];
}

$total_cars_all = 0;
$total_washer_amount_all = 0;
$total_amount_all = 0;
$total_difference_all = 0;

$result->data_seek(0);
while ($row = $result->fetch_assoc()) {
    $total_cars_all += $row['cars_worked'];
    $total_washer_amount_all += $row['washer_amount'];
    $total_amount_all += $row['total_amount'];
    $total_difference_all += $row['difference'];
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(255, 0, 0);
$pdf->Row(['Grand Total', '', $total_cars_all, $total_washer_amount_all, $total_amount_all, $total_difference_all]);

if (!$valid) {
    echo 0;
    exit;
}

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, 'Grand Summary For All Worker Days', 0, 1, 'C');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetWidths(array(50, 40, 20, 20, 20, 30));
$pdf->Row(['Item', 'Cars', 'Worker Amount(GHS)', 'Amount (GHS)', 'Difference (GHS)']);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(255, 0, 0);
$pdf->Row(['Grand Total', '', $total_cars_all, $total_washer_amount_all, $total_amount_all, $total_difference_all]);

$pdf->Output('F','report/workerDailyReport.pdf');

if ($valid) {
    echo 11;
}

function deleteFile($filePath) {
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}
?>
