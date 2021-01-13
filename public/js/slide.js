(() => {

     const d = document,
          $signinContainer = d.querySelector('.signin');

     d.addEventListener("click", e =>{  

          if(e.target.matches(".btn__sign-in")) 
               $signinContainer.classList.remove("right-panel-active");

          if(e.target.matches(".btn__sign-up")) 
               $signinContainer.classList.add("right-panel-active");
     });

})();
