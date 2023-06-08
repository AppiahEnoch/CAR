<?php
include "config.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare data from the request
    $newText = $_POST['newText'];
    $rowId = $_POST['rowId']; // Use rowId instead of rowIndex
    $colIndex = $_POST['colIndex'];

    // Define which column corresponds to which colIndex
    switch($colIndex) {
        case 0:
            $columnName = 'carname';
            break;
        case 1:
            $columnName = 'action';
            break;
        case 2:
            $columnName = 'amount';
            break;
        case 3:
            $columnName = 'washeramount';
            break;
        case 4:
            $columnName = 'car_recdate';
            break;
        case 5:
            $columnName = 'img';
            break;
        default:
            die("Invalid column index.");
    }

    // Prepare your query
    $stmt = $conn->prepare("UPDATE `car` SET `".$columnName."` = ? WHERE id = ?");
    if (!$stmt) {
        printf("Errormessage: %s\n", $conn->error);
    }
    


    // Bind parameters
    $stmt->bind_param("si", $newText, $rowId); // "si" means we are binding 1 string (s) and 1 integer (i)

    // Execute the query
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        die('Error in update query');
    }
    
    $stmt->close();
}
?>
