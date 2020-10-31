<?php 

require_once('../core/Autoload.php');

use app\core\Application;

$prueba = new Prueba();

$app = new Application();


$app = new Application();

$app->router->get('/', "Estas en Home");

$app->router->get('/login', 'Estas en login');

$app->run();
// $app->router->get('/register', [SiteController::class, 'register']);
// $app->router->post('/register', [SiteController::class, 'register']);
// $app->router->get('/login', [SiteController::class, 'login']);
// $app->router->post('/login', [SiteController::class, 'login']);
// $app->router->get('/logout', [SiteController::class, 'logout']);
// $app->router->get('/contact', [SiteController::class, 'contact']);
// $app->router->get('/about', [AboutController::class, 'index']);
// $app->router->get('/profile', [SiteController::class, 'profile']);