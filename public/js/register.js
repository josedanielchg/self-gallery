import FormValidation from "./modules/FormValidation.js";
import submitData from "./modules/submitData.js";

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
               const res =await submitData($form, '/register');
               console.log(res);
               if(res.ok)
               {
                    alert("Registration completed successfully");
                    d.querySelector('.signin').classList.remove("right-panel-active");
               }
               else
               {
                    for( const [key, value] of Object.entries(res.errors) )
                         value.forEach( er => formValidation.addError(key, er));
               }
          }
     });
})();