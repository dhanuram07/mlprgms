<?php
// Get the file parameter from the URL and sanitize it
$file = basename($_GET['file']);

// Define the full path to the file (same directory as the script)
$file_path = __DIR__ . '/' . $file;

// Debugging: Output the file path
error_log("Requested file: " . $file);
error_log("Full file path: " . $file_path);

// Check if file exists
if (file_exists($file_path)) {
    // Set headers
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_path));
    header('Content-Length: ' . filesize($file_path));
    header('Cache-Control: private');
    
    // Flush the output buffer
    ob_clean();
    flush();
    
    // Read the file and output it
    readfile($file_path);
    exit;
} else {
    // File not found
    http_response_code(404);
    error_log("Error: File not found at " . $file_path); // Log error for debugging
    die('Error: File not found at ' . $file_path);
}
?>
