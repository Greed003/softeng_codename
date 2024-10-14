<?php 
        $host = "localhost"; // Your PostgreSQL host
        $dbname = "kaskada_db"; // Your PostgreSQL database name
        $user = "postgres"; // Your PostgreSQL username
        $password = "admin"; // Your PostgreSQL password
    
        // Connect to PostgreSQL database
        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        } catch (PDOException $e) {
            die("Error: Could not connect. " . $e->getMessage());
        }