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
                // Successful login
                $_SESSION['username'] = $user['username'];
                header("Location: ../../pages/admin.php");
                exit();
            } else {
                // Invalid password
                $_SESSION['error'] = 'p404';
                header("Location: ../../pages/404.php");
                exit();
            }
        } else {
            // Username not found
            $_SESSION['error'] = 'u404';
            header("Location: ../../pages/404.php");
            exit();
        }
    } catch (PDOException $e) {
        // Database error
        $_SESSION['error'] = 'd404';
        header("Location: ../../pages/404.php");
        exit();
    }
} else {
    // Invalid request method
    $_SESSION['error'] = 'ua404';
    header("Location: ../../pages/404.php");
    exit();
}
?>
