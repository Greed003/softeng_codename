<?php
require 'connection.php';

try {
    $stmt = $pdo->query("
        SELECT o.order_id, o.name, oi.add_ons, o.status, o.total, oi.quantity, p.name AS product_name
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.product_id
        ORDER BY o.order_date DESC
    ");

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($orders);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}