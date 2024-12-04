<?php
header('Content-Type: application/json');
include '../db/connect/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['photo']) && isset($_POST['description'])) {
        $file = $_FILES['photo'];
        $description = $_POST['description'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        if ($fileSize < 10485760) { // 10MB limit
            $imageData = file_get_contents($fileTmpName);
            list($width, $height) = getimagesizefromstring($imageData);

            try {
                $stmt = $pdo->prepare("
                    INSERT INTO photos (image_path, file_name, file_size, width, height, description, mime_type) 
                    VALUES (:image_path, :file_name, :file_size, :width, :height, :description, :mime_type)
                ");
                $stmt->execute([
                    ':image_path' => 'data:' . $fileType . ';base64,' . base64_encode($imageData),
                    ':file_name' => $fileName,
                    ':file_size' => $fileSize,
                    ':width' => $width,
                    ':height' => $height,
                    ':description' => $description,
                    ':mime_type' => $fileType,
                ]);

                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'File size exceeds the limit (10MB).']);
        }
    }
}
?>
