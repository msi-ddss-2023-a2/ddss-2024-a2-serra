<?php
session_start();
require_once '../src/login-action.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtremely Secure - Login</title>
    <link rel="stylesheet" href="assets/styles.css"/>
    <script src="assets/htmx.min.js"></script>
    <meta name="htmx-config" content='{"selfRequestsOnly":false}'> 
</head>

<body>
<div class="main">

    <div class="loginForm">
    <form hx-post="/login" hx-target="#error-message" hx-swap="innerHTML">
        <div id="error-message" style="background-color: black; color: red;"></div>
        <table class="loginFields">
            <th>
                <b>Login Form</b>
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
                <button type="submit" id="login">Log In</button>
            </th>
        </table>
    </form>
    <a href="/register">
        <button id="register">Register</button>
    </a>
    </div>

</div>
</body>

</html>
