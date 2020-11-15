<!-- Solo en movil -->
<div class="btn-menu">
     <button href="" class="btn__sign-in">Sign in</button>
     <button href="" class="btn__sign-up">Sign up</button>
</div>

<!-- Formularios vista en ambos tamaños -->
<div class="form-container sign-in-container">
     <form action="" class="sign-form">
          <h2>Sign in</h2>

          <div class="form-container__group">
               <img src="img/user.svg" alt="" class="icon">
               <div>
                    <label for="signinUsername">username:</label>
                    <input type="text" id="signinUsername" />
               </div>
          </div>
          
          <div class="form-container__group">
               <img src="img/lock.svg" alt="" class="icon">
               <div>
                    <label for="signinPassword">password:</label>
                    <input type="password" id="signinPassword"/>
               </div>
          </div>

          <button class="form-container__forgot forgot-btn">Forgot your password?</button>

          <div class="form-container__group">
               <input type="submit" value="Sign In" class="button">
          </div>

     </form>
     <form action="" class="forgot-password-form">
          <h2>
               Introduce your recovery email address 
               <span>and we will send you an email</span>
          </h2>

          <div class="form-container__group">
               <img src="img/envelope.svg" alt="" class="icon">
               <div>
                    <label for="email">mail:</label>
                    <input type="email" id="email" />
               </div>
          </div>

          <button class="form-container__forgot forgot-btn">Go Back</button>

          <div class="form-container__group">
               <input type="submit" value="Continue" class="button">
          </div>
     </form>
</div>

<div class="form-container sign-up-container">
     <form action="" class="sign-form">
          <h2>Create Account</h2>

          <div class="form-container__group">
               <img src="img/envelope.svg" alt="" class="icon">
               <div>
                    <label for="email">mail:</label>
                    <input type="email" id="email" />
               </div>
          </div>

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
                    <label for="password">password:</label>
                    <input type="password" id="password"/>
               </div>
          </div>

          <div class="form-container__group">
               <img src="img/lock.svg" alt="" class="icon">
               <div>
                    <label for="repeatPassword">repeat password:</label>
                    <input type="password" id="repeatPassword"/>
               </div>
          </div>
          
          <div class="form-container__group">
               <input type="submit" value="Sign Up" class="button">
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
