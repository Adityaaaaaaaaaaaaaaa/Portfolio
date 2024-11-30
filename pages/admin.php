<?php
    // admin.php: Admin Dashboard

    session_start();

    // Check if the admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        // If not logged in, redirect to login page
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You are now logged in as an admin.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
