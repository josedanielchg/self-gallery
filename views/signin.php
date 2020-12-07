<!-- Solo en movil -->
<div class="btn-menu">
     <button href="" class="btn__sign-in">Sign in</button>
     <button href="" class="btn__sign-up">Sign up</button>
</div>

<!-- Formularios vista en ambos tamaños -->
<div class="form-container sign-in-container">
     <form action="" class="sign-form" method="post" id="login">
          <h2>Sign in</h2>

          <div class="form-container__group">
               <img src="img/user.svg" alt="" class="icon">
               <label for="loginUsername">username:</label>
               <div class="form-container__group-input">
                    <input type="text" id="loginUsername" name="username" required class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error">
                    <p class="">Both passwords must be the same</p>
               </div>
          </div>
          
          <div class="form-container__group ">
               <img src="img/lock.svg" alt="" class="icon">
               <label for="loginPassword">password:</label>
               <div class="form-container__group-input">
                    <input type="password" id="loginPassword" name="password" required title="This field is required" class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error"></div>
          </div>

          <button class="form-container__forgot forgot-btn">Forgot your password?</button>

          <div class="form-container__group">
               <div class="form-container__group-submit">
                    <input type="submit" value="Sign In" class="button">
               </div>
          </div>

     </form>
     <form action="" class="forgot-password-form" method="post">
          <h2>
               Introduce your recovery email address 
               <span>and we will send you an email</span>
          </h2>

          <div class="form-container__group">
               <img src="img/envelope.svg" alt="" class="icon">
               <label for="forgotEmail">mail:</label>
               <div class="form-container__group-input">
                    <input type="email" id="forgotEmail" name="email" required class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error"></div>
          </div>

          <button class="form-container__forgot forgot-btn">Go Back</button>

          <div class="form-container__group">
               <div class="form-container__group-submit">
                    <input type="submit" value="Continue" class="button">
               </div>
          </div>
     </form>
</div>

<div class="form-container sign-up-container">
     <form action="" class="sign-form" method="post" id="createAccount">
          <h2>Create Account</h2>

          <div class="form-container__group">
               <img src="img/envelope.svg" alt="" class="icon">
               <label for="createAccountEmail">mail:</label>
               <div class="form-container__group-input">
                    <input type="email" id="createAccountEmail" name="email" required class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error"></div>
          </div>

          <div class="form-container__group">
               <img src="img/user.svg" alt="" class="icon">
               <label for="createAccountUsername">username:</label>
               <div class="form-container__group-input">
                    <input type="text" id="createAccountUsername" name="username" required class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error"></div>
          </div>
          
          <div class="form-container__group">
               <img src="img/lock.svg" alt="" class="icon">
               <label for="createAccountPassword">password:</label>
               <div class="form-container__group-input">
                    <input type="password" id="createAccountPassword" name="password" required class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error"></div>
          </div>

          <div class="form-container__group">
               <img src="img/lock.svg" alt="" class="icon">
               <label for="createAccountPasswordRepeat">repeat password:</label>
               <div class="form-container__group-input">
                    <input type="password" id="createAccountPasswordRepeat" name="passwordConfirm" required class="input"/>
                    <img src="img/times-circle.svg" alt="" class="icon state incorrect">
                    <img src="img/check-circle.svg" alt="" class="icon state correct">
               </div>
               <div class="form-container__group-input-error"></div>
          </div>
          
          <div class="form-container__group">
               <div class="form-container__group-submit">
                    <input type="submit" value="Sign Up" class="button">
               </div>
          </div>
     </form>
</div>

<!-- Solo en desktop-->
<div class="overlay-container">
     <div class="overlay">
          
          <div class="overlay__panel overlay-left">
               <h2>Welcome Back!</h2>
               <p>
                    Are you alredy register?
                    <br/>
                    Then please login with your user an enjoy
               </p>
               <button href="" class="button btn__sign-in button-transparent">Sign In</button>
          </div>
          
          <div class="overlay__panel overlay-right">
               <h2>Welcome!</h2>
               <p>
                    <b>Don't you have an account yet?</b>
                    <br/>
                    Enter your personal details and start journey with us
               </p>
               <button href="" class="button btn__sign-up button-transparent">Sign Up</button>
          </div>
     </div>
</div>
