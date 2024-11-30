<?php
include_once '../db/connect/conn.php';

// Initialize an array to hold errors
$errors = [
    'usernameError' => '',
    'passwordError' => ''
];

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle username validation if it is sent
    if (isset($_POST['username'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        
        if (empty($username)) {
            $errors['usernameError'] = "Username field is as empty as my fridge on a Sunday!";
        } elseif (strlen($username) < 3) {
            $errors['usernameError'] = "You know its short ? do you ?";
        } elseif (strlen($username) > 15) {
            $errors['usernameError'] = "You know its long ? do you ?<br>You sure you remember your username ?";
        } else {
            try {
                // Check if the username exists in the database
                $sql = "SELECT username FROM adminx WHERE username = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    $errors['usernameError'] = "This username seems to be as real as unicorns! or maybe is it ...?";
                } else {
                    $errors['usernameError'] = "Idk, maybe it's good ? maybe not ?";
                }
            } catch (PDOException $e) {
                $errors['usernameError'] = "Oops! A database gremlin struck (Error code 500).";
            }
        }
    }

    // Handle password validation if it is sent
    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        if (empty($password)) {
            $errors['passwordError'] = "Password field is emptier than my wallet after payday!";
        } elseif (strlen($password) < 3) {
            $errors['passwordError'] = "Your password is shorter than my patience in traffic!";
        } elseif (strlen($password) > 20) {
            $errors['passwordError'] = "That's a long password for a small field!<br>Who knows ...? might be good or not ?";
        } else {
            try {
                // Validate the password independently
                $sql = "SELECT password FROM adminx WHERE password = :password";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    $errors['passwordError'] = "We can't tell if the password you just typed is correct or not. It's probably not?
                    <br>Try your luck !";
                } else {
                    $errors['passwordError'] = "Idk, maybe it's good ? maybe not ? Try again ? ";
                }
            } catch (PDOException $e) {
                $errors['passwordError'] = "Oops! Our database took a nap (Error code 500).<br>Try see if it works ?";
            }
        }
    }

    // Return the errors as JSON
    echo json_encode($errors);
}
