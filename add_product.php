<?php
require 'connection.php';
// Get the raw POST data
$data = json_decode(file_get_contents("php://input"));

// Debug: Log incoming data (useful for debugging)
error_log(print_r($data, true));

// Check if required fields are present
if (isset($data->product_name) && isset($data->product_description) && isset($data->product_price) && isset($data->product_category)) {
    // Extract the data
    $productName = $data->product_name;
    $productDescription = $data->product_description;
    $productCategory = $data->product_category;  // Category name or identifier
    $productSize = !empty($data->product_size) ? $data->product_size : null;  // Optional field
    $productPrice = $data->product_price;
    $productImage = $data->product_image;

    try {
        // Get the product category ID from the 'product_type' table based on the category name
        $stmt = $pdo->prepare("SELECT type_id FROM product_type WHERE name = ?");
        $stmt->execute([$productCategory]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if category exists
        if ($category) {
            $productCategoryId = $category['type_id'];

            // Insert the new product into the products table
            $stmt = $pdo->prepare("INSERT INTO products (name, description, type_id, img) VALUES (?, ?, ?, ?)");
            $stmt->execute([$productName, $productDescription, $productCategoryId, $productImage]);

            // Get the inserted product ID
            $productId = $pdo->lastInsertId();

            // If size is provided, insert it into the product_size table
            if ($productSize) {
                $stmt = $pdo->prepare("INSERT INTO product_size (product_id, size, price) VALUES (?, ?, ?)");
                $stmt->execute([$productId, $productSize, $productPrice]);
            }else{
                $stmt = $pdo->prepare("INSERT INTO product_size (product_id, price) VALUES (?, ?)");
                $stmt->execute([$productId, $productPrice]);
            }

            // Success response
            echo json_encode(['success' => true, 'message' => 'Product added successfully!']);
        } else {
            // Category not found error
            echo json_encode(['success' => false, 'message' => 'Category not found!']);
        }
    } catch (PDOException $e) {
        // Error handling for database issues
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    // Error response for missing required fields
    echo json_encode(['success' => false, 'message' => 'Missing required fields!']);
}
?>
