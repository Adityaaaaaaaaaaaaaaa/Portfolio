<?php
require_once '../db/connect/conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $stmt = $pdo->prepare("
            SELECT id, file_name, file_size, width, height, upload_date, description 
            FROM photos 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $metadata = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($metadata) {
            header('Content-Type: application/json');
            echo json_encode($metadata);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Metadata not found"]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request, no ID provided"]);
}
