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
       } catch (PDOException $e) {
           $this->fail("Error: Could not connect. " . $e->getMessage());
       }
    }

    public function testFetchProductsByTypeId()
    {
        $typeId = 1; 
        
        $sql = "
            SELECT p.name, p.img, p.price, p.size 
            FROM products p
            INNER JOIN (
                SELECT name, MIN(price) as min_price
                FROM products
                WHERE type_id = :type_id
                GROUP BY name
            ) AS min_prices ON p.name = min_prices.name AND p.price = min_prices.min_price
            WHERE p.type_id = :type_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['type_id' => $typeId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($rows, "No products were fetched for the provided type_id.");
        foreach ($rows as $row) {
            $this->assertArrayHasKey('name', $row);
            $this->assertArrayHasKey('img', $row);
            $this->assertArrayHasKey('price', $row);
            $this->assertArrayHasKey('size', $row);
        }
    }

    // Clean up
    protected function tearDown(): void
    {
        $this->pdo = null;
    }
}
