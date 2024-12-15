<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting

require 'connection.php'; // Your database connection file

// Retrieve the JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is correctly retrieved
if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$order_id = $data['order_id'];
$status = $data['status'];
$cash = $data['cash'];
$change = $data['change'];

try {
    // Ensure order_id is an integer
    if (!is_numeric($order_id)) {
        echo json_encode(['success' => false, 'error' => 'Order ID must be an integer']);
        exit;
    }

    // Ensure cash and change are numeric values
    if (!is_numeric($cash) || !is_numeric($change)) {
        echo json_encode(['success' => false, 'error' => 'Cash and Change must be numeric values']);
        exit;
    }

    // Prepare the SQL statement with placeholders
    $sql = "UPDATE orders SET status = :status, cash = :cash, change = :change WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'status' => $status,
        'cash' => $cash,
        'change' => $change,
        'order_id' => $order_id
    ]);

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
