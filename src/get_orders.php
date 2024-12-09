<?php
require 'connection.php';

try {
    // Query to fetch orders
    $stmt = $pdo->query("
        SELECT o.order_id, o.name AS customer_name, o.service, o.status, o.total, o.cash, o.change, oi.quantity, oi.size, oi.add_ons, oi.price, p.name AS product_name, o.order_date
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.product_id
        ORDER BY o.order_date DESC
    ");

    $orders = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Group orders by order_id
        if (!isset($orders[$row['order_id']])) {
            $orders[$row['order_id']] = [
                'customer_name' => $row['customer_name'],
                'service' => $row['service'],
                'status' => $row['status'],
                'total' => $row['total'],
                'cash' => $row['cash'],
                'change' => $row['change'],
                'items' => [],
            ];
        }

        $orders[$row['order_id']]['items'][] = [
            'quantity' => $row['quantity'],
            'product_name' => $row['product_name'],
            'size' => $row['size'],
            'price' => $row['price'],
            'add_ons' => $row['add_ons'] ? $row['add_ons'] : null,
        ];
    }

    // Generate HTML output
    foreach ($orders as $order) {
        echo '<div class="orders" data-status="' . htmlspecialchars($order['status']) . '">';
        echo '  <div class="row">';
        echo '      <h2 class="mar">Name: ' . htmlspecialchars($order['customer_name']) . '</h2>';
        echo '      <h2 class="mar">Service: ' . htmlspecialchars($order['service']) . '</h2>';
        echo '      <h2 class="mar w">Total: ₱' . htmlspecialchars($order['total']) . '</h2>';
        echo '      <h2 class="mar">Status: ' . htmlspecialchars($order['status']) . '</h2><div class="del"><button class="done delete">Delete</button></div>';
        echo '      <img src="img/arrow_down.png" class="mar toggle-arrow" width="30px" height="30px" />';
        echo '  </div>';

        echo '  <div class="drop">';
        echo '      <div class="line"></div>';
        echo '      <table>';
        echo '          <tr>';
        echo '              <th><h2 class="mar">Items</h2></th>';
        echo '              <th><h2 class="mar">Price</h2></th>';
        echo '          </tr>';

        foreach ($order['items'] as $item) {
            echo '<tr>';
            echo '  <td>';
            echo '      <h3 class="mar" id="product">' . htmlspecialchars($item['quantity']) . 'x ' . htmlspecialchars($item['product_name']) . ' ' . htmlspecialchars($item['size']) . '</h3>';
            if ($item['add_ons']) {
                echo '      <h4 class="mar" id="addons">Add ons: ' . nl2br(htmlspecialchars($item['add_ons'])) . '</h4>';
            } else {
                echo '      <h4 class="mar" id="addons"></h4>';
            }
            echo '  </td>';
            echo '  <td><h3 class="mar" id="price">₱' . htmlspecialchars($item['price']) . '</h3></td>';
            echo '</tr>';
        }

        echo '      </table>';
        echo '      <div class="line"></div>';

        // Check if the status is "Completed"
        if ($order['status'] == 'Completed') {
            // Show this if status is completed
            echo '      <table>';
            echo '          <tr>';
            echo '              <th><h2 class="mar">Total:</h2></th>';
            echo '              <th><h2 class="mar" id="total">₱' . htmlspecialchars($order['total']) . '</h2></th>';
            echo '          </tr>';
            echo '          <tr>';
            echo '              <td><h3 class="mar">Cash:</h3></td>';
            echo '              <td><h3 class="mar">₱' . htmlspecialchars($order['cash']) . '</h3></td>';
            echo '          </tr>';
            echo '          <tr>';
            echo '              <td><h3 class="mar">Change:</h3></td>';
            echo '              <td><h3 class="mar" id="change">₱' . htmlspecialchars($order['change']) . '</h3></td>';
            echo '          </tr>';
            echo '          <tr>';
            echo '              <td></td>';
            echo '              <td><button class="done print show">Print</button></td>';
            echo '          </tr>';
            echo '      </table>';
        } else {
            // Show this if status is not completed
            echo '      <table>';
            echo '          <tr>';
            echo '              <th><h2 class="mar">Total:</h2></th>';
            echo '              <th><h2 class="mar" id="total">₱' . htmlspecialchars($order['total']) . '</h2></th>';
            echo '          </tr>';
            echo '          <tr>';
            echo '              <td><h3 class="mar">Cash:</h3></td>';
            echo '              <td><input class="input2" type="text" id="cash" name="cash" placeholder=""/></td>';
            echo '          </tr>';
            echo '          <tr class="table"></tr>';
            echo '          <tr>';
            echo '              <td></td>';
            echo '              <td><button class="done submit">Submit</button><button class="done print">Print</button></td></td>';
            echo '          </tr>';
            echo '      </table>';
        }

        echo '  </div>';
        echo '</div>';
    }
} catch (PDOException $e) {
    echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>
