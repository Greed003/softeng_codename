<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

// Database connection details for initial connection
$connectionParams = [
    'dbname' => 'postgres', // Connect to the default 'postgres' database initially
    'user' => 'postgres',
    'password' => 'admin',
    'host' => 'localhost',
    'driver' => 'pdo_pgsql',
];

try {
    // Establish connection
    $conn = DriverManager::getConnection($connectionParams);

    // Check if `kaskada_db` exists
    $dbCheck = $conn->fetchOne("SELECT 1 FROM pg_database WHERE datname = 'kaskada_db'");

    // Create the `kaskada_db` if it does not exist
    if (!$dbCheck) {
        $conn->executeStatement("CREATE DATABASE kaskada_db");
        echo "Database `kaskada_db` created successfully.\n";
    } else {
        echo "Database `kaskada_db` already exists.\n";
    }

    // Connect to the `kaskada_db` for the rest of the setup
    $conn->close();
    $connectionParams['dbname'] = 'kaskada_db';
    $conn = DriverManager::getConnection($connectionParams);

    // Load SQL commands from an external file
    $sqlFile = 'database.sql'; // Specify the path to your .sql file
    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);

        // Split the SQL into individual statements
        $statements = explode(";", $sql);

        // Execute each SQL command separately
        $conn->beginTransaction();
        foreach ($statements as $statement) {
            $trimmedStatement = trim($statement);
            if (!empty($trimmedStatement)) {
                $conn->executeStatement($trimmedStatement);
            }
        }
        $conn->commit();

        echo "Database setup completed successfully.\n";
    } else {
        echo "SQL file not found: $sqlFile\n";
    }
    
} catch (\Exception $e) {
    echo "Failed to set up database: " . $e->getMessage() . "\n";
}
