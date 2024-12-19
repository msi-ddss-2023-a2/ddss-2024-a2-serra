<?php
session_start();

$host = 'postgresql';
$dbname = getenv("DBNAME");
$dbuser = getenv("DBUSER");
$dbpw = getenv("DBPASS");

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $textcontent  = trim($_POST['textbox']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO content (user_id, title, content) VALUES (:user_id, :title, :textcontent)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
    $stmt->bindParam(":textcontent", $textcontent, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "New post successfully created!";

        die();
    } else {
        echo "Error: " . $stmt->error;

        die();
    }
}
?>