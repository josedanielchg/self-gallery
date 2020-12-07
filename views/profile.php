<section class="section-header">
     <a href="/home" class="section-header__icon-back">
          <img  class="icon btn-icon" src="img/chevron-left.svg" alt="">
     </a>

     <h2 class="section-header__title">Settings</h2>
</section>

<form action="" class="form-container" method="post" id="profile">

     <label class="form-container__photo-frame" for="photo-file">
     <img src="img/1.jpg" alt="" class="form-container__user-photo">
          <div class="form-container__edit-user-photo">
               <img src="img/pen.svg" alt="" class="icon">
          </div>
     </label>
     <input type="file" id="photo-file" class="photo">

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
               <input type="password" id="currentPassword" name="currentPassword" required class="input"/>
               <img src="img/times-circle.svg" alt="" class="icon state incorrect">
               <img src="img/check-circle.svg" alt="" class="icon state correct">
          </div>
          <div class="form-container__group-input-error"></div>
     </div>
     
     <div class="form-container__group">
          <img src="img/lock.svg" alt="" class="icon">
          <label for="newPassword">new password:</label>
          <div class="form-container__group-input">
               <input type="password" id="newPassword" name="newPassword" required class="input"/>
               <img src="img/times-circle.svg" alt="" class="icon state incorrect">
               <img src="img/check-circle.svg" alt="" class="icon state correct">
          </div>
          <div class="form-container__group-input-error"></div>
     </div>

     <div class="form-container__group">
          <div class="form-container__group-submit">
               <input type="submit" value="Save" class="button">
          </div>
     </div>

</form>