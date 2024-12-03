<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

try {
    // Azure PostgreSQL connection details
    $connectionParams = [
        'dbname' => 'kaskada-cafe-database',  // Your Azure database name
        'user' => 'frbsbsokkv',
        'password' => 'NK$JyHjLvJCq8mrQ',
        'host' => 'kaskada-cafe-server.postgres.database.azure.com',
        'port' => 5432,
        'driver' => 'pdo_pgsql',
        'sslmode' => 'require', // Ensure SSL connection
    ];

    // Establish connection
    $conn = DriverManager::getConnection($connectionParams);
    echo "Connected to Azure PostgreSQL successfully.\n";

    // Load SQL commands from an external file
    $sqlFile = 'database.sql'; // Specify the path to your .sql file

    if (file_exists($sqlFile)) {
        echo "Executing SQL setup from $sqlFile...\n";
        
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
                    echo "Executed SQL: $trimmedStatement\n";
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
