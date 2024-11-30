<?php
include_once '../db/connect/conn.php';

session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    try {
        // SQL query to get the stored credentials from the database
        $sql = "SELECT username, password_hash FROM adminx WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        // Check if a user was found
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            
            // Verify password
            if (password_verify($password, $user['password_hash'])) {
                // Login successful: Set session variable and redirect to admin page
                $_SESSION['username'] = $user['username'];
                header("Location: ../../pages/admin.php");
                exit();
            } else {
                // Invalid password
                $error = "Incorrect password.";
            }
        } else {
            // Username not found
            $error = "No user found with that username.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>