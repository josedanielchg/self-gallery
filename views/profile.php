<section class="section-header">
     <a href="/home" class="section-header__icon-back">
          <img  class="icon btn-icon" src="img/chevron-left.svg" alt="">
     </a>

     <h2 class="section-header__title">Settings</h2>
</section>

<form action="" class="form-container" method="post" id="profile">

     <div class="form-container__photo-frame" id="photo-file">
          <img src="./files/thumbs/{{ $imageProfile }}" alt="" class="form-container__user-photo" id="user-photo">
          <div class="form-container__edit-user-photo">
               <img src="img/pen.svg" alt="" class="icon">
          </div>
          <input type="hidden" name="profile_image" value="{{ $imageId }}">
     </div>

     <div class="form-container__group">
          <img src="img/user.svg" alt="" class="icon">
          <label for="username">username:</label>
          <div class="form-container__group-input">
               <input type="text" id="username" name="username" value="{{ $username }}" required class="input"/>
               <img src="img/times-circle.svg" alt="" class="icon state incorrect">
               <img src="img/check-circle.svg" alt="" class="icon state correct">
          </div>
          <div class="form-container__group-input-error"></div>
     </div>
     
     <div class="form-container__group">
          <img src="img/lock.svg" alt="" class="icon">
          <label for="currentPassword">current password:</label>
          <div class="form-container__group-input">
               <input type="password" id="currentPassword" name="password" required class="input"/>
               <img src="img/times-circle.svg" alt="" class="icon state incorrect">
               <img src="img/check-circle.svg" alt="" class="icon state correct">
          </div>
          <div class="form-container__group-input-error"></div>
     </div>
     
     <div class="form-container__group">
          <img src="img/lock.svg" alt="" class="icon">
          <label for="newPassword">new password: (optional)</label>
          <div class="form-container__group-input">
               <input type="password" id="newPassword" name="newPassword" class="input"/>
               <img src="img/times-circle.svg" alt="" class="icon state incorrect">
               <img src="img/check-circle.svg" alt="" class="icon state correct">
          </div>
          <div class="form-container__group-input-error"></div>
     </div>

     <div class="form-container__group">
          <div class="form-container__group-submit">
               <input type="submit" value="Save" class="button">
               <div class="spinner">
                         <div class="bounce1"></div>
                         <div class="bounce2"></div>
                         <div class="bounce3"></div>
               </div>
          </div>
     </div>

</form>

<div class="modal">
     <img src="img/x-dark.svg" alt=""class="icon-btn btn-close">

     <section class="gallery">

          <div class="gallery__item">
               <div class="cover"></div>
               <div class="image-container">
                    <img src="./files/thumbs/profile.png" alt="" class="gallery__image" data-id="null">
               </div>
               <img src="img/check-circle.svg" alt="" class="icon-state correct">
          </div>

          <?php 
               use app\models\ImageModel;
               use app\core\Application;

               $images = ImageModel::getImagesByUserId(Application::$app->session->getUser());

               foreach ($images as $img => $attr) {
                    $filename = str_replace('img-', 'thumb-', $attr["filename"]);
                    $id = $attr["image_id"];

                   $isSelect = ($filename == $imageProfile)
                         ? 'select'
                         : '';

                    $template = '
                         <div class="gallery__item %s">
                              <div class="cover"></div>
                              <div class="image-container">
                                   <img src="./files/thumbs/%s" alt="" class="gallery__image" data-original="%s" data-id="%s">
                              </div>
                              <img src="img/check-circle.svg" alt="" class="icon-state correct">
                         </div>
                    ';
                    printf($template, $isSelect, $filename, $filename, $id);
               }
          ?>
     </section>
</div>
