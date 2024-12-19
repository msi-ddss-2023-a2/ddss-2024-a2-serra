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

$queried_title = $_GET['title'];
$search_term = "%$queried_title%";

$sql = "SELECT * FROM content WHERE title ILIKE :queried_title";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":queried_title", $search_term, PDO::PARAM_STR);

if ($stmt->execute()) {
    $found_row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($found_row) {
        echo "<b>" . htmlspecialchars($found_row['title']) . "</b>";
        echo "<p>" . htmlspecialchars($found_row['content']) . "</p>";
        
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