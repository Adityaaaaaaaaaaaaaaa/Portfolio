<?php
    // Set Mauritius Time Zone
    date_default_timezone_set("Indian/Mauritius");

    // Settings
    $title = "Interactive Portfolio";
    $tagline = "Developer & Photographer | Showcasing Creativity and Skills";

    // Get the current hour
    $hour = date("H");

    // Read and decode the JSON file
    $json = file_get_contents('config/home.json');
    $data = json_decode($json, true);

    // Get the appropriate greeting and phrase from the JSON data
    $greeting = $data['greetings'][$hour] ?? "Hello!"; // Default value as fallback
    $hourlyPhrase = $data['phrasesHourly'][$hour] ?? "What a great time to visit!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/dark_mode.js"></script>
</head>
<body>
    <?php include 'php/templates/header.php'; ?>

    <main>
        <section class="hero" id="theme-image">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown intro_text"><?php echo $greeting; ?>, Welcome to My Portfolio!</h1>
                <p class="animate__animated animate__fadeInUp intro_text"><?php echo $hourlyPhrase; ?></p>
                <p id="dynamic-phrase" class="animate__animated animate__fadeInUp intro_text"></p>
                <button id="scroll-btn" class="animate__animated animate__pulse">Explore More</button>
            </div>
        </section>

        <section class="intro" id="intro-section">
            <h2 class="section-title">Explore My Work</h2>
            <p class="section-description">This portfolio showcases my passion for both technology and photography. Scroll down to explore!</p>
            <p class="animate__animated animate__fadeInUp section-description intro_text"><?php echo $tagline; ?></p>
        </section>

        <!-- Photo Carousel Section -->
        <section class="photo-carousel">
            <h3 class="section-title">Photo Carousel</h3>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                        $photos = [
                            ['src' => 'https://picsum.photos/400/300?random=1', 'description' => 'This is Photo 1', 'link' => 'https://example.com/photo1'],
                            ['src' => 'https://picsum.photos/400/300?random=2', 'description' => 'This is Photo 2', 'link' => 'https://example.com/photo2'],
                            ['src' => 'https://picsum.photos/400/300?random=3', 'description' => 'This is Photo 3', 'link' => 'https://example.com/photo3'],
                            ['src' => 'https://picsum.photos/400/300?random=4', 'description' => 'This is Photo 4', 'link' => 'https://example.com/photo4'],
                            ['src' => 'https://picsum.photos/400/300?random=5', 'description' => 'This is Photo 5', 'link' => 'https://example.com/photo5'],
                            ['src' => 'https://picsum.photos/400/300?random=6', 'description' => 'This is Photo 6', 'link' => 'https://example.com/photo6'],
                            ['src' => 'https://picsum.photos/400/300?random=7', 'description' => 'This is Photo 7', 'link' => 'https://example.com/photo7'],
                            ['src' => 'https://picsum.photos/400/300?random=8', 'description' => 'This is Photo 8', 'link' => 'https://example.com/photo8'],
                            ['src' => 'https://picsum.photos/400/300?random=9', 'description' => 'This is Photo 9', 'link' => 'https://example.com/photo9']
                        ];
                    
                        foreach ($photos as $photo): 
                    ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $photo['src']; ?>" alt="<?php echo $photo['description']; ?>" data-description="<?php echo $photo['description']; ?>" data-link="<?php echo $photo['link']; ?>">
                    </div>
                    <?php 
                        endforeach; 
                    ?>
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
    <script src="./js/home.js"></script>

</body>
</html>
