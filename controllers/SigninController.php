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
          if(!Application::$app->isGuest())
               Application::$app->response->redirect('/home');

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
                    'slide.js' => 'module-type',
                    'login.js' => 'module-type',
                    'register.js' =>'module-type',
                    'vendors/sweetalert2@10.js' => 'not-module-type'
               ]
          ]);
     }

     public function register(Request $request)
     {
          $registerModel = new User();
          $registerModel->loadData($request->getBody());
          
          if ($registerModel->validate() && $registerModel->save())
               $res = [
                    'ok' => true,
                    'status' => http_response_code(200),
                    'statusText' => 'Registration completed successfully'
               ];
          else
               $res = [
                    'ok' => false,
                    'errors' => $registerModel->getErrors(),
                    'status' => http_response_code(400),
                    'statusText' => 'Registration error'
               ];
          echo json_encode($res);
     }
     
     public function login(Request $request)
     {
          $loginModel = new LoginModel();
          $loginModel->loadData($request->getBody());

          if ($loginModel->validate() && $loginModel->login())
               $res = [
                    'ok' => true,
                    'url' => '/home' ,
                    'status' => http_response_code(200),
                    'statusText' => 'Login successfully'
               ];
          else
               $res = [
                    'ok' => false,
                    'errors' => $loginModel->getErrors(),
                    'status' => http_response_code(400),
                    'statusText' => 'Login error'
               ];
          echo json_encode($res);
     }

     public function logout(Request $request, Response $response)
     {
          Application::$app->logout();
          $response->redirect('/');
     }
}