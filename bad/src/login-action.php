<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);   // Possible XSS vuln
    $password = trim($_POST['password']);

    $sql = "SELECT id, username, password FROM users_unsafe WHERE 
        username = '" . $username . "' AND 
        password = '" . $password . "' LIMIT 1";
    $stmt = $pdo->query($sql);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // matches password against a string (bad)
    if ($user && $password == $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("HX-Redirect: home"); // because im using htmx in frontend
    } else {
        echo "Invalid username or password";
        die();
    }

    $pdo = null;
}
?>