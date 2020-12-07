const d = document;

export default class FormValidation {

     constructor(rules = {}, $form)
     {
          this.rules = rules;
          this.attributes = Object.keys(this.rules)
          this.attributes.forEach(attr => this[attr] = null);

          this.expressions = {
               username: /^[a-zA-Z0-9\_\-]{4,16}$/,
               email: /^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$/,
          }
          this.errors = {}

          this.loadData($form)
     }

     //----------
     loadData($form)
     {
          let $inputs =Array.from($form.elements).filter(el => el.getAttribute("name"))
          
          $inputs.forEach(el => {
               let name = (el.getAttribute('name'));
               this[name] = el;
          });

          $inputs.forEach((input) => {
               input.addEventListener('keyup',e => this.validateField(e.target));
               input.addEventListener('blur', e => this.validateField((e.target)));
          });
     }

     //----------
     validateField($input)
     {
          const fieldRules = this.rules[$input.name],
               inputName = $input.name,
               inputValue = $input.value;
          
          this.errors[inputName] = new Set();

          for( const [ruleName, propertyValue] of Object.entries(fieldRules) )
          {
               if (ruleName === 'RULE_REQUIRED' && !inputValue)
                    this.addErrorByRule(inputName, 'RULE_REQUIRED');
               
               if (ruleName === 'RULE_EMAIL' && !this.expressions.email.test(inputValue))
                    this.addErrorByRule(inputName, 'RULE_EMAIL');

               if (ruleName === 'RULE_USERNAME' && !this.expressions.username.test(inputValue))
                    this.addErrorByRule(inputName, 'RULE_USERNAME');
                    
               if (ruleName === 'RULE_MIN'  && inputValue.length < propertyValue)
                    this.addErrorByRule(inputName, 'RULE_MIN', { 'min': propertyValue } );
                    
               if (ruleName === 'RULE_MAX'  && inputValue.length > propertyValue)
                    this.addErrorByRule(inputName, 'RULE_MAX', { 'max': propertyValue } );
               
               if (ruleName === 'RULE_MATCH' && inputValue !== this[propertyValue].value)
                    this.addErrorByRule(inputName, 'RULE_MATCH', { 'match': propertyValue } );

               if (ruleName === 'RULE_DEPENDENCE')
                    this.validateField( this[propertyValue] )
               
          }

          this.displayErrors($input);
     }

     //----------
     validateForm()
     {                  
          for( const[key, value] of Object.entries(this.errors) )
               if (value.size !== 0) return false;

          return true;
     }

     //----------
     displayErrors($input)
     {
          const fieldErrors = this.errors[$input.name] ?? new Set(),
               $formContainer = $input.closest(".form-container__group"),
               $errorContainer = $formContainer.querySelector('.form-container__group-input-error'),
               $fragment = d.createDocumentFragment();

          $errorContainer.innerHTML = '';

          if(fieldErrors.size === 0)
          {
               $formContainer.classList.add('correct');
               $formContainer.classList.remove('incorrect');
               return;
          }

          fieldErrors.forEach(el => {
               const $p = d.createElement("p");
               $p.innerHTML = el;
               $fragment.appendChild($p)
          });

          $errorContainer.appendChild($fragment);
          $formContainer.classList.add('incorrect');
          $formContainer.classList.remove('correct');
     }

     //----------
     errorMessages()
     {
          return {
               RULE_REQUIRED: 'This field is required',
               RULE_EMAIL: 'This field must be valid email address',
               RULE_USERNAME: 'Username can only have letters and numbers',
               RULE_MIN: 'Min length of this field must be {min}',
               RULE_MAX: 'Max length of this field must be {max}',
               RULE_MATCH: 'This field must be the same as {match}',
          };
     }

     //----------
     errorMessage(rule)
     {
          return this.errorMessages()[rule];
     }

     //----------
     addErrorByRule(inputName, rule, params = {} )
     {
          let errorMessage = this.errorMessage(rule);
          
          for( const [key, value] of Object.entries(params) )
               errorMessage = errorMessage.replace('{'+key+ '}', value);
          
          if(!this.errors[inputName])
               this.errors[inputName] = new Set();
          
          this.errors[inputName].add(errorMessage);
     }

     //----------
     addError(inputName, message)
    {
         let errorMessage = message;

         if( !this.errors[inputName] )
               this.errors[inputName] = new Set();
          
          this.errors[inputName].add(errorMessage);

          this.displayErrors( this[inputName] )
    }
}