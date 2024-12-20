<?php
if (!isset($_SESSION)) {
    session_start();
}

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

    <div class="searchForm">
    <form class="searchFields"
    hx-get="api.php?file=find-post.php"
    hx-target="#found-body"
    hx-swap="innerHTML">
        <div id="error-message"></div>
        
        <table>
            <thead>
                <th><b>Content Search Area</b></th>
            </thead>

            <tbody>
                <tr>
                    <td><label for="title">Title</label></td>
                    <td>
                        <input type="text" id="title" name="title"></input>
                    </td>
                </tr>
                <tr>
                    <td><label for="author">Author</label></td>
                    <td>
                        <input type="text" id="author" name="author"></input>
                    </td>
                </tr>
            </tbody>
        </table>
        <button
        type="submit" 
        id="find">Find Post</button>
    </form>

    </br>

    <a href='/home'>
        <button>Go To Content Posting Area</button>
    </a>
    </div>

    <div class="foundPost">
        <b>Found Post</b>
        <div id="found-body" class="foundBody"></div>
    </div>
</div>
</body>
</html>