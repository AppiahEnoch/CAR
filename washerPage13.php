<?php

include "config.php";
require __DIR__ . '/vendor/autoload.php';

if (!isset($_SESSION)) {
    session_start();
}

$LOC= $_SESSION["LOC"];
$locUser=  $_SESSION["username"];
$userMobile= $_SESSION["mobile"];

$carname= $_POST["carname"];
$washer=$_POST["washer"];
$action= $_POST["action"];
$amount=$_POST["amount"];
$washeramount=$_POST["washeramount"];
$carNumber=$_POST["carNumber"];

$receiptID=generateUniqueID();

$stmt = $conn->prepare("INSERT INTO washed 
(washer, carname, carNumber, `action`, amount, washeramount,
 locationUser,`location`,receiptid)
 VALUES (?,?, ?, ?, ?, ?,?,?,?)");

$stmt->bind_param("sssssssss",
 $washer, $carname, $carNumber,
  $action, $amount, $washeramount,
  $locUser,$LOC,$receiptID);

$stmt->execute();

$stmt->close();
$conn->close();

createReceipt();

function createReceipt(){
    global $amount, $carname, $washer, $action, $washeramount, $carNumber, $receiptID;

    $totalAmount=0;

    $CEO= $_SESSION["ceo"];
    $CEOM= $_SESSION["ceoM"];
    $LOC= $_SESSION["LOC"];
    $locUser=  $_SESSION["username"];
    $userMobile= $_SESSION["mobile"];

    $pdf = new FPDF('P', 'mm', array(80, 160));
    $pdf->AddPage();
    $pdf->SetMargins(10, 10, 10);

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Crystal Clear Washing Bay', 0, 1, 'C');
    $pdf->Ln(-5);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'CEO: '.$CEO, 0, 1, 'C');
    $pdf->Ln(-5);

    $pdf->Cell(0, 10, 'Mobile: '.$CEOM, 0, 1, 'C');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Location: '.$LOC, 0, 1, 'C');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Location Manager: '.$locUser, 0, 1, 'C');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Mobile:'.$userMobile, 0, 1, 'C');
    $pdf->Ln(-5);

    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(30, 10, 'Car Number:', 0, 0);
    $pdf->Cell(40, 10, $carNumber, 0, 1);

    $pdf->Cell(30, 10, 'Washer:', 0, 0);
    $pdf->Cell(40, 10, $washer, 0, 1);

    $pdf->SetLineWidth(0.5);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Line(5, 50, 70, 50);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Service', 1, 0);
    $pdf->Cell(23, 10, 'Amt(GHS)', 1, 1);

    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(40, 10, $action, 1, 0);
    $pdf->Cell(23, 10, $amount, 1, 1);

    // Add the total amount
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Total', 1, 0);
    $pdf->Cell(23, 10, $amount, 1, 1);  // Here the total amount is the same as the single service amount

    $curDate = date('l, jS F, Y');
    $pdf->Cell(0, 10, $curDate, 0, 1, 'C');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, $receiptID, 0, 1, 'C');

    $pdf->Output('F',  "report/".$locUser.".pdf");
}

echo $locUser.".pdf";
exit;

function generateUniqueID() {
    $seed = md5(uniqid(mt_rand(), true));
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}[]<>?';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 27; $i++) {
        $charIndex = hexdec(substr($seed, $i, 1)) % $charactersLength;
        $randomString .= $characters[$charIndex];
    }
    return $randomString;
}

?>
