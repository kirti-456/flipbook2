<?php
session_start();
include('database.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to save a flipbook.";
        exit;
    }

    $userId = $_SESSION['user_id'];
    $flipbookName = $_POST['flipbookName'] ?? 'Unnamed Flipbook';

    // Sanitize and create a folder name based on the flipbook name
    $safeFlipbookName = preg_replace('/[^a-zA-Z0-9_]/', '_', $flipbookName);
    $flipbookDir = "uploads/flipbooks/$userId/$safeFlipbookName/";

    // Create the directory if it doesn't exist
    if (!is_dir($flipbookDir)) {
        mkdir($flipbookDir, 0777, true);
    }

    $imagePaths = []; // To store paths of extracted images
      
    // Handle PDF uploads
    if (isset($_FILES['flipbookFile']) && $_FILES['flipbookFile']['type'] === 'application/pdf') {
        $pdfFile = $_FILES['flipbookFile']['tmp_name'];
        $pdfFileName = uniqid() . '.pdf';
        $pdfPath = $flipbookDir . $pdfFileName;

        if (move_uploaded_file($pdfFile, $pdfPath)) {
            // Extract images from the PDF and save them in the same directory
            $imagePaths = extractImagesFromPDF($pdfPath, $flipbookDir);
        } else {
            echo "Error uploading the PDF.";
            exit;
        }
    }

    // Save flipbook information to the database
    $stmt = $conn->prepare("INSERT INTO flipbooks (user_id, flipbook_name, flipbook_path) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $flipbookName, $flipbookDir);

    if ($stmt->execute()) {
        $flipbookId = $stmt->insert_id; // Get the inserted flipbook ID

        // Save extracted images to the database
        if (!empty($imagePaths)) {
            $imageStmt = $conn->prepare("INSERT INTO flipbook_images (flipbook_id, image_path) VALUES (?, ?)");
            foreach ($imagePaths as $imagePath) {
                $imageStmt->bind_param("is", $flipbookId, $imagePath);
                $imageStmt->execute();
            }
        }

        echo "Flipbook saved successfully!";
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error saving flipbook: " . $stmt->error;
    }

    if (!isset($_FILES['flipbookFile']) || $_FILES['flipbookFile']['error'] === UPLOAD_ERR_NO_FILE) {
        echo "Please upload a file before saving the flipbook.";
        exit;
    }
    
}

// Function to extract images from a PDF and save them as JPEGs
function extractImagesFromPDF($pdfPath, $outputDir) {
    // Ensure the output directory exists
    if (!is_dir($outputDir)) {
        if (!mkdir($outputDir, 0777, true)) {
            echo "Error: Unable to create output directory.";
            return [];
        }
    }

    // Command to convert PDF to images (each page as a JPEG)
    $outputPattern = $outputDir . DIRECTORY_SEPARATOR . 'page_%d.jpg'; // Pattern for output files
    $command = "pdftoppm -jpeg -r 300 " . escapeshellarg($pdfPath) . " " . escapeshellarg($outputPattern);

    // Execute the command
    exec($command, $output, $returnVar);

    // Check if the command was successful
    if ($returnVar !== 0) {
        echo "Error: Failed to convert PDF to images.";
        return [];
    }

    // Gather the paths of the saved images
    $imagePaths = [];
    foreach (glob($outputDir . DIRECTORY_SEPARATOR . 'page_*.jpg') as $imagePath) {
        $imagePaths[] = $imagePath;
    }

    return $imagePaths;
}
?>
