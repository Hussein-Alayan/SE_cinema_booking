<?php

$apis = [
    '/user'  => ['controller' => 'UserController', 'method' => 'handleRequest'],
    '/movie' => ['controller' => 'MovieController', 'method' => 'handleRequest'],
    '/auth' => ['controller' => 'AuthController', 'method' => 'handleRequest'],
];

//----------------------------------------------------------
// Define your base directory 
$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the base directory from the request if present
if (strpos($request, $base_dir) === 0) {
    $request = substr($request, strlen($base_dir));
}

// Remove /api.php from the request path
$request = str_replace('/api.php', '', $request);

// Ensure the request is at least '/'
if ($request == '') {
    $request = '/';
}

//Routing Logic here 
//----------------------------------------------------------
if (isset($apis[$request])) {
    $controller_name = $apis[$request]['controller'];
    $method = $apis[$request]['method'];
    require_once __DIR__ . "/../controllers/{$controller_name}.php";

    $controller = new $controller_name();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Error: Method {$method} not found in {$controller_name}.";
    }
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => '404 Not Found']);
}
