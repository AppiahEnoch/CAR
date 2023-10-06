<?php

session_start();
include "config.php";
'./vendor/autoload.php';
require('mc_table.php');

$finalFileName='report/workerDailyReport.pdf';

$pageTitle="DAILY WASHER REPORT";
$workerNameSanitized = "KOFI BOAKYE";
$workerDaysSanitized = 7;

// CREATE A PDF HEADER
// SELECT app_name, location, email FROM app;

$sql1 = "SELECT wfullname as name, wmobile as mobile, wemail as email FROM washer WHERE wfullname  = '$workerNameSanitized'";

//$sql1 = "SELECT `app_name` AS BUSSINESS,`email`,`location`as Loc FROM `app` WHERE 1";





// SECOND QUERY YOU MAY FORM YOUR QUERY IN ANY WAY HERE I AM JUST GIVING AN EXAMPLE


$workerNameSanitized = "KOFI BOAKYE";
$workerDaysSanitized = 7;

$sql2 = "SELECT 
            location, 
            carNumber,
            action AS service,
            DATE_FORMAT(recdate, '%W, %D %M, %Y') AS workDay, 
            carNumber AS cars_worked, 
            washeramount AS washer_amount, 
            amount AS total_amount,
            (amount - washeramount) AS difference 
        FROM washed 
        WHERE 
            washer = '$workerNameSanitized' 
            AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL $workerDaysSanitized DAY) AND NOW()
        GROUP BY location, DATE(recdate), carNumber, 'action';";




















// MAKE THESE NULL IF YOU WILL NOT NEED THEM

$criteria1 = 'location';
$criteria2 = 'workDay';


$criteria1 =null;
$criteria2 = null;


// SET COLUMN WIDTHS
$widths = [30, 30, 20];  

















$logo = "5.jpg"; // replace with the actual path to your company logo
$pdf = createReportHeading($conn, $sql1, $pageTitle, $logo);


// CREATE TABLES

$workerName = "KOFI BOAKYE";
$workerDays = 7;
$records = fetchRecords($conn, $sql2);

generateReport($pdf,$conn, $records,$criteria1,$criteria2, $widths,$finalFileName);




function createReportHeading($conn, $sql, $reportTitle = 'Report', $logoPath = null) {
    $pdf = new PDF_MC_Table();
    $pdf->AddPage('L', 'A4');
  // Right aligned cell

    $pdf->SetFont('Arial', 'I', 12);
    $timestamp = date("l, jS F, Y , h:i a");
    $pdf->SetXY(-150, 10);  // Adjust position for right alignment
    $pdf->Cell(140, 10, $timestamp, 0, 2, 'R');
    $pdf->SetFont('Arial', 'I', 8);
    //reduce line   space\
  

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // If logo is provided, add it to the top left
        if ($logoPath && file_exists($logoPath)) {
            $pdf->Image($logoPath, 5, 8, 33);
            $pdf->Ln(5);  // Adjusted for better spacing after the logo
        }

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 10, $reportTitle, 0, 1, 'C');

        // Loop through each column dynamically
        foreach ($user as $columnName => $columnValue) {
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(0, 10, strtoupper($columnName) . ": " . strtoupper($columnValue), 0, 1, 'C');
            $pdf->Ln(-2);
        }

        $pdf->Ln();
        $pdf->SetDrawColor(0, 0, 0); // Black color
        $pdf->Line(10, $pdf->GetY(), 290, $pdf->GetY());
        $pdf->Ln(5);
    }

    return $pdf; // Return the PDF object with the heading for further modifications or output
}













function fetchRecords($conn, $sql) {
    // Ensure workerName and workerDays are properly sanitized


    $result = $conn->query($sql);

    if (!$result) {
        die("Error executing query: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}




function generateReport($pdf,$conn, $records, $groupByColumn1 = null, $groupByColumn2 = null, $columnWidths = [], $afterTableCallback = null,$finalFileName=null) {

    $pdf->SetFont('Arial', 'B', 10);

    if (is_null($records) || !is_array($records) || empty($records)) {
        return;
    }

    $groupedRecords = [];
    foreach ($records as $record) {
        $groupValue1 = $groupByColumn1 ? $record[$groupByColumn1] : '';
        $groupValue2 = $groupByColumn2 ? $record[$groupByColumn2] : '';

        // Create a composite key for grouping
        $compositeKey = "{$groupValue1}_{$groupValue2}";

        if (!isset($groupedRecords[$compositeKey])) {
            $groupedRecords[$compositeKey] = [];
        }
        $groupedRecords[$compositeKey][] = $record;
    }

    $grandTotals = [];
    $defaultWidth = 40;

    foreach ($groupedRecords as $compositeKey => $groupRecords) {
        $pdf->SetFont('Arial', 'B', 12);

        // Split the composite key back into its components for display
        list($groupValue1, $groupValue2) = explode('_', $compositeKey);

        if ($groupByColumn1) $pdf->Cell(0, 6, strtoupper($groupByColumn1) . ": " . $groupValue1, 0, 1, 'L');
        if ($groupByColumn2) $pdf->Cell(0, 6, strtoupper($groupByColumn2) . ": " . $groupValue2, 0, 1, 'L');
        
        $pdf->Ln(4);

        $columns = array_keys($groupRecords[0]);
        $pdf->SetFont('Arial', 'B', 10);

        $widths = [];
        foreach ($columns as $index => $column) {
            $widths[] = isset($columnWidths[$index]) ? $columnWidths[$index] : $defaultWidth;
        }
        $pdf->SetWidths($widths);
        // bold black font
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 11);


        $pdf->Row($columns);
        $pdf->SetFont('Arial', '', 10);

        $totals = [];
        foreach ($groupRecords as $record) {
            $rowValues = [];
            foreach ($columns as $column) {
                $value = $record[$column];
                $rowValues[] = $value;

                if (is_numeric($value)) {
                    if (!isset($totals[$column])) $totals[$column] = 0;
                    $totals[$column] += $value;

                    if (!isset($grandTotals[$column])) $grandTotals[$column] = 0;
                    $grandTotals[$column] += $value;
                } else {
                    if (!isset($totals[$column])) $totals[$column] = 0;
                    $totals[$column] += 1;  // Count

                    if (!isset($grandTotals[$column])) $grandTotals[$column] = 0;
                    $grandTotals[$column] += 1;  // Count
                }
            }
            $pdf->Row($rowValues);
        }

        $pdf->SetFont('Arial', 'B', 10);
        //color red
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Row(array_values($totals));
        $pdf->Ln(10);
        $pdf->SetTextColor(0, 0, 0);

  

// CREATE SUB TABLE HERE 
     //   $totalAmount = $totals['totalAmount']; // column name from parent table




  




   


//



    }

    $pdf->SetFont('Arial', 'B', 12);
 
    $pdf->SetTextColor(255, 0, 0);

    $pdf->Row(['GRAND TOTAL'] + array_values($grandTotals));
    //color black
    $pdf->SetTextColor(0, 0, 0);

    // set font regular
    $pdf->SetFont('Arial', '', 8);

    $pdf->Ln(-2);
    $pdf->Cell(250, 10, 'Powered By AECleanCodes', 0, 2, 'R'); 
    $pdf->Ln(-5);
    $pdf->Cell(250, 10, '0549822202', 0, 2, 'R'); 

    $pdf->Output('F',$finalFileName);

    if ($conn && $conn instanceof mysqli) {
        $conn->close();
    }
}


























?>






















































