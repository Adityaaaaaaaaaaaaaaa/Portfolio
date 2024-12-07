<?php
require_once '../db/connect/conn.php'; // Adjust the path if necessary

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer
    try {
        $stmt = $pdo->prepare("SELECT image_data, mime_type FROM photos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $photo = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($photo) {
            // Set appropriate headers and output the image
            header("Content-Type: " . $photo['mime_type']);
            echo $photo['image_data'];
            exit;
        } else {
            http_response_code(404);
            echo "Image not found.";
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Error retrieving image: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "Invalid request. No ID provided.";
}
