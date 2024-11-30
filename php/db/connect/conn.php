<?php
// Database configuration
$host = 'localhost';        // Hostname (usually 'localhost')
$dbname = 'portfolio';      // Database name
$username = 'root';         // Database username
$password = '';             // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
