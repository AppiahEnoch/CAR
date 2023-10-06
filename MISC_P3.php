<?php
session_start();
require_once './vendor/autoload.php';
include "./config.php";


require('mc_table.php');

ob_end_clean();

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

// Insert Logo
$pdf->Image('5.jpg',10,10,-150);

$pdf->SetX(-110);
$pdf->Cell(100, 6, date("l jS \of F Y h:i:s A"), 0, 1, "R");
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 6, 'CRYSTAL CLEAR WASHING BAY', 0, 1, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', 'BU', 16);
$pdf->Cell(0, 6, 'Miscellaneous Report', 0, 1, 'C');

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$pdf->SetWidths(array(60, 40, 30, 30, 30));

$sql = "SELECT misc.*, washer.wfullname,
        MONTHNAME(misc.DateAdded) AS MonthName,
        YEAR(misc.DateAdded) AS YearNum
        FROM misc
        JOIN washer ON misc.washer_id = washer.wmobile
        ORDER BY YearNum, MONTH(misc.DateAdded)";

$result = $conn->query($sql);

$monthwise_data = [];

while ($row = $result->fetch_assoc()) {
    $month = $row['MonthName'];
    $year = $row['YearNum'];

    $key = $year . ' - ' . $month;

    $monthwise_data[$key][] = [
        'description' => $row['Description'],
        'totalAmount' => $row['totalAmount'],
        'washerAmount' => $row['washer_amount'],
        'difference' => $row['totalAmount'] - $row['washer_amount'],
        'wfullname' => $row['wfullname']
    ];
}

foreach ($monthwise_data as $month => $records) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, $month, 0, 1, 'L');
    $pdf->Ln(2);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Row(['Description', 'Total Amount', 'Washer Amount', 'Difference', 'Washer Fullname']);

    $totalAmountForMonth = 0;
    $washerAmountForMonth = 0;
    $differenceForMonth = 0;

    foreach ($records as $index => $record) {
        $pdf->Row([
            $record['description'],
            $record['totalAmount'],
            $record['washerAmount'],
            $record['difference'],
            $record['wfullname']
        ]);

        $totalAmountForMonth += $record['totalAmount'];
        $washerAmountForMonth += $record['washerAmount'];
        $differenceForMonth += $record['difference'];
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Row([
        '',
        'Total: ' . $totalAmountForMonth,
        'Total: ' . $washerAmountForMonth,
        'Total: ' . $differenceForMonth,
        ''
    ]);
    $pdf->Ln(10);
}

$pdf->Output('D', 'Washer_Misc_Report.pdf');

$conn->close();
?>
