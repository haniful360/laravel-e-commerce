import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// brand image show
    const fileInput = document.getElementById('myFile');
    const preview = document.getElementById('imgpreview');
    const previewImg = preview.querySelector('img');

    fileInput.addEventListener('change', function(e) {
        const [file] = fileInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
