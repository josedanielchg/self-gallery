<section class="user">

     <div class="user__photo-container">
          <div class="user__photo-frame">
               <a href="/profile">
                    <img class="user__photo" src="./files/thumbs/{{ $imageProfile }}" alt="" srcset="">
               </a>
          </div>
     </div>

     <div class="user__data">
          <h2 class="user__username">{{ $username }}</h2>
          <h3 class="user__publications">
               <span class="user__publications-number publications">{{ $publications }}</span> publications
          </h3>

          <a href="/profile" class="button button-small user__edit-profile">
               <span>
                    Edit profile 
                    <img src="img/cog.svg"  class="icon cog" alt="" srcset="">
               </span>
          </a>
          <a href="/logout" class="button button-small button-light user__sign-out">
               <span>
                    Logout
                    <img src="img/sign-out-alt.svg"  class="icon" alt="" srcset="">
               </span>
          </a>
     </div>

</section>

<section class="gallery">
     <?php 
     
          if($images) {
               foreach ($images as $img => $attr) {
                    $filename = str_replace('img-', 'thumb-', $attr["filename"]);
                    $id = $attr["image_id"];
                    $template = '
                         <div class="gallery__item">
                              <img src="./files/thumbs/%s" alt="" class="gallery__image" data-original="%s" data-id="%s">
                         </div>
                    ';
                    printf($template, $filename, $filename, $id);
               }
          }
          else
               print('
               <h3 class="gallery__title"x>
                    <span class="text-big">No images yet :(</span>
                    Press the 
                    <span class="btn-icon"><img src="img/plus.svg" class="icon" alt=""></span> 
                    button to upload them.
               </h3>');
     ?>
</section>

<div class="modal">
     <img src="" alt="" class="full-img" data-id="">
     <img src="img/x.svg" alt=""class="icon-btn btn-close">

     <div class="btn-delete-container">
          <div class="spinner white">
               <div class="bounce1"></div>
               <div class="bounce2"></div>
               <div class="bounce3"></div>
          </div>
          <img src="img/trash-alt.svg" alt="" class="icon-btn btn-delete">
     </div>
</div>
