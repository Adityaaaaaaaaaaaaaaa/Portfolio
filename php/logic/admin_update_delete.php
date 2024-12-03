<?php
include '../db/connect/conn.php'; // Include the database connection

// Handle Update
if (isset($_POST['update'])) {
    $photoId = $_POST['photo_id'];
    $newDescription = $_POST['description'];

    try {
        $stmt = $pdo->prepare("UPDATE photos SET description = :description WHERE id = :id");
        $stmt->execute([
            ':description' => $newDescription,
            ':id' => $photoId,
        ]);
        echo "Description updated successfully!";
    } catch (PDOException $e) {
        echo "Error updating description: " . $e->getMessage();
    }
}

// Handle Delete
if (isset($_POST['delete'])) {
    $photoId = $_POST['photo_id'];

    try {
        // Fetch the image path for deletion
        $stmt = $pdo->prepare("SELECT image_path FROM photos WHERE id = :id");
        $stmt->execute([':id' => $photoId]);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image && file_exists($image['image_path'])) {
            unlink($image['image_path']); // Delete the file from the server
        }

        // Delete the record from the database
        $stmt = $pdo->prepare("DELETE FROM photos WHERE id = :id");
        $stmt->execute([':id' => $photoId]);

        echo "Photo deleted successfully!";
    } catch (PDOException $e) {
        echo "Error deleting photo: " . $e->getMessage();
    }
}

header("Location: ../../pages/admin.php");
exit();
