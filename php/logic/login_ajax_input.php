<?php
include_once '../db/connect/conn.php';

// Initialize an array to hold errors
$errors = [
    'usernameError' => '',
    'passwordError' => ''
];

// Check if it's a request for username or password validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        
        // Validate username
        if (strlen($username) < 3) {
            $errors['usernameError'] = "Username error: Username must be at least 3 characters long.";
        } else {
            // Check if the username exists in the database
            try {
                $sql = "SELECT username FROM adminx WHERE username = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    $errors['usernameError'] = "Username error: This username does not exist.";
                }
            } catch (PDOException $e) {
                $errors['usernameError'] = "Error code 500: Database error.";
            }
        }
    }

    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        
        // Validate password
        if (strlen($password) < 3) {
            $errors['passwordError'] = "Password error: Password must be at least 3 characters long.";
        } else {
            // Check if the password matches for the username
            try {
                $sql = "SELECT password FROM adminx WHERE username = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $storedPassword = $stmt->fetchColumn(); // Get the stored password
                    // Assuming you are using hashed passwords:
                    if (!password_verify($password, $storedPassword)) {
                        $errors['passwordError'] = "Password incorrect: The password you entered is incorrect.";
                    }
                }
            } catch (PDOException $e) {
                $errors['passwordError'] = "Error code 500: Database error.";
            }
        }
    }

    // Return the errors as JSON
    echo json_encode($errors);
}
?>
