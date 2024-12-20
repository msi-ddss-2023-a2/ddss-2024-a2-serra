<?php
session_start();

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    $filePath = '../src/' . basename($file);

    if (file_exists($filePath)) {
        include $filePath;
    } else {
        http_response_code(404);
        echo "File not found";
    }
} else {
    http_response_code(404);
    echo "No file specified";
}
?>