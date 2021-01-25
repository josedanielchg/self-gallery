import submitData from './modules/submitData.js';

(() => {
     const d = document,
          w = window,
          $files = d.getElementById('files'),
          $progressContainer = d.querySelector('.progress-container'),
          $dropZone = d.querySelector('.drop-zone');

//--------------------------- add event listeners ---------------------------
     $files.addEventListener('change', async e => {
          const files = Array.from(e.target.files);
          files.forEach(file => progressUpload(file));
          $files.value = '';
     });

//---------------------------
     d.addEventListener('click', e=> {
          if(e.target.matches('.btn-close')) {
               let $progressItem = e.target.closest('.progress-container__item');
               $progressContainer.removeChild($progressItem);
          }
     });

//---------------------------
     $dropZone.addEventListener('dragover', e=> {
          e.preventDefault();
          e.stopPropagation();
          $dropZone.classList.add('is-active');
     });

     $dropZone.addEventListener('dragleave', e=> {
          e.preventDefault();
          e.stopPropagation();
          $dropZone.classList.remove('is-active');
     });

     $dropZone.addEventListener('drop', e=> {
          e.preventDefault();
          e.stopPropagation();
          $dropZone.classList.remove('is-active');
          const files = Array.from(e.dataTransfer.files);
          files.forEach( file => progressUpload(file) );
     });

//--------------------------- functions  ---------------------------
     const progressUpload = (file) => {
          const errors = validateFile(file),
          {
               $itemContainer, 
               $progressBar,
               $percentage,
               $status,
               $containerData
          } = buildItem(file);

          if( errors !== true ) {
               displayErrors( $itemContainer, $progressBar, $status, $containerData, file, errors);
               return;
          }

          const fileReader = new FileReader();
          fileReader.readAsDataURL(file);

          //While the file load is in progress
          fileReader.addEventListener('progress', e => {
               let progress = parseInt( (e.loaded * 100 ) / e.total );
               $progressBar.value = progress;
               $percentage.innerHTML = `${progress}%`;
          });

          //When the file load is end
          fileReader.addEventListener('loadend', async e => {
               $progressBar.value = 100;
               $percentage.innerHTML = '100%';
               const  upload = await uploader(file);

               (upload === true)
                    ? $status.innerText = 'Complete!!!'
                    : displayErrors( $itemContainer, $progressBar, $status, $containerData, file, upload.errors )
          });
     };

//------------------------------------------------------
     const uploader = async (file) => {
          const formData = new FormData();
               formData.append('file', file);
          
          let res =await submitData(formData, 'add_image');
          return (res.ok) ? true : res;
     };

//------------------------------------------------------
     const validateFile = (file) => {
          const imgExt = file.name.split('.'),
               imgActualExt = imgExt[imgExt.length-1],
               allowed = ['jpg', 'jpeg', 'png', 'gif'],
               errors = {};

          if(!allowed.includes(imgActualExt))
               errors['errorFileExtension'] = ['Invalid file extension'];

          if(file.size > (5 * 1024 * 1024))
               errors['errorFileSize'] = ['The maximum size is: 5Mb'];

          return (JSON.stringify(errors) === '{}')
               ? true
               : errors;
     };

//------------------------------------------------------
     const displayErrors = ( $itemContainer, $progressBar, $status, $containerData, file, errors) => {
          $itemContainer.classList.add('error');
          $itemContainer.removeChild($progressBar);
          $status.innerText = `Error - ${file.name}`;
          $containerData.innerHTML = '';

          let $list = d.createElement('ul');

          for( const [key, value] of Object.entries(errors) )
               value.forEach( er => {
                    let $li = d.createElement('li');
                    $li.insertAdjacentText("afterbegin", er);
                    $list.insertAdjacentElement("beforeend", $li);
               });
          $containerData.insertAdjacentElement('beforeend', $list);
     };

//------------------------------------------------------
     const buildItem = (file) => {
          const $itemContainer = d.createElement('div'),
               $progressContent = `
               <h3>Uploading...</h3>
               <div class='progress-container__data'>
                    <span class='progress-container__percentage percentage'></span> - 
                    <span class='progress-container__name filename'></span>
               </div>
               <progress class='progress-container__bar' value='80' max='100'></progress>
               <button class=''progress-container__close btn-close'>
                    <img src="img/plus.svg" alt=""class="icon-btn btn-close">
               </button>
          `;
          
          $itemContainer.classList.add('progress-container__item');
          $itemContainer.insertAdjacentHTML('afterbegin', $progressContent);
          $progressContainer.insertAdjacentElement('beforeend', $itemContainer);
          $itemContainer.offsetWidth;
          $itemContainer.classList.add('open');

          let $progressBar = $itemContainer.querySelector('progress'),
               $fileName = $itemContainer.querySelector('.filename'),
               $percentage = $itemContainer.querySelector('.percentage'),
               $status = $itemContainer.querySelector('h3'),
               $containerData = $itemContainer.querySelector('.progress-container__data');

          $progressBar.value = 0;
          $progressBar.max = 100;
          $fileName.insertAdjacentText('afterbegin', file.name);

          return {
               $itemContainer: $itemContainer,
               $progressBar: $progressBar,
               $fileName: $fileName,
               $percentage: $percentage,
               $status: $status,
               $containerData: $containerData
          }
     }
})();