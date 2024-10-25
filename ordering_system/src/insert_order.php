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
        INSERT INTO order_items (order_id, product_id, quantity, price) 
        VALUES (:order_id, :product_id, :quantity, :price)
    ");

    // Prepare a statement to get product_id based on product name and size
    $productStmtWithSize = $pdo->prepare("SELECT product_id FROM products WHERE name = :name AND size = :size");
    $productStmtWithoutSize = $pdo->prepare("SELECT product_id FROM products WHERE name = :name AND size IS NULL");

    foreach ($orderItems as $item) {
        $productId = null;

        // Check if size is provided or is an empty string
        if (isset($item['size']) && $item['size'] !== '') {
            // Use the product statement that includes size
            $productStmtWithSize->execute(['name' => $item['productName'], 'size' => $item['size']]);
            $productIdResult = $productStmtWithSize->fetch(PDO::FETCH_ASSOC);
        } else {
            // Use the product statement that does not include size
            $productStmtWithoutSize->execute(['name' => $item['productName']]);
            $productIdResult = $productStmtWithoutSize->fetch(PDO::FETCH_ASSOC);
        }

        // Check if we found the product
        if ($productIdResult) {
            $productId = $productIdResult['product_id'];

            // Insert each item into order_items
            $stmt->execute([
                'order_id' => $orderId,
                'product_id' => $productId,
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
