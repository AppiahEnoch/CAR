<?php
include "vendor/autoload.php";
include "config.php";

if (!isset($_SESSION)) {
    session_start();
  }

// Your SQL query
$sql = "SELECT * FROM tempwashed";
$result = $conn->query($sql);

// Create a new PDF document
$pdf = new FPDF('P','mm', array(80,297)); // Width of 80mm, Height can be anything. Here it's A4 Height

$pdf->SetMargins(10, 10, 10); // Set the margins. Values are in the order (left, top, right)
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);
$m=  $_SESSION["ceoM"];
$ceo_name=  $_SESSION["ceo"];
$ceo_name=strtoupper($ceo_name);
// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Get the first row to display the single instance info
    $row = $result->fetch_assoc();
    // Display the single instance info
    $pdf->SetFont('Arial', 'B', 16); // Set font to Arial Bold 16
    // Display title
    $pdf->Cell(60, 10, 'Crystal Clear Washing Bay', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(-4); 
    $pdf->Cell(60, 10,"CEO: ".$ceo_name, 0, 1, 'L');
    $pdf->Ln(-4); 
    $pdf->Cell(60, 10,"Mobile:".$m, 0, 1, 'L');
    $pdf->Ln(-4); 
 // Reset font to Arial regular 12 for the rest of the receipt

    $pdf->Cell(60, 10, "Loc:".$row["location"], 0, 1, 'L');
    $pdf->Ln(-3); 
    $pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());


    $pdf->Cell(60, 10, 'Receipt ID: ' . $row["receiptid"], 0, 1, 'L');
    $pdf->Ln(-5); 
    $pdf->Cell(60, 10, 'Car Number: ' . $row["carNumber"], 0, 1, 'L');
    $pdf->Ln(-5); 
    $pdf->Cell(60, 10, 'Description: ' . $row["carname"], 0, 1, 'L');
    $pdf->Ln(-5); 
   

    $pdf->Cell(60, 10, 'Loc. Manager: ' . $row["locationUser"], 0, 1, 'L');
    $pdf->Ln(-1); // Line break

    // Column headers
    $pdf->Cell(40, 10, 'Service', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Amount', 1, 1, 'C'); // Line end

    // Display the first row
    $pdf->Cell(40, 10, $row["action"], 1);
    $pdf->Cell(20, 10, $row["amount"], 1, 1, 'C'); // Line end

    // Output data of each additional row


    while($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row["action"], 1);
        $pdf->Cell(20, 10, $row["amount"], 1, 1, 'C'); // Line end
  
    }


    $sql = "SELECT sum(amount) as total_amount  FROM tempwashed";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $total_amount = $row["total_amount"];





    $pdf->Cell(40, 10, 'Total Amount (GHS)', 1, 0, 'C');
    $pdf->Cell(20, 10, $total_amount, 1, 1, 'C'); // Line end, 1, 0, 'C');
    $pdf->Ln(-1); 
    $currentDateTime = date('Y-m-d H:i:s');

    // Format the date and time
    $formattedDateTime = date('l, jS F, Y  g:i a', strtotime($currentDateTime));
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(60, 10, $formattedDateTime, 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
} else {
    $pdf->Cell(60, 10, 'No results', 0, 1, 'C');
}

$pdf->Output();



$sql  =  "DELETE FROM tempwashed";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>
