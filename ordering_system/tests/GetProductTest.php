<?php

use PHPUnit\Framework\TestCase;

class GetProductTest extends TestCase
{
    private $pdo;

    // Setup method to establish a connection to the test database
    protected function setUp(): void
    {
        $host = "localhost";
        $dbname = "kaskada_db"; // Use the actual database or a test database
        $user = "postgres";
        $password = "admin";
        $dsn = "pgsql:host=$host;dbname=$dbname";

        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
