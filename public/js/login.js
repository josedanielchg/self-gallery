import FormValidation from "./modules/FormValidation.js";
import submitData from "./modules/submitData.js";

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
                const res =await submitData($form, 'login');
               console.log(res);
               if(res.ok)
               {
                    w.location.href = res.url;
               }
               else
               {
                    for( const [key, value] of Object.entries(res.errors) )
                         value.forEach( er => formValidation.addError(key, er));
               }
          }
     });
})();