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

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    }
?>