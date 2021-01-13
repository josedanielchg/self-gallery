import FormValidation from "./modules/FormValidation.js";
import submitData, {displayLoader, hiddenLoader} from "./modules/submitData.js";

(() => {
     const d = document,
          w = window,
          $form = d.getElementById('profile'),
          $label = d.getElementById('photo-file'),
          $modal = d.querySelector('.modal'),
          $galleryItems = d.querySelectorAll(".gallery__item"),
          $profileImg = d.getElementById("user-photo");

     const formValidation = new FormValidation({
          username: {
               RULE_REQUIRED: true,
               RULE_MIN: 4,
               RULE_MAX: 16,
               RULE_USERNAME: true
          },
          password: {
               RULE_REQUIRED: true,
               RULE_MIN: 8,
          },
          newPassword: {
               RULE_MIN: 8,
               RULE_UNMATCH: 'password',
               RULE_UNREQUIRED: true,
          },
          profile_image: {}
     }, $form);

//--------------------------- add event listeners ---------------------------
     d.addEventListener("click", e=> {
          
          if( (e.target != $modal && !$modal.contains(e.target)) || e.target.matches(".btn-close") )
               $modal.classList.remove("open");

          if( $label.contains(e.target) )
               $modal.classList.add("open");

          if(e.target.matches('.gallery__item *')) {
               const $item = e.target.closest('.gallery__item');

               if($item.classList.contains('select'))
               {
                    $item.classList.remove('select');
                    $form['profile_image'].value = '0';
                    $profileImg.src = 'files/profile.png';
               }
               else
               {
                    $galleryItems.forEach(el => el.classList.remove('select'))
                    $item.classList.add('select');
                    $profileImg.src = e.target.getAttribute('src');
                    $form['profile_image'].value = e.target.getAttribute('data-id');
               }
          }
     });

//---------------------------
     $form.addEventListener("submit", async e => {
          e.preventDefault();
          
          const {value: confirm} = await Swal.fire({
               title: 'Important!',
               text: 'Are you sure you want to save the changes?',
               icon: 'info',
               confirmButtonText: 'Save',
               showCancelButton: true,
          });

          if (confirm)
               if( formValidation.validateForm() )
               {
                    const $spinner = e.target.querySelector('.spinner');

                    displayLoader($spinner);
                    const res =await submitData(new FormData($form), '/profileUpdate');
                    hiddenLoader($spinner);

                    if(res.ok)
                    {
                         await Swal.fire({
                              title: 'Success!',
                              text: 'Update completed',
                              icon: 'success',
                              timer: 3000,
                              timerProgressBar: true,
                         });
                         w.location.href = res.url;
                    }
                    else
                    {
                         for( const [key, value] of Object.entries(res.errors) )
                              value.forEach( er => formValidation.addError(key, er));

                         Swal.fire({
                              title: 'Error!',
                              text: 'Update failed. Please try again',
                              icon: 'error',
                              timer: 3000,
                              timerProgressBar: true,
                         });
                    }
               }
     });

//---------------------------
     d.addEventListener("DOMContentLoaded", e => {
          $galleryItems.forEach(el => el.style.height = el.offsetWidth+'px');
     });

//---------------------------
     addEventListener("resize", e => {
          $galleryItems.forEach(el => el.style.height = el.offsetWidth+'px');
     });
})();