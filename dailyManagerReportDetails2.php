<?php
session_start();
require_once './vendor/autoload.php';
include "./config.php";


require('mc_table.php');
ob_end_clean();

// vaariables for overall profit and loss calculation

$overall_total_amount = 0;
$overall_total_washer_amount = 0;
$overall_total_difference = 0;
$overall_record_count = 0;


// vaariables for overall profit and loss calculation on miscellaneous

$overall_total_amount_misc = 0;
$overall_total_washer_amount_misc = 0;
$overall_total_difference_misc = 0;
$overall_record_count_misc = 0;



// vaariables for overall profit and loss calculation on miscellaneous

$overall_total_amount_misc = 0;
$overall_total_washer_amount_misc = 0;
$overall_total_difference_misc = 0;
$overall_record_count_misc = 0;


// vaariables for overall profit and loss calculation on miscellaneous

$overall_total_amount_misc = 0;
$overall_total_washer_amount_misc = 0;



$total_difference = 0;
$workerName = $_POST["workerName"];
$workerDays = $_POST["workerDays"];

$managerMobile = null;
$managerEmail = null;
$managerLoc = null;
$name_for_search = $workerName;

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

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

// Insert Logo in a professional manner
$pdf->Image('5.jpg', 10, 10, -150);
$pdf->SetX(-110);
$pdf->Cell(100, 6, date("l jS \of F Y h:i:s A"), 0, 1, "R");
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 6, 'CRYSTAL CLEAR WASHING BAY', 0, 1, 'C');
$pdf->Ln();

// Manager details from the provided POST data
$pdf->SetFont('Arial', 'BU', 16);
$pdf->Cell(0, 6, 'Location Manager Daily Report Details', 0, 1, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'Manager Name: ' . $workerName, 0, 1, 'L');
$pdf->Cell(0, 6, 'Mobile: ' . $managerMobile, 0, 1, 'L');
$pdf->Cell(0, 6, 'Email: ' . $managerEmail, 0, 1, 'L');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
// set red  color
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(0, 6, 'All amonuts are in Ghana Cedis (GHS)', 0, 1, 'L');

$pdf->Ln();
//set black color
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial', '', 10);
$pdf->SetWidths(array(50, 30, 40, 20, 20, 20));

$sql = "SELECT washer, carNumber, 'action', washeramount, amount, 
        DAYNAME(recdate) AS DayName, DATE_FORMAT(recdate, '%d %M %Y') AS FormattedDate 
        FROM washed WHERE locationUser = '$name_for_search' 
        AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL $workerDays DAY) AND NOW() 
        ORDER BY recdate DESC";




$result = $conn->query($sql);
$daywise_data = [];

while ($row = $result->fetch_assoc()) {
    $overall_total_amount += $row['amount'];
    $overall_total_washer_amount += $row['washeramount'];
    $overall_total_difference += $row['amount'] - $row['washeramount'];
    $overall_record_count++;

    $total_difference += $row['amount'] - $row['washeramount'];

    $day = $row['DayName'];
    $date = $row['FormattedDate'];
    $key = $day . ', ' . $date;

    $daywise_data[$key][] = [
        'washer' => $row['washer'],
        'carNumber' => $row['carNumber'],
        'action' => $row['action'],
        'washerAmount' => $row['washeramount'],
        'amount' => $row['amount'],
        'difference' => $row['amount'] - $row['washeramount']
    ];
}
$grandTotalAmount = 0;
$grandTotalWasherAmount = 0;
$grandTotalDifference = 0;

