<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class DeleteOrderTest extends TestCase
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
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->fail("Error: Could not connect. " . $e->getMessage());
        }
    }

    public function testDeleteOrder()
    {
        // Insert a sample order for testing with auto-increment for order_id
        $stmt = $this->pdo->prepare("INSERT INTO orders (name, status, total, cash, change, order_date, service) 
                                     VALUES (:name, :status, :total, :cash, :change, NOW(), :service) 
                                     RETURNING order_id");
        $stmt->execute([
            ':name' => 'Test Order',
            ':status' => 'Pending',
            ':total' => 100.00,
            ':cash' => 150.00,
            ':change' => 50.00,
            ':service' => 'Dine In'  // Add a valid value for 'service' if necessary
        ]);
        
        $orderId = $stmt->fetch(PDO::FETCH_ASSOC)['order_id'];

        // Delete the order
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);

        // Verify the deletion
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEmpty($order, "Order was not deleted.");
    }

    // Clean up
    protected function tearDown(): void
    {
        $this->pdo = null;
    }
}
