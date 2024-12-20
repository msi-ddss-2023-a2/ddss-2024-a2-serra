<?php
require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // verify if user already exists?
    $sql_verify = "SELECT username FROM users_unsafe WHERE username = '" . $username . "'";
    $stmt = $pdo->query($sql_verify);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // already exists
        echo "Username " . $user["username"] . " already exists. Try another one!";
        die();
    }

    // adds new user with non-hashed password to db
    $sql = "INSERT INTO users_unsafe (username, password) VALUES ('" . $username . "', '" . $password . "')";
    $stmt = $pdo->query($sql);

    if ($stmt) {
        // header("Location: login");
        echo "Registration successful! You may now <a href='/login'>login</a> as " . htmlspecialchars($username) . ".";
        // sleep(2);
        die();
    } else {
        echo "Error: " . $pdo->errorInfo()[2];
        die();
    }

    // $stmt = null;
    // $pdo = null;
}
?>