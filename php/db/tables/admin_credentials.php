<?php
include_once '../connect/conn.php';

try {
    // SQL to create the admin table if it doesn't already exist
    $sql = "CREATE TABLE IF NOT EXISTS adminx (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL
    )";

    // Execute the table creation query
    $pdo->exec($sql);
    echo "Admin table created successfully.<br>";

    // Default admin credentials
    $username = 'Aditya';
    $password = 'aditya1234';

    // Check if the admin username already exists
    $checkSql = "SELECT COUNT(*) FROM adminx WHERE username = :username";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->bindParam(':username', $username);
    $checkStmt->execute();

    if ($checkStmt->fetchColumn() == 0) {
        // If username does not exist, hash the password and insert the credentials
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $insertSql = "INSERT INTO adminx (username, password_hash) VALUES (:username, :password_hash)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':password_hash', $passwordHash);
        $insertStmt->execute();

        echo "Admin credentials inserted successfully.<br>";
    } else {
        echo "Admin credentials already exist. No insertion performed.<br>";
    }
} catch (PDOException $e) {
    echo "Error during setup: " . $e->getMessage();
}
?>
