<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class SigninController extends Controller {

     public function signin()
     {
          $this->setLayout([
               'main' => 'main',
               'complements' => [
                    'header',
                    'footer'
               ]
          ]);
          
          return $this->render('signin', [
               'variables' => [
                    'tittle' => 'SelfGallery',
                    'site' => 'signin',
               ],
               'scripts' => [
                    'signin.js'
               ]
          ]);
     }
}