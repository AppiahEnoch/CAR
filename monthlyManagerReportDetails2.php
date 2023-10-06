<?php
session_start();
include "config.php";
require __DIR__ . '/vendor/autoload.php';
require('mc_table.php');

$workerName = $_POST["workerName"];
$workerDays = $_POST["workerDays"];

$managerMobile = null;
$managerEmail = null;
$managerLoc = null;
$name_for_search = $workerName;
$overall_record_count = 0;

$sql = "SELECT * FROM user1 WHERE fullname=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $workerName);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $managerMobile = $row["mobile"];
    $managerEmail = $row["email"];
    $managerLoc = $row["location"];
    $name_for_search = $row["username"];
} else {
    $sql = "SELECT * FROM sysadmin WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $workerName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $managerMobile = $row["mobile"];
        $managerEmail = $row["email"];
        $managerLoc = $row["location"];
        $name_for_search = $row["username"];
    }
}





$sql = "SELECT 
location, 
washer, 
DATE_FORMAT(recdate, '%M, %Y') AS workDay, 
carNumber AS cars_worked, 
washeramount AS washer_amount, 
amount AS total_amount,
`action`
FROM washed 
WHERE 
locationUser = '$name_for_search' 
AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL $workerDays MONTH) AND NOW() order by recdate DESC
";

$result = $conn->query($sql);

ob_end_clean();
$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Location Manager Daily Report Details', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Manager Name: ' . $workerName, 0, 1);
$pdf->Ln(-5);
$pdf->Cell(0, 10, 'Mobile: ' . $managerMobile, 0, 1);
$pdf->Ln(-5);
$pdf->Cell(0, 10, 'Email: ' . $managerEmail, 0, 1);
$pdf->Ln(-2);
// RESET COLOR
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'Location: ' . $managerLoc, 0, 1, 'L');
// set black color
$pdf->Ln();
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(0, 10, 'All amounts are in Ghana Cedis (GHS)', 0, 1, 'L');

$pdf->SetTextColor(0, 0, 0);


// reset font
$pdf->SetFont('Arial', '', 10);

$currentMonth = "";
$nextRow = $result->fetch_assoc();

while ($nextRow) {
    $row = $nextRow;
    $nextRow = $result->fetch_assoc();  // Get the next row in advance for comparison
    
    if ($currentMonth != $row['workDay']) {
        $currentMonth = $row['workDay'];

        $pdf->Ln(7);  // Create a gap between months for clarity
      
        $pdf->Cell(0, 6, 'MONTH: ' . $currentMonth, 0, 1, 'L');
   

        
        

        // Reset totals for the new month
        $totalCarsWorked = 0;
        $totalWasherAmount = 0;
        $totalAmount = 0;

        // Column headers
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetWidths(array(60, 40, 30, 20, 20, 20, 20));
        // CENTER THE TEXT IN THE CELLS
        $pdf->SetAligns(array('L', 'L', 'C', 'C', 'C', 'C', 'C'));
        


        $pdf->Row(array
('Worker', 'Car No#', 'Service', 'Worker Amount', 'Amount', 'Difference'));

        // Reset font
        $pdf->SetFont('Arial', '', 10);
    }

    $difference = $row['total_amount'] - $row['washer_amount'];
    $pdf->Row(array($row['washer'], $row['cars_worked'], $row['action'], $row['washer_amount'], $row['total_amount'], $difference));

    $totalCarsWorked++;
    $totalWasherAmount += $row['washer_amount'];
    $totalAmount += $row['total_amount'];
    $overall_record_count++;
    
    // If the next record does not belong to the current month or is the last record, print the totals.
    if (!$nextRow || $nextRow['workDay'] != $currentMonth) {
        $differenceTotal = $totalAmount - $totalWasherAmount;

        //set font to bold
        $pdf->SetFont('Arial', 'B', 10);
        //color red
        $pdf->SetTextColor(255, 0, 0);

        // Totals row for the month
        $pdf->Row(array('Total for ' . $currentMonth, $totalCarsWorked, '', $totalWasherAmount, $totalAmount, $differenceTotal));
        $pdf->Ln();  // Create a gap after totals for clarity



          
        //select records where the mobile number is the same as the manager mobile number and the date is the same as the current month
        $sql = "SELECT * FROM misc WHERE manager_mobile=? AND DATE_FORMAT(recdate, '%M, %Y')=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $managerMobile, $currentMonth);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $totalMisc = 0;

        // create a table showing description and totalAmount,washer_amount and their defference 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 6, 'Miscellaneous', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetWidths(array(100, 20,20,20));
        // create table headings
        $pdf->Row(array('description',  'Worker Amount', 'Amount', 'Difference'));
        $pdf->SetFont('Arial', '', 10);

        // CENTER THE TEXT IN THE CELLS
        $pdf->SetAligns(array('L', 'L', 'C', 'C', 'C', 'C', 'C'));

// create varibles to calculate subtals for misc
        $totalMisc = 0;
        $totalMiscWasher = 0;
        $totalMiscAmount = 0;
        $totalMiscDifference = 0;


        while ($row2 = $result2->fetch_assoc()) {
            $differenceMisc = $row2['totalAmount'] - $row2['washer_amount'];
            $pdf->Row(array( $row2['Description'], $row2['washer_amount'], $row2['totalAmount'], $differenceMisc));
            $totalMisc += $row2['totalAmount'];

            $totalMiscWasher += $row2['washer_amount'];
            $totalMiscAmount += $row2['totalAmount'];
            $totalMiscDifference += $differenceMisc;
        // Create a gap after totals for clarity

        }
        // 
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Row(array('Total for ' . $currentMonth, $totalMiscWasher, $totalMiscAmount, $totalMiscDifference));
    // Create a gap after totals for clarity

        // SHOW SUM OF misc subtotals and the total for the month
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Row(array('Total for ' . $currentMonth, $totalMiscWasher + $totalWasherAmount, $totalMiscAmount + $totalAmount, $totalMiscDifference + $differenceTotal));
        $pdf->Ln();  // Create a gap after totals for clarity
        
        // reset
        $pdf->SetTextColor(0, 0, 0);


        


      











    }
  
// reset color
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 10);
}

$pdf->Output('F', 'report/managerMonthlyReport.pdf');



// if thear is no record echo 0
if ($overall_record_count == 0) {
    echo 0;
    exit;
}
else{
   echo 11;
}
$conn->close();
?>
