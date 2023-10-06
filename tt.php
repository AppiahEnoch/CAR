<?php
session_start();
require_once './vendor/autoload.php';
include "./config.php";
require('mc_table.php');


















































function fetchRecords($conn, $workerName, $workerDays) {
    $sql = "SELECT 
    location, 
    washer, 
    DATE_FORMAT(recdate, '%W, %D %M, %Y') AS workDay, 
    COUNT(DISTINCT carNumber) AS cars_worked, 
    SUM(washeramount) AS washer_amount, 
    SUM(amount) AS total_amount 
    FROM washed 
    WHERE 
    washer = '$workerName' 
    AND recdate BETWEEN DATE_SUB(NOW(), INTERVAL $workerDays DAY) AND NOW()
    GROUP BY location, washer, DATE(recdate);
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    

    return $result->fetch_all(MYSQLI_ASSOC);
}


function generateReport($conn, $records, $groupByColumn1 = null, $groupByColumn2 = null, $columnWidths = [], $afterTableCallback = null) {
    $pdf = new PDF_MC_Table();
    $pdf->AddPage('L', 'A4');
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
        $totalAmount = $totals['totalAmount']; // column name from parent table




  




   


//



    }

    $pdf->SetFont('Arial', 'B', 12);
 
    $pdf->SetTextColor(255, 0, 0);

    $pdf->Row(['GRAND TOTAL'] + array_values($grandTotals));
    //color black
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Output('D', 'Report.pdf');

    if ($conn && $conn instanceof mysqli) {
        $conn->close();
    }
}







$workerName = "KOFI BOAKYE";
$workerDays = 7;
$records = fetchRecords($conn, $workerName, $workerDays);
$widths = [30, 30, 20];  // or any other set of numbers for column widths
generateReport($conn, $records, null,null, $widths);



















?>
