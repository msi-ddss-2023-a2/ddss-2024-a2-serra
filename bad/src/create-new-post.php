<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $textcontent  = trim($_POST['textbox']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO content_unsafe (user_id, title, content) VALUES (" . $user_id . ", '" . $title . "', '" . $textcontent . "')";
    $stmt = $pdo->exec($sql);

    if ($stmt) {
        echo "New post successfully created!";

        die();
    } else {
        echo "Error: " . $stmt->error;

        die();
    }
}
?>