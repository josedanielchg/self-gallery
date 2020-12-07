<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginModel;
use app\models\User;

class SigninController extends Controller {

     public function renderForm()
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
                    'signin.js',
                    'login.js',
                    'register.js'
               ]
          ]);
     }

     public function register(Request $request)
     {
          $registerModel = new User();
          $registerModel->loadData($request->getBody());
          
          ($registerModel->validate() && $registerModel->save())
               ? $res = [ 'ok' => true ]
               : $res = [ 'ok' => false, 'errors' => $registerModel->getErrors()];

          echo json_encode($res);
     }
     
     public function login(Request $request)
     {
          $loginModel = new LoginModel();
          $loginModel->loadData($request->getBody());

          ($loginModel->validate() && $loginModel->login())
               ? $res = ['ok' => true, 'url' => '/home' ]
               : $res = ['ok' => false, 'errors' => $loginModel->getErrors() ];

          echo json_encode($res);
     }
}