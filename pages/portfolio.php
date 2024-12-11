<?php
require_once '../php/db/connect/conn.php';
session_start();

// Fetch photos from the database
try {
    $stmt = $pdo->query("SELECT id, file_name, description FROM photos");
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching photos: " . $e->getMessage();
    exit;
}

// Check if an admin is logged in
$isAdmin = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Gallery</title>
    <link rel="stylesheet" href="../css/portfolio.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/portfolio.js" defer></script>
    <script src="../js/dark_mode.js" defer></script>
</head>

<body>
    <?php include '../php/templates/header.php'; ?>

    <main>
        <section class="gallery">
            <h1>My Photography Gallery</h1>
            <div class="gallery-grid">
                <?php if (!empty($photos)): ?>
                    <?php foreach ($photos as $photo): ?>
                        <div class="gallery-item" 
                            data-id="<?= htmlspecialchars($photo['id']) ?>"
                            data-image-src="../php/logic/portfolio_fetch_image.php?id=<?= htmlspecialchars($photo['id']) ?>">
                            <img src="../php/logic/portfolio_fetch_image.php?id=<?= htmlspecialchars($photo['id']) ?>"
                                alt="<?= htmlspecialchars($photo['file_name']) ?>">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No photos found in the gallery.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Lightbox Popup -->
        <div id="lightbox" class="lightbox">
            <div class="lightbox-content">
                <div class="lightbox-left">
                    <img id="lightbox-image" src="" alt="Selected Image" />
                </div>
                <div class="lightbox-right">
                    <h3 id="lightbox-title">No Title Available</h3>
                    <p id="lightbox-description">No description available</p>
                    <?php if ($isAdmin): ?>
                        <div id="admin-controls">
                            <button id="edit-btn">Edit</button>
                            <button id="delete-btn">Delete</button>
                            <div id="edit-controls" style="display: none;">
                                <input type="text" id="edit-title" placeholder="Edit Title">
                                <textarea id="edit-description" placeholder="Edit Description"></textarea>
                                <button id="save-btn">Save</button>
                                <button id="cancel-btn">Cancel</button>
                            </div>
                            <div id="lightbox-message" style="margin-top: 10px; font-size: 14px;"></div>
                        </div>
                    <?php else: ?>
                        <button id="download-btn">Download</button>
                    <?php endif; ?>
                </div>
                <div class="close-btn">&times;</div>
            </div>
        </div>
    </main>

    <?php include '../php/templates/footer.php'; ?>
</body>

</html>
