<?php

namespace app\models;

use app\core\db\DbModel;
use app\models\User;

class ImageModel extends DbModel
{
     public string $filename ='';
     public int $user_id = 0;
     public array $img = [];

     public static function tableName(): string
     {
          return 'images';
     }

     public function attributes(): array
     {
          return ['user_id', 'filename'];
     }

     public function loadImg(?array $img)
     {
          $this->img = $img;
     }

     public function setUserId($user_id)
     {
          $this->user_id = $user_id;
     }

     public function deleteImage($imageId, $imagePath)
     {
          $tableName = static::tableName();
          $statement = self::prepare("DELETE FROM $tableName WHERE image_id = :image_id");
          $statement->bindValue(':image_id', $imageId);
          
          if( !$statement->execute())
               return false;
          
          if ( !unlink($imagePath))
               return false;
          
          $imageName = explode('/', $imagePath);
          $thumbName = str_replace('img-', 'thumb-', end($imageName));
          $thumbPath = "./files/thumbs/$thumbName";

          if( !unlink($thumbPath))
               return false;
          
          return User::decreasePublications($this->user_id);
     }

     public function save()
     {
          if ( !parent::save())
               return false;
          
          return User::increasePublications($this->user_id);
     }

     public function moveImage()
     {
          $imgName = $this->img['name'];
          $img = $this->img['tmp_name'];
          $error = $this->img['error'];
          $imgExt = explode('.', $imgName);
          $imgActualExt = strtolower(end($imgExt));

          $allowed = array('jpg', 'jpeg', 'png', 'gif');

          if( ! in_array($imgActualExt, $allowed)) {
               $this->addError('errorFileExtension', 'Invalid file extension');
               return false;
          }
          
          $imgName = uniqid('img-', true) . "." . $imgActualExt;
          $destination = "../public/files/$imgName";
          $upload = move_uploaded_file($img, $destination);

          if(!$upload) {
               $this->addError('errorUpladingFile', 'Error uploading file');
               return false;
          }

          $this->createThumbnail($destination, $imgName, $imgActualExt);

          $this->filename = $imgName;
          
          return true;
     }

     public function createThumbnail($filePath, $fileName, $fileExt)
     {
          $maxWidth = 497;
          $maxHeight = 497;
          $thumbPath = "../public/files/thumbs/" . str_replace('img-', 'thumb-', $fileName);
          list($srcWidth, $srcHeight) = getimagesize($filePath);

          if($srcWidth > $srcHeight) {
               $thumbHeight = $maxHeight;
               $thumbWidth = intval( ($thumbHeight * $srcWidth) / $srcHeight );
          } else {
               $thumbWidth = $maxWidth;
               $thumbHeight = intval ( ($thumbWidth * $srcHeight) / $srcWidth );
          }

          switch ($fileExt) {
               case 'jpg':
                    $imgt = "ImageJPEG";
                    $imgcreatefrom = "ImageCreateFromJPEG";
                    break;

               case 'jpeg':
                    $imgt = "ImageJPEG";
                    $imgcreatefrom = "ImageCreateFromJPEG";
                    break;

               case 'png':
                    $imgt = "ImagePNG";
                    $imgcreatefrom = "ImageCreateFromPNG";
                    break;

               case 'gif':
                    $imgt = "ImageGIF";
                    $imgcreatefrom = "ImageCreateFromGIF";
                    break;
               
               default:
                    return false;
                    break;
          };

          $oldImage = $imgcreatefrom($filePath);
          $thumbnail = imagecreatetruecolor($thumbWidth, $thumbHeight);
          
          // Apply transparent background only if is a png image else a white background
          if($fileExt === 'png') {
               imagesavealpha($thumbnail, TRUE);
               $color = imagecolorallocatealpha($thumbnail, 0, 0, 0, 127);
               imagefill($thumbnail, 0, 0, $color);
          } else {
               list($red, $green, $blue) = [255, 255, 255];
               $color = imagecolorallocate($thumbnail, $red, $green, $blue);
               imagefill($thumbnail, 0, 0, $color);
          }

          imagecopyresized($thumbnail, $oldImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);
          $imgt($thumbnail, $thumbPath);
          return file_exists($thumbPath);
     }

     public static function getImagesByUserId($user_id)
     {
          $tableName = static::tableName();
          $statement = self::prepare("SELECT * FROM $tableName WHERE user_id = :user_id");
          $statement->bindValue(':user_id', $user_id);
          $statement->execute();
          return $statement->fetchAll(\PDO::FETCH_ASSOC) ?? false;
     }

     public static function getImageById($image_id)
     {
          $tableName = static::tableName();
          $statement = self::prepare("SELECT * FROM $tableName WHERE image_id = :image_id");
          $statement->bindValue(':image_id', $image_id);
          $statement->execute();
          $img = $statement->fetchAll(\PDO::FETCH_ASSOC);
          return $img[0]['filename'] ?? null;
     }
}    