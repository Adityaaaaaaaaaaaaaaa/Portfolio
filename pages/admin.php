<?php
    // Start the session to access session variables
    session_start();

    // Check if the admin is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: 404.php?error=ua404");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/dark_mode.js"></script>
</head>
<body>
    <?php include '../php/templates/header.php'; ?>

    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You are now logged in as an admin.</p>

    <?php include '../php/templates/footer.php'; ?>
</body>
</html>
