<?php

namespace app\core;

use app\core\db\Database;
use app\models\User;

class Application
{
     public static Application $app;
     public static string $ROOT_DIR;
     public Router $router;
     public Request $request;
     public Response $response;
     public ?Controller $controller = null;
     public View $view;

     public Database $db;
     public Session $session;
     public string $userClass;
     public ?User $user ;

     public function __construct($rootDir, $config)
     {     
          self::$ROOT_DIR = $rootDir;
          self::$app = $this;

          $this->user = null;
          $this->userClass = $config['userClass'];

          $this->db = new Database($config['db']);
          $this->session = new Session();

          $this->request = new Request();
          $this->response = new Response();
          $this->router = new Router($this->request, $this->response);
          $this->view = new View();

          $userId = $this->session->getUser();

          if($userId)
               $this->user = $this->userClass::findOne( [ 'id' => $userId ] );

     }

     public static function isGuest()
    {
          return !self::$app->user;
    }

     public function logout()
     {
          $this->user = null;
          self::$app->session->remove('user');
     }

     public function run() 
     {
     //    try {
               echo $this->router->resolve();
     //    } catch (\Exception $e) {
     //        echo $this->router->renderView('_error', [
     //            'exception' => $e,
     //        ]);
     //    }
     }
}
