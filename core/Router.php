<?php

namespace app\core;
use app\core\exception\NotFoundException;

class Router
{
    private Request $request;
    private Response $response;
    
    private array $routeMap = [];

     public function __construct(Request $request, Response $response)
     {
          $this->request = $request;
          $this->response = $response;
     }

     //Establece una ruta valida por GET
     public function get(string $url, $callback)
    {
        $this->routeMap['get'][$url] = $callback;
    }

     //Establece una ruta valida por POST
    public function post(string $url, $callback)
    {
        $this->routeMap['post'][$url] = $callback;
    }

    //Revisa si la URL esta en el routeMap y ejecuta la callback correspondiente 
    public function resolve()
     {
          $method = $this->request->getMethod();
          $url = $this->request->getUrl();
          $callback = $this->routeMap[$method][$url] ?? false;

          if (!$callback) {
               throw new NotFoundException();
               return;
          }

          if (is_string($callback)) {
               return $callback;
          }

          if (is_array($callback)) {
               $controller = new $callback[0];
               Application::$app->controller = $controller;
               $callback[0] = $controller;
          }

          return call_user_func($callback, $this->request, $this->response);
     }
}