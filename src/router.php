<?php
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//define mapping
$routes = [
    '/' => 'home.php',
];

if (array_key_exists($request_uri, $routes)) {
    include $routes[$request_uri];
} else {
    // 404
    http_response_code(404);
    echo "Page not found!!";
}
?>