<?php
session_start();

$host = 'postgresql';
$dbname = getenv("DBNAME");
$user = getenv("DBUSER");
$password = getenv("DBPASS");

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, username, password FROM users WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);    // prepares sql statement (good)
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // matches password against a hash (good)
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // header("Location: home");
        header("HX-Redirect: home");
        die();
    } else {
        // http_response_code(401);
        echo "Invalid username or password";
        die();
    }

    $stmt = null;
    $pdo = null;
}
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
    <form hx-post="login.php" hx-target="#error-message" hx-swap="innerHTML">
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
