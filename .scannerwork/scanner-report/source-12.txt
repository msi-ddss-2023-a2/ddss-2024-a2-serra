<?php
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
?>