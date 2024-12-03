<?php
include_once '../connect/conn.php';

// SQL query to create the 'photos' table
$query = "
CREATE TABLE IF NOT EXISTS photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_size INT NOT NULL,
    width INT NOT NULL,
    height INT NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    tags VARCHAR(255),
    mime_type VARCHAR(50)
);
";

try {
    // Execute the query
    $pdo->exec($query);
    echo "Table 'photos' created successfully!";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

// Close the database connection by nullifying the PDO object
$pdo = null;
?>
