<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $parts = explode('/', $file);

    if (count($parts) == 2) {
        $name = urlencode($parts[0]);
        $version_number = urlencode($parts[1]);
        
        // Predefined version
        $version = 'version';

        $modrinthUrl = 'https://modrinth.com/mod/' . $name . '/' . $version . '/' . $version_number;

        // Redirect user to Modrinth download URL
        header('Location: ' . $modrinthUrl);
        exit;
    } else {
        http_response_code(400);
        die('Error: Invalid file parameter format. Use name/version_number.');
    }
} else {
    http_response_code(400);
    die('Error: No file specified.');
}
?>
