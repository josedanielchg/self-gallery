<section class="section-header">
     <a href="/home" class="section-header__icon-back">
          <img src="img/chevron-left.svg" class="icon btn-icon">
     </a>

     <h2 class="section-header__title">Settings</h2>
</section>

<section class="drop-container">

     <label class="drop-container__placeholder" for="photo-file">
          <img src="img/images.svg" alt="" class="icon drop-container__icon">

          <p class="drop-container__description">
               <b>Drop</b> your image/s here
               <br />
                or Click to <b>Browse</b>
          </p>
     </label>

     <input type="file" id="photo-file" class="photo">

</section>

<div class="progress-container">

     <div class="open progress-container__item">
          <h3>Uploading...</h3>
          <div class="progress-container__data">
               <span class="progress-container__percentage">80%</span> -
               <span class="progress-container__name">my_image.jpg</span>
          </div>
          
          <progress class="progress-container__bar" value="80" max="100"></progress>
     
     </div>
</div>