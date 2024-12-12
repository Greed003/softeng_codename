<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class UpdateOrderTest extends TestCase
{
    private $pdo;
    private $insertedOrderId;

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

    public function testUpdateOrder()
    {
        // Insert a sample order with all required fields, including 'total'
        $name = 'John Doe'; // Make sure 'name' is provided
        $service = 'Dine In'; // Make sure 'service' is provided
        $total = 0.00; // Set the total value
        $this->pdo->exec("INSERT INTO orders (name, status, service, cash, change, total) VALUES ('$name', 'Pending', '$service', 0, 0, $total)");
        $this->insertedOrderId = $this->pdo->lastInsertId(); // Capture the inserted order ID

        // Update the order (don't change the total)
        $status = 'Completed';
        $cash = 200.00;
        $change = 10.00;

        $sql = "UPDATE orders SET status = :status, cash = :cash, change = :change WHERE order_id = :order_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'status' => $status,
            'cash' => $cash,
            'change' => $change,
            'order_id' => $this->insertedOrderId
        ]);

        // Verify the update
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $this->insertedOrderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($order, "Order not found.");
        $this->assertEquals($status, $order['status'], "Order status does not match.");
        $this->assertEquals($cash, (float) $order['cash'], "Order cash does not match.");
        $this->assertEquals($change, (float) $order['change'], "Order change does not match.");
    }


    // Clean up
    protected function tearDown(): void
    {
        if ($this->insertedOrderId) {
            $this->pdo->exec("DELETE FROM orders WHERE order_id = " . $this->insertedOrderId); // Remove the test data
        }
        $this->pdo = null;
    }
}
