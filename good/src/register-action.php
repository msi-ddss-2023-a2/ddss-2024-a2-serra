<?php
require_once 'include/db.php';

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

    // $stmt = null;
    // $pdo = null;
}
?>