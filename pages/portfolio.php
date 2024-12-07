<?php
require_once '../php/db/connect/conn.php'; // Adjust the path if necessary

try {
    // Fetch images from the database
    $stmt = $pdo->query("SELECT id, file_name, description FROM photos");
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching photos: " . $e->getMessage();
    exit; // Stop execution if there's a database error
}
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
                            data-id="<?= $photo['id'] ?>"
                            data-image-src="../php/logic/portfolio_fetch_image.php?id=<?= $photo['id'] ?>">
                            <img src="../php/logic/portfolio_fetch_image.php?id=<?= $photo['id'] ?>"
                                alt="<?= htmlspecialchars($photo['file_name']) ?>">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No photos found in the gallery.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Popup/Lightbox -->
        <div id="lightbox" class="lightbox">
            <div class="lightbox-content">
                <!-- Left: Mini Image Section -->
                <div class="lightbox-left">
                    <img id="lightbox-image" src="" alt="Selected Image" />
                </div>
                
                <!-- Right: Details Section -->
                <div class="lightbox-right">
                    <h3 id="lightbox-title">No Title Available</h3>
                    <p id="lightbox-description">No description available</p>
                    <p id="lightbox-file-size">File Size: N/A</p>
                    <p id="lightbox-dimensions">Dimensions: N/A</p>
                    <p id="lightbox-upload-date">Upload Date: N/A</p>
                </div>
                
                <!-- Close Button -->
                <div class="close-btn">&times;</div>
            </div>
        </div>
    </main>

    <?php include '../php/templates/footer.php'; ?>
</body>

</html>