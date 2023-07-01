<?php
require_once 'config.php';

if (isset($_POST['id'], $_POST['column'], $_POST['value'])) {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Prepare the SQL statement to update the record
    $sql = "UPDATE washed SET $column = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $value, $id);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating record']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
