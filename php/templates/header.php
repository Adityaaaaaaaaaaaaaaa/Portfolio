<!-- header.php -->
<?php
// Define the navigation links in PHP
$navLinks = [
    "Home" => "index.php",
    "About" => "pages/about.php",
    "Portfolio" => "pages/portfolio.php",
    "Resume" => "pages/resume.php",
    "Contact" => "pages/contact.php"
];
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
                ?>
            </ul>
            <!-- Theme Toggle Button -->
            <div id="theme-toggle" class="theme-toggle">
                <button id="toggle-btn">Theme</button>
            </div>
        </nav>
    </header>
