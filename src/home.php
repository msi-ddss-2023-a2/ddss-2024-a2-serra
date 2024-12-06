<?php
session_start();

// check if logged in
if (!isset($_SESSION['username'])) {
    header('Location: login'); // redirect to login
    exit();
}

// and display homepage if thats the case
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtremely Secure - Home</title>
    <link rel="stylesheet" href="assets/styles.css"/>
</head>

<body>
    <div class="main">
        <h2>Hello</h2>
    </div>
</body>
</html>