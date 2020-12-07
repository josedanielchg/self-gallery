(() => {
     
const d = document,
     $modal = d.querySelector('.modal'),
     $modalImg = d.querySelector('.full-img');

d.addEventListener("click", e=> {

     if(e.target.matches(".gallery img")) {
          $modal.classList.add("open");
          const modalImgSrc = e.target.getAttribute('data-original');
          $modalImg.src = `./img/${modalImgSrc}`;
     }
     
     if(e.target.matches(".modal") || e.target.matches(".btn-close")){
          $modal.classList.remove("open");
     }
})

})();
