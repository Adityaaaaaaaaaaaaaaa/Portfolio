<!-- header.php -->
<?php
// Define the navigation links in PHP
$navLinks = [
    "Home" => "/Portfolio/home.php",
    "About" => "/Portfolio/pages/about.php",
    "Portfolio" => "/Portfolio/pages/portfolio.php",
    "Resume" => "/Portfolio/pages/resume.php",
    "Contact" => "/Portfolio/pages/contact.php"
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
                <li id="toggle-btn"><a class="nav-link">Theme</a></li>
            </ul>
        </nav>
    </header>
