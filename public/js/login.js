import FormValidation from "./modules/FormValidation.js";
import submitData, {displayLoader, hiddenLoader} from "./modules/submitData.js";

(() => {
     const d = document,
          w = window,
          $form = d.getElementById('login');

     const formValidation = new FormValidation({
          username: {
               RULE_REQUIRED: true,
               RULE_MIN: 4,
               RULE_MAX: 16
          },
          password: {
               RULE_REQUIRED: true,
               RULE_MIN: 8,
          },
     }, $form);
     
     //------------------------------------------------------
     $form.addEventListener("submit", async e => {
          e.preventDefault();
          
          if( formValidation.validateForm() )
          {
               const $spinner = e.target.querySelector('.spinner');

               displayLoader($spinner);
               const res =await submitData(new FormData($form), 'login');
               hiddenLoader($spinner);

               if(res.ok)
                    w.location.href = res.url;
               else
               {
                    Swal.fire({
                         title: 'Error!',
                         text: 'Please try again',
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