<?php 

require_once('../core/Autoload.php');

use app\core\Application;
use app\controllers\AddImageController;
use app\controllers\HomeController;
use app\controllers\ProfileController;
use app\controllers\SigninController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/home', [HomeController::class, 'home']);
$app->router->get('/signin', [SigninController::class, 'signin']);
$app->router->get('/add_image', [AddImageController::class, 'addImage']);
$app->router->get('/profile', [ProfileController::class, 'profile']);

$app->run();