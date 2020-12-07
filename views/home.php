<section class="user">

     <div class="user__photo-container">
          <div class="user__photo-frame">
               <a href="/profile">
                    <img class="user__photo" src="img/3.jpg" alt="" srcset="">
               </a>
          </div>
     </div>

     <div class="user__data">
          <h2 class="user__username">{{ $username }}</h2>
          <h3 class="user__publications">
               <span class="user__publications-number">{{ $publications }}</span> publications
          </h3>

          <a href="/profile" class="button button-small user__edit-profile">
               <span>
                    Edit profile 
                    <img src="img/cog.svg"  class="icon cog" alt="" srcset="">
               </span>
          </a>
          <a href="/signin" class="button button-small button-light user__sign-out">
               <span>
                    Sign out
                    <img src="img/sign-out-alt.svg"  class="icon" alt="" srcset="">
               </span>
          </a>
     </div>

</section>

<section class="gallery">

     <!-- IMAGENES AQUI -->
     <!-- Tres por fila -->
     <div class="gallery__item">
          <img src="img/1.jpg" alt="" class="gallery__image" data-original="1.jpg">
     </div>

     <div class="gallery__item">
          <img src="img/3.jpg" alt="" class="gallery__image" data-original="3.jpg">
     </div>
     
     <div class="gallery__item">
          <img src="img/1.jpg" alt="" class="gallery__image" data-original="1.jpg">
     </div>
     
     <div class="gallery__item">
          <img src="img/2.jpg" alt="" class="gallery__image" data-original="2.jpg">
     </div>
</section>

<div class="modal">
     <img src="img/3.jpg" alt="" class="full-img">

     <img src="img/x.svg" alt=""class="icon-btn btn-close">
     <img src="img/trash-alt.svg" alt="" class="icon-btn btn-delete">
</div>
