<section class="section-header">
     <a href="/home" class="section-header__icon-back">
          <img  class="icon btn-icon" src="img/chevron-left.svg" alt="">
     </a>

     <h2 class="section-header__title">Settings</h2>
</section>

<form action="" class="form-container">

     <label class="form-container__photo-frame" for="photo-file">
     <img src="img/1.jpg" alt="" class="form-container__user-photo">
          <div class="form-container__edit-user-photo">
               <img src="img/pen.svg" alt="" class="icon">
          </div>
     </label>
     <input type="file" id="photo-file" class="photo">

     <div class="form-container__group">
          <img src="img/user.svg" alt="" class="icon">
          <div>
               <label for="username">username:</label>
               <input type="text" id="username" />
          </div>
     </div>
     
     <div class="form-container__group">
          <img src="img/lock.svg" alt="" class="icon">
          <div>
               <label for="currentPassword">current password:</label>
               <input type="password" id="currentPassword"/>
          </div>
     </div>
     
     <div class="form-container__group">
          <img src="img/lock.svg" alt="" class="icon">
          <div>
               <label for="newPassword">new password:</label>
               <input type="password" id="newPassword"/>
          </div>     
     </div>

     <div class="form-container__group">
          <input type="submit" value="Save" class="button">
     </div>

</form>