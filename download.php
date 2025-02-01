<?php
require 'vendor/autoload.php';  // Include MongoDB library

// Check if code is provided
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Connect to MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->file_sharing->files;

    // Check if the code exists in the database
    $file = $collection->findOne(['code' => (int)$code]);

    if ($file) {
        // If the code is valid, serve the file for download
        $filePath = $file['path'];
        if (file_exists($filePath)) {
            // Set headers to trigger file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "<script>alert('File not found.'); window.location.href = 'index.php';</script>";
        }
    } else {
        // If the code is invalid
        echo "<script>alert('Invalid code. Please check the code and try again.'); window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('No code provided.'); window.location.href = 'index.php';</script>";
}
?>