foreach ($daywise_data as $day => $records) {
    $pdf->SetWidths(array(50, 30, 40, 20, 20, 20));
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, $day, 0, 1, 'L');
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Row(['Worker', 'Car NO#', 'Service', 'Worker Amount', 'Amount', 'Difference']);

    $totalAmountForDay = 0;
    $washerAmountForDay = 0;
    $differenceForDay = 0;

    $grandTotalAmount += $totalAmountForDay;
    $grandTotalWasherAmount += $washerAmountForDay;
    $grandTotalDifference += $differenceForDay;

    foreach ($records as $index => $record) {
        $pdf->Row([
            $record['washer'],
            $record['carNumber'],
            $record['action'],
            $record['washerAmount'],
            $record['amount'],
            $record['difference']
        ]);

        $totalAmountForDay += $record['amount'];
        $washerAmountForDay += $record['washerAmount'];
        $differenceForDay += $record['difference'];
    }

    $pdf->SetFont('Arial', 'B', 10);
    // set red color
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Row([
        'TOTAL',
        '',
        '',
        $washerAmountForDay,
        $totalAmountForDay,
        $differenceForDay
    ]);
    $pdf->Ln(2);
    $pdf->SetTextColor(0, 0, 0);


    
    
        // Extract the actual date part from the formatted $day for comparison
        $formattedDateForComparison = DateTime::createFromFormat('l, d F Y', $day)->format('Y-m-d');
    
        // Fetch data for sub-table
        $sql_misc = "SELECT totalAmount, Description, washer_amount FROM misc WHERE manager_mobile = ? AND DATE_FORMAT(DateAdded, '%Y-%m-%d') = ?";
        $stmt_misc = $conn->prepare($sql_misc);
        $stmt_misc->bind_param("ss", $managerMobile, $formattedDateForComparison);
        $stmt_misc->execute();
        $result_misc = $stmt_misc->get_result();
    
        // Check if there are records for the sub-table
    // Check if there are records for the sub-table
    if ($result_misc->num_rows > 0) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Ln(1);
        $pdf->Cell(0, 6, 'MISCELLANEOUS RECORD FOR '.$day, 0, 1, 'L');
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);

        // Correcting the column widths
        $pdf->SetWidths(array(50, 30, 30, 30));

        // Correcting the header for the sub-table
        $pdf->Row(['Description', 'totalAmount', 'washer_amount', 'difference']);
       
        $ms_total_amount = 0;
        $ms_total_Washer_amount = 0;
        $ms_total_difference = 0;

        while ($row_misc = $result_misc->fetch_assoc()) {
 
            $ms_total_amount += $row_misc['totalAmount'];
            $ms_total_Washer_amount += $row_misc['washer_amount'];
            $ms_total_difference += $row_misc['totalAmount'] - $row_misc['washer_amount'];


                       // get values for overall profit and loss calculation on miscellaneous
            $overall_total_amount_misc += $row_misc['totalAmount'];
            $overall_total_washer_amount_misc += $row_misc['washer_amount'];
            $overall_total_difference_misc += $row_misc['totalAmount'] - $row_misc['washer_amount'];
            $overall_record_count_misc++;


            $difference_misc = $row_misc['totalAmount'] - $row_misc['washer_amount'];
            $pdf->Row([
                $row_misc['Description'],
                $row_misc['totalAmount'],
                $row_misc['washer_amount'],
                $difference_misc
            ]);
        }

         
    // show total $ms_total_amount, $ms_total_Washer_amount, $ms_total_difference
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Row([
        'TOTAL',
        $ms_total_amount,
        $ms_total_Washer_amount,
        $ms_total_difference
    ]);


    // show total for $total_Amount, $total_Washer_Amount, $total_Difference Plus $ms_total_amount, $ms_total_Washer_amount, $ms_total_difference
    $pdf->SetFont('Arial', 'B', 10);

    // set red color
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Row([
        'GRAND TOTAL',
        $totalAmountForDay + $ms_total_amount,
        $washerAmountForDay + $ms_total_Washer_amount,
        $differenceForDay + $ms_total_difference
    ]);


    $pdf->SetTextColor(0, 0, 0);

    
    

    }
    $pdf->Ln(10);



}


// create table for overall profit and loss calculation
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'OVERALL PROFIT AND LOSS CALCULATION', 0, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 10);
$pdf->SetWidths(array(50, 30, 30, 30));

$pdf->Row(['Worker', 'Amount', 'Washer Amount', 'Difference']);

$pdf->SetFont('Arial', 'B', 10);

// set red color
$pdf->SetTextColor(255, 0, 0);
$pdf->Row([
    'TOTAL',
    $overall_total_amount,
    $overall_total_washer_amount,
    $overall_total_difference
]);

$pdf->SetTextColor(0, 0, 0);

// create table for overall profit and loss calculation on miscellaneous
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(10);
$pdf->Cell(0, 6, 'OVERALL PROFIT AND LOSS CALCULATION ON MISCELLANEOUS', 0, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 10);

$pdf->SetWidths(array(50, 30, 30, 30));

// Correcting the column widths
$pdf->SetWidths(array(50, 30, 30, 30));

// Correcting the header for the sub-table
$pdf->Row(['Description', 'totalAmount', 'washer_amount', 'difference']);

$pdf->SetFont('Arial', 'B', 10);

// set red color
$pdf->SetTextColor(0, 0, 0);
$pdf->Row([
    'TOTAL',
    $overall_total_amount_misc,
    $overall_total_washer_amount_misc,
    $overall_total_difference_misc
]);

$pdf->SetTextColor(0, 0, 0);

// show total for $total_Amount, $total_Washer_Amount, $total_Difference Plus $ms_total_amount, $ms_total_Washer_amount, $ms_total_difference
$pdf->SetFont('Arial', 'B', 10);

// set red color
$pdf->SetTextColor(255, 0, 0);

// show total for $total_Amount, $total_Washer_Amount, $total_Difference Plus $ms_total_amount, $ms_total_Washer_amount, $ms_total_difference
$pdf->SetFont('Arial', 'B', 10);


// join miscellaneous and washed table for overall profit and loss calculation
$overall_total_amount = $overall_total_amount + $overall_total_amount_misc;
$overall_total_washer_amount = $overall_total_washer_amount + $overall_total_washer_amount_misc;
$overall_total_difference = $overall_total_difference + $overall_total_difference_misc;

$pdf->Row([
    'GRAND TOTAL',
    $overall_total_amount,
    $overall_total_washer_amount,
    $overall_total_difference
]);


// if thear is no record echo 0
if ($overall_record_count == 0) {
    echo 0;
    exit;
}
else{
   echo 11;
}


$pdf->Output('F', 'managerDailyReport.pdf');
$conn->close();
?>
