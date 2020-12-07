<?php 

require_once('../core/Autoload.php');
require_once('../config/DB.php');

use app\core\Application;
use app\controllers\AddImageController;
use app\controllers\HomeController;
use app\controllers\ProfileController;
use app\controllers\SigninController;

$config = [
     'userClass' => \app\models\User::class,
     'db' => [
          'dsn' => $DB_DSN,
          'user' => $DB_USER,
          'password' => $DB_PASSWORD
     ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SigninController::class, 'renderForm']);
$app->router->get('/signin', [SigninController::class, 'renderForm']);
$app->router->post('/login', [SigninController::class, 'login']);
$app->router->post('/register', [SigninController::class, 'register']);

$app->router->get('/home', [HomeController::class, 'home']);
$app->router->get('/add_image', [AddImageController::class, 'addImage']);
$app->router->get('/profile', [ProfileController::class, 'profile']);
        

$app->run();