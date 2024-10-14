<?php
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        $host = "localhost"; 
        $dbname = "kaskada_db"; 
        $user = "postgres";
        $password = "admin"; 

        try {
            $this->pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        } catch (PDOException $e) {
            $this->fail("Error: Could not connect. " . $e->getMessage());
        }
    }

    public function testConnection() {
        $this->assertNotNull($this->pdo, "PDO object is null. Connection failed.");
        $this->assertInstanceOf(PDO::class, $this->pdo, "Object is not an instance of PDO.");
    }

    protected function tearDown(): void {
        $this->pdo = null;
    }
}
