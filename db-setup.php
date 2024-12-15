<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

try {
    // Database connection details for initial connection to the default 'postgres' database
    $connectionParams = [
        'dbname' => 'postgres',  // Connect to the default postgres database initially
        'user' => 'postgres',
        'password' => 'admin',
        'host' => $_ENV['DOCKER_HOST'],  // Use the Docker container name 'db'
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

    // Create or replace the function 'clean_old_orders'
    $cleanOldOrdersSQL = "
    CREATE OR REPLACE FUNCTION clean_old_orders() 
    RETURNS VOID AS $$
    BEGIN
        DELETE FROM orders WHERE order_date < CURRENT_DATE;
    END;
    $$ LANGUAGE plpgsql;
    ";

    // Execute the function creation SQL
    try {
        $conn->executeStatement($cleanOldOrdersSQL);
        echo "Function `clean_old_orders` created successfully.\n";
    } catch (\Exception $e) {
        echo "Error creating function: " . $e->getMessage() . "\n";
    }

    // Create or replace the function `trigger_clean_old_orders`
    $triggerFunctionSQL = "
    CREATE OR REPLACE FUNCTION trigger_clean_old_orders()
    RETURNS TRIGGER AS $$
    BEGIN
        -- Call the clean_old_orders function when a new order is inserted
        PERFORM clean_old_orders();
        RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;
    ";

    // Execute the trigger function creation SQL
    try {
        $conn->executeStatement($triggerFunctionSQL);
        echo "Trigger function `trigger_clean_old_orders` created successfully.\n";
    } catch (\Exception $e) {
        echo "Error creating trigger function: " . $e->getMessage() . "\n";
    }

    // Create the trigger to call the function after insert on `orders`
    $triggerSQL = "
    CREATE TRIGGER clean_old_orders_trigger
    AFTER INSERT ON orders
    FOR EACH ROW
    EXECUTE FUNCTION trigger_clean_old_orders();
    ";

    // Execute the trigger creation SQL
    try {
        $conn->executeStatement($triggerSQL);
        echo "Trigger `clean_old_orders_trigger` created successfully.\n";
    } catch (\Exception $e) {
        echo "Error creating trigger: " . $e->getMessage() . "\n";
    }

} catch (\Exception $e) {
    echo "Failed to set up database: " . $e->getMessage() . "\n";
}
