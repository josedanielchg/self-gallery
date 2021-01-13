<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\UpdateModel;
use app\models\ImageModel;

class ProfileController extends Controller {

     public function renderProfile()
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

        return $this->render('profile', [
               'variables' => [
                    'tittle' => 'SelfGallery',
                    'site' => 'profile',
                    'addImageBtn' => true,
                    'username' => Application::$app->user->username,
                    'imageProfile' => $imageProfileName,
                    'imageId' => $imageProfileId ?? 0
               ],
               'scripts'=> [
                    'vendors/sweetalert2@10.js' => 'not-module-type',
                    'profile.js' => 'module-type'
               ]
        ]);
    }

    public function profileUpdate(Request $request)
     {
          $updateModel = new UpdateModel();
          $updateModel->loadData($request->getBody());
          $data = $request->getBody();

          // echo '<pre>';
          // var_dump(Application::$app->user);
          // echo '</pre>';
          // echo '<pre>';
          // var_dump($request->getBody());
          // echo '</pre>';
          if ($updateModel->validate() && $updateModel->update($data))
               $res = [
                    'ok' => true,
                    'url' => '/home' ,
                    'status' => http_response_code(200),
                    'statusText' => 'Update completed successfully',
               ];
          else
               $res = [
                    'ok' => false,
                    'errors' => $updateModel->getErrors(),
                    'status' => http_response_code(400),
                    'statusText' => 'Update error',
               ];

          echo json_encode($res);
     }
}