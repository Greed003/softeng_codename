<?php
use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        $host = "localhost"; 
        $dbname = "kaskada_db"; 
        $user = "postgres";
        $password = "admin";

        $this->pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    }

    public function testFetchBreadMenu() {
        $sql = "SELECT * FROM bread_menu";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertIsArray($rows);
        $this->assertNotEmpty($rows);

        $firstRow = $rows[0];
        $this->assertArrayHasKey('item_name', $firstRow);
        $this->assertArrayHasKey('price', $firstRow);
        $this->assertArrayHasKey('image_url', $firstRow);
    }

    protected function tearDown(): void {
        $this->pdo = null;
    }
}
