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

    <!-- Manage Section -->
    <h2 class="title">Manage Selected Photos</h2>
    <div id="manage-section" class="photo-gallery">
        <!-- Files will be dynamically displayed here -->
    </div>
    <div id="batch-buttons" style="display: none;">
        <button id="upload-all" class="action-button">Upload All</button>
        <button id="remove-all" class="action-button">Remove All</button>
    </div>

    <!-- Display Existing Photos with Metadata -->
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

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fileInput = document.getElementById("file-input");
            const nextButton = document.getElementById("next-button");
            const manageSection = document.getElementById("manage-section");
            const batchButtons = document.getElementById("batch-buttons");
            const uploadAllBtn = document.getElementById("upload-all");
            const removeAllBtn = document.getElementById("remove-all");
            const filesList = new Map(); // Store files for reference

            // Handle "Next" button click
            nextButton.addEventListener("click", () => {
                const files = Array.from(fileInput.files);
                if (!files.length) {
                    alert("Please select at least one file.");
                    return;
                }
                files.forEach((file, index) => {
                    const fileId = `${file.name}-${index}`;
                    if (filesList.has(fileId)) return;

                    // Store file reference
                    filesList.set(fileId, file);

                    // Create file card
                    const fileCard = document.createElement("div");
                    fileCard.className = "photo-item";
                    fileCard.id = fileId;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        fileCard.innerHTML = `
                            <img src="${e.target.result}" alt="${file.name}" width="100">
                            <p><strong>Name:</strong> ${file.name}</p>
                            <p><strong>Size:</strong> ${file.size} bytes</p>
                            <p><strong>Description:</strong> 
                                <input type="text" class="description-input" placeholder="Enter description">
                            </p>
                            <button class="upload-button">Upload</button>
                            <button class="remove-button">Remove</button>
                        `;
                        manageSection.appendChild(fileCard);
                        batchButtons.style.display = "block";

                        // Add event listeners for buttons
                        fileCard.querySelector(".upload-button").addEventListener("click", () => handleUpload(fileId));
                        fileCard.querySelector(".remove-button").addEventListener("click", () => handleRemove(fileId));
                    };
                    reader.readAsDataURL(file);
                });
            });

            const handleUpload = (fileId) => {
                const file = filesList.get(fileId);
                if (!file) return;

                const fileCard = document.getElementById(fileId);
                const description = fileCard.querySelector(".description-input").value;

                const formData = new FormData();
                formData.append("photo", file);
                formData.append("description", description);

                fetch("../php/logic/upload_file.php", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            fileCard.querySelector(".upload-button").disabled = true;
                            alert("File uploaded successfully!");
                        } else {
                            alert("Upload failed: " + data.message);
                        }
                    });
            };

            const handleRemove = (fileId) => {
                const fileCard = document.getElementById(fileId);
                fileCard.remove();
                filesList.delete(fileId);

                if (filesList.size === 0) batchButtons.style.display = "none";
            };

            uploadAllBtn.addEventListener("click", () => {
                filesList.forEach((_, fileId) => handleUpload(fileId));
            });

            removeAllBtn.addEventListener("click", () => {
                filesList.forEach((_, fileId) => handleRemove(fileId));
            });
        });
    </script>
</body>

</html>
