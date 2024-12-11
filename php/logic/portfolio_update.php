<?php
require_once '../db/connect/conn.php';
session_start();

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is admin
    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
        exit;
    }

    // Get the input data
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id'], $input['file_name'], $input['description'])) {
        echo json_encode(['success' => false, 'message' => 'Incomplete data.']);
        exit;
    }

    $id = $input['id'];
    $file_name = trim($input['file_name']);
    $description = trim($input['description']);

    try {
        $stmt = $pdo->prepare("UPDATE photos SET file_name = :file_name, description = :description WHERE id = :id");
        $stmt->execute([
            ':file_name' => $file_name,
            ':description' => $description,
            ':id' => $id
        ]);

        if ($stmt->rowCount()) {
            echo json_encode(['success' => true, 'message' => 'Metadata updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes made or invalid ID.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
