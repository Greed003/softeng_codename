<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting

require 'connection.php'; // Include your database connection

// Retrieve the JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is correctly retrieved
if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$order_id = $data['order_id'];

try {
    // Ensure order_id is an integer
    if (!is_numeric($order_id)) {
        echo json_encode(['success' => false, 'error' => 'Order ID must be an integer']);
        exit;
    }

    // Prepare the SQL statement with placeholders
    $sql = "DELETE FROM orders WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['order_id' => $order_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Order Cancelled successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Order not found or already cancelled']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
