<?php
include_once '../db/connect/conn.php'; // Ensure that your DB connection is included

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate and handle the uploaded file
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpName = $_FILES['photo']['tmp_name'];
            //$fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $fileType = $_FILES['photo']['type'];
            $description = $_POST['description'] ?? 'No description';
            $updatedFileName = $_POST['updatedFileName'] ?? $_FILES['photo']['name'];


            // Get image dimensions
            $imageSize = getimagesize($fileTmpName);
            $width = $imageSize[0];
            $height = $imageSize[1];

            // Read the file's binary data
            $imageData = file_get_contents($fileTmpName);

            // SQL query to insert the data
            $query = "
                INSERT INTO photos (image_data, file_name, file_size, width, height, description, mime_type)
                VALUES (:image_data, :file_name, :file_size, :width, :height, :description, :mime_type)
            ";

            // Prepare the query
            $stmt = $pdo->prepare($query);

            // Bind the parameters
            $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB); // Bind binary data as LOB
            $stmt->bindParam(':file_name', $updatedFileName);
            $stmt->bindParam(':file_size', $fileSize);
            $stmt->bindParam(':width', $width);
            $stmt->bindParam(':height', $height);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':mime_type', $fileType);

            // Execute the query
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Image uploaded successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No valid file uploaded.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }

    // Close the database connection
    $pdo = null;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
