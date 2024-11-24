<!-- header.php -->
<?php
// Define the navigation links in PHP
$navLinks = [
    "Home" => "home.php",
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
                <li id="toggle-btn"><a class="nav-link">Theme</a></li>
            </ul>
        </nav>
    </header>
