<?php

// Require composer autoloader
require __DIR__ . './../../vendor/autoload.php';




/*
*
*    ROUTER
*
*/
// Create Router instance
$router = new \Bramus\Router\Router();

// Before Router Middleware
$router->before('GET', '/.*', function () {
    header('X-Powered-By: g-server');
});

/*admin auth*/
$router->before('GET|POST|DELETE', '/admin/.*', function() {///admin/.*
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});



session_start();

// Define routes
$router->get('/','\Web\OS\Controllers\PageController@home');

//web auth
$router->get('/login','\Web\OS\Controllers\AuthController@get_login');
$router->post('/login','\Web\OS\Controllers\AuthController@post_login');

$router->get('/admin/','\Web\OS\Controllers\PageController@home');






$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "<span style='margin-top:30px;'/><p style='font-size:3em;color:gray;'>404 - Page not found.</p>";
});



// Run it!
$router->run();





?>