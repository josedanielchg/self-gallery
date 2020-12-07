<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class ProfileController extends Controller {

     public function profile()
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

        return $this->render('profile', [
               'variables' => [
                    'tittle' => 'SelfGallery',
                    'site' => 'profile',
                    'addImageBtn' => true,
                    'username' => Application::$app->user->username,
               ],
               'scripts'=> [
                    'profile.js'
               ]
        ]);
    }
}