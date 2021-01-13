<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ImageModel;

class HomeController extends Controller {

     public function renderHome()
     {
          if(Application::$app->isGuest())
               Application::$app->response->redirect('/');
          
          $imageProfileId = Application::$app->user->profile_image;
          $imageProfile =  ImageModel::getImageById($imageProfileId) ?? 'profile.png';
          $imageProfileName = str_replace('img-', 'thumb-', $imageProfile);

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
                    'publications' => Application::$app->user->publications,
                    'imageProfile' => $imageProfileName
               ],
               'scripts' => [
                    'vendors/sweetalert2@10.js' => 'not-module-type',
                    'home.js' => 'module-type' 
               ]
          ]);
     }
}