<?php

require_once 'include/db.php';

$sql = "SELECT * FROM content_unsafe ORDER BY title DESC LIMIT 3";
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