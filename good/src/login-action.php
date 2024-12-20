<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username'])); // Possibly fix XSS vuln
    $password = htmlspecialchars(trim($_POST['password']));

    $sql = "SELECT id, username, password FROM users WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);    // prepares sql statement (good)
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // matches password against a hash (good)
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['username'] = $user['username'];

        header("HX-Redirect: home");    // because im using htmx in frontend
    } else {
        echo "Invalid username or password";
    }

    unset($pdo);
}
?>