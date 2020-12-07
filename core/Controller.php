<?php

namespace app\core;

class Controller
{
     public $layouts = [];

     public function render($view, $params = []): string 
     {
        return Application::$app->view->renderView($view, $params);
    }

     public function setLayout(array $layout): void 
     {
        $this->layouts = $layout;
    }


}
