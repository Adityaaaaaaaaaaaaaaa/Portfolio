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

        <div class="quote-container">
            <p id="quote" class="quote">Fetching a quote...</p>
            <p id="author" class="author"></p>
        </div>

        <div class="quote-controls">
            <select id="category-selector">
                <option value="">Random</option>
            </select>
            <button id="fetch-quote-btn">Fetch Quote</button>
        </div>

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
                <h3>Photography ?</h3>
                <div class="skill-bar" data-skill="photo"></div>
            </div>
            <div class="skill">
                <h3>Coding ?</h3>
                <div class="skill-bar" data-skill="web"></div>
            </div>
            <div class="skill">
                <h3>Design ?</h3>
                <div class="skill-bar" data-skill="java"></div>
            </div>
        </div>
        <div class="button-container">
            <button class="buttony">
                <div class="icony">
                    <span class="text-icony hidey">Icon</span>
                    <svg
                        class="css-i6dzq1"
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        fill="none"
                        stroke-width="2"
                        stroke="currentColor"
                        height="24"
                        width="24"
                        viewBox="0 0 24 24">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg>
                </div>
                <span class="titley"> 'Do nothing button' </span>
                <div class="padding-lefty hidey">
                    <div class="padding-left-liney">
                        <span class="padding-left-texty">Left Padding</span>
                    </div>
                </div>
                <div class="padding-righty hidey">
                    <div class="padding-right-liney">
                        <span class="padding-right-texty">Right Padding</span>
                    </div>
                </div>
                <div class="backgroundy hidey">
                    <span class="background-texty">Background</span>
                </div>
                <div class="bordery hidey">
                    <span class="border-texty">Border Radius</span>
                </div>
            </button>

            <button id="buttonx" onclick="window.location.href = '/Portfolio/home.php';">
                Learn more 👀!
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