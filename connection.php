<?php
require_once __DIR__ . '/vendor/autoload.php'; // Adjust this path if needed

use Dotenv\Dotenv;

// Load the .env file from the root directory of the project
$dotenv = Dotenv::createImmutable(__DIR__ . '/'); // Make sure this path correctly points to your root directory
$dotenv->load();

// Access environment variables
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Create a PDO connection
try {
    $dsn = "pgsql:host=$dbHost;dbname=$dbName";
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

