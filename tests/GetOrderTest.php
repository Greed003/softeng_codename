<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class GetOrderTest extends TestCase
{
    private $pdo;
    private $orderId; // To store the inserted order_id for cleanup

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
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->fail("Error: Could not connect. " . $e->getMessage());
        }
    }

    public function testFetchOrders()
    {
        // Insert a sample order into the orders and order_items tables
        try {
            // Begin a transaction to ensure data consistency
            $this->pdo->beginTransaction();

            // Insert into orders table
            $stmt = $this->pdo->prepare("INSERT INTO orders (name, status, service, total, cash, change, order_date) 
                                         VALUES (:name, :status, :service, :total, :cash, :change, NOW()) RETURNING order_id");
            $stmt->execute([
                ':name' => 'John Doe',
                ':status' => 'Pending',
                ':service' => 'Dine In',
                ':total' => 200.00,
                ':cash' => 250.00,
                ':change' => 50.00
            ]);
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->orderId = $order['order_id']; // Store the order_id for cleanup

            // Insert into order_items table
            $stmt = $this->pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, size) 
                                         VALUES (:order_id, :product_id, :quantity, :price, :size)");
            $stmt->execute([
                ':order_id' => $this->orderId,
                ':product_id' => 1, // Assume product_id 1 exists
                ':quantity' => 2,
                ':price' => 100.00,
                ':size' => 'Hot 12oz'
            ]);

            // Insert into item_addons table (if applicable)
            // Add any item add-ons if required, for example:
            // $stmt = $this->pdo->prepare("INSERT INTO item_addons (order_item_id, addon_id) VALUES (:order_item_id, :addon_id)");

            // Commit the transaction
            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->fail("Error inserting sample data: " . $e->getMessage());
        }

        // Now fetch the orders
        $sql = "
            SELECT 
                o.order_id, 
                o.name AS customer_name, 
                o.status, 
                o.total, 
                o.cash, 
                o.change, 
                oi.quantity, 
                oi.price, 
                oi.size, 
                p.name AS product_name, 
                o.order_date,
                COALESCE(STRING_AGG(a.name, ', '), '') AS addon_names
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            LEFT JOIN item_addons ia ON oi.order_item_id = ia.order_item_id
            LEFT JOIN addons a ON ia.addon_id = a.addon_id
            GROUP BY 
                o.order_id, 
                o.name, 
                o.status, 
                o.total, 
                o.cash, 
                o.change, 
                oi.quantity, 
                oi.price, 
                oi.size, 
                p.name, 
                o.order_date
            ORDER BY o.order_date DESC;
        ";

        try {
            $stmt = $this->pdo->query($sql);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Assert that we have fetched some orders
            $this->assertNotEmpty($orders, "No orders were fetched.");
        } catch (PDOException $e) {
            $this->fail("Error executing SQL query: " . $e->getMessage());
        }
    }

    // Clean up the inserted data
    protected function tearDown(): void
    {
        // Delete the inserted order and its associated data
        try {
            if ($this->orderId) {
                $this->pdo->beginTransaction();

                // Delete the order
                $stmt = $this->pdo->prepare("DELETE FROM orders WHERE order_id = :order_id");
                $stmt->execute([':order_id' => $this->orderId]);

                // Commit the transaction
                $this->pdo->commit();
            }
        } catch (PDOException $e) {
            $this->fail("Error cleaning up data: " . $e->getMessage());
        } finally {
            // Close the connection
            $this->pdo = null;
        }
    }
}
