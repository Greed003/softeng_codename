<?php
require 'connection.php';
require_once 'auth_check.php';
// SQL Query to get the product data, including category name
$sql = "SELECT 
            p.product_id, 
            p.name, 
            p.description, 
            pt.name AS category, 
            p.img, 
            ps.size, 
            ps.price
        FROM 
            products p
        JOIN 
            product_size ps ON p.product_id = ps.product_id
        JOIN 
            product_type pt ON p.type_id = pt.type_id";

// Execute the query
$stmt = $pdo->query($sql);

// Fetch the data
$products = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Group products by product_id
    $products[$row['product_id']]['name'] = $row['name'];
    $products[$row['product_id']]['description'] = $row['description'];
    $products[$row['product_id']]['category'] = $row['category'];  // Category name from product_type
    $products[$row['product_id']]['img'] = $row['img'];
    $products[$row['product_id']]['sizes'][] = [
        'size' => $row['size'],
        'price' => $row['price']
    ];
}

// Loop through each product and create a table row
foreach ($products as $index => $product) {
    // Generate the product size options dynamically
    $sizeOptions = '';
    foreach ($product['sizes'] as $size) {
        $sizeOptions .= "<option value='{$size['size']}' data-price='{$size['price']}'>{$size['size']}</option>";
    }

    // Output the table row with product_id as a data attribute
    echo "<tr data-product-id='{$index}'>
            <td>" . ($index + 1) . "</td>
            <td>{$product['name']}</td>
            <td>{$product['description']}</td>
            <td>{$product['category']}</td>
            <td><img src='{$product['img']}' class='table-image' /></td>
            <td>
                <select id='productSize' class='psTable' name='size'>
                    {$sizeOptions}  <!-- Dynamic size options -->
                </select>
            </td>
            <td class='price'>₱{$product['sizes'][0]['price']}</td> <!-- Default price from first size option -->
            <td>
                <img src='img/delete1.png' class='action-icon delete-icon' />
                <img src='img/edit.png' class='action-icon edit-icon' />
            </td>
        </tr>";
}
?>
