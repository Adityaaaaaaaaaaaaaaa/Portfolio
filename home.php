<?php
// Set Mauritius Time Zone
date_default_timezone_set("Indian/Mauritius");

// Settings
$title = "Interactive Portfolio";
$tagline = "Developer & Photographer | Showcasing Creativity and Skills";

// Dynamic Greetings Based on Time (Mauritius Time)
$hour = date("H");
$greeting = ($hour < 12) ? "Good Morning" : (($hour < 18) ? "Good Afternoon" : "Good Evening");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="./js/home_animation.js"></script>
    <script src="js/dark_mode.js"></script>
    <script src="js/mouse.js"></script>
</head>
<body>
    <?php include 'php/templates/header.php'; ?>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown"><?php echo $greeting; ?>, Welcome to My Portfolio!</h1>
                <p class="animate__animated animate__fadeInUp"><?php echo $tagline; ?></p>
                <button id="scroll-btn" class="animate__animated animate__pulse">Explore More</button>
            </div>
        </section>

        <section class="intro" id="intro-section">
            <h2 class="section-title">Explore My Work</h2>
            <p class="section-description">This portfolio showcases my passion for both technology and photography. Scroll down to explore!</p>
        </section>

        <!-- Gallery Section -->
        <section class="gallery">
            <h3 class="section-title">Featured Photography</h3>
            <div class="gallery-grid">
                <img src="https://picsum.photos/400/300" alt="Placeholder for Photography 1">
                <img src="https://picsum.photos/400/300" alt="Placeholder for Photography 2">
                <img src="https://picsum.photos/400/300" alt="Placeholder for Photography 3">
            </div>
        </section>

        <section class="quick-links">
            <h3 class="section-title">Quick Navigation</h3>
            <ul class="quick-links-list">
                <?php
                foreach ($navLinks as $name => $url) {
                    if ($name !== "Home") {
                        echo "<li><a href='$url' class='quick-link'>$name</a></li>";
                    }
                }
                ?>
            </ul>
        </section>
    </main>
    
    <?php include 'php/templates/footer.php'; ?>

</body>
</html>
