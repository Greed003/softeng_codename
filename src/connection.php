<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Adjust this path if needed

use Dotenv\Dotenv;

// Load the .env file from the root directory of the project
$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Make sure this path correctly points to your root directory
$dotenv->load();

// Access environment variables
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];
$sslCertPath = 'DigiCertGlobalRootCA.crt.pem'; // Adjust the path to your SSL certificate file if needed

// Create a PDO connection with SSL for PostgreSQL
try {
    // PostgreSQL connection string with SSL
    $dsn = "pgsql:host=$dbHost;dbname=$dbName;sslmode=require";  // SSL mode set to 'require' for secure connection
    $pdo = new PDO($dsn, $dbUser, $dbPassword, [
        // Specify the path to the SSL certificate file
        PDO::PGSQL_ATTR_SSL_CERT => $sslCertPath
    ]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
