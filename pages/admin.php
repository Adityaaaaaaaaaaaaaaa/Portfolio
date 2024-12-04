<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'ua404';
    header("Location: 404.php");
    exit();
}

// Database connection
include '../php/db/connect/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the photo upload
    if (isset($_FILES['photo'])) {
        $file = $_FILES['photo'];
        $description = $_POST['description'];

        // Get file details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileError = $file['error'];

        // Set upload directory
        $uploadDir = "../upload/";
        $filePath = $uploadDir . basename($fileName);

        // Check for file errors
        if ($fileError === 0) {
            if ($fileSize < 10485760) { // 10MB limit
                // Move file to the uploads folder
                if (move_uploaded_file($fileTmpName, $filePath)) {
                    // Get image dimensions
                    list($width, $height) = getimagesize($filePath);

                    try {
                        // Insert metadata into the database
                        $stmt = $pdo->prepare("
                            INSERT INTO photos (image_path, file_name, file_size, width, height, description, mime_type) 
                            VALUES (:image_path, :file_name, :file_size, :width, :height, :description, :mime_type)
                        ");
                        $stmt->execute([
                            ':image_path' => $filePath,
                            ':file_name' => $fileName,
                            ':file_size' => $fileSize,
                            ':width' => $width,
                            ':height' => $height,
                            ':description' => $description,
                            ':mime_type' => $fileType,
                        ]);
                        echo "Photo uploaded successfully!";
                    } catch (PDOException $e) {
                        echo "Error uploading photo: " . $e->getMessage();
                    }
                } else {
                    echo "Failed to move the uploaded file.";
                }
            } else {
                echo "File size exceeds the limit (10MB).";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    }
}

// Fetch photos for display in the admin panel
try {
    $query = "SELECT * FROM photos";
    $result = $pdo->query($query);
} catch (PDOException $e) {
    die("Error fetching photos: " . $e->getMessage());
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
</head>

<body>
    <?php include '../php/templates/header.php'; ?>

    <h1 class="title">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p class="title">You are now logged in as an admin.</p>


    <div class="form-container">
        <form class="form" action="admin.php" method="POST" enctype="multipart/form-data">
            <span class="form-title">Select Photo:</span>
            <p class="form-paragraph">File should be an image</p>
            <label for="file-input" class="drop-container">
                <span class="drop-title">Drop files here</span>
                or
                <input type="file" name="photo" id="photo" accept="image/*" multiple required="" class="file-input">
            </label>
            <br>
            <label for="description" class="form-paragraph">Description:<br>
                <span class="form-paragraph">
                    <input type="text" name="description" class="description-input" id="description" placeholder="Enter description" required>
                </span>
            </label>
            <br>
            <button type="submit" class="next-button">
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

    <!-- Display Photos with Metadata -->
    <h2 class="title">Manage Uploaded Photos</h2>
    <div class="photo-gallery">
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="photo-item">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['file_name']); ?>" width="100">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($row['file_name']); ?></p>
                <p><strong>Size:</strong> <?php echo htmlspecialchars($row['file_size']); ?> bytes</p>
                <p><strong>Dimensions:</strong> <?php echo htmlspecialchars($row['width']); ?> x <?php echo htmlspecialchars($row['height']); ?></p>
                <p><strong>Description:</strong> <input type="text" name="description_<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['description']); ?>"></p>
                <form action="../php/logic/admin_update_delete.php" method="POST">
                    <input type="hidden" name="photo_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete">Delete</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include '../php/templates/footer.php'; ?>
</body>

</html>