<?php

namespace app\core;

class Application
{
     public static Application $app;
     public static string $ROOT_DIR;
     public Router $router;
     public Request $request;
     public Response $response;
     public ?Controller $controller = null;
     public View $view;

     public function __construct($rootDir) {
          
          self::$ROOT_DIR = $rootDir;
          self::$app = $this;

          $this->request = new Request();
          $this->response = new Response();
          $this->router = new Router($this->request, $this->response);
          $this->view = new View();
     }

     public function run() {
     //    try {
               echo $this->router->resolve();
     //    } catch (\Exception $e) {
     //        echo $this->router->renderView('_error', [
     //            'exception' => $e,
     //        ]);
     //    }
     }
}
