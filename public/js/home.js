import submitData, {displayLoader, hiddenLoader}  from "./modules/submitData.js";

(() => {
     const d = document,
          $modal = d.querySelector('.modal'),
          $modalImg = d.querySelector('.full-img'),
          $galleryItems = d.querySelectorAll(".gallery__item"),
          $galleryContainer = d.querySelector('.gallery');

//--------------------------- add event listeners ---------------------------
     d.addEventListener("click", e=> {
          if(e.target.matches(".gallery img")) {
               const modalImgSrc = e.target.getAttribute('data-original'),
                    imgId = e.target.getAttribute('data-id');
               
               $modalImg.setAttribute("src", `./files/${ modalImgSrc.replace('thumb-', 'img-') }`);
               $modal.classList.add("open");
               $modalImg.setAttribute('data-id', imgId);
          }
          
          if(e.target.matches(".modal") || e.target.matches(".btn-close"))
          {
               $modal.classList.remove("open");
               $modalImg.setAttribute("src", '');
          }

          if(e.target.matches("img.btn-delete"))
               deleteImage( $modalImg.getAttribute('data-id'), e.target);
     });
//---------------------------
     d.addEventListener("keydown", e => {
          if(e.code === 'Escape' || e.keyCode === 27)
          {
               $modal.classList.remove("open");
               $modalImg.setAttribute("src", '');
          }
     })
//---------------------------
     d.addEventListener("DOMContentLoaded", e => {
          const rowHeight = $galleryItems[0].offsetWidth + 'px';
          $galleryContainer.style.setProperty('--row-height', rowHeight);
          $galleryContainer.classList.add('show');
     });

//---------------------------
     addEventListener("resize", e => {
          const rowHeight = $galleryItems[0].offsetWidth + 'px';
          $galleryContainer.style.setProperty('--row-height', rowHeight);
          $galleryContainer.classList.add('show');
     });


//--------------------------- functions  ---------------------------
     const deleteImage = async(imageId, $deleteBtn) => {
          const {value: confirm} = await Swal.fire({
               title: 'Warning!',
               text: 'Are you sure you want to delete this image?',
               icon: 'warning',
               confirmButtonText: 'Delete',
               showCancelButton: true,
          });

          if(!confirm)
               return;
          
          const json = JSON.stringify({
               'image_id': imageId,
               'image_path': $modalImg.getAttribute('src'),
          });
          
          const $spinner = $deleteBtn.previousElementSibling;
          displayLoader($spinner);
          const res =await submitData( json, 'remove_image');
          hiddenLoader($spinner);
          
          if (res.ok)
          {
               Swal.fire({
                    title: 'Success!',
                    text: 'Removal completed',
                    icon: 'success',
                });
               const $imagesGallery= d.querySelector('.gallery'),
                    $images = Array.from(d.querySelectorAll('.gallery__image')),
                    $deleteImage = $images.find(el => el.getAttribute('data-id') == imageId).closest('.gallery__item'),
                    $publications = d.querySelector('.publications');
               
               $imagesGallery.removeChild($deleteImage);
               $modal.classList.remove("open");
               $publications.innerText = parseInt($publications.innerText) -1;
          }
          else
               Swal.fire({
                    title: 'Error!',
                    text: 'Please try again',
                    icon: 'error',
                });
     }
})();
