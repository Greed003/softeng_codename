<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class GetProductTest extends TestCase
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

    public function testFetchProductsByTypeId()
    {
        $typeId = 1; 
        
        $sql = "
            SELECT 
                p.product_id,
                p.name, 
                p.description, 
                p.type_id,
                p.img, 
                ps.size, 
                ps.price
            FROM 
                products p
            JOIN 
                product_size ps ON p.product_id = ps.product_id
            WHERE 
                p.type_id = :type_id
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['type_id' => $typeId]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->assertNotEmpty($rows, "No products were fetched for the provided type_id.");

            foreach ($rows as $row) {
                $this->assertArrayHasKey('product_id', $row);
                $this->assertArrayHasKey('name', $row);
                $this->assertArrayHasKey('description', $row);
                $this->assertArrayHasKey('type_id', $row);
                $this->assertArrayHasKey('img', $row);
                $this->assertArrayHasKey('size', $row);
                $this->assertArrayHasKey('price', $row);
            }
        } catch (PDOException $e) {
            $this->fail("Error executing SQL query: " . $e->getMessage());
        }
    }

    // Clean up
    protected function tearDown(): void
    {
        $this->pdo = null;
    }
}