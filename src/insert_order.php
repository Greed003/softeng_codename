<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting

require 'connection.php'; // Your database connection file
if (!empty($_POST)) {
    $data = $_POST; // Use directly from $_POST if available (e.g., during testing)
} else {
    // Retrieve the JSON data
    $data = json_decode(file_get_contents('php://input'), true);
}
// Check if data is correctly retrieved
if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$userName = $data['userName'];
$total = $data['total'];
$orderItems = $data['orderItems'];

try {
    // Begin a transaction
    $pdo->beginTransaction();

    // Step 1: Insert the order into the `orders` table
    $stmt = $pdo->prepare("INSERT INTO orders (name, total) VALUES (:name, :total)");
    $stmt->execute(['name' => $userName, 'total' => $total]);

    // Get the last inserted `order_id`
    $orderId = $pdo->lastInsertId();

    // Step 2: Insert each item into `order_items`
    $stmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product_id, size, add_ons, quantity, price) 
        VALUES (:order_id, :product_id, :size, :add_ons, :quantity, :price)
    ");

    // Prepare a statement to get product_id based on product name (ignore size)
    $productStmt = $pdo->prepare("SELECT product_id FROM products WHERE name = :name");

    foreach ($orderItems as $item) {
        $productId = null;

        // Fetch product_id by name only (no size consideration)
        $productStmt->execute(['name' => $item['productName']]);
        $productIdResult = $productStmt->fetch(PDO::FETCH_ASSOC);

        // Check if we found the product
        if ($productIdResult) {
            $productId = $productIdResult['product_id'];

            // Set the size to null if not provided
            $size = isset($item['size']) ? $item['size'] : null;

            // Handle add_ons: if string, split by newline; if array, process directly
            $addOns = '';
            if (isset($item['add_ons'])) {
                if (is_string($item['add_ons'])) {
                    $addOns = implode(", ", array_map('trim', explode("\n", $item['add_ons'])));
                } elseif (is_array($item['add_ons'])) {
                    $addOns = implode(", ", array_map('trim', $item['add_ons']));
                }
            }

            // Insert each item into order_items with all necessary fields
            $stmt->execute([
                'order_id' => $orderId,
                'product_id' => $productId,
                'size' => $size,
                'add_ons' => $addOns,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => "Product not found: " . $item['productName']]);
            exit; // Exit if any product is not found
        }
    }

    // Commit the transaction
    $pdo->commit();

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Rollback the transaction on error
    $pdo->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
