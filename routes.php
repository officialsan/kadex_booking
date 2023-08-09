<?php

use Kadex\Route;
 
$router = new Route();

$router->get('/', 'Kadex\controllers\HomeController::index');
$router->get('/signup', 'Kadex\controllers\AuthController::signup');
$router->post('/register', 'Kadex\controllers\AuthController::register');
$router->get('/detail/:id', 'Kadex\controllers\HomeController::detail');
$router->post('/login', 'Kadex\controllers\AuthController::login');
$router->post('/get-otp', 'Kadex\controllers\AuthController::getOtp');
$router->post('/check-otp', 'Kadex\controllers\AuthController::checkOtp');
$router->get('/logout', 'Kadex\controllers\AuthController::logout');
$router->get('/modal-product/:id', 'Kadex\controllers\HomeController::productDetails');
$router->get('/add-to-cart', 'Kadex\controllers\HomeController::addToCart');
$router->get('/remove-item', 'Kadex\controllers\HomeController::removeItem');
$router->get('/update-cart-date-time', 'Kadex\controllers\HomeController::updateDateAndTime');
$router->get('/checkout', 'Kadex\controllers\HomeController::checkout');
$router->post('/order-submit', 'Kadex\controllers\HomeController::orderSubmit');
$router->get('/confirm', 'Kadex\controllers\HomeController::confirm');
$router->run();