<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'ua404';
    header("Location: 404.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/dark_mode.js"></script>
    <script src="../js/admin.js" defer></script>
</head>

<body>
    <?php include '../php/templates/header.php'; ?>

    <h1 class="title">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p class="title">You are now logged in as an admin.</p>

    <!-- File Upload Form -->
    <div class="form-container">
        <form class="form" id="fileUploadForm">
            <span class="form-title">Select Photo:</span>
            <p class="form-paragraph">File should be an image</p>
            <label for="file-input" class="drop-container">
                <span class="drop-title">Drop files here</span>
                or
                <input type="file" id="photo" accept="image/*" multiple class="file-input">
            </label>
            <br>
            <button type="button" id="nextButton" class="next-button">
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

    <!-- Scrollable Photo Preview -->
    <div id="photoPreviewContainer" class="photo-preview-container hidden">
        <h2 class="title">Manage Selected Photos</h2>
        <div class="photo-preview-scroll">
            <div id="photoPreviewList" class="photo-gallery"></div>
        </div>
        <div class="actions">
            <button id="uploadAllButton" class="action-button-all">Upload All</button>
            <button id="removeAllButton" class="action-button-all">Remove All</button>
        </div>
    </div>

    <?php include '../php/templates/footer.php'; ?>
</body>

</html>
