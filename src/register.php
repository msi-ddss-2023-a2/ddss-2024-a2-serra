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

    // verify if user already exists?
    $sql_verify = "SELECT username FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql_verify);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // already exists
        echo "Username " . $user["username"] . " already exists. Try another one!";
        die();
    }

    $hash_options = [
        'cost' => 12
    ];

    // adds new user with hashed password to db
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);    // prepares sql statement (good)
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $hashed_pw = password_hash($password, PASSWORD_BCRYPT, $hash_options);
    $stmt->bindParam(':password', $hashed_pw, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // header("Location: login");
        echo "Registration successful! You may now <a href='/login'>login</a> as " . htmlspecialchars($username) . ".";
        // sleep(2);
        die();
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Xtremely Secure - Register</title>
    <link rel="stylesheet" href="./styles.css"/>
    
    <script src="./htmx.min.js"></script>
    <meta name="htmx-config" content='{"selfRequestsOnly":false}'>
    
</head>

<body>
<div class="main">

    <div class="loginForm">
    <form hx-post="register.php" hx-target="#error-message" hx-swap="innerHTML">
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