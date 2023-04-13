<?php
include "config.php";
require __DIR__ . '/vendor/autoload.php';

// Retrieve data from the 'washed' table
$sql = "SELECT location, washer, DATE(recdate) AS date, COUNT(DISTINCT carNumber) AS cars_worked, SUM(washeramount) AS washer_amount, SUM(amount) AS total_amount 
        FROM washed 
        GROUP BY location, washer, DATE(recdate)";

$result = $conn->query($sql);

// Initialize the PDF document
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Washer Report', 0, 1, 'C');

// Loop through the data and create tables for each location
$current_location = null;
$total_cars = 0;
$total_washer_amount = 0;
$total_amount = 0;

while ($row = $result->fetch_assoc()) {
    if ($row['location'] != $current_location) {
        // Start a new table for each location
        if ($current_location !== null) {
            // Add a summary row for the previous location
            $pdf->Cell(90, 10, 'Total', 1, 0, 'R');
            $pdf->Cell(30, 10, $total_cars, 1, 0, 'C');
            $pdf->Cell(30, 10, $total_washer_amount, 1, 0, 'C');
            $pdf->Cell(30, 10, $total_amount, 1, 1, 'C');
            $pdf->Ln();
        }

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "location: ". $row['location'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(90, 10, 'worker', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Cars', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Worker Amount', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Amount', 1, 1, 'C');
      

        $current_location = $row['location'];
        $total_cars = 0;
        $total_washer_amount = 0;
        $total_amount = 0;
    }

    // Add a row for each washer for each day
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(90, 10, $row['washer'], 1, 0, 'L');
    $pdf->Cell(30, 10, $row['cars_worked'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['washer_amount'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['total_amount'], 1, 1, 'C');
 

    // Update the totals for each location
    $total_cars += $row['cars_worked'];
    $total_washer_amount += $row['washer_amount'];
    $total_amount += $row['total_amount'];
}

// Add a summary row for the last location
$pdf->Cell(90, 10, 'Total', 1, 0, 'R');
$pdf->Cell(30, 10, $total_cars, 1, 0, 'C');
$pdf->Cell(40, 10, $total_washer_amount, 1, 0, 'C');
$pdf->Cell(30, 10, $total_amount, 1, 1, 'C');
$pdf->Ln();

// Output the PDF
$pdf->Output('F','washerReport.pdf');
?>
