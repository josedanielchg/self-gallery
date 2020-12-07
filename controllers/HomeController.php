<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class HomeController extends Controller {

     public function home()
     {
          if(Application::$app->isGuest())
               Application::$app->response->redirect('/');

          $this->setLayout([
               'main' => 'main',
               'complements' => [
                    'header',
                    'footer',
                    'add_image_btn'
               ]
          ]);

          return $this->render('home', [
               'variables' => [
                    'tittle' => 'SelfGallery',
                    'site' => 'home',
                    'addImageBtn' => true,
                    'username' => Application::$app->user->username,
                    'publications' => Application::$app->user->publications
               ],
               'scripts' => [
                    'modal.js'
               ]
          ]);
     }
}