import FormValidation from "./modules/FormValidation.js";
import submitData, {displayLoader, hiddenLoader}  from "./modules/submitData.js";

(() => {
     const d = document,
          $form = d.getElementById('createAccount');
          
     const formValidation = new FormValidation({
          username: {
               RULE_REQUIRED: true,
               RULE_MIN: 4,
               RULE_MAX: 16,
               RULE_USERNAME: true
          },
          email: {
               RULE_REQUIRED: true,
               RULE_EMAIL: true
          },
          password: {
               RULE_REQUIRED: true,
               RULE_MIN: 8,
               RULE_DEPENDENCE: 'passwordConfirm'
          },
          passwordConfirm: {
               RULE_MATCH: 'password'
          }
     }, $form);

     //------------------------------------------------------
     $form.addEventListener("submit", async e => {
          e.preventDefault();
        
          if( formValidation.validateForm() )
          {
               const $spinner = e.target.querySelector('.spinner');

               displayLoader($spinner);
               const res =await submitData(new FormData($form), '/register');
               hiddenLoader($spinner);

               if(res.ok)
               {
                    await Swal.fire({
                         title: 'Success!',
                         text: 'Registration completed',
                         icon: 'success',
                         timer: 3000,
                         timerProgressBar: true,
                    });
                    d.querySelector('.signin').classList.remove("right-panel-active");
               }
               else
               {
                    Swal.fire({
                         title: 'Error!',
                         text: 'Register process failed. Please try again',
                         icon: 'error',
                         timer: 3000,
                         timerProgressBar: true,
                    });
                    for( const [key, value] of Object.entries(res.errors) )
                         value.forEach( er => formValidation.addError(key, er));
               }
          }
     });
})();