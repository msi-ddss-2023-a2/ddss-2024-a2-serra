<?php

require_once 'include/db.php';

$queried_title = $_GET['title'];
$search_term = "%$queried_title%";

$sql = "SELECT * FROM content WHERE title ILIKE " . $search_term;
$stmt = $pdo->query($sql);

if ($stmt) {
    $found_row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($found_row) {
        echo "<b>" . $found_row['title'] . "</b>";
        echo "<p>" . $found_row['content'] . "</p>";
        
        die();
    } else {
        echo "No Data Found...";

        die();
    }

    die();
} else {
    echo "Error Executing Statement...";

    die();
}
?>