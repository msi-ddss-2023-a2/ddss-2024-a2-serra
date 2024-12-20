<?php
require_once '../src/register-action.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtremely Secure - Register</title>
    <link rel="stylesheet" href="assets/styles.css"/>
    <script src="assets/htmx.min.js"></script>
    <meta name="htmx-config" content='{"selfRequestsOnly":false}'>
</head>

<body>
<div class="main">

    <div class="loginForm">
    <form 
    hx-post="/register" 
    hx-target="#error-message" 
    hx-swap="innerHTML">
        <div id="error-message"></div>
        <table class="loginFields">
            <th>
                <b>Registration</b>
            </th>
            <tr>
                <td>
                    <label for="username">Username</label>
                </td>
                <td>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password</label>
                </td>
                <td>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required></input>
                </td>
            </tr>
            <th>
                <button type="submit" id="login">Create Account</button>
            </th>
        </table>
    </form>
    </div>

</div>
</body>

</html>