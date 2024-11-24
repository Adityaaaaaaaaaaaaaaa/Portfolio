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
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/carousel.js"></script>
</head>
<body>
    <?php include 'php/templates/header.php'; ?>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown intro_text"><?php echo $greeting; ?>, Welcome to My Portfolio!</h1>
                <p class="animate__animated animate__fadeInUp intro_text"><?php echo $tagline; ?></p>
                <button id="scroll-btn" class="animate__animated animate__pulse">Explore More</button>
            </div>
        </section>

        <section class="intro" id="intro-section">
            <h2 class="section-title">Explore My Work</h2>
            <p class="section-description">This portfolio showcases my passion for both technology and photography. Scroll down to explore!</p>
        </section>

        <!-- Photo Carousel Section -->
        <section class="photo-carousel">
            <h3 class="section-title">Photo Carousel</h3>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- Carousel Slides -->
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=1" alt="Photo 1" data-description="This is Photo 1" data-link="https://example.com/photo1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=2" alt="Photo 2" data-description="This is Photo 2" data-link="https://example.com/photo2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=3" alt="Photo 3" data-description="This is Photo 3" data-link="https://example.com/photo3">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=4" alt="Photo 4" data-description="This is Photo 4" data-link="https://example.com/photo4">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=5" alt="Photo 5" data-description="This is Photo 5" data-link="https://example.com/photo5">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=6" alt="Photo 6" data-description="This is Photo 6" data-link="https://example.com/photo6">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=7" alt="Photo 7" data-description="This is Photo 7" data-link="https://example.com/photo7">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=8" alt="Photo 8" data-description="This is Photo 8" data-link="https://example.com/photo8">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300?random=9" alt="Photo 9" data-description="This is Photo 9" data-link="https://example.com/photo9">
                    </div>
                </div>
            </div>
        </section>

        <!-- Popup Modal -->
        <div id="photo-popup" class="popup hidden">
            <div class="popup-content">
                <span class="popup-close">&times;</span> <!-- This is the close button -->
                <img id="popup-image" src="" alt="Popup Image">
                <p id="popup-description"></p>
                <a id="popup-link" href="#" target="_blank">View More</a>
            </div>
        </div>

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
