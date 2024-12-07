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
                            data-title="<?= htmlspecialchars($photo['file_name']) ?>"
                            data-description="<?= htmlspecialchars($photo['description']) ?>">
                            <img src="../php/logic/portfolio_fetch.php?id=<?= $photo['id'] ?>"
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
                <div class="lightbox-left">
                    <img id="lightbox-image" src="" alt="Selected Image" />
                </div>
                <div class="lightbox-right">
                    <h2 id="lightbox-title">Image Title</h2>
                    <p id="lightbox-description">Description or Metadata</p>
                </div>
                <div class="close-btn">&times;</div>
            </div>
        </div>
    </main>

    <?php include '../php/templates/footer.php'; ?>
</body>

</html>