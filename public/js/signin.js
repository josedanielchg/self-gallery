(() => {


     const d = document,
          $signinContainer = d.querySelector('.signin'),
          $forgotContainer = d.querySelector(".forgot-password-form");

     d.addEventListener("click", e =>{  

          if(e.target.matches(".btn__sign-in")) 
               $signinContainer.classList.remove("right-panel-active");

          if(e.target.matches(".btn__sign-up")) 
               $signinContainer.classList.add("right-panel-active");

          if(e.target.matches(".forgot-btn"))
          {
               e.preventDefault();
               $forgotContainer.classList.toggle("active")
          }     
     });

})();
