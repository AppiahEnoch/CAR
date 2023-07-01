<?php
require_once 'config.php';

// Check if the ID is provided in the POST data
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement to delete the record
    $stmt = $conn->prepare("DELETE FROM washed WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        // Successfully deleted
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
    } else {
        // Failed to delete
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Error deleting record']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'ID not provided']);
}

?>
