<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class GetOrderTest extends TestCase
{
    private $pdo;

    // Setup method to establish a connection to the test database
    protected function setUp(): void
    {
        // Load the .env file to access environment variables
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            // Create a new PDO instance
            $this->pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        } catch (PDOException $e) {
            $this->fail("Error: Could not connect. " . $e->getMessage());
        }
    }

    public function testFetchOrders()
    {
        $sql = "
            SELECT o.order_id, o.name, o.status, o.total, oi.quantity, p.name AS product_name
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            ORDER BY o.order_date DESC
        ";

        $stmt = $this->pdo->query($sql);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($orders, "No orders were fetched.");
        
        foreach ($orders as $order) {
            $this->assertArrayHasKey('order_id', $order);
            $this->assertArrayHasKey('name', $order);
            $this->assertArrayHasKey('status', $order);
            $this->assertArrayHasKey('total', $order);
            $this->assertArrayHasKey('quantity', $order);
            $this->assertArrayHasKey('product_name', $order);
        }
    }

    // Clean up
    protected function tearDown(): void
    {
        $this->pdo = null;
    }
}