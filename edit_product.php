<?php
require 'connection.php';

// Read the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Log the received data for debugging
error_log("Received data: " . print_r($data, true));

// Check if the required POST data is available
if (isset($data['product_id']) && isset($data['description']) && isset($data['image']) && isset($data['price']) && isset($data['size'])) {
    $product_id = $data['product_id'];
    $description = $data['description'];
    $image = $data['image'];
    $price = $data['price'];
    $size = $data['size']; // Size is also passed (if available)

    // Prepare the SQL query to update the product details
    $sql = "UPDATE products SET description = :description, img = :image WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':product_id', $product_id);

    // Execute the update query for product details
    $stmt->execute();

    // Now, handle the price and size in the product_size table
    if ($size) {
        // Check if the size already exists for the product
        $check_size_sql = "SELECT * FROM product_size WHERE product_id = :product_id AND size = :size";
        $stmt_check_size = $pdo->prepare($check_size_sql);
        $stmt_check_size->bindParam(':product_id', $product_id);
        $stmt_check_size->bindParam(':size', $size);
        $stmt_check_size->execute();

        if ($stmt_check_size->rowCount() > 0) {
            // If the size exists, update the price for that size
            $sql_price_update = "UPDATE product_size SET price = :price WHERE product_id = :product_id AND size = :size";
            $stmt_price = $pdo->prepare($sql_price_update);
            $stmt_price->bindParam(':price', $price);
            $stmt_price->bindParam(':product_id', $product_id);
            $stmt_price->bindParam(':size', $size);

            // Execute the update for the size's price
            $stmt_price->execute();
        } else {
            // If the size doesn't exist, insert a new record for that size and price
            $sql_price_insert = "INSERT INTO product_size (product_id, size, price) VALUES (:product_id, :size, :price)";
            $stmt_insert = $pdo->prepare($sql_price_insert);
            $stmt_insert->bindParam(':product_id', $product_id);
            $stmt_insert->bindParam(':size', $size);
            $stmt_insert->bindParam(':price', $price);

            // Execute the insert query for the new size
            $stmt_insert->execute();
        }
    }

    // Return a success message
    echo json_encode(['success' => true, 'message' => 'Product updated successfully']);
} else {
    // If any required data is missing, return an error message
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
?>
