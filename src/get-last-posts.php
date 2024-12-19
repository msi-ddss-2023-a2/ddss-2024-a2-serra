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

$sql = "SELECT * FROM content ORDER BY created_at DESC LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

if ($rows) {
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['content']) . "</td>";
        echo "</tr>";
    }

    die();
} else {
    echo "<tr><td>No Data Found...</td></tr>";

    die();
}
?>