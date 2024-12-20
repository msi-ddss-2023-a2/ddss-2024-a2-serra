<?php
if (!isset($_SESSION)) {
    session_start();
}

// check if logged in
if (!isset($_SESSION['username'])) {
    header('Location: login'); // redirect to login
    exit();
}
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
    hx-post="api.php?file=create-new-post.php" 
    hx-target="#error-message" 
    hx-swap="innerHTML">
        <div id="error-message"></div>
        <h3>Content Upload Area</h3>

        <label for="title"></label>
        <input type="text" id="title" name="title" placeholder="Title for your new post"></input>

        <label for="textbox">Write something nice</label>
        <textarea type="textarea" id="textbox" 
        name="textbox" rows="7" cols="40">5 tips to secure all your information systems...</textarea>

        <button type="submit" id="post">Post</button>
    </form>
    </br>
    <a href='/search'>
        <button>Go To Content Search Area</button>
    </a>
    </div>

    <div class="lastPosts">
    <table>
        <thead>
            <th><b>Output Zone</b></th>
        </thead>
        <tbody id="output-body">

        </tbody>
    </table>
    </div>

    <button
    hx-get="api.php?file=get-last-posts.php"
    hx-target="#output-body"
    hx-swap="innerHTML">Get Latest Posts</button>

</div>
</body>
</html>