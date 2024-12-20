<?php
require 'connection.php';
require_once 'auth_check.php';
try {
    // Query to fetch orders
    $stmt = $pdo->query("
        SELECT 
            o.order_id, 
            o.name AS customer_name, 
            o.service, 
            o.status, 
            o.total, 
            o.cash, 
            o.change, 
            oi.quantity, 
            oi.size, 
            oi.price, 
            p.name AS product_name, 
            o.order_date,
            STRING_AGG(a.name, ', ') AS addon_names -- Aggregates add-on names
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.product_id
        LEFT JOIN item_addons ia ON oi.order_item_id = ia.order_item_id
        LEFT JOIN addons a ON ia.addon_id = a.addon_id
        GROUP BY 
            o.order_id, 
            o.name, 
            o.service, 
            o.status, 
            o.total, 
            o.cash, 
            o.change, 
            oi.quantity, 
            oi.size, 
            oi.price, 
            p.name, 
            o.order_date
        ORDER BY o.order_date DESC;
    ");

    $orders = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Group orders by order_id
        if (!isset($orders[$row['order_id']])) {
            $orders[$row['order_id']] = [
                'order_id' => $row['order_id'],
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
            'addon_names' => $row['addon_names'] ? $row['addon_names'] : null,
        ];
    }

    // Generate HTML output using HEREDOC
    foreach ($orders as $order) {
        echo generateOrderHTML($order);
    }

} catch (PDOException $e) {
    echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}

// Function to generate HTML for each order
function generateOrderHTML($order) {
    $status = htmlspecialchars($order['status']);
    $order_id = htmlspecialchars($order['order_id']);
    $customer_name = htmlspecialchars($order['customer_name']);
    $service = htmlspecialchars($order['service']);
    $total = htmlspecialchars($order['total']);
    
    // Start order container
    $orderHtml = <<<HTML
<div class="orders" data-status="$status" data-order-id="$order_id">
    <div class="row">
        <h2 class="mar w3" id="cName">Name: $customer_name</h2>
        <h2 class="mar w" id="cService">Service: $service</h2>
        <h2 class="mar w">Total: ₱$total</h2>
        <h2 class="mar w2">Status: $status</h2>
        <div class="del w"><button class="done delete">Cancel</button></div>
        <img src="img/arrow_down.png" class="mar toggle-arrow" width="30px" height="30px" />
    </div>

    <div class="drop">
        <div class="line"></div>
        <table>
            <tr>
                <th><h2 class="mar">Items</h2></th>
                <th><h2 class="mar">Price</h2></th>
            </tr>
HTML;

    // Add each item
    foreach ($order['items'] as $item) {
        $quantity = htmlspecialchars($item['quantity']);
        $product_name = htmlspecialchars($item['product_name']);
        $size = htmlspecialchars($item['size']);
        $price = htmlspecialchars($item['price']);
    
        // Build formatted add-ons string
        $addon_html = '';
        if (!empty($item['addon_names'])) {
            $addons = explode(', ', $item['addon_names']); // Split the add-ons into an array
            $addon_list = '';
            foreach ($addons as $addon) {
                $addon_list .= "<br>&emsp;1x " . htmlspecialchars($addon);
            }
    
            $addon_html = <<<HTML
            <h4 class="mar" id="addons">Add ons: $addon_list</h4>
    HTML;
        }else{
            $addon_html = <<<HTML
            <h4 class="mar" id="addons"></h4>
    HTML;
        }
    
        $orderHtml .= <<<HTML
            <tr>
                <td>
                    <h3 class="mar" id="product">$quantity $product_name $size</h3>
                    $addon_html
                </td>
                <td><h3 class="mar" id="price">₱$price</h3></td>
            </tr>
    HTML;
    }
    // Add total, cash, and change based on status
    if ($order['status'] == 'Completed') {
        $orderHtml .= <<<HTML
            </table>
            <div class="line"></div>
            <table class="table">
                <tr><th><h2 class="mar">Total:</h2></th><th><h2 class="mar" id="total">₱$total</h2></th></tr>
                <tr><td><h3 class="mar">Cash:</h3></td><td><h3 class="mar" id="cashValue">₱{$order['cash']}</h3></td></tr>
                <tr><td><h3 class="mar">Change:</h3></td><td><h3 class="mar" id="change">₱{$order['change']}</h3></td></tr>
                <tr><td></td><td><button class="done print show">Print</button></td></tr>
            </table>
HTML;
    } else {
        $orderHtml .= <<<HTML
            </table>
            <div class="line"></div>
            <table>
                <tr><th><h2 class="mar">Total:</h2></th><th><h2 class="mar" id="total">₱$total</h2></th></tr>
                <tr><td><h3 class="mar">Cash:</h3></td><td><input class="input2" type="text" id="cash" name="cash" placeholder=""/></td></tr>
                <tr><td></td><td><button class="done submit">Submit</button><button class="done print">Print</button></td></tr>
            </table>
HTML;
    }

    $orderHtml .= '</div></div>';

    return $orderHtml;
}
?>
