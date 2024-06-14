<?php
if (isset($_GET['file'])) {
    // Sanitize the input to prevent directory traversal attacks
    $file = basename($_GET['file']);
    $filePath = '../mods/' . $file;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Get the file's MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);

        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output its contents
        readfile($filePath);
        exit;
    } else {
        // Log error or notify admin
        http_response_code(404);
        die('Error: File not found.');
    }
} else {
    http_response_code(400);
    die('Error: No file specified.');
}
?>
