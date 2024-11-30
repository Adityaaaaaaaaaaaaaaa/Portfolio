<?php
    // Start the session only if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Define the navigation links in PHP
    $navLinks = [
        "Home" => "/Portfolio/home.php",
        "About" => "/Portfolio/pages/about.php",
        "Portfolio" => "/Portfolio/pages/portfolio.php",
        "Resume" => "/Portfolio/pages/resume.php",
        "Contact" => "/Portfolio/pages/contact.php"
    ];

    // Check if the user is logged in
    $loggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <header>
        <nav>
            <ul>
                <?php
                // Loop through the navigation links array and generate the list items
                foreach ($navLinks as $name => $url) {
                    echo "<li><a href='$url' class='nav-link'>$name</a></li>";
                }

                // If logged in, show "Admin" and "Logout"
                if ($loggedIn) {
                    echo "<li><a href='/Portfolio/pages/admin.php' class='nav-link'>Admin</a></li>";
                    echo "<li><a href='/Portfolio/pages/logout.php' class='nav-link'>Logout</a></li>";
                } else {
                    // If not logged in, show "Login"
                    echo "<li><a href='/Portfolio/pages/login.php' class='nav-link'>Login</a></li>";
                }
                ?>
                <li id="toggle-btn"><a class="nav-link">Theme</a></li>
            </ul>
        </nav>
    </header>
