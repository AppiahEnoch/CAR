<?php
require_once 'vendor/autoload.php';

include "config.php";

// Fetch data from the database
$query = "SELECT carNumber, COUNT(DISTINCT receiptid) AS number_of_washes FROM washed GROUP BY carNumber ORDER BY number_of_washes DESC";
$result = $conn->query($query);

$pdf = new \FPDF();
$pdf->AddPage();

// Add Logo
$pdf->Image('5.jpg',10,6,20);

// Set font
$pdf->SetFont('Arial','B',16);

// Add Brand Name
$pdf->Cell(80,10,'',0,0);
$pdf->Cell(30,10,'CRYSTAL CLEAR WASHING BAY',0,1 ,'C');

// Title
$pdf->Cell(0,10,'Best Customer Report',0,1,'C');

// Date
$pdf->SetFont('Arial','',12);
$date = date('jS F, Y, g:i:s a'); // Get the current date in the specified format
$pdf->Cell(0,10,'Date: ' . $date,0,1,'R');

// Set a smaller font for the table
$pdf->SetFont('Arial','',12);

// Column headers
$header = array('Car Number', 'Number of Washes');

// Column widths
$w = array(90, 90);

// Colors for table header
$pdf->SetFillColor(255, 0, 0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 0, 0);

// Header
for($i=0;$i<count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C', true);
$pdf->Ln();

// Reset text color and draw color for data
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(128, 0, 0);

// Data
$fill = false;
while($row = $result->fetch_assoc()) {
    $pdf->Cell($w[0],6,$row['carNumber'],'LR', 0, 'C', $fill);
    $pdf->Cell($w[1],6,$row['number_of_washes'],'LR', 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill;
}

// Closing line
$pdf->Cell(array_sum($w),0,'','T');

// Save the PDF
$pdf->Output('D','car_wash_frequency_report.pdf');
?>
