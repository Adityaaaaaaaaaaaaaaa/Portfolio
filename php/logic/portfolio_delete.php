<?php
require_once '../db/connect/conn.php';
session_start();

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if user is admin
    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
        exit;
    }

    // Get the input data (ID from URL query string)
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        exit;
    }

    try {
        // Get the image file path
        $stmt = $pdo->prepare("SELECT * FROM photos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $photo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$photo) {
            echo json_encode(['success' => false, 'message' => 'Photo not found.']);
            exit;
        }

        $file_path = $photo['file_path'];

        // Delete the database entry
        $stmt = $pdo->prepare("DELETE FROM photos WHERE id = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount()) {
            // Delete the physical file
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            echo json_encode(['success' => true, 'message' => 'Photo deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete photo.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
