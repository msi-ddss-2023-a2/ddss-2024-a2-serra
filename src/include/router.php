<?php
session_start();

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/login':
        include('login.php');
        break;
    case '/register':
        include('register.php');
        break;
    case '/home':
        include('home.php');
        break;
    default:
        include('index.php');
        break;
}
?>