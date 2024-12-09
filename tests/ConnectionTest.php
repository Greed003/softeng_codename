<?php
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class ConnectionTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
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

    public function testConnection() {
        $this->assertNotNull($this->pdo, "PDO object is null. Connection failed.");
        $this->assertInstanceOf(PDO::class, $this->pdo, "Object is not an instance of PDO.");
    }

    public function testDatabaseIsAccessible() {
        // Optionally test if a simple query works
        $stmt = $this->pdo->query("SELECT 1");
        $this->assertSame(1, $stmt->fetchColumn(), "Database query failed.");
    }

    protected function tearDown(): void {
        $this->pdo = null; // Close the connection
    }
}