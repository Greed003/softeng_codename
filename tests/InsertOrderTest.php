<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class InsertOrderTest extends TestCase
{
    private $pdo;
    private $createdOrderId; // Store the created order's ID

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

        $this->cleanDatabase();
    }

    public function testOrderProcessing()
    {
        // Sample JSON data as input for the test case, including 'service' field
        $inputJson = json_encode([
            'userName' => 'John',
            'total' => 190.00,
            'service' => 'Dine-in', // Add service field
            'orderItems' => [
                ['productName' => 'Americano', 'size' => 'Hot 12oz', 'quantity' => 2, 'price' => 130.00],
            ],
        ]);
        
        ob_start(); // Start output buffering
        $this->processOrder($inputJson);
        $output = ob_get_clean(); // Get the output and clean the buffer
        
        // Check for success in the output
        $result = json_decode($output, true);
        
        // Check if the result is not null and if success is true
        $this->assertNotNull($result, "No response from order processing.");
        $this->assertArrayHasKey('success', $result, "Response does not contain 'success' key.");
        $this->assertTrue($result['success'], "Order was not created: " . ($result['error'] ?? ''));
        
        // Verify that the order was created successfully
        $stmt = $this->pdo->query("SELECT * FROM orders WHERE name = 'John'");
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($order, "Order was not created.");
        
        // Store the created order_id for cleanup later
        $this->createdOrderId = $order['order_id'];
        
        // Verify that the 'service' field was added correctly
        $this->assertEquals('Dine-in', $order['service'], "Service field does not match.");
        
        // Verify that order items were added
        $stmt = $this->pdo->query("SELECT * FROM order_items WHERE order_id = " . $this->createdOrderId);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($items, "No order items were added.");
        $this->assertCount(1, $items, "The number of order items does not match.");
        
        // Fetch product name from the products table using product_id
        $productId = $items[0]['product_id'];
        $stmt = $this->pdo->prepare("SELECT name FROM products WHERE product_id = :productId");
        $stmt->execute([':productId' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->assertEquals('Americano', $product['name'], "Product name does not match.");
        $this->assertEquals(2, $items[0]['quantity'], "Quantity does not match.");
        $this->assertEquals(130.00, $items[0]['price'], "Price does not match.");
    }

    protected function processOrder($json)
    {
        // Decode the JSON string directly
        $data = json_decode($json, true);
        
        // Check if JSON is valid
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
            return;
        }

        // Simulate POST data
        $_POST = $data; // Directly assign the decoded data to $_POST

        // Include the order processing script
        include __DIR__ . '/../src/insert_order.php'; // Adjust the path as necessary
    }

    protected function cleanDatabase()
    {
        // Ensure no data remains from previous tests by deleting based on the created order_id
        if (isset($this->createdOrderId)) {
            // Now delete the order itself
            $this->pdo->exec("DELETE FROM orders WHERE order_id = " . $this->createdOrderId);
        }
    }

    // Clean up
    protected function tearDown(): void
    {
        // Clean up the created order
        $this->cleanDatabase();

        // Close the PDO connection
        $this->pdo = null;
    }
}
