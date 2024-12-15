<?php
require 'connection.php'; // Include your DB connection file

$typeId = isset($_GET['type_id']) ? intval($_GET['type_id']) : 5; // Default to type_id 5

// Fetch all products and sizes for the specified type_id
$sql = "
  SELECT 
    p.product_id,
    p.name, 
    p.description, 
    p.type_id,
    p.img, 
    ps.size, 
    ps.price
  FROM 
    products p
  JOIN 
    product_size ps ON p.product_id = ps.product_id
  WHERE p.type_id = :type_id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['type_id' => $typeId]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$products = [];
foreach ($rows as $row) {
    $products[$row['product_id']]['name'] = $row['name'];
    $products[$row['product_id']]['description'] = $row['description'];
    $products[$row['product_id']]['img'] = $row['img'];
    $products[$row['product_id']]['sizes'][] = [
        'size' => $row['size'],
        'price' => $row['price']
    ];
}

foreach ($products as $productId => $product): ?>                             
  <div class="product" 
    data-product-id="<?php echo $productId; ?>"
    data-product-name="<?php echo $product['name']; ?>"
    data-product-description="<?php echo $product['description']; ?>"
    data-product-img="<?php echo $product['img']; ?>"
    data-type-id="<?php echo $typeId; ?>"
    data-sizes='<?php echo json_encode($product['sizes']); ?>'
  >
    <img src="<?php echo $product['img']; ?>" style="border-radius: 20px;" id="icon" width="309px" height="309px"/>
    <h2><?php echo $product['name']; ?></h2>
  </div>
<?php endforeach; ?>


