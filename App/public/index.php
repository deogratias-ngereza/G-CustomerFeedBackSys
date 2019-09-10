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
session_start();
//routes definations
include_once("./../Routes/routes.php");
// Run it!
$router->run();





?>