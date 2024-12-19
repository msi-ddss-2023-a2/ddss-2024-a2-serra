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
    <script src="assets/htmx.min.js"></script>
    <meta name="htmx-config" content='{"selfRequestsOnly":false}'>
</head>

<body>
<div class="main">

    <div class="contentForm">
    <form class="contentFields"
    hx-post="home.php" 
    hx-target="#error-message" 
    hx-swap="innerHTML">
        <div id="error-message"></div>
        <h3>Content Search Area</h3>
    </form>
    </br>
    <a href='/home'>
        <button>Go To Content Posting Area</button>
    </a>
    </div>

</div>
</body>
</html>