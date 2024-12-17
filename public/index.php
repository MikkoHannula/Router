<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\CustomerController;
use App\Controller\LoginController;
use App\Controller\DashboardController;
use App\AuthMiddleware;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new Router();

$router->get('/', [HomeController::class, 'home']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/posts', [HomeController::class, 'posts']);

$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'handleRegister']);

$router->get('/login', [LoginController::class, 'showLoginForm']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->post('/login', [LoginController::class, 'login']);

$router->get('/dashboard', [DashboardController::class, 'index'], [AuthMiddleware::class, 'handle']);

// Customers
$router->get('/customers', [CustomerController::class, 'getCustomers']);
$router->get('/customer/{id}', [CustomerController::class, 'getCustomer']);
$router->post('customer/add', [CustomerController::class, 'addCustomer']);

$router->get('/test', function(){
  echo 'test';
});


$router->run();

