<?php
require 'connection.php'; // Include your DB connection file

$typeId = isset($_GET['type_id']) ? intval($_GET['type_id']) : 5; // Default to type_id 5

$sqlAddons = "SELECT addon_id, name, price FROM addons WHERE type_id = :type_id";
$stmtAddons = $pdo->prepare($sqlAddons);
$stmtAddons->execute(['type_id' => $typeId]);
$addons = $stmtAddons->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="ao" id="addon">
<?php if (!empty($addons)): ?>
  <h5 class="hh5">ADD ONS</h5>
  <div class="pdrow cf">
    
      <?php foreach ($addons as $addon): ?>
        <div class="addons" 
          data-add-ons=""
          data-add-id="<?php echo $addon['addon_id']; ?>" 
          data-add-name="<?php echo $addon['name']; ?>" 
          data-add-price="<?php echo $addon['price']; ?>">
          <?php echo $addon['name']; ?> 
        </div>
      <?php endforeach; ?> 
  </div>
  <?php endif; ?>
</div>
