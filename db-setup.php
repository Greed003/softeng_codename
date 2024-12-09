<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

try {
    // Database connection details for initial connection to the default 'postgres' database
    $connectionParams = [
        'dbname' => 'postgres',  // Connect to the default postgres database initially
        'user' => 'postgres',
        'password' => 'admin',
        'host' => 'localhost',  // Use the Docker container name 'db'
        'driver' => 'pdo_pgsql',
    ];

    // Establish connection
    $conn = DriverManager::getConnection($connectionParams);

    // Check if `kaskada_db` exists
    $dbCheck = $conn->fetchOne("SELECT 1 FROM pg_database WHERE datname = 'kaskada_db'");

    // Create the `kaskada_db` if it does not exist
    if (!$dbCheck) {
        echo "Database `kaskada_db` does not exist. Creating it...\n";
        $conn->executeStatement("CREATE DATABASE kaskada_db");
        echo "Database `kaskada_db` created successfully.\n";
    } else {
        echo "Database `kaskada_db` already exists.\n";
    }

    // Close connection to the default database and connect to `kaskada_db`
    $conn->close();
    $connectionParams['dbname'] = 'kaskada_db';
    $conn = DriverManager::getConnection($connectionParams);

    // Load SQL commands from an external file
    $sqlFile = 'database.sql'; // Specify the path to your .sql file

    if (file_exists($sqlFile)) {        
        // Read SQL file and split into statements
        $sql = file_get_contents($sqlFile);
        $statements = explode(";", $sql);

        // Execute each SQL command separately
        $conn->beginTransaction();
        foreach ($statements as $statement) {
            $trimmedStatement = trim($statement);
            if (!empty($trimmedStatement)) {
                try {
                    $conn->executeStatement($trimmedStatement);
                    // echo "Executed SQL: $trimmedStatement\n";
                } catch (\Exception $e) {
                    echo "Error executing statement: " . $e->getMessage() . "\n";
                }
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
