<?php
require 'vendor/autoload.php';

// Upload file handling
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = $file['name'];
    $fileTempPath = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Check for upload errors
    if ($fileError === 0) {
        $uniqueCode = rand(100000, 999999);  // Generating a random 6-digit code

        // Specify the upload path
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . $filename;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($fileTempPath, $filePath)) {
            // Connect to MongoDB
            $client = new MongoDB\Client("mongodb://localhost:27017");
            $collection = $client->file_sharing->files;

            // Insert file details into the database
            $collection->insertOne([
                'filename' => $filename,
                'path' => $filePath,
                'code' => $uniqueCode
            ]);

            // Redirect to success page with the code
            header('Location: success.php?code=' . $uniqueCode);
            exit();
        } else {
            echo "<script>alert('File upload failed.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Error uploading file.'); window.location.href = 'index.php';</script>";
    }
}
?>
