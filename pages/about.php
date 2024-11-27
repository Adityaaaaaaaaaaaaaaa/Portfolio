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
                <p><strong>Nov 2022</strong> - Began Coding Journey</p>
                <p>Started the University journey.</p>
            </div>
            <div class="timeline-item">
                <p><strong>Year 1 - 2022 - 2023</strong> - University</p>
                <p>lost, studying java, built a website, did not know what to do</p>
            </div>
            <div class="timeline-item">
                <p><strong>Year 2 - 2023 - 2024</strong> - University</p>
                <p>Crazy year, still figuting out howI landed my internship, how did I make till the exams</p>
            </div>
            <div class="timeline-item">
                <p><strong>Year 3 - 2024 - 2025</strong> - University</p>
                <p>Will update in due time, stay tuned !</p>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills-section">
        <h2>My Skills</h2>
        <div class="skills-container">
            <div class="skill">
                <h3>Photography</h3>
                <div class="skill-bar" data-skill="photo"></div>
            </div>
            <div class="skill">
                <h3>Web Development</h3>
                <div class="skill-bar" data-skill="web"></div>
            </div>
            <div class="skill">
                <h3>Java</h3>
                <div class="skill-bar" data-skill="java"></div>
            </div>
        </div>
        <div class="button-container">
            <button id="buttonx" onclick="window.location.href = '/Portfolio/home.php';">
                Learn more !
            </button>
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
