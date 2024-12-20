<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, username, password FROM users_unsafe WHERE 
        username = '" . $username . "' AND 
        password = '" . $password . "' LIMIT 1";
    $stmt = $pdo->query($sql);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // matches password against a hash (good)
    if ($user && $password == $user['password']) {
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

    // $stmt = null;
    // $pdo = null;
}
?>