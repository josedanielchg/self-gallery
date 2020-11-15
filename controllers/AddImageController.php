<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class AddImageController extends Controller {

     public function addImage()
    {
          $this->setLayout([
               'main' => 'main',
               'complements' => [
                    'header',
                    'footer'
               ]
          ]);

        return $this->render('add_image', [
               'variables' => [
                    'tittle' => 'SelfGallery',
                    'site' => 'add-image'
               ],
               'scripts'=> []
        ]);
    }
}