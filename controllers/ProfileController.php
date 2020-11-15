<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class ProfileController extends Controller {

     public function profile()
    {
          $this->setLayout([
               'main' => 'main',
               'complements' => [
                    'header',
                    'footer',
                    'add_image_btn'
               ]
          ]);

        return $this->render('profile', [
               'variables' => [
                    'tittle' => 'SelfGallery',
                    'site' => 'profile',
                    'addImageBtn' => true,
               ],
               'scripts'=> []
        ]);
    }
}