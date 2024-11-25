<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about me - my journey, skills, and aspirations.">
    <title>About Me</title>
    <link rel="stylesheet" href="../css/about.css">
    <link rel="stylesheet" href="../css/main.css">
    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>


    <script src="../js/about.js" defer></script>
    <script src="../js/dark_mode.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php include('../php/templates/header.php'); ?>

    <!-- Hero Section -->
    <header class="about-hero">
        <h1>About Me</h1>
        <p>Discover my journey, skills, and what drives me forward.</p>
    </header>

    <!-- Interactive Timeline Section -->
    <section class="timeline-section">
        <h2>My Journey</h2>
        <div id="timeline">
            <div class="timeline-item">
                <p><strong>2018</strong> - Started Photography</p>
                <p>Discovered my passion for capturing moments.</p>
            </div>
            <div class="timeline-item">
                <p><strong>2020</strong> - Began Coding Journey</p>
                <p>Started exploring web development.</p>
            </div>
            <div class="timeline-item">
                <p><strong>2023</strong> - Mastered Spring Boot</p>
                <p>Built advanced backend systems.</p>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills-section">
        <h2>My Skills</h2>
        <div class="skills-container">
            <div class="skill">
                <h3>Photography</h3>
                <div class="skill-bar" data-skill="90%"></div>
            </div>
            <div class="skill">
                <h3>Web Development</h3>
                <div class="skill-bar" data-skill="85%"></div>
            </div>
            <div class="skill">
                <h3>Java (Spring Boot)</h3>
                <div class="skill-bar" data-skill="80%"></div>
            </div>
            <!-- Add more skills as needed -->
        </div>
    </section>

    <!-- Spline Placeholder -->
    <section class="spline-section">
        <h2>Explore in 3D</h2>
        <div id="spline-placeholder">
            <p>[3D Spline Integration Coming Soon]</p>
        </div>
    </section>

    <!-- Footer -->
    <?php include('../php/templates/footer.php'); ?>
</body>
</html>
