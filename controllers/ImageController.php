<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ImageModel;
use app\models\User;

class ImageController extends Controller {

     public function renderImage()
     {
          if(Application::$app->isGuest())
               Application::$app->response->redirect('/');
               
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
               'scripts'=> [
                    'add_image.js' => 'module-type'
               ]
          ]);
     }

     public function addImage(Request $request)
     {
          $uploadedImg = $request->getUploadedFiles('file');
          $imageModel = new ImageModel();
          $imageModel->loadImg($uploadedImg);
          $imageModel->setUserId(Application::$app->session->getUser());

          if($imageModel->moveImage() && $imageModel->save())
               $res = [
                    "ok" => true,
                    "status" => http_response_code(200),
                    "statusText" => "Image upload completed successfully"
               ];
          else
               $res = [
                    "ok" => false,
                    'errors' => $imageModel->getErrors(),
                    "status" => http_response_code(400),
                    "statusText" => "Error uploading image"
               ];
          
          echo json_encode($res);
     }

     public function removeImage(Request $request)
     {
          $str_json = file_get_contents( 'php://input');
          $data = json_decode( $str_json, true);
          $imageId = $data['image_id'];
          $image_path = $data['image_path'];

          $imageModel = new ImageModel();
          $imageModel->setUserId(Application::$app->session->getUser());

          if($imageModel->deleteImage($imageId, $image_path))
               $res = [
                    "ok" => true,
                    "status" => http_response_code(200),
                    "statusText" => "Image delete successfully"
               ];
          else
               $res = [
                    "ok" => false,
                    "status" => http_response_code(400),
                    "statusText" => "Error deleting successfully"
               ];

          echo json_encode($res);
     }
}