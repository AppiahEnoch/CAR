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
$pdf = new FPDF('P', 'mm', array(80, 297));
$pdf->SetMargins(5, 10, 5); // Adjusted margins for better space utilization
$pdf->AddPage();

// Company Header
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(70, 10, 'Crystal Clear', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(70, 6, 'Washing Bay', 0, 1, 'C');

// Add a decorative line
$pdf->SetLineWidth(0.5);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Contact Information Section
    $pdf->SetFont('Arial', 'B', 9);
    $ceo_name = strtoupper($_SESSION["ceo"]);
    $m = $_SESSION["ceoM"];
    
    // Two-column layout for contact info
    $pdf->Cell(35, 5, 'CEO:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $ceo_name, 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 5, 'Mobile:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $m, 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 5, 'Location:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $row["location"], 0, 1, 'L');
    
    // Decorative line
    $pdf->SetLineWidth(0.2);
    $pdf->Line(5, $pdf->GetY() + 2, 75, $pdf->GetY() + 2);
    $pdf->Ln(4);
    
    // Transaction Details
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 5, 'Receipt ID:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $row["receiptid"], 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 5, 'Car Number:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $row["carNumber"], 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 5, 'Vehicle:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $row["carname"], 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 5, 'Manager:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 5, $row["locationUser"], 0, 1, 'L');
    
    $pdf->Ln(2);
    
    // Services Table Header
    $pdf->SetFillColor(240, 240, 240);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(45, 7, 'Service', 1, 0, 'C', true);
    $pdf->Cell(25, 7, 'Amount', 1, 1, 'C', true);
    
    // Reset font for table content
    $pdf->SetFont('Arial', '', 9);
    
    // First row
    $pdf->Cell(45, 6, $row["action"], 1);
    $pdf->Cell(25, 6, number_format($row["amount"], 2), 1, 1, 'R');
    
    // Additional rows
    while($row = $result->fetch_assoc()) {
        $pdf->Cell(45, 6, $row["action"], 1);
        $pdf->Cell(25, 6, number_format($row["amount"], 2), 1, 1, 'R');
    }
    
    // Calculate total
    $sql = "SELECT sum(amount) as total_amount FROM tempwashed";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_amount = $row["total_amount"];
    
    // Total Amount Row
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(45, 7, 'Total Amount (GHS)', 1, 0, 'C', true);
    $pdf->Cell(25, 7, number_format($total_amount, 2), 1, 1, 'R', true);
    
    $pdf->Ln(3);
    
    // Footer
    $currentDateTime = date('Y-m-d H:i:s');
    $formattedDateTime = date('l, jS F, Y  g:i a', strtotime($currentDateTime));
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(70, 5, $formattedDateTime, 0, 1, 'C');
    
    // Thank you message
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Thank You For Your Business!', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(70, 5, 'Please Come Again', 0, 1, 'C');
    
} else {
    $pdf->Cell(70, 10, 'No results', 0, 1, 'C');
}

$pdf->Output();

// Clean up temporary data
$sql = "DELETE FROM tempwashed";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>