<?php
// Set Mauritius Time Zone
date_default_timezone_set("Indian/Mauritius");

// Settings
$title = "Interactive Portfolio";
$tagline = "Developer & Photographer | Showcasing Creativity and Skills";

// Dynamic Greetings Based on Time (Mauritius Time)
$hour = date("H");
$greeting = "";

// Determine the greeting based on the time of day
if ($hour < 12) {
    $greeting = "Good Morning 🌞";
} elseif ($hour < 18) {
    $greeting = "Good Afternoon 🌅";
} else {
    $greeting = "Good Evening 🌙";
}

// Funny or Engaging Phrases Array
$phrases = [
    "What exciting things are you working on today? 🤔",
    "Feeling inspired? Let's create something awesome today! 💡",
    "What’s your creative plan for today? 🎨",
    "Got any cool projects on your mind today? 🚀",
    "What adventure are you embarking on today? ✨",
    "What new skills are you planning to learn today? 📚",
    "What tech wizardry are you up to today? 🧙‍♂️",
    "Feeling productive or more like a nap today? 😴",
    "What’s the one thing you’ve been dreaming of creating lately? 💭",
    "Is today the day you tackle that big project? 💪",
    "What’s your motivation for today? 🔥",
    "What’s one thing that’s inspiring you today? 💫",
    "Got any cool ideas brewing? 🍳",
    "What are you most excited about today? 😍",
    "How’s your creativity flowing today? 🌊",
    "What’s the plan for today? 💥",
    "Got some big ideas to execute today? 🏗️",
    "Feeling extra productive today, or are you in chill mode? 😎",
    "What’s your mood today? Let’s get inspired! 🌈",
    "What’s your project of the day? 🛠️",
    "Taking a break or making magic happen today? ✨",
    "Is your coffee as strong as your coding skills today? ☕💻",
    "What amazing thing are you pretending to work on today? 😜",
    "Let’s make some magic happen, or at least pretend to! 🧙‍♂️✨",
    "Got your creative hat on, or just taking a nap? 🧢💤",
    "Coding or procrastinating? Choose wisely. 🖥️⏳",
    "How’s it going, creative genius? Let’s see what you’ve got today! 🎨🔥",
    "Today is a great day to pretend you know what you're doing. 😅",
    "Making things or just making excuses? 😏",
    "Are you coding or just Googling for solutions? 🧐",
    "Let’s turn caffeine into code! 💻☕",
    "You know what they say: ‘Procrastination today, progress tomorrow.’ 🙃",
    "Is it a good day for a breakthrough or a breakdown? 🔨🧠",
    "Is today the day you finally fix that bug? 🐞",
    "Do you think the code will fix itself, or should we try? 🤔",
    "If at first you don’t succeed, try again... or just Google it. 🔍",
    "Don’t just stand there — create something epic! 🎨",
    "Did you find the perfect font, or just the first one you saw? 😎",
    "Does this look like something you just made, or is it magic? 🪄✨",
    "Time to make things happen — or just look busy! 😉",
    "Is it coding time, or just procrastination time? 🖥️⌛",
    "You got this! Maybe... unless you don’t. 😬",
    "Remember, even bad code can look good with enough colors. 🎨",
    "If at first you don’t succeed, blame the keyboard. 😜",
    "Your code is like a mystery novel. I have no idea what’s happening, but I’m intrigued. 📚",
    "When in doubt, break the code and blame it on ‘modern technologies.’ 😂",
    "It’s not a bug, it’s a feature. Or is it? 🤷‍♂️",
    "You’re not just a developer; you’re a master of creating digital mayhem. 🤪",
    "Was that a bug, or was that intentional? 👀",
    "Your debugging skills are top-notch… for a beginner. 😜",
    "Well, that wasn’t *quite* what I had in mind. 😬",
    "If mistakes were worth money, you'd be a millionaire by now. 💸",
    "Your code doesn’t just need a fix; it needs a whole makeover. 💅",
    "You code like you’ve never seen a syntax error. 🤯",
    "Just when I thought you couldn’t mess it up more, you did! 😂",
    "Are you coding, or just rearranging chaos? 😅",
    "You’re the reason we have ‘comments’ in code. 🙈",
    "Your code is like a magic trick: I don’t know how it works, but it’s not right. 🎩✨",
    "Is that your code or a modern art project? 🖼️",
    "Did the computer crash, or did you just break it? 🤔",
    "Your code is like a roller coaster — full of ups and downs! 🎢",
    "You’re the reason the ‘undo’ button exists. 🤦‍♂️",
    "If I had a dollar for every typo in your code... well, I’d be rich. 💰",
    "That bug didn’t just show up; it moved in and made itself comfortable. 🐛"
];

// Change the phrase every 5 minutes
$timeIndex = floor(time() / 5) % count($phrases);  // Time-based index to change every 5 minutes
$selectedPhrase = $phrases[$timeIndex];

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
    <script>
        // Passing the PHP array to JavaScript as a global variable
        const phrases = <?php echo json_encode($phrases); ?>;
    </script>
</head>
<body>
    <?php include 'php/templates/header.php'; ?>

    <main>
        <section class="hero" id="theme-image">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown intro_text"><?php echo $greeting; ?>, Welcome to My Portfolio!</h1>
                <p class="animate__animated animate__fadeInUp intro_text"><?php echo $tagline; ?></p>
                <p id="dynamic-phrase" class="animate__animated animate__fadeInUp intro_text"><?php echo $selectedPhrase; ?></p>
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
    <script src="./js/home.js"></script>

</body>
</html>
