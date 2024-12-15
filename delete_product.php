<?php
require 'connection.php';

header('Content-Type: application/json');

// Check if the request is a POST request and contains JSON data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if product_id is provided in the request
    if (isset($data['product_id'])) {
        $productId = $data['product_id'];

        // SQL Query to delete the product from the products table
        $sql = "DELETE FROM products WHERE product_id = :product_id";

        try {
            // Prepare and execute the SQL query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            // Check if any row was affected (i.e., product was deleted)
            if ($stmt->rowCount() > 0) {
                // Send success response
                echo json_encode(['success' => true]);
            } else {
                // Send failure response (product not found or could not be deleted)
                echo json_encode(['success' => false, 'message' => 'Product not found or could not be deleted.']);
            }
        } catch (PDOException $e) {
            // Handle database error
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        // Send error if product_id is not provided
        echo json_encode(['success' => false, 'message' => 'Product ID is required.']);
    }
} else {
    // Send error if the request is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
