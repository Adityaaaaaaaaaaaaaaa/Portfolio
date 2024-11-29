<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Gallery</title>
    <link rel="stylesheet" href="../css/portfolio.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/portfolio.js"></script>
    <script src="../js/dark_mode.js"></script> 
</head>
<body>
    <?php include '../php/templates/header.php'; ?>
    
    <main>
        <section class="gallery">
            <h1>My Photography Gallery</h1>
            <div class="gallery-grid">
                <!-- Placeholder for images -->
                <div class="gallery-item" data-title="Photo 1" data-description="A beautiful scene.">
                    <img src="../assets/images-home/img1.png" alt="Photo 1">
                </div>
                <div class="gallery-item" data-title="Photo 2" data-description="Another beautiful scene.">
                    <img src="../assets/images-home/img2.png" alt="Photo 2">
                </div>
                <!-- Add more items dynamically -->
            </div>
        </section>

        <!-- Popup/Lightbox -->
        <div id="lightbox" class="lightbox">
            <div class="lightbox-content">
                <!-- Left: Image -->
                <div class="lightbox-left">
                    <img id="lightbox-image" src="" alt="Selected Image" />
                </div>
                <!-- Right: Metadata -->
                <div class="lightbox-right">
                    <h2 id="lightbox-title">Image Title</h2>
                    <p id="lightbox-description">Description or Metadata</p>
                </div>
                <!-- Close Button -->
                <div class="close-btn">&times;</div>
            </div>
        </div>
    </main>

    <?php include '../php/templates/footer.php'; ?>

</body>
</html>
