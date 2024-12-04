<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script defer src="../js/admin.js"></script>
</head>

<body>
    <?php include '../php/templates/header.php'; ?>

    <h1 class="title">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p class="title">You are now logged in as an admin.</p>

    <!-- File Selection Section -->
    <div class="form-container">
        <form id="file-form" class="form" enctype="multipart/form-data">
            <span class="form-title">Select Photos:</span>
            <p class="form-paragraph">File should be images.</p>
            <label for="file-input" class="drop-container">
                <span class="drop-title">Drop files here</span>
                or
                <input type="file" id="file-input" accept="image/*" multiple required class="file-input">
            </label>
            <button type="button" class="next-button" id="next-button">
                <span class="labelx">Next</span>
                <span class="iconx">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                    </svg>
                </span>
            </button>
        </form>
    </div>

    <!-- Scrollable Window for Selected Photos -->
    <h2 class="title">Manage Selected Photos</h2>
    <div id="manage-section-container" class="scrollable-window">
        <div id="manage-section" class="photo-gallery"></div>
    </div>
    <div id="batch-buttons" style="display: none;">
        <button id="upload-all" class="action-button">Upload All</button>
        <button id="remove-all" class="action-button">Remove All</button>
    </div>

    <?php include '../php/templates/footer.php'; ?>
</body>

</html>
