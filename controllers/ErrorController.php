<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class ErrorController extends Controller {

     public function renderError($e)
    {
          $this->setLayout([
               'main' => 'main',
               'complements' => [
                    'header',
                    'footer',
               ]
          ]);

        return $this->render('_error', [
               'variables' => [
                    'tittle' => 'SelfGallery - Error '. $e->getCode(),
                    'site' => 'error',
                    'exception' => $e,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
               ],
               'scripts'=> []
        ]);
    }
}