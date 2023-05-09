<?php

use Kadex\Route;
 
$router = new Route();

$router->get('/', 'Kadex\controllers\HomeController::index');
$router->post('/login', 'Kadex\controllers\AuthController::login');

$router->run();