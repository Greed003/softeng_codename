<?php
require 'connection.php'; // Make sure to include your DB connection file

$typeId = isset($_GET['type_id']) ? intval($_GET['type_id']) : 5; // Default to type_id 5

// Use a subquery to get the minimum price and its associated size
$sql = "
    SELECT p.name, p.img, p.price, p.size 
    FROM products p
    INNER JOIN (
        SELECT name, MIN(price) as min_price
        FROM products
        WHERE type_id = :type_id
        GROUP BY name
    ) AS min_prices ON p.name = min_prices.name AND p.price = min_prices.min_price
    WHERE p.type_id = :type_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['type_id' => $typeId]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row): ?>                             
  <div class="product" data-product-name="<?php echo $row['name']; ?>">
    <img src="<?php echo $row['img']; ?>" style="border-radius: 20px;" id="icon" width="309px" height="309px"/>
    <h2><?php echo $row['name']; ?></h2>
    <div class="price">
      <h3>₱<?php echo $row['price']; ?></h3>
      <h3 id="size"><?php echo $row['size']; ?></h3>
      <img src="img/plus.png" class="add" id="icon" alt="plus" width="47px" height="47px" />
    </div>
  </div>
<?php endforeach; ?>